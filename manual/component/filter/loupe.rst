.. _component_filter_loupe:

|img_filter_default| Loupe
===========================

Die Filterregel "Loupe" (Paket ``filter_loupe``, ab MM 2.4) erzeugt einen
Volltext-Index über ausgewählte Attribute in einer eigenen SQLite-Datenbank und
ermöglicht eine leistungsfähige Volltextsuche mit Ähnlichkeitssuche (Fuzzy-Search).
Die Implementierung basiert auf der PHP-Bibliothek
`Loupe <https://github.com/loupe-php/loupe>`_.

Im Unterschied zur :ref:`Levenshtein-Suche <component_filter_levenshtein>` verwendet
Loupe eine eigenständige SQLite-Datenbank für den Index und bietet erweiterte
Konfigurationsmöglichkeiten für Fuzzy-Distanz und Ranking.

.. seealso:: Detaillierte Dokumentation zu Loupe:
   :ref:`rst_extended_loupe`


Installation
------------

Die Filterregel wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/filter_loupe


Einstellungen beim Anlegen der Filterregel
------------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - Typ
     - Auswahl des Filterregeltyps – hier: "Loupe".
   * - Aktiviert
     - Aktiviert oder deaktiviert diese Filterregel.
   * - Kommentar
     - Freitextfeld zur Beschreibung des Zwecks dieser Filterregel.
   * - Zu indizierende Attribute
     - Auswahl der Attribute (checkboxWizard), die in den Loupe-Suchindex
       aufgenommen werden sollen. Pflichtfeld.
   * - Fuzzy-Distanz
     - MCW-Tabelle, die für verschiedene Wortlängen (Mindestzeichen) den erlaubten
       Levenshtein-Abstand (Fuzzy-Distanz, 0–10) festlegt. |br|
       Standard: Wortlänge 5 → Distanz 1; Wortlänge 9 → Distanz 2.
   * - Ranking gleichgewichten
     - Ist diese Option aktiv, werden alle Treffer unabhängig von ihrer Relevanz
       gleichwertig gerankt (kein Relevanz-Ranking).
   * - Formatierte Werte verwenden
     - Ist diese Option aktiv, werden die formatierten Ausgabewerte der Attribute
       indiziert (statt der Rohwerte aus der Datenbank).


Einstellungen für das Frontend-Widget
--------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - URL-Parameter
     - Der Schlüssel (Key) des URL-Parameters für die Sucheingabe.
   * - URL-Typ für den Parameter
     - Legt fest, ob der Parameter als Slug (sprechende URL), als GET-Parameter übergeben wird (ab MM 2.4) - :ref:`siehe
       SEO <rst_cookbook_tips_seo_filter-url>`
   * - Label
     - Beschriftung des Sucheingabefelds.
   * - Label beim Filterwidget ausblenden
     - Unterdrückt die Ausgabe des Labels.
   * - Template
     - Template für die Widget-Ausgabe. Standard: ``mm_filteritem_default``.
   * - Diesen Filter für verbleibende Werte ignorieren
     - Dieser Filter liefert beim Berechnen verbleibender Werte seine eigenen Optionen
       nicht als Einschränkung zurück.
   * - CSS-ID/Klasse
     - Setzt eine CSS-ID oder -Klasse am Widget-Element.


Passende Attribute
------------------

Die Filterregel "Loupe" kann die folgenden Attributtypen indizieren:

* :ref:`Text <component_attribute_text>`
* :ref:`Langtext <component_attribute_longtext>`
* :ref:`Alias <component_attribute_alias>`
* :ref:`Kombinierte Einträge <component_attribute_combinedvalues>`
* :ref:`Token <component_attribute_token>`
* :ref:`Übersetzter Text <component_attribute_translatedtext>`
* :ref:`Übersetzter Langtext <component_attribute_translatedlongtext>`


Sonderfunktionen
----------------

**Index neu aufbauen**

In der Filterregelliste erscheint für Loupe-Filterregeln ein zusätzliches
Operationssymbol (Loupe-Icon) zum manuellen Neuaufbau des SQLite-Suchindex.
Der Index wird außerdem automatisch bei Änderungen an indizierten Items
aktualisiert.

**SQLite-Datenbank**

Der Loupe-Index wird in einer eigenständigen SQLite-Datei gespeichert (nicht in der
Contao-Hauptdatenbank). Dies ermöglicht schnelle Volltextsuchen auch bei großen
Datenmengen.


.. |img_filter_default| image:: /_img/icons/filter_default.png

.. |br| raw:: html

   <br />
