.. _rst_extended_contao-api:

MetaModels Contao-API
=====================

Die Contao-API stellt die **Datensätze (Items) der MetaModels als REST-Schnittstelle** bereit - zum Lesen, Anlegen,
Ändern und Löschen. Sie baut auf dem API-Bundle von Contao 6 (API Platform) auf. Darüber sind die MetaModels auch für
den :ref:`MCP-Server von Contao <rst_extended_mcp-admin>` und damit für KI-Agenten erreichbar.

Die Schnittstelle ist so aufgebaut wie die Bearbeitung im Backend: Es gelten dieselben Rechte, dieselbe Validierung
und es laufen dieselben Ereignisse (Versionen, Log, Suchindex).

.. note:: Die Erweiterung ist Teil des **Standardpakets** im "Early-Adopter-Programm" (EAP) - mehr dazu unter
   **Fundraising** auf der `MM Webseite <https://now.metamodel.me/de/unterstuetzer/fundraising#metamodels_2-6>`_.

.. note:: Das API-Bundle, das MCP-Bundle und der OAuth-Server von Contao sind noch nicht stabil: Es gibt zurzeit nur
   den Entwicklungszweig ``dev-main``, die Schnittstelle ist von Contao als *experimentell* gekennzeichnet. Bis
   Contao Versionen veröffentlicht, sind die Bundles nur mit einer Zusatzeinstellung in der ``composer.json``
   installierbar - `siehe unten <#installation-per-composer>`_.

Voraussetzungen
---------------

* MetaModels core ab 2.6
* Contao 6.x und PHP 8.4
* ``contao/api-bundle`` von Contao


Installation per Composer
-------------------------

Solange ``contao/api-bundle`` nicht auf Packagist veröffentlicht ist, muss das Repository in der ``composer.json``
des Projektes eingetragen werden:

.. code-block:: bash

   composer config repositories.contao-api-bundle vcs https://github.com/contao/api-bundle.git
   composer require contao/api-bundle:dev-main metamodels/contao-api

Anschließend wie üblich die Datenbank aktualisieren (Contao-Manager, ``contao-setup`` oder
``php vendor/bin/contao-console contao:migrate``).


Aufruf der Schnittstelle
------------------------

Für jedes MetaModel gibt es eine eigene Ressource unter

``/contao/api/mm/<Tabellenname>``  bzw.  ``/contao/api/mm/<Tabellenname>/<id>``

z. B. ``/contao/api/mm/mm_employees/12``. Die Operationen:

.. list-table::
   :header-rows: 1
   :widths: 20 80

   * - Methode
     - Aufgabe
   * - ``GET`` (Liste)
     - Liste der Items. Mit ``page`` und ``itemsPerPage`` wird geblättert.
   * - ``GET`` (``…/<id>``)
     - Ein Item lesen.
   * - ``POST``
     - Ein Item anlegen (Inhaltstyp ``application/ld+json``).
   * - ``PATCH``
     - Ein Item ändern - gesendet werden nur die Felder, die sich ändern (Inhaltstyp
       ``application/merge-patch+json``).
   * - ``DELETE``
     - Ein Item löschen.

Die Beschreibung aller Ressourcen im OpenAPI-Format mit allen Attributen der MetaModels gibt es unter
``/contao/api`` - dort ist auch die Swagger-Oberfläche erreichbar.


Anmeldung per Token
-------------------

Für den Zugriff ohne Browser wird ein **Personal Access Token** von Contao verwendet. Er wird im Backend-Modul
*Sicherheit* erzeugt (Schaltfläche zum Erzeugen eines Tokens, mit Name und Ablaufdatum). Der Token beginnt mit
``ct_pat_`` und wird **nur einmal angezeigt**. Er gilt für den Backend-Benutzer, der ihn erzeugt hat.

Der Token wird bei jeder Anfrage als Bearer-Token mitgeschickt:

.. code-block:: bash

   curl -H "Authorization: Bearer ct_pat_…" \
        "https://example.org/contao/api/mm/mm_employees?itemsPerPage=10"

   curl -X PATCH -H "Authorization: Bearer ct_pat_…" \
        -H "Content-Type: application/merge-patch+json" \
        -d '{"name": "Neuer Name"}' \
        "https://example.org/contao/api/mm/mm_employees/12"

.. warning:: Ein Token gibt dieselben Rechte wie der Benutzer im Backend. Er gehört nicht in ein Repository und nicht
   in Dateien, die weitergegeben werden. Ein nicht mehr benötigter Token wird im Backend gelöscht.


