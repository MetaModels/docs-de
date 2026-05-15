.. _component_attribute_tablemulti:

Multi-Tabelle (MCW)
===================

Das Attribut "Multi-Tabelle (MCW)" ist eine erweiterte Variante des
:ref:`Text-Tabellen-Attributs <component_attribute_tabletext>`. Statt reiner
Texteingaben kann in jeder Tabellenzelle ein eigener Widget-Typ konfiguriert
werden — z. B. Select, Radiobuttons, Checkboxen, Datumspicker oder Textfelder.
Die Daten werden in einer eigenen Wertetabelle gespeichert, sodass für das
Attribut **keine eigene Spalte** in der MetaModel-Tabelle angelegt wird.

Typische Einsatzbereiche:

* Technische Spezifikationen mit gemischten Eingabetypen (Text + Auswahl + Datum)
* Öffnungszeiten mit Wochentag-Auswahl und Zeitfeldern
* Konfigurierbare Merkmallisten mit validierter Eingabe

.. warning:: Die Spaltenstruktur (Anzahl und Typ der Spalten) wird **nicht**
   im MetaModels-Backend konfiguriert, sondern in einer PHP-Konfigurationsdatei
   (``contao/config/config.php``). Dies erfordert Entwicklerkenntnisse.

.. seealso:: Für mehrsprachige MetaModels steht das Attribut
   :ref:`component_attribute_translatedtablemulti` zur Verfügung.

.. seealso:: Dieses Attribut wird von der :ref:`File-Usage Integration <rst_extended_file-usage>`
   unterstützt. Damit lässt sich in der Contao-Dateiverwaltung anzeigen, ob und wo eine Datei
   eingebunden ist.


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_tablemulti


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Das Attribut besitzt keine eigenen Einstellungen im MetaModels-Backend beim
Anlegen. Es werden nur die allgemeinen Attribut-Einstellungen verwendet:

* Name, Spaltenname, Beschreibung
* Varianten überschreiben

Die eigentliche Konfiguration der Tabellenstruktur erfolgt in der PHP-
Konfigurationsdatei über ``$GLOBALS['TL_CONFIG']['metamodelsattribute_multi']``:

.. code-block:: php

   $GLOBALS['TL_CONFIG']['metamodelsattribute_multi']['mm_beispiel']['mein_feld'] = [
       'minCount'     => 0,
       'maxCount'     => 0,
       'columnFields' => [
           'col_name' => [
               'label'     => 'Bezeichnung',
               'inputType' => 'text',
               'eval'      => ['style' => 'width:200px'],
           ],
           'col_type' => [
               'label'     => 'Typ',
               'inputType' => 'select',
               'options'   => ['a' => 'Option A', 'b' => 'Option B'],
               'eval'      => ['style' => 'width:150px'],
           ],
       ],
   ];

Hierbei steht ``mm_beispiel`` für den Tabellennamen des MetaModels und
``mein_feld`` für den Spaltennamen des Attributs.


Einstellungen bei den Render-Einstellungen
-------------------------------------------

Das Attribut besitzt eine eigene Render-Einstellung:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Tabellenkopf verbergen
     - Blendet die Spaltenüberschriften in der Frontend-Ausgabe aus.
   * - Template
     - Auswahl eines eigenen Templates für die Ausgabe.
   * - CSS-Klasse
     - Optionale CSS-Klasse, die dem Ausgabeelement hinzugefügt wird.


Einstellungen bei der Eingabemaske
------------------------------------

Wird das Attribut einer Eingabemaske hinzugefügt, stehen folgende Optionen
zur Verfügung:

**Darstellung**

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Backend-Klasse
     - CSS-Klassen für die Darstellung des Feldes im Backend-Formular.
   * - Template für das Backend
     - Auswahl eines eigenen Widget-Templates für das Backend-Formular.


Filterregeln
------------

Das Multi-Tabellen-Attribut kann mit folgenden Filterregeln verwendet werden:

.. list-table::
   :header-rows: 1
   :widths: 30 70

   * - Filterregel
     - Hinweis
   * - Einzelauswahl / Mehrfachauswahl
     - Filtert nach vorhandenen Zellwerten (Distinct-Werte aus der Wertetabelle).


Sonderfunktionen
-----------------

**Datenbank-Speicherung**

Die Tabellenwerte werden **nicht** in der MetaModel-Tabelle gespeichert, sondern
in der eigenen Wertetabelle ``tl_metamodel_tablemulti`` mit den Spalten
``att_id``, ``item_id``, ``row`` (Zeilenindex), ``col`` (Spaltenbezeichner) und
``value``. Dadurch wird keine Spalte in der MM-Tabelle angelegt und keine
DB-Migration ist nötig.

**Widget-Typen je Spalte**

Im Gegensatz zum Text-Tabellen-Attribut können die einzelnen Spalten mit
beliebigen Contao-Widget-Typen belegt werden: ``text``, ``select``,
``checkbox``, ``radio``, ``datePicker``, ``colorPicker`` usw.

**Speicherformat**

Binäre UUIDs werden vor der Speicherung in lesbare UUIDs konvertiert.
Array-Werte werden serialisiert gespeichert und beim Auslesen automatisch
deserialisiert.


.. |br| raw:: html

   <br />
