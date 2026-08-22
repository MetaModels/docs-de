.. _component_attribute_tabletext:

|svg_attr_tabletext_22| Text-Tabelle
====================================

Das Attribut "Text-Tabelle" ermöglicht die Eingabe von Textdaten in einer
tabellarischen Struktur mit konfigurierten Spalten und beliebig vielen Zeilen.
Die Daten werden in einer eigenen Wertetabelle gespeichert, sodass für das
Attribut **keine eigene Spalte** in der MetaModel-Tabelle angelegt wird.
Typische Einsatzbereiche:

* Mehrere URLs oder Telefonnummern pro Datensatz (z. B. "URL + Beschriftung")
* Technische Spezifikationen mit mehreren Zeilen (z. B. "Eigenschaft + Wert")
* Öffnungszeiten (z. B. "Wochentag + Von + Bis")
* Preislisten mit mehreren Spalten

Die Anzahl und Bezeichnung der Spalten wird beim Anlegen des Attributs
definiert. In der Eingabemaske können dann beliebig viele Zeilen hinzugefügt
werden.

.. seealso:: Für mehrsprachige MetaModels steht das Attribut
   :ref:`component_attribute_translatedtabletext` zur Verfügung.


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_tabletext


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Neben den allgemeinen Attribut-Einstellungen (Name, Spaltenname, Beschreibung,
Varianten überschreiben) bietet das Text-Tabellen-Attribut folgende spezifische
Optionen:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Spalteneinstellung
     - Definition der Tabellenspalten. Für jede Spalte werden angegeben:

       * **Label** – Bezeichnung der Spalte (erscheint als Spaltenüberschrift
         in der Eingabemaske und im Frontend-Template)
       * **Breite** – Breite der Spalte in der Eingabemaske (z. B. ``200px``,
         ``50%``); hat keinen Einfluss auf die Frontend-Ausgabe.

       Die Anzahl der Zeilen in der Spalteneinstellung bestimmt die Anzahl
       der Spalten der Tabelle.
   * - Mindestanzahl der Zeilen
     - Mindestanzahl von Datenzeilen, die in der Eingabemaske angezeigt werden
       (0 = keine Mindestvorgabe).
   * - Maximale Anzahl von Zeilen
     - Maximale Anzahl von Datenzeilen, die eingegeben werden können
       (0 = keine Begrenzung).
   * - Sortierung deaktivieren
     - Blendet die Auf/Ab-Schaltflächen zur manuellen Sortierung der Zeilen
       in der Eingabemaske aus.


Einstellungen bei den Render-Einstellungen
-------------------------------------------

Das Text-Tabellen-Attribut besitzt eine eigene Render-Einstellung:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Tabellenkopf verbergen
     - Blendet die Spaltenüberschriften (Labels) in der Frontend-Ausgabe aus.
   * - Template
     - Auswahl eines eigenen Templates für die Ausgabe. Wird kein Template
       angegeben, erfolgt die Ausgabe als HTML-Tabelle.
   * - CSS-Klasse
     - Optionale CSS-Klasse, die dem Ausgabeelement hinzugefügt wird.


Einstellungen bei der Eingabemaske
------------------------------------

Wird das Text-Tabellen-Attribut einer Eingabemaske hinzugefügt, stehen folgende
Optionen zur Verfügung:

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


Filterregeln
------------

Das Text-Tabellen-Attribut kann mit folgenden Filterregeln verwendet werden:

.. list-table::
   :header-rows: 1
   :widths: 30 70

   * - Filterregel
     - Hinweis
   * - Levenshtein-gestützte Suche
     - Ähnlichkeitssuche mit Tippfehlertoleranz über alle Zellwerte; erfordert
       das Paket ``attribute_levenshtein``.
   * - Loupe
     - Volltext-Index-Suche über alle Zellwerte; erfordert das Paket
       ``filter_loupe`` (ab MM 2.4).


Sonderfunktionen
-----------------

**Datenbank-Speicherung**

Die Tabellenwerte werden **nicht** in der MetaModel-Tabelle gespeichert, sondern
in der eigenen Wertetabelle ``tl_metamodel_tabletext`` mit den Spalten
``item_id``, ``att_id``, ``row`` (Zeilenindex), ``col`` (Spaltenindex) und
``value``. Dadurch wird keine Spalte in der MM-Tabelle angelegt und es ist
keine DB-Migration nötig.

**Spaltenstruktur im Template**

Im Frontend-Template stehen die Werte als verschachteltes Array zur Verfügung:
``$arrData['raw']`` enthält Zeilen (row) mit Spalten (col_0, col_1, …), wobei
die Spaltennamen automatisch aus der Spalteneinstellung generiert werden.


.. |svg_attr_tabletext_22| image:: /_img/icons_svg/tabletext.svg
   :width: 22px
.. |br| raw:: html

   <br />