Rechte
------

Die Rechte folgen dem Backend:

* Ein Benutzer braucht für das MetaModel eine **Eingabemaske** (Zuordnung der Eingabemaske zu den Benutzern bzw.
  Gruppen in den :ref:`Eingabe-/Render-Zuordnungen <component_dca-combine>`). Ohne Zugriff antwortet die Schnittstelle
  mit ``403``, und das MetaModel taucht in der OpenAPI-Beschreibung und im MCP für diesen Benutzer nicht auf.
* Es sind nur die **Attribute der Eingabemaske** sichtbar und schreibbar.
* Die Einstellungen der Eingabemaske gelten auch hier: *schreibgeschützt*, *Pflichtfeld* sowie die Rechte zum
  Anlegen, Bearbeiten und Löschen von Datensätzen.
* Die Attributtypen *Token*, *Geodistanz* und *Levenshtein* werden nicht ausgegeben.


Lesen
-----

Die Werte werden pro Attributtyp in ein passendes JSON-Format umgewandelt, z. B. Zahlen als Zahl, Tags und
Mehrfachauswahlen als Liste und Dateien als Liste der UUIDs. Die Antwort ist eine Hydra-Collection mit
``totalItems`` und den Links zu den Seiten.

Attribute vom Typ *Zeitstempel* (Datum, Uhrzeit) werden als **Unix-Zeitstempel** ausgegeben und erwartet: eine Ganzzahl
in Sekunden, z. B. ``1798675200`` für den 31.12.2026, 00:00 Uhr UTC.


Mehrsprachige MetaModels
------------------------

Bei MetaModels mit mehreren Sprachen wird die Sprache mit dem Query-Parameter ``lang`` angegeben:

* **Schreiben** (``POST``, ``PATCH``, ``DELETE``): ``lang`` ist **Pflicht**, sonst würde unbemerkt die Fallback-Sprache
  überschrieben. Ohne ``lang`` oder mit einer unbekannten Sprache antwortet die Schnittstelle mit ``400``.
* **Lesen**: ``lang`` ist optional (``GET …?lang=en``), ohne Angabe wird die aktive Sprache verwendet.


Schreiben
---------

Gespeichert wird immer über das MetaModel selbst (wie im Backend), nicht direkt in die Datenbank. Vor dem Speichern
wird der Inhalt geprüft:

* Unbekannte oder nicht schreibbare Felder, falsche Typen und fehlende Pflichtfelder werden mit ``422`` und einer
  Meldung zum betroffenen Feld abgelehnt.
* **Verknüpfungen** werden aufgelöst, bevor gespeichert wird: Ein unbekannter Alias in einer Auswahl, unbekannte Tags
  oder Spalten einer Tabelle werden **nicht stillschweigend verworfen**, sondern abgelehnt.
* **Dateien** werden als UUID angegeben (keine Pfade). Die Datei muss existieren, im Ordner liegen, der im Attribut
  festgelegt ist, und eine erlaubte Endung haben.
* Nach dem Speichern wird wie im Backend eine **Version** angelegt (nur wenn sich der Datensatz geändert hat) - mit dem
  Namen des angemeldeten Benutzers. Die Versionen sind im Backend sichtbar und können dort wiederhergestellt werden.
  Das Löschen legt keine Version an.
* Die Aktionen werden wie im Backend in das **System-Log** geschrieben, wenn im MetaModel das Logging aktiviert ist.
* Der **Suchindex** der Backend-Suche von Contao wird aktualisiert (nur wenn ``contao.backend_search`` aktiviert ist
  und der Worker läuft), ebenso der Index des :ref:`Loupe-Filters <rst_extended_loupe>`. Ein Fehler dabei bricht das
  Speichern nicht ab, er wird im Log als Warnung vermerkt.
* **Abgeleitete Attribute** (Alias, kombinierte Werte, Token, Index des Levenshtein-Filters) entstehen beim Anlegen eines
  Items, auch wenn sie nicht in der Eingabemaske stehen und die Anfrage sie nicht nennt. Der Alias wird aus den
  Quellfeldern des Attributs gebildet, wie im Backend. Das braucht MetaModels ab 2.6 (bzw. 2.5.4): Davor speicherte
  ``saveItem()`` einem neuen Item nur die Attribute, die gesetzt waren, ein per API oder Skript angelegtes Item hatte
  keinen Alias. Bei einem vorhandenen Item gilt wie im Backend die Einstellung des Attributs.
