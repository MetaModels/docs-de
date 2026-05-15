.. _component_attribute_translatedtags:

Übersetzte Mehrfachauswahl [tags]
==================================

Das Attribut "Übersetzte Mehrfachauswahl" ist eine Erweiterung des
:ref:`Mehrfachauswahl-Attributs <component_attribute_tags>`. Es wird verwendet,
wenn die referenzierte Quelltabelle eine eigene Sprachspalte besitzt — etwa
eine externe Tabelle mit einem ``language``-Feld. Die Verknüpfungen werden wie
beim einsprachigen Attribut in der Relationstabelle ``tl_metamodel_tag_relation``
gespeichert, sodass keine eigene Spalte in der MetaModel-Tabelle entsteht.

Typische Einsatzbereiche:

* Mehrfachauswahl aus einer externen sprachabhängigen Tabelle (z. B. Schlagwörter
  aus einer Tabelle mit Sprachspalte)
* Verknüpfung mit Contao-eigenen mehrsprachigen Tabellen
* Szenarien, in denen die Quelltabelle selbst sprachabhängige Einträge liefert
  und MetaModels anhand der aktiven Sprache filtern soll

.. note:: Für Relationen zwischen zwei mehrsprachigen MetaModels-Tabellen
   genügt in der Regel das einsprachige Mehrfachauswahl-Attribut — MetaModels
   erkennt die Sprache automatisch und wechselt entsprechend.

.. seealso:: Die einsprachige Variante dieses Attributs ist unter
   :ref:`component_attribute_tags` beschrieben.

.. seealso:: Hinweise zur Mehrsprachigkeit in MetaModels sind auf der Seite
   :ref:`component_multi-language` zu finden.


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_translatedtags


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Neben den allgemeinen Attribut-Einstellungen und den Optionen des einsprachigen
Mehrfachauswahl-Attributs bietet das übersetzte Attribut folgende zusätzliche
Optionen:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Datenbanktabelle
     - Die Tabelle, aus der die Auswahlwerte bezogen werden.
   * - Tabellenspalte für Bezeichnung/Name
     - Die Spalte der Quelltabelle, deren Inhalt als Bezeichnung angezeigt wird.
   * - ID der Mehrfachauswahl
     - Die Spalte, die als eindeutiger Bezeichner dient (Standard: ``id``).
   * - Alias der Mehrfachauswahl
     - Die Spalte, die als lesbarer Bezeichner in Filterwidgets verwendet wird.
   * - Sortierung der Mehrfachauswahl
     - Spalte, nach der die Auswahlliste sortiert wird.
   * - Sortierrichtung
     - Aufsteigend (A → Z) oder absteigend (Z → A).
   * - SQL (WHERE-Bedingung)
     - Optionale SQL-WHERE-Bedingung zur Einschränkung der Auswahlliste. Der
       Alias ``t`` steht für die Quelltabelle.
   * - Filter
     - Auswahl eines MetaModels-Filtersets zur dynamischen Einschränkung
       der Optionen.
   * - Filterparameter
     - Vorgabewerte für die Parameter des ausgewählten Filtersets.
   * - Sprachspalte
     - Spalte in der Quelltabelle, die den Sprachcode des Eintrags enthält
       (z. B. ``language``). MetaModels filtert die Auswahlliste automatisch
       auf die aktive Sprache.
   * - Quelltabelle (Übersetzung)
     - Alternative Quelltabelle für sprachunabhängige Stammdaten, aus der
       bei fehlender Übersetzung die Fallback-Werte bezogen werden.
   * - Sortierung (Quelltabelle)
     - Sortierungsspalte in der Quelltabelle für die übersetzte Ansicht.


Einstellungen bei den Render-Einstellungen
-------------------------------------------

Das Attribut besitzt keine eigenen Render-Einstellungen. In der Attributliste
einer Render-Einstellung stehen die üblichen Optionen zur Verfügung:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Template
     - Auswahl eines eigenen Templates für die Ausgabe der verknüpften Werte.
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
   * - Anzeigetyp wählen
     - Darstellungsart der Mehrfachauswahl:

       * **Checkboxmenü** – Klassische Checkbox-Liste
       * **Checkbox-Wizard** – Checkbox-Liste mit Auf/Ab-Sortierung
       * **Popup-Picker** – Auswahl über einen Baum-Picker (für hierarchische
         Quelltabellen wie ``tl_page`` oder ``tl_files``)
       * **Tag-Liste** – Durchsuchbares Dropdown mit chosen.js
   * - Niedrigste Ebene (Baum)
     - Bei Baum-Picker: Datensätze unterhalb dieser Ebene sind nicht auswählbar.
   * - Höchste Ebene (Baum)
     - Bei Baum-Picker: Datensätze oberhalb dieser Ebene sind nicht auswählbar.

**Funktionen**

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Pflichtfeld
     - Macht das Feld zu einem Pflichtfeld.

**Übersicht (Backend-Filter und -Suche)**

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Filterbar
     - Das Attribut steht im Backend als Filterkriterium zur Verfügung.
   * - Suchbar
     - Das Attribut steht im Backend als Suchfeld zur Verfügung.


Filterregeln
------------

.. list-table::
   :header-rows: 1
   :widths: 30 70

   * - Filterregel
     - Hinweis
   * - Mehrfachauswahl
     - Filtert nach einem oder mehreren ausgewählten Werten aus der Quelltabelle;
       die Filterliste wird automatisch auf die aktive Sprache eingeschränkt.
   * - Filter auf Attribut des Modells mit einer Relation
     - Filtert MetaModel-Items anhand eines Attributwerts des verknüpften
       MetaModels.


Sonderfunktionen
-----------------

**Speicherung**

Die Relationen werden in der Zwischentabelle ``tl_metamodel_tag_relation``
gespeichert (Spalten: ``att_id``, ``item_id``, ``value_id``, ``value_sorting``).
Keine eigene Spalte in der MetaModel-Tabelle. Die Übersetzung betrifft
ausschließlich die Anzeigewerte der Auswahlliste, nicht die gespeicherten
Relationen.

**Sprachabhängige Auswahlliste**

MetaModels filtert die Auswahlliste im Backend automatisch anhand der
konfigurierten Sprachspalte auf die aktive Backend-Sprache.

**SQL-WHERE-Bedingung**

In der WHERE-Bedingung steht der Alias ``t`` für die Quelltabelle. Beispiel
zur Filterung auf veröffentlichte Einträge:

.. code-block:: sql

   t.published = '1'


.. |br| raw:: html

   <br />
