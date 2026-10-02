.. _component_attribute_tags:

|svg_attr_tags_22| |img_tags| Mehrfachauswahl [tags]
====================================================

Das Attribut "Mehrfachauswahl [tags]" erstellt eine :ref:`m:n-Relation <component_relations_standard-relation-mton>` zu
einer anderen Tabelle — entweder einer MetaModels-Tabelle oder einer beliebigen Contao-Tabelle
(z. B. ``tl_member``, ``tl_page``). Die Verknüpfung wird in einer eigenen
Relationstabelle (``tl_metamodel_tag_relation``) gespeichert, sodass für das
Attribut **keine eigene Spalte** in der MetaModel-Tabelle angelegt wird.
Typische Einsatzbereiche:

* Zuordnung mehrerer Schlagwörter (Tags) zu einem Produkt
* Verknüpfung eines Artikels mit mehreren Kategorien oder Autoren
* Auswahl mehrerer Regionen, Sprachen oder Zielgruppen

Die Auswahl im Backend kann als Checkbox-Liste, als Checkbox-Wizard, als
Baum-Picker oder als durchsuchbares Dropdown dargestellt werden.

.. note:: Für Relationen zwischen zwei mehrsprachigen MetaModels sollte die
   einsprachige Variante "Mehrfachauswahl" verwendet werden — MetaModels erkennt
   die Sprache automatisch und wechselt entsprechend.

.. seealso:: Für Spezialfälle mit eigener Sprachspalte in der referenzierten
   Tabelle steht :ref:`component_attribute_translatedtags` zur Verfügung.


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_tags


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Neben den allgemeinen Attribut-Einstellungen (Name, Spaltenname, Beschreibung,
Varianten überschreiben) bietet das Attribut folgende spezifische Optionen:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Datenbanktabelle
     - Die Tabelle, aus der die Auswahlwerte bezogen werden. Verfügbar sind
       MetaModels-Tabellen sowie alle Contao-Datenbanktabellen.
   * - Tabellenspalte für Bezeichnung/Name
     - Die Spalte der Quelltabelle, deren Inhalt als Bezeichnung in der
       Auswahlliste angezeigt wird.
   * - ID der Mehrfachauswahl
     - Die Spalte, die als eindeutiger Bezeichner (gespeicherter Wert) dient.
       Standard: ``id``.
   * - Alias der Mehrfachauswahl
     - Die Spalte, die als lesbarer Bezeichner in Filterwidgets verwendet wird.
   * - Sortierung der Mehrfachauswahl
     - Spalte, nach der die Auswahlliste sortiert wird.
   * - Sortierrichtung
     - Aufsteigend (A → Z) oder absteigend (Z → A).
   * - SQL (WHERE-Bedingung)
     - Optionale SQL-WHERE-Bedingung zur Einschränkung der Auswahlliste. Der
       Alias ``t`` steht für die Quelltabelle (z. B. ``t.published = '1'``). Bedingung filtert nicht, wenn
       Widgettyp "Popup-Picker ausgewählt wurde.
   * - Filter
     - Auswahl eines MetaModels-Filtersets zur dynamischen Einschränkung der
       Optionen.
   * - Filterparameter
     - Vorgabewerte für die Parameter des ausgewählten Filtersets.


Einstellungen bei den Render-Einstellungen
-------------------------------------------

In der Attributliste einer Render-Einstellung stehen folgende Optionen zur Verfügung:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Template
     - Auswahl eines eigenen Templates für die Ausgabe der verknüpften Werte.
   * - CSS-Klasse
     - Optionale CSS-Klasse, die dem Ausgabeelement hinzugefügt wird.
   * - Weitere Attribute (seit MM 2.5)
     - Nur bei einem MetaModel als Quelltabelle: Attribute des Ziel-MetaModels, die zusätzlich zu den
       Basisattributen (Werte-, Alias-, ID- und Auswahl-Sortierung) geladen und in den Werten der Tags
       bereitgestellt werden (Knoten ``raw`` und ``text``). Siehe unten.

