.. _rst_cookbook_mcp_event-management:

Eventverwaltung mit einem KI-Agenten
====================================

**Stand: 03.11.2026**

Dieses Rezept zeigt, wie ein KI-Agent über :ref:`MCP <rst_extended_mcp-admin>` eine komplette Eventverwaltung einrichtet:
mehrsprachige MetaModels, Eingabemaske, Render-Einstellungen, Filter, Seiten und Beispieldaten. Es ist ein
**Gesprächsverlauf in Schritten**, kein Skript: Der Agent arbeitet am besten, wenn man ihn in kleinen Schritten führt
und nach jedem Schritt das Ergebnis prüft. Wie Liste und Detailseite von Hand aufgebaut werden, steht im Rezept
:ref:`Liste mit Detailseite <rst_cookbook_frontend_list-with-detail-page>`.

.. note:: Die Antworten hängen vom Agenten und vom Sprachmodell ab, sie fallen anders aus als hier beschrieben. Die Prompts
   sind Vorlagen zum Anpassen und keine Garantie für ein bestimmtes Ergebnis.

.. contents::
   :local:
   :depth: 1


Voraussetzungen
---------------

* Der Agent ist mit dem MCP-Server verbunden und das Schreiben ist eingeschaltet, siehe
  :ref:`MCP-Administration <rst_extended_mcp-admin>`. Das Schreiben ist standardmäßig aus, weil der Agent mit den Rechten
  des Backend-Benutzers handelt - es ist für Entwicklungs- und Testsysteme gedacht, nicht für eine Live-Seite.
* Im ersten Prompt nennt man die Adresse der Seite und des MCP-Servers - z. B. ``https://example.org/`` und
  ``https://example.org/contao/mcp``.
* Bei Claude startet man den Agenten am besten in der **Konsole** (``claude`` im Projektordner) und prüft vor dem ersten
  Prompt mit ``/mcp``, dass der Server *connected* und *authenticated* meldet. Die Desktop-App verlor im Test mehrfach die
  Verbindung, siehe :ref:`MCP-Administration <rst_extended_mcp-admin>`. Ein ``codex mcp login contao`` (Codex) oder ``/mcp``
  (Claude) genügt, wenn die Anmeldung abgelaufen ist.
* Der Agent braucht den **ganzen Auftrag in der Sitzung**. Startet man nach einem Abbruch eine neue Sitzung, gibt man den
  Wunsch aus Schritt 1 und die Entscheidungen aus dem Plan noch einmal mit.
* Sollen die Seiten in mehreren Sprachen entstehen, braucht Contao je Sprache eine **Startseite** (Root-Seite). Ohne
  sie legt der Agent keine Seiten für diese Sprache an und fragt - die Texte der Events sind dann trotzdem
  mehrsprachig. Die Startseite legt man vorher an oder lässt sie als eigenen Schritt vom Agenten anlegen.


1. Wunsch beschreiben und prüfen lassen
---------------------------------------

Man beschreibt, was gebraucht wird, und lässt den Agenten zuerst **prüfen**, nicht bauen:

.. code-block:: text

   Ich möchte eine Eventverwaltung mit folgenden Funktionen erstellen:

   * Mehrsprachig mit DE, EN, FR - DE ist Standard
   * Zuordnung zu einer Kategorie: Konferenz, Workshop, Seminar
   * Eventstatus: veröffentlicht und abgesagt
   * Zuordnung zu einem oder mehreren Schlagworten: Sport, Musik, Theater, pers. Entwicklung, Ökologie
   * Felder eines Events: Titel, Beschreibung, Bild, Datum, mehrtägig, Uhrzeit, Ort, Preis,
     max. Anzahl der Teilnehmer, Kontaktinformationen
   * Wenn mehrtägig, dann soll es auch ein Enddatum geben
   * Eine Liste der veröffentlichten Events mit Titel, Bild (Thumbnail), Datum, Uhrzeit, Ort,
     absteigend nach Datum sortiert
   * Filtern nach Kategorie, nach Schlagwort, nach Datumsbereich von bis
   * Link zu den Eventdetails - dafür eine eigene Seite mit allen Details des Events

   Contao läuft unter https://example.org/, der MCP-Server unter https://example.org/contao/mcp
   Prüfe vorher meine Angaben und gib ein Feedback, wie wir vorgehen könnten.

