.. _rst_extended_mcp-admin:

MetaModels MCP-Administration
=============================

Mit der MCP-Administration kann ein **KI-Agent** (z. B. Claude oder Codex) über den MCP-Server von Contao MetaModels
**auslesen und einrichten**: Er erfährt, welche Bausteine es gibt, prüft, welche Pakete für eine Aufgabe nötig sind,
und legt auf Wunsch ein MetaModel mit Attributen, Eingabemasken, Render-Einstellungen und Filtern an.

MCP (*Model Context Protocol*) ist ein offener Standard, über den KI-Programme mit Anwendungen sprechen. Contao 6
bringt dafür einen eigenen MCP-Server mit (``/contao/mcp``), die MCP-Administration erweitert ihn um das Wissen über
MetaModels. Die **Datensätze** der MetaModels sind über die :ref:`Contao-API <rst_extended_contao-api>` erreichbar,
die ebenfalls über diesen Server angeboten wird.

.. note:: Die Erweiterung ist Teil des **Standardpakets** im "Early-Adopter-Programm" (EAP) - mehr dazu unter
   **Fundraising** auf der `MM Webseite <https://now.metamodel.me/de/unterstuetzer/fundraising#metamodels_2-6>`_.

.. note:: Die Erweiterung ist ein früher Stand (*early*). Die zugrunde liegenden Bundles von Contao (API, MCP,
   OAuth-Server) sind noch nicht stabil - es gibt nur den Entwicklungszweig ``dev-main``.

.. warning:: Der Agent handelt mit den Rechten des Backend-Benutzers, der ihn verbunden hat. Das **Schreiben der
   Konfiguration ist deshalb standardmäßig ausgeschaltet** und für Entwicklungssysteme gedacht - nicht für
   Live-Seiten.

Voraussetzungen
---------------

* MetaModels core ab 2.6
* Contao 6.x und PHP 8.4
* ``contao/mcp-bundle`` und ``contao/oauth-server-bundle`` von Contao (zusammen mit dem ``contao/api-bundle``)
* für den Zugriff auf Datensätze zusätzlich :ref:`metamodels/contao-api <rst_extended_contao-api>`
* Ein Administrator-Konto im Backend - alle Werkzeuge erfordern die Rolle ``ROLE_ADMIN``


Installation per Composer
-------------------------

Solange die Bundles von Contao nicht auf Packagist veröffentlicht sind, müssen die Repositories in der
``composer.json`` des Projektes eingetragen werden:

.. code-block:: bash

   composer config repositories.contao-api-bundle vcs https://github.com/contao/api-bundle.git
   composer config repositories.contao-mcp-bundle vcs https://github.com/contao/mcp-bundle.git
   composer config repositories.contao-oauth-server-bundle vcs https://github.com/contao/oauth-server-bundle.git
   composer require contao/api-bundle:dev-main contao/mcp-bundle:dev-main contao/oauth-server-bundle:dev-main
   composer require metamodels/contao-api metamodels/mcp-admin

Danach die Datenbank aktualisieren (Contao-Manager, ``contao-setup`` oder
``php vendor/bin/contao-console contao:migrate``) - der OAuth-Server legt dabei die Tabelle ``oauth_server_token`` an.

.. note:: Die Adressen unter ``/.well-known/`` müssen vom Webserver an Contao weitergegeben werden. Manche
   Konfigurationen sperren alle Dateien, die mit einem Punkt beginnen - dann ist die Anmeldung des Agenten nicht
   möglich (der Server antwortet mit ``403``).


Einen Agenten verbinden
-----------------------

Der MCP-Server hat die Adresse ``https://<Domain>/contao/mcp``. Die Anmeldung läuft über OAuth: Der Agent öffnet das
Backend, nach der Anmeldung fragt Contao *„Connect … with Contao?“* und weist darauf hin, dass der Agent alles tun darf,
was der Benutzer im Backend darf. Mit der Zustimmung erhält der Agent ein Token, das er selbst erneuert.

Bei Codex sieht das so aus:

.. code-block:: bash

   codex mcp add contao --url https://example.org/contao/mcp
   codex mcp login contao

Bei Claude Code wird der Server als HTTP-Server eingetragen. Die Anmeldung startet man im Programm mit ``/mcp``: Server
auswählen, *Authenticate*, im Browser anmelden und zustimmen.