* Der **HTTP-Cache** wird wie im Backend informiert: Nach dem Speichern und Löschen verfallen die Cache-Tags der Tabelle
  (``contao.db.<Tabelle>``) und des Items (``contao.db.<Tabelle>.<id>``). Die Listen von MetaModels (Modul und
  Inhaltselement) tragen beide Tags, damit auch neue Items, Items, die erst durch eine Änderung zum Filter passen, und
  leere Listen im Cache ablaufen. Ohne HTTP-Cache mit Tag-Unterstützung geschieht nichts.

Andere Erweiterungen können auf das Speichern und Löschen reagieren: Die Schnittstelle löst dafür die Symfony-Ereignisse
``metamodels.contao-api.item-saved`` (Argumente ``metamodel`` und ``created``) und
``metamodels.contao-api.item-deleted`` (Argument ``metamodel``) aus. Das Item ist jeweils das Subject des Ereignisses.


Varianten
---------

Bei MetaModels mit Varianten haben die Items die Felder ``varbase`` (``true`` bei einem
Basis-Item) und ``vargroup`` (die ID des Basis-Items).

* Eine **neue Variante** entsteht, wenn beim ``POST`` die ID des Basis-Items als ``vargroup`` angegeben wird. Sie startet
  als Kopie der Basis und darf nur die Variantenattribute enthalten.
* Die **geteilten Attribute** werden am Basis-Item geändert und an die Varianten weitergegeben.
* Die ``vargroup`` eines vorhandenen Items kann nicht geändert werden.
* Beim Löschen eines Basis-Items werden die Varianten mit gelöscht.


Felder mit dem MultiColumnWizard
--------------------------------

Das API-Bundle von Contao kennt den MultiColumnWizard nicht. Das Bundle ``menatwork/contao-multicolumnwizard-bundle``
bringt deshalb einen eigenen Konverter mit (ab Version 3.8, zurzeit der Zweig ``develop``), den es nur lädt, wenn das API-Bundle
aktiv ist. Damit erscheinen Felder mit diesem Widget in den Ressourcen von Contao (``/contao/api/dc/…``), zum Beispiel
die Parameter eines MetaModels-Moduls oder -Inhaltselements:

* Ein Feld ist eine **Liste von Objekten**, eine Eigenschaft je Spalte. Jede Spalte wird so umgewandelt wie das Widget,
  das sie im Backend benutzt (Text, Auswahl, Datei usw.). ``minCount`` und ``maxCount`` des Widgets gelten als Mindest-
  und Höchstzahl der Zeilen.
* Beim Schreiben prüft das Widget jede Zelle wie im Backend (z. B. Pflichtfelder); Fehler stehen mit dem Pfad der Zelle
  in der Antwort (``422``).
* Nicht unterstützt sind Felder, deren Spalten aus einer Funktion kommen (``columnsCallback``), und Felder mit einer
  Spalte, für die es keinen Konverter gibt. Sie fehlen in der Schnittstelle, damit beim Schreiben keine Werte verloren
  gehen.
* Ist eine Spalte schreibgeschützt, ist das ganze Feld schreibgeschützt: Beim Hinzufügen, Entfernen oder Umsortieren von
  Zeilen könnte der Wert dieser Spalte nicht erhalten bleiben.


Öffentlicher Lesezugriff
------------------------

Contao selbst bietet noch keine Schnittstelle für das Frontend: Alle Ressourcen des API-Bundles liegen unter
``/contao/api`` und verlangen einen Backend-Benutzer. Für Seiten, die MetaModels ohne Anmeldung per JSON lesen sollen
(z. B. mit Vue oder Stimulus), bringt die Erweiterung deshalb einen **nur lesenden Zugang** mit, der **nicht über die
API-Plattform** läuft und außerhalb des Backends liegt:

* ``GET /api/mm/<tabelle>`` liefert eine Liste, ``GET /api/mm/<tabelle>/<id>`` ein einzelnes Item.
* Es ist **nichts öffentlich, solange es nicht in der Konfiguration steht**. Pro MetaModel werden eine
  **Render-Einstellung** und eine **Filter-Einstellung** angegeben:

  .. code-block:: yaml

     # config/config.yaml
     meta_models_contao_api:
         public:
             mm_veranstaltungen:
                 render_setting: 35   # Id der Render-Einstellung
                 filter: 16           # Id der Filter-Einstellung
                 sort_by: startdate   # optional, Standard: id
                 sort_direction: ASC  # optional
                 per_page: 30         # optional, Obergrenze max_per_page (Standard 100)
                 cache_ttl: 3600      # optional, Sekunden im gemeinsamen Cache

