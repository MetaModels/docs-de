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


Bekannte Einschränkungen
------------------------

* Unbekannte Attributtypen (z. B. von Erweiterungen) werden mit dem Wert des Widgets und einem untypisierten Schema
  ausgegeben.
* Die Übersetzungen der Variantenattribute werden beim Anlegen einer Variante nicht von der Basis kopiert.
* Die Bundles von Contao sind noch nicht stabil (siehe oben). Die Erweiterung ist deshalb eng an den aktuellen Stand
  gebunden und kann sich bis zur Veröffentlichung der Contao-Bundles noch ändern.