.. code-block:: bash

   claude mcp add --transport http contao https://example.org/contao/mcp

.. note:: **Claude: besser in der Konsole als in der Desktop-App.** Im Test lief die Verbindung in der Konsole (``claude``
   im Projektordner) stabil, auch die Erneuerung des Tokens nach etwa einer Stunde. In der Desktop-App brach sie mehrfach
   ab: über Nacht, nach einem Neustart der Datenbank und einmal mitten in der Sitzung, jeweils ohne Fehler im Server. Dort
   gibt es kein ``/mcp``, und die Seite *Konnektoren* verlangt eine öffentliche https-Adresse - ein System auf
   ``127.0.0.1`` lässt sich dort nicht eintragen. Wer die App nutzen will, trägt den Server mit ``claude mcp add`` ein (oder
   legt im Projektordner eine ``.mcp.json`` an), meldet ihn einmal in der Konsole mit ``/mcp`` an und startet danach eine
   **neue** Sitzung in der App.

   Vor dem ersten Prompt prüft man in der Konsole mit ``/mcp``, ob der Server *connected* und *authenticated* meldet.
   Eine laufende Sitzung lädt den Server nicht nach: Wurde er beim Start der Sitzung nicht erreicht (Datenbank neu
   gestartet, Anmeldung abgelaufen), hilft auch ein *Reconnect* nicht, erst eine neue Sitzung.

Contao erlaubt nur Clients, die sich mit einem öffentlichen Dokument (*Client ID Metadata Document*) ausweisen und
deren Domain freigegeben ist. Vorbelegt sind ``chatgpt.com`` (Codex), ``claude.ai`` und ``vscode.dev``. Weitere Clients
werden freigegeben mit:

.. code-block:: yaml

   # config/config.yaml
   contao_oauth_server:
       cimd_trusted_domains: ['example.org']

Der Server holt das Dokument des Clients selbst aus dem Internet - das System braucht dafür eine ausgehende
Verbindung. Getestet sind die Anmeldung und der Ablauf mit Codex und mit Claude Code (lesen, schreiben, planen,
anwenden und zurücknehmen).

.. note:: Für den Aufruf von ``contao_api_execute`` (Daten lesen und schreiben) verlangt Codex je Aufruf eine
   Bestätigung, weil das Werkzeug nicht als *schreibgeschützt* gekennzeichnet ist.


Was der Agent kann
------------------

Die MCP-Administration ergänzt den Server von Contao um folgende Elemente:

.. list-table::
   :header-rows: 1
   :widths: 35 15 50

   * - Name
     - Art
     - Aufgabe
   * - ``metamodels://guide/overview``
     - Ressource
     - Anleitung: die Bausteine eines MetaModels, die Reihenfolge beim Anlegen und wie man die nötigen Pakete findet.
   * - ``metamodels://catalog/types``
     - Ressource
     - Alle bekannten Attribut- und Filtertypen mit Paket, Kurzbeschreibung, Verfügbarkeit und ob sie hier installiert
       sind.
   * - ``metamodels://catalog/articles``
     - Ressource
     - Seiten des Handbuchs zu Themen (z. B. Relationen, Mehrsprachigkeit) und Rezepte des Kochbuchs.
   * - ``metamodels://schema/{kind}/{type}``
     - Ressource
     - Die Einstellungen, die ein Typ kennt: Eingabe, Regeln, Vorgaben, Auswahlwerte und Beschriftungen.
   * - ``metamodels_search_catalog``
     - Werkzeug
     - Findet Typen, Erweiterungen und Handbuchseiten zu einer Aufgabe, aus wenigen Worten. Die Sprache der Worte wird im Parameter ``language`` angegeben (Vorgabe ``en``).
   * - ``metamodels_list``
     - Werkzeug
     - Alle MetaModels mit Tabelle, Sprachen und der Anzahl der Attribute, Eingabemasken, Render-Einstellungen und
       Filter.
   * - ``metamodels_describe``
     - Werkzeug
     - Die Konfiguration eines MetaModels: Attribute, Eingabemasken mit Feldern und Ansichtsbedingungen,
       Render-Einstellungen, Filter.
   * - ``metamodels_check_types``
     - Werkzeug
     - Prüft die Typen, die eine Aufgabe braucht: Fehlende werden mit dem ``composer require``-Befehl genannt.
   * - ``metamodels_plan``
     - Werkzeug
     - Prüft eine Beschreibung eines MetaModels und zeigt die Datenbankzeilen und -befehle. Schreibt nichts.
   * - ``metamodels_apply``
     - Werkzeug
     - Schreibt die geplanten Zeilen in einer Transaktion. Braucht den Schalter ``write``.
   * - ``metamodels_migrate_schema``
     - Werkzeug
     - Legt Tabellen und Spalten des MetaModels an. Braucht den Schalter ``write``.
   * - ``metamodels_journal``
     - Werkzeug
     - Zeigt, was ``metamodels_apply`` angelegt und geändert hat.
   * - ``metamodels_undo``
     - Werkzeug
     - Nimmt einen Schreibvorgang zurück. Braucht den Schalter ``write``.