* Die **Attribute** der Render-Einstellung sind die, die ausgegeben werden, und zwar als gerenderte Texte, wie sie auch
  eine Liste im Frontend zeigt (z. B. ein Datum als Datum und eine Auswahl mit ihrem Label).
* Die **Filter-Einstellung** ist Pflicht. Sie begrenzt die Items (z. B. mit der Regel *Veröffentlicht*, sonst wären
  auch unveröffentlichte Items sichtbar) und legt die Parameter fest, die als Query-Parameter angenommen werden. Andere
  Parameter werden ignoriert. Ein einzelnes Item muss denselben Filter erfüllen wie die Liste, sonst antwortet die
  Schnittstelle mit ``404``.
* Die Liste kennt ``page``, ``itemsPerPage`` und bei mehrsprachigen MetaModels ``lang``. Die Antwort enthält
  ``total``, ``page``, ``itemsPerPage`` und ``items``. Fehler kommen ebenfalls als JSON.
* Die Antworten sind für den HTTP-Cache freigegeben und mit ``contao.db.<tabelle>`` und
  ``contao.db.<tabelle>.<id>`` markiert. Das Speichern eines Items im Backend oder über die Schnittstelle lässt sie
  verfallen.
* Es gibt keinen CORS-Header: Die Seite, die die Daten abruft, liegt auf demselben Host.

Beispiel: Anzeige mit Vue
^^^^^^^^^^^^^^^^^^^^^^^^^

Eine Liste mit Suche, Seitenwechsel und Detailansicht braucht nur ein wenig HTML und JavaScript, das das JSON abruft.
Das Beispiel des Teams ist als Teil der Seitenstruktur aufgebaut, nicht als fertige HTML-Datei:

* **Eine Seite** (z. B. „API Demo“) im Seitenbaum mit einem Inhaltselement **HTML**. Als Template des Elements wird
  eine eigene Variante gewählt, ``ce_html_api_demo_events`` (Datei ``templates/ce_html_api_demo_events.html.twig``).
  Sie enthält das Markup, die Styles und das Skript. Das Standard-Template des Elements würde ``<script>`` entfernen,
  die Variante gibt ihren Inhalt unverändert aus. Das Feld *HTML* des Elements bleibt deshalb leer oder nimmt einen
  Kommentar auf.
* **Die Bibliothek** (``vue.global.prod.min.js``) liegt in einem öffentlichen Unterordner von ``files/`` (z. B.
  ``files/api-demo/``). Der Ordner muss **öffentlich** sein: In der Dateiverwaltung den Schalter *Öffentlich* setzen, das
  legt die Datei ``.public`` an. Danach ``contao:symlinks`` ausführen. So braucht das Beispiel kein CDN.
* **Ausdrücke von Vue** schreibt man mit ``v-text`` und Bindungen (``:href``), nicht mit ``{{ … }}``: Contao hält diese
  Klammern für Insert-Tags.
* **Links mit ``#``:** Contao setzt ``<base href>`` in die Seite. Ein Link, der nur aus ``#/4`` besteht, führt deshalb auf
  die Startseite. Das Beispiel hängt den Pfad der aktuellen Seite davor (``window.location.pathname``).
* Die Seite ruft die Schnittstelle auf demselben Host ab, ohne Anmeldung:

  .. code-block:: javascript

     const query = new URLSearchParams({ page: 1, itemsPerPage: 5, q: 'api' });
     const response = await fetch('/api/mm/mm_veranstaltungen?' + query);
     const { total, items } = await response.json();

     // Detailansicht eines Items
     const item = await (await fetch('/api/mm/mm_veranstaltungen/4')).json();

* ``q`` und weitere Parameter sind die Parameter der Filter-Einstellung (im Beispiel eine Textsuche im Titel und eine
  im Ort). Ein unveröffentlichtes Item liefert ``404``, das Beispiel zeigt dann eine Meldung statt der Detailseite.

.. warning:: Alles, was in der Render-Einstellung steht und der Filter durchlässt, ist für jeden abrufbar. Ein Attribut,
   das nicht öffentlich sein soll, gehört nicht in die Render-Einstellung.


Zugriff für angemeldete Mitglieder
----------------------------------

