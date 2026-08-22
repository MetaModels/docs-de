.. _component_attribute_translatedtablemulti:

|svg_attr_translatedtablemulti_22| Übersetzte Multi-Tabelle (MCW)
=================================================================

Das Attribut "Übersetzte Multi-Tabelle (MCW)" ist die mehrsprachige Variante des
:ref:`Multi-Tabellen-Attributs <component_attribute_tablemulti>`. Es ermöglicht
je Sprache eigene Tabellenwerte bei gleicher Spaltenstruktur. Die Daten werden
in einer eigenen Übersetzungstabelle gespeichert, sodass für das Attribut
**keine eigene Spalte** in der MetaModel-Tabelle angelegt wird.

Typische Einsatzbereiche:

* Mehrsprachige technische Spezifikationen mit gemischten Eingabetypen
* Übersetzte Öffnungszeiten oder Merkmalstabellen

.. warning:: Die Spaltenstruktur wird **nicht** im MetaModels-Backend konfiguriert,
   sondern in einer PHP-Konfigurationsdatei. Dies erfordert Entwicklerkenntnisse.

.. seealso:: Die einsprachige Variante dieses Attributs ist unter
   :ref:`component_attribute_tablemulti` beschrieben.

.. seealso:: Hinweise zur Mehrsprachigkeit in MetaModels sind auf der Seite
   :ref:`component_multi-language` zu finden.

.. seealso:: Dieses Attribut wird von der :ref:`File-Usage Integration <rst_extended_file-usage>`
   unterstützt. Damit lässt sich in der Contao-Dateiverwaltung anzeigen, ob und wo eine Datei
   eingebunden ist.


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_translatedtablemulti


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Das Attribut besitzt keine eigenen Einstellungen im MetaModels-Backend. Die
Konfiguration der Tabellenstruktur erfolgt in der PHP-Konfigurationsdatei
über ``$GLOBALS['TL_CONFIG']['metamodelsattribute_multi']`` — identisch zur
einsprachigen Variante:

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
       ],
   ];


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
   * - Template für das Frontend
     - Auswahl eines eigenen Widget-Templates für das Frontend-Editing
       (nur wenn "Frontend Editing" installiert ist).


Filterregeln
------------

Das übersetzte Multi-Tabellen-Attribut unterstützt keine Filterregeln —
``getFilterOptions()`` gibt ein leeres Array zurück.


Sonderfunktionen
-----------------

**Speicherung**

Die Tabellenwerte werden sprachspezifisch in ``tl_metamodel_translatedtablemulti``
gespeichert (Felder: ``att_id``, ``item_id``, ``langcode``, ``row``, ``col``,
``value``). Die MetaModel-Tabelle erhält keine eigene Spalte.

**Fallback-Sprache**

Fehlt für eine Sprache ein Wert, greift MetaModels automatisch auf die
Fallback-Sprache zurück.

**Unterschied zur einsprachigen Variante**

Der einzige strukturelle Unterschied zur einsprachigen Multi-Tabelle ist
die zusätzliche ``langcode``-Spalte in der Wertetabelle und die Verwendung
der sprachbewussten ``getTranslatedDataFor()``- und ``setTranslatedDataFor()``-
Methoden.


.. |svg_attr_translatedtablemulti_22| image:: /_img/icons_svg/translatedtablemulti.svg
   :width: 22px
.. |br| raw:: html

   <br />