Eine Installation von Paketen bleibt immer beim Menschen: Der Agent erfährt, was fehlt, und nennt den Befehl - Composer
wird über MCP nicht ausgeführt.

Beispiele für Aufträge an den Agenten:

* *„Welche MetaModels gibt es und was für Attribute hat das MetaModel Mitarbeiter?“*
* *„Ich brauche ein MetaModel für Veranstaltungen mit Titel, Datum, Ort und einem Preis. Welche Pakete brauche ich?“*
* *„Lege das MetaModel an und zeige mir vorher den Plan.“*
* *„Zeige mir alle Mitarbeiter der Abteilung Vertrieb.“* (über die Contao-API)

Ein ausführliches Beispiel steht im Kochbuch: :ref:`Eventverwaltung mit einem KI-Agenten <rst_cookbook_mcp_event-management>`.


Pakete prüfen und Zugang
------------------------

Nicht jedes Paket steht frei zur Verfügung - viele Erweiterungen sind noch im Fundraising. Der Agent bekommt diese
Angaben aus den Metadaten (siehe unten): Bei einem Paket im Early-Adopter-Programm empfiehlt er kein
``composer require``, sondern nennt die Seite, auf der man den Zugang erhält.


Konfiguration schreiben
-----------------------

Das Schreiben ist für Entwicklungssysteme gedacht und standardmäßig ausgeschaltet:

.. code-block:: yaml

   # config/config.yaml
   meta_models_mcp_admin:
       write: true

Der Ablauf besteht aus drei Schritten:

1. ``metamodels_plan`` nimmt die Beschreibung (MetaModel, Attribute, Eingabemasken, Render-Einstellungen, Filter und
   die Zuordnung zum Backend) entgegen und prüft sie wie das Backend: installierte Typen, Tabellen- und Spaltennamen,
   Einstellungen des Typs. Die Antwort enthält die Probleme oder die geplanten Zeilen mit einer ``plan_id``.
2. ``metamodels_apply`` schreibt die Zeilen in einer Transaktion - nur für die ``plan_id`` des aktuellen Plans.
3. ``metamodels_migrate_schema`` führt die Datenbankbefehle von Contao für die Tabellen dieses MetaModels aus
   (``mm_<name>`` und ``mm_<name>_*``). Befehle, die etwas löschen, umbenennen oder leeren, werden nie ausgeführt.

Ein MetaModel braucht eine Eingabemaske und Render-Einstellungen, die den Backend-Benutzern zugeordnet sind, damit es
im Backend geöffnet werden kann. Beides wird für das erste MetaModel automatisch angelegt.

Soll das MetaModel im Backend in einer **eigenen Navigationsgruppe** erscheinen, setzt der Agent an der Eingabemaske den
Backend-Bereich. Die Gruppe selbst ist Konfiguration (``meta_models_core.be_sections`` in der ``config/config.yaml``,
siehe :ref:`Eigene Sektion in der Backend-Navigation <rst_cookbook_tips_backend-section>`) und kann der Agent nicht
schreiben. Er nennt, was einzutragen ist. Danach den Cache leeren. Ohne die Gruppe erscheint das MetaModel nicht in der
Navigation.

Für **Checkboxen** setzt der Agent zwei Dinge selbst:

* Das Feld einer neuen Checkbox in der Eingabemaske bekommt die CSS-Klassen ``w50 cbx m12``, damit es mit den Feldern
  daneben fluchtet. Eine ``tl_class``, die in den Einstellungen des Feldes steht, ersetzt sie.
* Nutzt ein Filter die Checkbox als „veröffentlicht“ (Regel ``checkbox_published`` bzw. ``translatedcheckbox_published``),
  schaltet der Agent am Attribut die Option **Wechselicon** (``check_publish``) ein. Die Liste im Backend zeigt dann das
  übliche Auge zum Umschalten. Mit ``"check_publish": false`` in den Einstellungen des Attributs bleibt sie aus. Das gilt
  auch für ein vorhandenes Attribut, an dem die Option noch fehlt.

Ein neues **Alias**-Attribut (``alias`` und ``translatedalias``) startet wie im Backend mit den Optionen **Eindeutig**
(``isunique``) und **Immer aktualisieren** (``force_alias``, beim übersetzten Alias ``force_talias``). In einem MetaModel
mit Varianten setzt der Agent sie nicht, dort sind eindeutige Werte nicht möglich. Mit ``false`` in den Einstellungen des
Attributs bleibt eine Option aus. Andere Attributtypen bekommen diese Vorgaben nicht.

Ein Feld der Eingabemaske kann an eine :ref:`Ansichtsbedingung <component_dca_visibility-conditions>` geknüpft werden,
z. B. das Enddatum eines Events nur dann, wenn die Checkbox "Mehrtägig" gesetzt ist. Der Agent legt sie beim Feld an
(``conditions``). Dabei gilt:

* Die Bedingungen einer Ebene sind mit UND verknüpft, ein Wrapper ``conditionand`` ist nicht nötig.
* Das Feld des Attributs, auf das sich die Bedingung bezieht (hier "Mehrtägig"), braucht die Option "Absenden bei
  Änderungen". Ohne sie zeigt das Backend die Wirkung erst nach dem Speichern. Der Planer weist darauf hin.
* Die Typen kommen aus dem Core: *Eigenschaftswert ist*, *Eigenschaft enthält einen von*, *Eigenschaft ist sichtbar*
  sowie die Container *UND*, *ODER* und *NICHT*.

Nach dem Anlegen kennt die Contao-API das MetaModel sofort. Damit es im Frontend erscheint, legt der Agent Seite,
Artikel und ein Inhaltselement vom Typ *MetaModel-Liste* (``metamodel_content``) an.

Die Beschreibung ist der **gewünschte Zustand**, auch für Vorhandenes: Der Plan zeigt jede Zeile als *anlegen*,
*ändern* (mit den neuen und den bisherigen Werten) oder *vorhanden*. Nur was die Beschreibung nennt, wird geändert;
alles andere bleibt unberührt.

Nicht unterstützt (wird als Problem gemeldet): ein anderer Typ oder eine andere Spalte für ein vorhandenes Attribut,
ein anderer Typ oder ein anderes Attribut für eine vorhandene Filterregel oder Ansichtsbedingung, Sprachen hinzufügen, Varianten umschalten
und die Reihenfolge ändern. Gelöscht wird nichts - außer beim Zurücknehmen eines Schreibvorgangs.


Zurücknehmen
------------

Die meisten Konfigurationstabellen kennen im Backend keine Versionen. Deshalb schreibt jedes ``metamodels_apply`` ein
**Journal** (eine JSON-Datei in ``var/mm_mcp_admin/journal``) mit den angelegten und geänderten Zeilen - in derselben
Transaktion: Kann das Journal nicht geschrieben werden, bleibt vom Schreiben nichts stehen.

``metamodels_undo`` löscht die angelegten Zeilen und stellt die Werte geänderter Zeilen wieder her. Ohne ``confirm``
zeigt es nur, was passieren würde. Es verweigert das Zurücknehmen und ändert nichts, wenn

* eine Zeile seit dem Schreiben verändert wurde,
* darunter etwas hinzugefügt wurde (ein Attribut, ein Feld, eine Filterregel) oder
* ein MetaModel gelöscht werden soll, dessen Tabelle Datensätze enthält.

Tabellen und Spalten bleiben bestehen, die Datenbankaktualisierung löscht nichts. Ein Journal kann einmal
zurückgenommen werden. Alle Schreibvorgänge stehen im System-Log von Contao.

