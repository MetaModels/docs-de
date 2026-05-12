.. _component_attribute_translatedselect:

Übersetzte Einzelauswahl [select]
==================================

Das Attribut "Übersetzte Einzelauswahl" ist eine Erweiterung des
:ref:`Einzelauswahl-Attributs <component_attribute_select>`. Es wird verwendet,
wenn die referenzierte Quelltabelle eine eigene Sprachspalte besitzt — etwa
eine externe Tabelle mit einem ``language``-Feld oder eine nicht-MetaModels-Tabelle,
deren Einträge sprachspezifisch sind. Die ID des ausgewählten Datensatzes wird
wie beim einsprachigen Attribut in der MetaModel-Tabelle als Ganzzahl gespeichert.

Typische Einsatzbereiche:

* Auswahl aus einer externen Tabelle (z. B. ``tl_news``) mit Sprachspalte
* Verknüpfung mit Contao-eigenen mehrsprachigen Tabellen
* Szenarien, in denen die Quelltabelle selbst sprachabhängige Einträge
  liefert und MetaModels anhand der aktiven Sprache filtern soll

.. note:: Für Relationen zwischen zwei mehrsprachigen MetaModels-Tabellen
   genügt in der Regel das einsprachige Einzelauswahl-Attribut — MetaModels
   erkennt die Sprache automatisch und wechselt entsprechend.

.. seealso:: Die einsprachige Variante dieses Attributs ist unter
   :ref:`component_attribute_select` beschrieben.


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_translatedselect


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Neben den allgemeinen Attribut-Einstellungen und den Optionen des einsprachigen
Einzelauswahl-Attributs bietet das übersetzte Attribut folgende zusätzliche
Optionen:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Quelltabelle
     - Die Tabelle, aus der die Auswahlwerte bezogen werden.
   * - Werte-Spalte
     - Die Spalte der Quelltabelle, deren Inhalt als Bezeichnung angezeigt wird.
   * - ID-Spalte
     - Die Spalte, die als eindeutiger Bezeichner dient (Standard: ``id``).
   * - Alias-Spalte
     - Die Spalte, die als lesbarer Bezeichner in Filterwidgets verwendet wird.
   * - Auswahl-Sortierung
     - Spalte, nach der die Auswahlliste sortiert wird.
   * - Sortierrichtung
     - Aufsteigend (A → Z) oder absteigend (Z → A).
   * - SQL (WHERE-Bedingung)
     - Optionale SQL-WHERE-Bedingung zur Einschränkung der Auswahlliste.
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
     - Auswahl eines eigenen Templates für die Ausgabe des verknüpften Wertes.
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
   * - Anzeigetyp
     - Darstellungsart der Auswahl:

       * **Auswahlmenü (Select)** – Klassisches Dropdown-Menü
       * **Radiobutton-Liste** – Alle Optionen als Radiobuttons
       * **Popup-Picker** – Auswahl über einen Baum-Picker (für hierarchische
         Quelltabellen wie ``tl_page`` oder ``tl_files``)
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
   * - Leere Option anzeigen
     - Zeigt eine leere Auswahloption an.

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
   * - Einzelauswahl
     - Filtert nach einem ausgewählten Wert aus der Quelltabelle;
       die Filterliste wird automatisch auf die aktive Sprache eingeschränkt.
   * - Filter auf Attribut des Modells mit einer Relation
     - Filtert MetaModel-Items anhand eines Attributwerts des verknüpften
       MetaModels.


Sonderfunktionen
-----------------

**Speicherung**

Die ID des ausgewählten Datensatzes wird als ``int(11) NULL`` in der
MetaModel-Tabelle gespeichert — identisch zum einsprachigen Einzelauswahl-
Attribut. Die Übersetzung betrifft ausschließlich die Anzeigewerte der
Auswahlliste, nicht den gespeicherten Wert.

**Sprachabhängige Auswahlliste**

MetaModels filtert die Auswahlliste im Backend automatisch anhand der
konfigurierten Sprachspalte auf die aktive Backend-Sprache. Damit erscheinen
nur sprachlich passende Datensätze zur Auswahl.

**SQL-WHERE-Bedingung**

In der WHERE-Bedingung steht der Alias ``sourceTable`` für die Quelltabelle.
Beispiel zur Filterung auf veröffentlichte Einträge:

.. code-block:: sql

   sourceTable.published = '1'


.. |br| raw:: html

   <br />
