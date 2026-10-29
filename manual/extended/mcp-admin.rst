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

.. admonition:: Kurzanleitung für KI-Clients (z. B. Codex oder Claude Code)

   Ein KI-Programm findet den MCP-Server nicht von selbst, die Adresse muss ihm einmal mitgeteilt werden. Die
   Erweiterung muss dafür auf der Seite installiert sein, siehe :ref:`unten <rst_extended_mcp-admin_install>`.

   **Die Einrichtung führt der Mensch selbst im Terminal aus.** Ein Agent im Chat kann das nicht für dich tun: Er läuft
   meist in einer Sandbox ohne Zugriff auf deinen Rechner und die Konfiguration des Clients, und die Anmeldung im Backend
   bestätigst du im Browser. Der Agent kann dir die Befehle erklären, ausführen musst du sie.

   * **Adresse des Servers:** ``https://<Domain>/contao/mcp`` - bei einer lokalen Entwicklungsumgebung z. B.
     ``http://127.0.0.1:8027/contao/mcp``
   * **Codex:** ``codex mcp add contao --url https://<Domain>/contao/mcp`` und danach ``codex mcp login contao`` -
     lokal also z. B. ``codex mcp add contao --url http://127.0.0.1:8027/contao/mcp``
   * **Claude Code:** ``claude mcp add --transport http contao https://<Domain>/contao/mcp`` und danach im Programm
     ``/mcp`` aufrufen und den Server anmelden
   * **Anmeldung:** Der Client öffnet das Backend im Browser. Dort anmelden (Passwort tippt immer der Mensch) und auf der
     Seite *„Connect … with Contao?“* zustimmen. Das Passwort und Tokens werden nie in den Chat des Agenten kopiert.
   * **Danach:** Eine neue Sitzung des Clients starten, die Werkzeuge ``metamodels_*`` und ``contao_api_*`` erscheinen dann.

   Wer einen Agenten bittet, die Seite zu lesen: Nicht jeder Client kann Handbuchseiten abrufen. In dem Fall hilft es, den Text
   dieser Kurzanleitung in den Chat zu kopieren.

Voraussetzungen
---------------

* MetaModels core ab 2.6
* Contao 6.x und PHP 8.4
* ``contao/mcp-bundle`` und ``contao/oauth-server-bundle`` von Contao (zusammen mit dem ``contao/api-bundle``)
* für den Zugriff auf Datensätze zusätzlich :ref:`metamodels/contao-api <rst_extended_contao-api>`
* Ein Administrator-Konto im Backend - alle Werkzeuge erfordern die Rolle ``ROLE_ADMIN``


.. _rst_extended_mcp-admin_install:

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

Contao erlaubt nur Clients, die sich mit einem öffentlichen Dokument (*Client ID Metadata Document*) ausweisen und
deren Domain freigegeben ist. Vorbelegt sind ``chatgpt.com`` (Codex), ``claude.ai`` und ``vscode.dev``. Weitere Clients
werden freigegeben mit:

.. code-block:: yaml

   # config/config.yaml
   contao_oauth_server:
       cimd_trusted_domains: ['example.org']

Der Server holt das Dokument des Clients selbst aus dem Internet - das System braucht dafür eine ausgehende
Verbindung. Getestet ist die Anmeldung und der Ablauf mit Codex; ein Test mit Claude steht noch aus.

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
     - Findet Typen, Erweiterungen und Handbuchseiten zu einer Aufgabe, aus wenigen Worten in jeder Sprache.
   * - ``metamodels_list``
     - Werkzeug
     - Alle MetaModels mit Tabelle, Sprachen und der Anzahl der Attribute, Eingabemasken, Render-Einstellungen und
       Filter.
   * - ``metamodels_describe``
     - Werkzeug
     - Die Konfiguration eines MetaModels: Attribute, Eingabemasken mit Feldern, Render-Einstellungen, Filter.
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

Nach dem Anlegen kennt die Contao-API das MetaModel sofort. Damit es im Frontend erscheint, legt der Agent Seite,
Artikel und ein Inhaltselement vom Typ *MetaModel-Liste* (``metamodel_content``) an.

Die Beschreibung ist der **gewünschte Zustand**, auch für Vorhandenes: Der Plan zeigt jede Zeile als *anlegen*,
*ändern* (mit den neuen und den bisherigen Werten) oder *vorhanden*. Nur was die Beschreibung nennt, wird geändert;
alles andere bleibt unberührt.

Nicht unterstützt (wird als Problem gemeldet): ein anderer Typ oder eine andere Spalte für ein vorhandenes Attribut,
ein anderer Typ oder ein anderes Attribut für eine vorhandene Filterregel, Sprachen hinzufügen, Varianten umschalten
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


Wissensbasis (Metadaten)
------------------------

Ein nicht installiertes Paket kann nicht mitteilen, welche Typen es mitbringen würde. Die Angaben zu den Paketen und
ihren Attribut- und Filtertypen kommen deshalb aus einer Metadaten-Datei des Repositories
`MetaModels/mcp-metadata <https://github.com/MetaModels/mcp-metadata>`_:

* je Paket: ob es frei verfügbar ist oder im Early-Adopter-Programm, wo man den Zugang erhält, eine Kurzbeschreibung,
  Stichworte und die Seite im Handbuch,
* je Typ: das Paket, eine Kurzbeschreibung, Stichworte in den Sprachen der Anwender und die Handbuchseite,
* je Artikel: eine Seite des Handbuchs zu einem Thema oder ein Rezept des Kochbuchs mit Titel, Pfad und Stichworten
  - nur ein Verweis, der Text bleibt im Handbuch.

Die Datei wird unter ``https://metamodels.github.io/mcp-metadata/metadata.json`` veröffentlicht. Die Erweiterung holt sie
von dort (nur über https), behält sie einen Tag und merkt sich die letzte gute Fassung. Ist der Server nicht erreichbar,
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