Mitglieder der Webseite können über dieselbe Schnittstelle ihre **eigenen Datensätze** lesen, anlegen, ändern und
löschen, zum Beispiel für ein Frontend-Editing mit Vue oder Stimulus. Der Core von Contao kann (noch) keine Token für
Mitglieder ausstellen, deshalb gilt die **Sitzung des angemeldeten Mitgliedes**: Die Seite ruft die Schnittstelle auf
demselben Host auf, der Browser sendet das Sitzungs-Cookie mit.

* Die Adressen: ``/api/member/mm/<tabelle>`` (Liste mit ``GET``, Anlegen mit ``POST``) und
  ``/api/member/mm/<tabelle>/<id>`` (``GET``, ``PATCH``, ``DELETE``). ``GET /api/member/me`` nennt den Benutzernamen,
  ohne Anmeldung antworten alle Adressen mit ``401``.
* Auch hier ist **nichts erreichbar, solange es nicht in der Konfiguration steht**:

  .. code-block:: yaml

     # config/config.yaml
     meta_models_contao_api:
         member:
             - mm_veranstaltungen

* Die Rechte sind die des :ref:`Frontend-Editings <rst_extended_frontend_editing>`: Die **Eingabemaske**, die den
  Mitgliedergruppen zugeordnet ist (:ref:`Eingabe-/Render-Zuordnungen <component_dca-combine>`), legt fest, welche
  Attribute Mitglieder sehen und schreiben und ob sie Datensätze anlegen, bearbeiten und löschen dürfen.
* Mit der Einstellung **Rechteprüfung** der Eingabemaske (Attribut für das Mitglied: eine Einfachauswahl auf
  ``tl_member`` mit dem Alias ``username``) sehen und ändern Mitglieder nur Datensätze, die sie als Besitzer nennen.
  Fremde Datensätze antworten mit ``404``. Ein angelegter Datensatz gehört dem angemeldeten Mitglied, der Inhalt der
  Anfrage kann keinen anderen Besitzer nennen. Ohne diese Einstellung dürfen alle Mitglieder der Gruppe alle Datensätze
  bearbeiten, wie im Frontend-Editing.
* Das Schreiben läuft wie bei der Schnittstelle im Backend (Prüfung der Werte, Versionen, Suchindex, Cache). Fehler
  in den Werten kommen mit ``422`` und einer Liste der Probleme. Der Alias eines neuen Datensatzes entsteht von selbst,
  auch wenn das Attribut nicht in der Eingabemaske der Mitglieder steht.

.. warning:: Eine Zuordnung für die Mitgliedergruppe ``*`` gilt für **jedes** Mitglied und gewinnt durch ihre Position.
   Wer für die Backend-Benutzer eine eigene Zeile anlegt, gibt ihr deshalb eine Mitgliedergruppe, in der kein Mitglied
   ist (z. B. „Gäste“), damit die Mitglieder ihre eigene Eingabemaske bekommen.

Das Beispiel für Mitglieder ist eine **Unterseite einer geschützten Seite** (im Test „API Demo FEE“ unter „Mein Konto
TEST“, geschützt für die Mitgliedergruppe). Die Unterseite erbt den Schutz, nur angemeldete Mitglieder kommen hin. Sie
hat wie die öffentliche Seite ein Inhaltselement **HTML** mit einer Template-Variante (``ce_html_api_demo_member``), die das
Formular zum Anlegen und Ändern und die Liste der eigenen Datensätze ausgibt. Läuft die Sitzung ab, zeigt die Seite einen
Hinweis mit dem Link zur Anmeldung.

Gegen das Einschleusen von Anfragen durch fremde Seiten (CSRF) verlangt jede ändernde Anfrage ``Content-Type:
application/json`` und den Header ``X-Requested-With``. Beides löst bei einer fremden Seite eine Vorabprüfung aus, die
die Schnittstelle nicht erlaubt (es gibt keinen CORS-Header). Ein Token ist dafür nicht nötig. Die Antworten sind nicht
für den gemeinsamen Cache bestimmt.

Bekannte Einschränkungen
------------------------

* Unbekannte Attributtypen (z. B. von Erweiterungen) werden mit dem Wert des Widgets und einem untypisierten Schema
  ausgegeben.
* Die Übersetzungen der Variantenattribute werden beim Anlegen einer Variante nicht von der Basis kopiert.
* Die Bundles von Contao sind noch nicht stabil (siehe oben). Die Erweiterung ist deshalb eng an den aktuellen Stand
  gebunden und kann sich bis zur Veröffentlichung der Contao-Bundles noch ändern.
