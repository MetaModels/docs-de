.. _component_attribute_translatedtabletext:

Übersetzte Text-Tabelle
========================

Das Attribut "Übersetzte Text-Tabelle" ist die mehrsprachige Variante des
:ref:`Text-Tabellen-Attributs <component_attribute_tabletext>`. Es ermöglicht
die Eingabe von Textdaten in einer tabellarischen Struktur mit konfigurierten
Spalten — je Sprache mit eigenen Spaltenbeschriftungen und eigenen Datenwerten.
Die Daten werden in einer eigenen Übersetzungstabelle gespeichert, sodass für
das Attribut **keine eigene Spalte** in der MetaModel-Tabelle angelegt wird.

Typische Einsatzbereiche:

* Mehrsprachige Spezifikationstabellen (z. B. "Eigenschaft + Wert" in DE und EN)
* Übersetzte Öffnungszeiten mit sprachabhängigen Wochentag-Bezeichnungen
* Sprachspezifische Preislisten oder Merkmaltabellen

.. seealso:: Die einsprachige Variante dieses Attributs ist unter
   :ref:`component_attribute_tabletext` beschrieben.


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_translatedtabletext


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Neben den allgemeinen Attribut-Einstellungen bietet das Attribut folgende
spezifische Optionen:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Anzahl der Spalten
     - Legt die Anzahl der Tabellenspalten fest. Dieser Wert bestimmt, wie viele
       Spalten im mehrsprachigen Spalten-Assistenten konfiguriert werden können.
   * - Spalteneinstellung (übersetzt)
     - Mehrspaltiger Assistent zur Definition der Spaltenbeschriftungen je Sprache.
       Für jede Sprache und jede Spalte können angegeben werden:

       * **Sprache** – Sprachkürzel (z. B. ``de``, ``en``)
       * **Label** – Bezeichnung der Spalte in dieser Sprache
       * **Breite** – Breite der Spalte in der Eingabemaske (z. B. ``200px``)

       Die Spaltenbeschriftungen werden im Backend und im Frontend-Template
       sprachspezifisch ausgegeben.
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

Das Attribut besitzt eine eigene Render-Einstellung:

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

.. list-table::
   :header-rows: 1
   :widths: 30 70

   * - Filterregel
     - Hinweis
   * - Levenshtein-gestützte Suche
     - Ähnlichkeitssuche mit Tippfehlertoleranz über alle Zellwerte der
       aktiven Sprache; erfordert das Paket ``attribute_levenshtein``.
   * - Loupe
     - Volltext-Index-Suche über alle Zellwerte; erfordert das Paket
       ``filter_loupe`` (ab MM 2.4).


Sonderfunktionen
-----------------

**Speicherung**

Die Tabellenwerte werden sprachspezifisch in ``tl_metamodel_translatedtabletext``
gespeichert (Felder: ``att_id``, ``item_id``, ``langcode``, ``row``
(Zeilenindex), ``col`` (Spaltenindex), ``value``). Die MetaModel-Tabelle
erhält keine eigene Spalte.

**Sprachabhängige Spaltenbeschriftungen**

Im Gegensatz zur einsprachigen Text-Tabelle können die Spaltenüberschriften je
Sprache unterschiedlich definiert werden. Im Frontend-Template werden die
Spaltenbeschriftungen der aktiven Sprache ausgegeben.

**Fallback-Sprache**

Fehlt für eine Sprache ein Wert, greift MetaModels auf die Fallback-Sprache
zurück.

**Spaltenstruktur im Template**

Im Frontend-Template stehen die Werte als verschachteltes Array zur Verfügung:
``$arrData['raw']`` enthält Zeilen (row) mit Spalten (col_0, col_1, …), wobei
die Spaltennamen automatisch aus der Spaltenanzahl generiert werden. Die
übersetzten Spaltenbeschriftungen sind als ``$arrData['cols']`` verfügbar.


.. |br| raw:: html

   <br />
