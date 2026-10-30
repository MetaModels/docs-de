.. _rst_cookbook_mcp_event-management:

Eventverwaltung mit einem KI-Agenten
====================================

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
   * - Das Badge "Abgesagt" fehlt.
     - Das ist eine Sache des Templates, die Werkzeuge schreiben keine Templates - siehe
       :ref:`Templates <rst_cookbook_templates_index>`.

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