**Zu prüfen:** Meldet der Agent fehlende Pakete? Für die Mehrsprachigkeit braucht es z. B.
``attribute_translatedtext`` und ``attribute_translatedalias``. Der Agent nennt die Pakete und den Zugang (viele sind im
Early-Adopter-Programm) und installiert sie nicht selbst. Man installiert sie, aktualisiert die Datenbank und lässt den
Agenten die Typen mit ``metamodels_check_types`` neu prüfen, bevor es mit Schritt 2 weitergeht. Eine einsprachige
Ausweichlösung ist keine Option, weil sie die Aufgabe verfehlt.

Fragt der Agent bei Mehrdeutigem nach (z. B. "Eventstatus")? Sagt er, was er nicht kann? Zur Bedingung "Enddatum nur bei
mehrtägig" legt er eine :ref:`Ansichtsbedingung <component_dca_visibility-conditions>` an. Er soll sie im Plan nennen.


2. Planen lassen, nichts schreiben
----------------------------------

.. code-block:: text

   Plane die MetaModels (nichts schreiben) und zeige mir den Plan und die Datenbankbefehle.

Der Plan nennt die Tabellen, Attribute, Eingabemaske, Render-Einstellungen und Filter und enthält Hinweise des
Planers. Hier ist der richtige Moment für Korrekturen:

.. code-block:: text

   Ändere den Plan: Die Haupttabelle heißt mm_event_events, damit alle MetaModels das Präfix mm_event_ haben.
   Statt eines Hilfsmodells für den Status nimm zwei Checkboxen published und cancelled. published steuert,
   was die Liste zeigt (Filter), cancelled ist nur ein Hinweis bei der Ausgabe. Der Preis ist eine Dezimalzahl
   (Typ decimal), max_participants vom Typ numeric. Der Ort wird übersetzt (translatedtext), die Kontaktfelder
   bleiben für alle Sprachen gleich. Plane dazu Eingabemaske, Render-Einstellung und den Filter
   (Kategorie, Schlagwort, Datum von-bis) und zeig mir die Änderung.

**Zu prüfen:** Stimmen Tabellennamen, Typen und Übersetzungen? Der Plan zeigt jede Zeile als *anlegen*, *ändern* oder
*vorhanden* - es ändert sich nur, was er nennt.


3. Anwenden und Tabellen anlegen
--------------------------------

.. code-block:: text

   Wende die Pläne für Kategorien, Schlagworte und Events an und lege die Tabellen an. Zeig mir das Ergebnis
   mit metamodels_describe für alle drei und nenne mir die journal_id jedes Schreibvorgangs.
   Seiten und Datensätze kommen erst im nächsten Schritt.

Der Agent wendet die MetaModels nacheinander an: erst Kategorien und Schlagworte, dann die Events, weil diese darauf
verweisen. Meldet er, ein Plan sei veraltet, plant er neu - das ist normal und kein Fehler.

**Zu prüfen:** Sind die drei MetaModels im Backend sichtbar und lassen sie sich öffnen? Falls nicht, fehlt die Zuordnung
zum Backend - dann bittet man den Agenten, die ``assignments`` mit ``metamodels_describe`` zu prüfen und zu ergänzen.

Erscheint im Backend das Enddatum eines neuen Events erst, wenn man "Mehrtägig" anklickt? Das setzt voraus, dass die
Checkbox "Absenden bei Änderungen" hat, der Planer weist darauf hin. Fehlt die Bedingung, bittet man den Agenten, sie
nachzutragen, z. B. "Das Enddatum soll nur erscheinen, wenn Mehrtägig gesetzt ist. Plane zuerst und zeig mir den Plan."
Sind Titel und Startdatum, aus denen der Alias entsteht, keine Pflichtfelder, weist der Planer ebenfalls darauf hin.


4. Seiten, Artikel und Inhaltselemente
--------------------------------------

