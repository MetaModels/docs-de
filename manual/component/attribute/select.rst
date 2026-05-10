.. _component_attribute_select:

Einzelauswahl [select]
======================

Das Attribut "Einzelauswahl [select]" erstellt eine 1:n-Relation zu einer anderen
Tabelle — entweder einer MetaModels-Tabelle oder einer beliebigen Contao-Tabelle
(z. B. ``tl_member``, ``tl_page``). In der Datenbank wird die ID des ausgewählten
Datensatzes gespeichert. Typische Einsatzbereiche:

* Zuordnung eines Produkts zu einer Kategorie
* Verknüpfung eines Artikels mit einem Autor
* Auswahl einer Contao-Seite als Zielseite

Die Auswahl im Backend kann als Dropdown, als Radiobutton-Liste oder als
Baum-Picker dargestellt werden.

.. note:: Für Relationen zwischen zwei mehrsprachigen MetaModels sollte die
   einsprachige Variante "Einzelauswahl" verwendet werden — MetaModels erkennt
   die Sprache automatisch und wechselt entsprechend.

.. seealso:: Für Spezialfälle mit eigener Sprachspalte in der referenzierten
   Tabelle steht :ref:`component_attribute_translatedselect` zur Verfügung.


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Neben den allgemeinen Attribut-Einstellungen (Name, Spaltenname, Beschreibung,
Varianten überschreiben) bietet das Attribut folgende spezifische Optionen:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Quelltabelle
     - Die Tabelle, aus der die Auswahlwerte bezogen werden. Verfügbar sind
       MetaModels-Tabellen sowie alle Contao-Datenbanktabellen.
   * - Werte-Spalte
     - Die Spalte der Quelltabelle, deren Inhalt als Bezeichnung in der
       Auswahlliste angezeigt wird.
   * - ID-Spalte
     - Die Spalte, die als eindeutiger Bezeichner (gespeicherter Wert) dient.
       Standard: ``id``.
   * - Alias-Spalte
     - Die Spalte, die als lesbarer Bezeichner in Filterwidgets verwendet wird.
       Ist man unsicher, dieselbe Spalte wie bei der ID-Spalte wählen.
   * - Auswahl-Sortierung
     - Spalte, nach der die Auswahlliste sortiert wird.
   * - Sortierrichtung
     - Aufsteigend (A → Z) oder absteigend (Z → A).
   * - SQL (WHERE-Bedingung)
     - Optionale SQL-WHERE-Bedingung zur Einschränkung der Auswahlliste. Der
       Alias ``sourceTable`` steht für die Quelltabelle (z. B.
       ``sourceTable.published = '1'``).
   * - Filter
     - Auswahl eines MetaModels-Filtersets zur dynamischen Einschränkung der
       Optionen.
   * - Filterparameter
     - Vorgabewerte für die Parameter des ausgewählten Filtersets.


Einstellungen bei den Render-Einstellungen
-------------------------------------------

Das Einzelauswahl-Attribut besitzt keine eigenen Render-Einstellungen. In der
Attributliste einer Render-Einstellung stehen die üblichen Optionen zur Verfügung:

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
       (nur verfügbar, wenn die Erweiterung "Frontend Editing" installiert ist).
   * - Anzeigetyp
     - Darstellungsart der Auswahl:

       * **Auswahlmenü (Select)** – Klassisches Dropdown-Menü
       * **Radiobutton-Liste** – Alle Optionen als Radiobuttons
       * **Popup-Picker** – Auswahl über einen Baum-Picker (für hierarchische
         Quelltabellen wie ``tl_page`` oder ``tl_files``)
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
   * - Leere Option anzeigen
     - Zeigt eine leere Auswahloption an, damit keine Vorauswahl getroffen ist.

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

Das Einzelauswahl-Attribut kann mit folgenden Filterregeln verwendet werden:

.. list-table::
   :header-rows: 1
   :widths: 30 70

   * - Filterregel
     - Hinweis
   * - Einzelauswahl
     - Filtert nach einem ausgewählten Wert aus der Quelltabelle; z. B. alle
       Produkte einer bestimmten Kategorie.
   * - Filter auf Attribut des Modells mit einer Relation
     - Filtert MetaModel-Items anhand eines Attributwerts des verknüpften
       MetaModels; z. B. alle Produkte, deren Kategorie ein bestimmtes Merkmal
       hat.


Sonderfunktionen
-----------------

**Datenbank-Speicherung**

Die ID des ausgewählten Datensatzes wird als ``int(11) NULL`` in der
MetaModel-Tabelle gespeichert.

**Quelltabellentypen**

Als Quelltabelle können gewählt werden:

* **MetaModels-Tabellen** – mit vollem Zugriff auf alle Attribute
* **Nicht-übersetzte Contao-Tabellen** – jede Tabelle aus der Contao-Datenbank
* **SQL-Tabellen** – direkte Tabellenauswahl per SQL-Alias

**SQL-WHERE-Bedingung**

In der WHERE-Bedingung steht der Alias ``sourceTable`` für die Quelltabelle.
Beispiel zur Filterung auf veröffentlichte Einträge:

.. code-block:: sql

   sourceTable.published = '1'


.. |br| raw:: html

   <br />