**Was das Journal nicht kennt.** Es enthält nur, was ``metamodels_apply`` geschrieben hat. Datensätze, Seiten, Artikel,
Inhaltselemente, Bildgrößen und Template-Dateien entstehen über die Contao-API oder von Hand und stehen nicht darin.
Soll ein Test **vollständig** zurückgenommen werden, geht man in dieser Reihenfolge vor und lässt den Agenten jeden
Schritt zeigen, bevor er ihn ausführt:

1. Inhaltselemente, Artikel und Seiten entfernen, die der Agent angelegt hat, ebenso eine angelegte Bildgröße und eine
   Template-Datei. Vorhandenes, das der Agent nur mitbenutzt hat, bleibt.
2. Die Datensätze der MetaModels löschen (bei übersetzten MetaModels je Sprache, mit ``lang``). Erst dann lässt
   ``metamodels_undo`` die MetaModels zu.
3. ``metamodels_undo`` mit dem **neuesten** Eintrag des Journals beginnen und rückwärts gehen. Zuerst ohne ``confirm``,
   das zeigt, was passiert.
4. Die leeren Tabellen (``DROP TABLE``) löscht man von Hand, wenn sie stören. ``metamodels_migrate_schema`` löscht nie,
   und ein späteres ``contao:migrate`` kann sie als überzählig anzeigen.

Der Agent soll vorher sagen, was er löschen will. Ein Auftrag „nimm alles zurück“ kann er so verstehen, dass auch die
Beispieldaten und Seiten gehören, die er selbst angelegt hat.


Templates
---------

Templates schreibt nicht die MCP-Administration, sondern der MCP-Server von Contao mit seinen Template-Werkzeugen
(``contao_template_*``): Templates finden und lesen, den Code prüfen, die Nutzer eines Templates ermitteln, einen
Override anlegen und speichern sowie Wiederherstellungspunkte anlegen, vergleichen und zurückspielen. Damit kann der
Agent auch die Templates von MetaModels überschreiben, zum Beispiel einen Block der Seitennavigation
(``mm_pagination``) oder des Filters (``mm_filter_default``). Die :ref:`Twig-Blöcke <component_templates_twig-blocks>`
dieser Templates bleiben im Override erreichbar.

Wichtig dabei:

* Der Agent legt vor jeder Änderung einen **Wiederherstellungspunkt** an. Er gilt für das ganze Verzeichnis
  ``templates/`` und liegt im Cache der Anwendung - er ist kein dauerhaftes Backup.
* Die Prüfung des Codes zeigt nur, dass das Template übersetzt werden kann. Ob die Ausgabe stimmt, zeigt erst die
  Seite im Frontend.
* Die Analyse der Nutzer findet die Templates von MetaModels nicht: MetaModels lädt sie aus PHP, nicht über Twig. Der
  Agent meldet dann nur nicht auflösbare Verweise. Welche Listen ein Template nutzen, muss man im Frontend prüfen.
* ``contao_template_create_override`` kennt **keinen Trockenlauf**. Schickt der Agent trotzdem ``dry_run: true`` mit, wird
  der Parameter ohne Meldung ignoriert und die Datei entsteht. Im Test war das ein leeres Override für
  ``checkbox.html.twig``, das alle Checkboxen der Seite betroffen hätte. Der Agent hat es bemerkt und gelöscht. Man weist
  ihn an, vor jedem Anlegen zu sagen, welche Datei entsteht, und danach ``git status`` oder den Ordner ``templates/``
  zu prüfen.
* Für das Template eines **einzelnen Attributs** (z. B. ein Badge nur bei gesetzter Checkbox) bieten die Werkzeuge keine
  Variante an. Der Agent schreibt die Datei dann selbst und trägt den Namen in der Render-Einstellung des Attributs ein
  (Journal: eine Änderung, die Datei steht nicht darin). Im Test funktionierte beides: ein Twig-Template unter
  ``templates/metamodels/attribute/`` und ein klassisches ``.html5`` direkt in ``templates/`` (Name ``mm_attr_<typ>_…``).
  Die Datei liegt außerhalb des Journals und bleibt beim Zurücknehmen stehen.


Wissensbasis (Metadaten)
------------------------