.. code-block:: text

   Lege jetzt die Seiten an, sag mir vorher kurz, was du anlegst. Eine Seite mit der Eventliste (Filter und
   Liste, absteigend nach Startdatum, nur veröffentlichte Events) und eine Detailseite für ein Event.
   Die Detailseite ist über den Link der Liste erreichbar. Nutze dafür die contao_api_*-Werkzeuge. Die Datensätze
   kommen erst im nächsten Schritt. Wo etwas nicht mit den Werkzeugen geht, sag es mir.

.. tip:: Wenn der Agent in der Contao-API ein Werkzeug sucht, hilft ein **einzelnes Wort im Singular** als
   Suchbegriff (z. B. "page" statt "Seiten anlegen").

Gibt es schon Seiten für Liste und Detail (z. B. aus einem früheren Versuch), nutzt der Agent sie weiter, statt Duplikate
anzulegen, und sagt es. Man sollte vorher wissen, welche Seiten es gibt, sonst bleibt unklar, was von ihm stammt (wichtig
beim Zurücknehmen, siehe Schritt 7). Die Filter stehen vor der Liste im selben Artikel, die Detailseite ist versteckt und
verlangt ein Element (``requireItem``). Die Filter laufen über die **Adresse** (``/kategorie/workshop``,
``/schlagwort/musik``, ``/datum/2026-11-01,2026-11-30``), nicht über ``?kategorie=workshop``.

Für die Seiten und Inhaltselemente braucht der Agent die Contao-API. Codex fragt bei jedem Aufruf von
``contao_api_execute`` nach Bestätigung.


5. Beispieldaten anlegen
------------------------

.. code-block:: text

   Lege die Datensätze an: die 3 Kategorien (Konferenz, Workshop, Seminar) und die 5 Schlagworte jeweils in DE, EN
   und FR, danach 10 Dummy-Events, ebenfalls in DE, EN und FR, mit einer Kategorie und einem bis drei
   Schlagworten, einige mehrtägig mit Enddatum, ein bis zwei abgesagt, zwei nicht veröffentlicht.
   Nutze dafür contao_api_mm_<tabelle>_post und lang. Jedes Event bekommt ein Bild: einfache Farbflächen.
   Wenn dir etwas fehlt, sag es mir.

Bei einem mehrsprachigen MetaModel schreibt der Agent jede Sprache einzeln - bei 10 Events in 3 Sprachen also 30
Schreibvorgänge. Das dauert.

.. warning:: Den **Alias** erzeugt MetaModels erst beim Speichern im Backend. Über die Contao-API muss der Agent den Wert
   mitgeben, sonst fehlen die Detail-Links, siehe :ref:`Liste mit Detailseite <rst_cookbook_frontend_list-with-detail-page>`.
   Im Test blieb der Alias nach dem Anlegen leer. Erst ein zweiter Schreibvorgang (``PATCH``) bildete ihn aus Titel und
   Startdatum (z. B. ``klimaschutz-konferenz-2026-2026-11-20``); vom Agenten mitgegebene Werte wurden dabei überschrieben.
   Man lässt ihn nach dem Anlegen prüfen, dass jedes Event in jeder Sprache einen Alias hat.


6. Ausgabe prüfen und nachbessern
---------------------------------

Man öffnet die Listenseite im Browser und prüft sie. Typische Nachbesserungen und der passende Prompt:

.. list-table::
   :header-rows: 1
   :widths: 40 60

   * - Beobachtung
     - Prompt (Kern)
   * - Die Liste zeigt auch unveröffentlichte Events.
     - "Prüfe, woran das liegt, und behebe es." (Es fehlt die Filterregel *Checkbox-Status* auf ``published``.)
   * - Das Bild erscheint als Dateiname.
     - "Das Bild soll in der Liste als Thumbnail erscheinen."
   * - Die Bildgröße stimmt nicht.
     - "Lege die Bildgröße 120 x 68 Pixel (proportional) bei Contao an und wähle sie in der Render-Einstellung der
       Liste." (Bildgrößen sind eine Einstellung von Contao, MetaModels wählt sie nur aus.)
   * - Die Links enden auf ``/published/1``.
     - "Finde die Ursache: Die Links sollen /de/veranstaltung/<alias> lauten, ein unveröffentlichtes Event soll
       auch über einen Lesezeichenlink nicht erscheinen, die Aliase sollen im Backend aus Titel und Startdatum
       entstehen."
   * - Das Badge "Abgesagt" fehlt, oder es steht "Abgesagt: 1".
     - "Baue den Hinweis "Abgesagt" in der Liste: Statt "Abgesagt: 1" soll bei abgesagten Events ein gut sichtbarer
       Hinweis erscheinen, bei den anderen nichts. Nutze dafür ein Template." Die MCP-Administration schreibt keine
       Templates, der Agent legt die Datei mit den Template-Werkzeugen von Contao an oder schreibt sie selbst und trägt
       sie in der Render-Einstellung der Liste ein. Siehe unten und :ref:`Templates <rst_cookbook_templates_index>`.
   * - Auf der Detailseite steht weiter "Abgesagt: 1".
     - Der Agent ändert nur, was verlangt wurde. Mit "Mach das auch auf der Detailseite" stellt er die Render-Einstellung
       der Detailseite um.
   * - Für eine Sprache gibt es keine Seiten.
     - Es fehlt die Startseite dieser Sprache, siehe Voraussetzungen.
   * - Der Filter über der Liste fehlt oder tut nichts.
     - "Prüfe, ob über der Liste das Filter-Element steht, und rufe die Liste mit /kategorie/workshop auf." Die Filter
       sind ein eigenes Inhaltselement und laufen über die Adresse, nicht über ``?kategorie=``.