**Weitere Attribute (seit MM 2.5)**

Von den ausgewählten Datensätzen des Ziel-MetaModels werden immer die **Basisattribute** geladen - die Spalten,
die bei den Einstellungen des Attributs als Werte-Spalte, Alias-Spalte, ID-Spalte und Auswahl-Sortierung
gewählt sind. Alle weiteren Attribute des Ziel-MetaModels lassen sich je Render-Einstellung anhaken, damit
sie ebenfalls zur Verfügung stehen, z. B. für die Ausgabe in der Detailansicht. Weil die Auswahl bei der
Render-Einstellung getroffen wird, können Liste und Detailseite unterschiedliche Attribute laden.

* Ist noch **keine Auswahl** gespeichert (bei bestehenden und bei gesammelt angelegten Render-Einstellungen),
  werden wie bisher **alle** Attribute geladen; im Backend sind dann alle angehakt.
* Werden **keine** Attribute angehakt und so gespeichert, werden nur die Basisattribute geladen. Das ist
  am schnellsten, ein Template darf dann nur noch auf diese zugreifen.
* Bei einer Contao-Tabelle als Quelltabelle gibt es die Option nicht, dort wird immer die komplette Zeile geladen.


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
       (nur verfügbar, wenn die Erweiterung "Frontend Editing" installiert ist).
   * - Anzeigetyp wählen
     - Darstellungsart der Mehrfachauswahl:

       * **Checkboxmenü** – Klassische Checkbox-Liste
       * **Checkbox-Wizard** – Checkbox-Liste mit Auf/Ab-Sortierung
       * **Popup-Picker** – Auswahl über einen Baum-Picker (für hierarchische
         Quelltabellen wie ``tl_page`` oder ``tl_files``)
       * **Tag-Liste** – Durchsuchbares Dropdown mit chosen.js
   * - Niedrigste Ebene (Baum)
     - Bei Baum-Picker: Datensätze unterhalb dieser Ebene sind nicht auswählbar
       (0 = keine Einschränkung).
   * - Höchste Ebene (Baum)
     - Bei Baum-Picker: Datensätze oberhalb dieser Ebene sind nicht auswählbar
       (0 = keine Einschränkung).

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

Das Mehrfachauswahl-Attribut kann mit folgenden Filterregeln verwendet werden:

.. list-table::
   :header-rows: 1
   :widths: 30 70

   * - Filterregel
     - Hinweis
   * - Mehrfachauswahl
     - Filtert nach einem oder mehreren ausgewählten Werten aus der Quelltabelle;
       z. B. alle Produkte mit einem bestimmten Tag.
   * - Filter auf Attribut des Modells mit einer Relation
     - Filtert MetaModel-Items anhand eines Attributwerts des verknüpften
       MetaModels; z. B. alle Produkte, deren Tags ein bestimmtes Merkmal haben.


Sonderfunktionen
-----------------

**Datenbank-Speicherung**

Die Relationen werden **nicht** in der MetaModel-Tabelle gespeichert, sondern
in der eigenen Zwischentabelle ``tl_metamodel_tag_relation`` mit den Spalten
``att_id`` (Attribut-ID), ``item_id`` (Item-ID), ``value_id`` (ID des
verknüpften Datensatzes) und ``value_sorting`` (Sortierreihenfolge). Dadurch
entfällt eine Spalte in der MM-Tabelle, und es ist keine DB-Migration nötig.

**SQL-WHERE-Bedingung**

In der WHERE-Bedingung steht der Alias ``t`` für die Quelltabelle. Beispiel
zur Filterung auf veröffentlichte Einträge:

.. code-block:: sql

   t.published = '1'


.. |svg_attr_tags_22| image:: /_img/icons_svg/tags.svg
   :width: 22px
.. |img_tags| image:: /_img/icons/tags.png
.. |br| raw:: html

   <br />