Ein nicht installiertes Paket kann nicht mitteilen, welche Typen es mitbringen würde. Die Angaben zu den Paketen und
ihren Attribut- und Filtertypen kommen deshalb aus einer Metadaten-Datei des Repositories
`MetaModels/mcp-metadata <https://github.com/MetaModels/mcp-metadata>`_:

* je Paket: ob es frei verfügbar ist oder im Early-Adopter-Programm, wo man den Zugang erhält, eine Kurzbeschreibung,
  Stichworte (je Sprache) und die Seite im Handbuch,
* je Typ: das Paket, eine Kurzbeschreibung, Stichworte je Sprache und die Handbuchseite,
* je Artikel: eine Seite des Handbuchs zu einem Thema oder ein Rezept des Kochbuchs mit Titel, Pfad und Stichworten
  - nur ein Verweis, der Text bleibt im Handbuch.

Die Stichworte stehen je Sprache in einer eigenen Liste, ``en`` ist Pflicht, jede Liste hat höchstens 12 Einträge::

    "keywords": {"en": ["date", "time"], "de": ["datum", "uhrzeit", "termin"]}

Die Listen werden bewusst nicht gemischt, denn ein Wort kann je nach Sprache etwas anderes bedeuten. Bei der Suche zählen die
Stichworte der angegebenen Sprache voll, die englischen als Rückfall mit halbem Gewicht; Stichworte anderer Sprachen werden nicht
durchsucht. Das frühere flache Array wird nicht mehr gelesen.

Die Datei wird unter ``https://metamodels.github.io/mcp-metadata/metadata.json`` veröffentlicht. Die Erweiterung holt sie
von dort (nur über https), behält sie einen Tag und merkt sich die letzte valide Fassung. Ist der Server nicht erreichbar,
wird die Datei verwendet, die mit der Erweiterung ausgeliefert wird.

Ein System ohne Internetzugang oder eines, das solche Anfragen nicht senden darf, schaltet das Abrufen aus:

.. code-block:: yaml

   meta_models_mcp_admin:
       metadata:
           url: null        # Standard: 'https://metamodels.github.io/mcp-metadata/metadata.json'
           ttl: 86400       # Sekunden, wie lange die Datei behalten wird

.. note:: Die Metadaten sind Daten, keine Anweisungen: Texte mit Markup oder mit mehr als 240 Zeichen und Links, die
   nicht mit ``https`` beginnen, werden beim Lesen verworfen.


Konfiguration
-------------

.. code-block:: yaml

   # config/config.yaml
   meta_models_mcp_admin:
       write: false                     # Schreiben der Konfiguration erlauben (Standard: false)
       journal_dir: '%kernel.project_dir%/var/mm_mcp_admin/journal'
       metadata:
           url: 'https://metamodels.github.io/mcp-metadata/metadata.json'
           ttl: 86400

``journal_dir`` legt fest, wo die Journale der Schreibvorgänge liegen. Mit ``write`` wird das Schreiben freigegeben.


Tipps und häufige Fragen
------------------------

Ein vollständiges Beispiel Schritt für Schritt steht im Kochbuch unter
:ref:`Eventverwaltung mit einem KI-Agenten <rst_cookbook_mcp_event-management>`.

**Wie geht man am besten vor?**

* In kleinen Schritten, nach jedem Schritt das Ergebnis prüfen (Backend, Frontend).
* Zuerst **planen** lassen ("Plane …, schreibe noch nichts"), den Plan lesen und korrigieren, erst dann anwenden.
* Sagen, was **nicht** geschehen soll ("Seiten und Datensätze kommen erst im nächsten Schritt").
* Den Agenten nach jedem Schreibvorgang die ``journal_id`` nennen lassen.
* Bei Unklarheiten fragen lassen: "Wo etwas nicht mit den Werkzeugen geht, sag es mir."