Bei Korrekturen fordert man den Agenten auf, **die Hilfe und die Hinweise des Planers neu zu laden**
(``metamodels://guide/overview``), wenn sich das System seit dem Start des Gesprächs geändert hat.


7. Journal und Zurücknehmen
---------------------------

.. code-block:: text

   Zeig mir das Journal. Was würde passieren, wenn ich alles wieder zurücknehme (nur anzeigen, noch nichts bestätigen)?
   Sag mir, was sich zurücknehmen lässt, was nicht und warum.

Solange Datensätze in den Tabellen stehen, verweigert ``metamodels_undo`` das Zurücknehmen der MetaModels. Seiten,
Artikel und Inhaltselemente stehen nicht im Journal, sie entstehen über die Contao-API. Mehr dazu unter
:ref:`Zurücknehmen <rst_extended_mcp-admin>`.

Im Test lief das Zurücknehmen so ab, und so sollte man es auch führen:

1. Der Agent zeigt das Journal (hier fünf Einträge) und prüft jeden Eintrag ohne ``confirm``.
2. Er meldet, dass die Konfiguration nur bei leeren Tabellen zurückgeht, und löscht zuerst seine Inhaltselemente,
   Artikel, Seiten, die Bildgröße und die Template-Datei, danach die Datensätze (bei übersetzten MetaModels mit ``lang``).
3. Dann nimmt er die Journal-Einträge zurück, den neuesten zuerst.
4. Er prüft das Ergebnis (Zahl der MetaModels, Seiten, Inhaltselemente) und sagt, was bleibt.

Geblieben sind die **leeren Tabellen** ``mm_event_categories``, ``mm_event_tags`` und ``mm_event_events`` (``DROP TABLE``
von Hand, wenn man sie nicht will) und die Seiten, die es schon vorher gab. Der Agent hat sie nicht selbst gelöscht und
das gesagt - so soll es sein. Der Auftrag "nimm alles zurück" ist allerdings weit gefasst: Der Agent löschte die
Beispieldaten und seine Seiten ohne Rückfrage mit. Wer das nicht will, schreibt es dazu ("Die Datensätze bleiben").


Was im Test herauskam
---------------------

Der Ablauf wurde mit Claude Code in der Konsole durchgespielt (Pakete ``attribute_translated*`` installiert, Schreiben
eingeschaltet):

* **Planen:** Drei Pläne, Tabellen und Datenbankbefehle, nichts geschrieben. Der Agent meldete selbst, was offen
  bleibt (Datumsfilter, Hinweis "Abgesagt", Bildgröße).
* **Anwenden:** Drei MetaModels (de, en, fr), Kategorien und Schlagworte, sieben Beispiel-Events in drei Sprachen, Liste und
  Detailseite, die Bedingung für das Enddatum im Backend. Alle Angaben des Agenten stimmten mit der Datenbank überein.
* **Frontend:** Die Liste zeigte die veröffentlichten Events absteigend nach Datum, ohne den Entwurf. Die Filter nach
  Kategorie, Schlagwort und Datumsbereich funktionierten über die Adresse.
* **Hinweis "Abgesagt":** Ein Template zeigte ein rotes Badge nur beim abgesagten Event, sonst nichts.
* **Zurücknehmen:** Alle Journal-Einträge ließen sich zurücknehmen, die Zahlen entsprachen dem Stand davor.

Die Hürden und wie man sie umgeht:

.. list-table::
   :header-rows: 1
   :widths: 35 65

   * - Hürde
     - Was hilft
   * - Pakete für die Mehrsprachigkeit fehlen.
     - Der Agent nennt sie und installiert nichts. Man installiert sie, aktualisiert die Datenbank und lässt die Typen
       mit ``metamodels_check_types`` neu prüfen, bevor es weitergeht.
   * - Die Werkzeuge fehlen in der Sitzung oder verschwinden.
     - ``/mcp`` in der Konsole prüfen, neu anmelden, **neue** Sitzung starten, den Auftrag vollständig mitgeben. Nicht
       die Desktop-App für den Test nehmen.
   * - Das Token läuft ab (60 Minuten).
     - In der Konsole erneuert es der Client selbst. Bei Fehlern wie ``401`` erneut anmelden.
   * - Der Planer verlangt ``fe_memberAttribut``.
     - Der Agent trägt eine beliebige Spalte ein. Ohne Wirkung, solange die Mitgliederrechte aus sind.
   * - Der Datumsfilter findet mehrtägige Events nicht, die vor dem Zeitraum beginnen.
     - Der Filter ``fromtodate`` prüft nur das Startdatum. Für Überschneidungen braucht man einen Filter über Start und
       Ende (``rangedate``) - bewusst entscheiden und im Plan festhalten.
   * - Das Alias-Feld ist nach dem Anlegen leer.
     - Alias nach dem Anlegen prüfen lassen. MetaModels bildet ihn beim Schreiben aus Titel und Startdatum und
       überschreibt mitgegebene Werte.
   * - Keine Seiten in der dritten Sprache.
     - Es fehlt die Startseite dieser Sprache.
   * - "Abgesagt: 1" statt eines Hinweises.
     - Ein Template für das Attribut, siehe Schritt 6. Die Werkzeuge haben keinen Trockenlauf bei
       ``contao_template_create_override``: Der Agent soll vorher sagen, welche Datei entsteht, und danach prüfen, dass
       kein leeres Override für alle Checkboxen entstanden ist.
   * - Das Zurücknehmen verweigert.
     - Erst Datensätze löschen, dann ``metamodels_undo``, neuester Eintrag zuerst. Die leeren Tabellen bleiben.
   * - Das Journal erfasst nur einen Teil.
     - Seiten, Inhaltselemente, Bildgrößen, Datensätze und Template-Dateien stehen nicht darin. Man lässt den Agenten
       nennen, was er angelegt hat, und prüft ``git status`` und die Seitenstruktur.

Wer den Test wiederholen will, sichert vorher Datenbank, ``files/`` und das Journal und spielt sie zurück, wenn keine
Sitzung des Agenten läuft.


Wie es weitergehen kann
-----------------------

Das Rezept endet bei der **Einrichtung**: MetaModels, Eingabemaske, Render-Einstellungen, Filter, Seiten und
Beispieldaten. Die **Anpassung der Templates** ist nicht Teil davon und wurde im Test nicht behandelt. Sie ist der
nächste Schritt, denn die Ausgabe im Frontend entspricht danach dem Standard der Render-Einstellung. Zum Beispiel:

* ein Hinweis "Abgesagt" bei Events mit gesetzter Checkbox ``cancelled``, in der Liste und auf der Detailseite,
* die Darstellung von Bild, Datum und Ort in der Liste und der Aufbau der Detailseite,
* Klassen und Gestaltung für das eigene Layout.

Die Werkzeuge schreiben keine Templates. Man legt sie von Hand an, siehe :ref:`Templates <rst_cookbook_templates_index>`,
oder bespricht sie mit dem Agenten in einem eigenen Schritt, mit den Angaben, was das Template zeigen soll.