**Der Agent findet die Werkzeuge nicht.**
Manche Agenten laden die Werkzeuge erst nach einigen Sekunden. Im Prompt nennt man den Server beim Namen (z. B. "nutze
den MCP-Server contao") und die Adresse des Servers. Bei einer abgelaufenen Anmeldung hilft eine erneute Anmeldung
(bei Codex ``codex mcp login contao``).

**Die Werkzeuge sind mitten im Gespräch weg.**
Der Server ist erreichbar, aber die Sitzung hat die Werkzeuge verloren (am häufigsten in der Desktop-App, siehe oben).
Man prüft in der Konsole mit ``/mcp`` den Status, meldet bei Bedarf neu an und startet eine **neue Sitzung**. Dort gibt man
den Auftrag noch einmal **vollständig** mit, denn die neue Sitzung kennt weder den Wunsch noch den bisherigen Plan.
Geschrieben ist bis dahin nur, was im Journal steht (``metamodels_journal``).

**Der Plan ist plötzlich veraltet.**
Schreibt der Agent mehrere Pläne nacheinander oder parallel, kann ein früher erstellter Plan ungültig werden (die
Reihenfolge der Zeilen hat sich geändert). Der Agent erkennt das und plant neu, man muss nichts tun. Man lässt ihn die
MetaModels deshalb nacheinander anwenden: erst Kategorien und Schlagworte, dann die Events.

**Der Agent bietet eine Dummy-Spalte an (``fe_memberAttribut``).**
Der Planer verlangt in der Eingabemaske ein Feld, das nur für Mitgliederrechte im Frontend gebraucht wird. Der Agent
füllt es mit einer beliebigen Spalte, das hat keine Wirkung, solange die Mitgliederrechte aus sind.

**Ein Test soll wiederholt werden.**
Das Journal reicht dafür nicht (siehe :ref:`Zurücknehmen <rst_extended_mcp-admin>`). Auf einem Testsystem sichert man vorher
Datenbank, ``files/`` und das Verzeichnis ``var/mm_mcp_admin/journal`` und spielt sie zurück - nicht, während eine
Sitzung des Agenten läuft.

**Der Agent meldet, ein Typ sei nicht installiert.**
Dann fehlt ein Paket, zum Beispiel für Mehrsprachigkeit (``attribute_translated*``). Der Agent nennt das Paket und
den Zugang. Man installiert es selbst und lässt die Typen mit ``metamodels_check_types`` erneut prüfen. Der Agent soll
nicht auf eine Variante ausweichen, die die Aufgabe verfehlt (etwa einsprachig statt mehrsprachig).

**Soll man "mehrsprachig" sagen?**
Ja, mit den Sprachen und der Standardsprache ("DE, EN, FR - DE ist Standard"). Dazu gehört, welche Felder übersetzt
werden sollen und welche für alle Sprachen gelten (z. B. Kontaktfelder).

**Was kann der Agent nicht?**

* Templates anpassen kann er nur mit den Template-Werkzeugen von Contao (siehe oben), nicht mit der
  MCP-Administration (z. B. ein Badge "Abgesagt" in der Ausgabe),
* die Reihenfolge von Attributen und Feldern ändern, etwas löschen und Spalten umbenennen,
* Sprachen hinzufügen und Varianten umschalten,
* Pakete installieren.

Er soll das sagen und einen Weg im Backend nennen. Tut er es nicht, fragt man danach.

**Die Daten stehen im Backend, aber die Detail-Links fehlen.**
Den Alias erzeugt MetaModels beim Speichern im Backend. Wer Datensätze über die Contao-API anlegt, muss den
Alias-Wert mitgeben. Die Attribute, aus denen der Alias entsteht (z. B. Titel und Datum), sollten Pflichtfelder sein, sonst
ist der Alias unvollständig und ändert sich später (siehe :ref:`Liste mit Detailseite <rst_cookbook_frontend_list-with-detail-page>`).

**Die Liste zeigt auch unveröffentlichte Einträge.**
Der Filter braucht die Regel *Checkbox-Status* (Paket ``attribute_checkbox``) auf das Attribut "veröffentlicht". Die Regel
"Ja / Nein" (``filter_checkbox``) ist ein Widget für die Besucher und filtert nur, wenn jemand sie bedient.

**Was ist, wenn sich die Antwort des Agenten nach einem Update ändert?**
Die Hilfe (``metamodels://guide/overview``) und die Hinweise des Planers werden beim Start des Gesprächs geladen.
Man bittet den Agenten, sie neu zu laden, wenn das System oder die Erweiterung aktualisiert wurde.

**Ist das für Live-Seiten geeignet?**
Nein, das Schreiben ist für Entwicklungssysteme gedacht. Der Agent handelt mit den Rechten des Backend-Benutzers.
