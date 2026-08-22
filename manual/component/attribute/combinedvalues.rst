.. _component_attribute_combinedvalues:

|svg_attr_combinedvalues_22| |img_combinedvalues| Kombinierte Einträge
======================================================================

Das Attribut "Kombinierte Einträge" fügt Werte aus mehreren vorhandenen Attributen
zu einem neuen, gespeicherten Textwert zusammen. Typische Einsatzbereiche:

* Zusammensetzen von Vor- und Nachname zu "Nachname, Vorname" für Anzeige oder Suche
* Erstellen von zusammengesetzten Bezeichnern aus mehreren Feldern z. B. für Attribut
  :ref:`Einzelauswahl <component_attribute_select>` oder :ref:`Mehrfachauswahl <component_attribute_tags>`
* Aufbereitung von Ausgabetexten, die fix kombiniert gespeichert werden sollen

Die Kombination erfolgt über eine ``sprintf``-Formatzeichenkette. Alle vorhandenen
MetaModels-Attribute sowie System-Metafelder (ID, PID, Sortierung usw.) können als
Quellfelder ausgewählt werden.

.. seealso:: Für mehrsprachige MetaModels steht das Attribut
   :ref:`component_attribute_translatedcombinedvalues` zur Verfügung.


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_combinedvalues


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Neben den allgemeinen Attribut-Einstellungen (Name, Spaltenname, Beschreibung,
Eindeutige Werte, Varianten überschreiben) bietet das Attribut folgende spezifische
Optionen:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Format
     - ``sprintf``-Formatzeichenkette, die festlegt, wie die Quellwerte kombiniert
       werden. Für jeden ausgewählten Feldwert muss ein Platzhalter ``%s`` vorhanden
       sein. Beispiele:

       * ``%s, %s`` → "Müller, Hans"
       * ``%s (%s)`` → "Produkt A (Kategorie B)"
       * ``%s-%s-%s`` → "2024-01-15"

       Alle Platzhalter-Varianten von ``sprintf`` sind möglich (siehe
       https://www.php.net/sprintf).
   * - Felder
     - Auswahl der Quell-Attribute in der Reihenfolge, in der sie in das Format
       eingesetzt werden. Neben eigenen MetaModels-Attributen stehen auch
       System-Metafelder zur Auswahl: ID, PID, Sortierung, Zeitstempel,
       Variantengruppe, Variantenbasis.
   * - Aktualisierung erzwingen
     - Ist diese Checkbox aktiv, wird der kombinierte Wert bei jeder Änderung
       eines der Quell-Attribute automatisch neu generiert. Das Feld wird im
       Backend dann als schreibgeschützt angezeigt. Ohne diese Option bleibt ein
       einmal generierter Wert unverändert.


Einstellungen bei den Render-Einstellungen
-------------------------------------------

Das Attribut "Kombinierte Einträge" besitzt keine eigenen Render-Einstellungen.
In der Attributliste einer Render-Einstellung stehen die üblichen Optionen zur Verfügung:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Template
     - Auswahl eines eigenen Templates für die Ausgabe des kombinierten Wertes.
       Wird kein Template angegeben, erfolgt die Ausgabe als einfacher Text.
   * - CSS-Klasse
     - Optionale CSS-Klasse, die dem Ausgabeelement hinzugefügt wird.


Einstellungen bei der Eingabemaske
------------------------------------

Wird das Attribut einer Eingabemaske hinzugefügt, stehen folgende Optionen zur Verfügung:

**Darstellung**

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Backend-Klasse
     - CSS-Klassen für die Darstellung des Feldes im Backend-Formular (z. B.
       ``long`` für volle Breite).
   * - Template für das Backend
     - Auswahl eines eigenen Widget-Templates für das Backend-Formular.
   * - Template für das Frontend
     - Auswahl eines eigenen Widget-Templates für das Frontend-Editing
       (nur verfügbar, wenn die Erweiterung "Frontend Editing" installiert ist).

**Funktionen**

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Pflichtfeld
     - Macht das Feld zu einem Pflichtfeld. Bei aktivierter Option "Eindeutige
       Werte" wird dies automatisch gesetzt.
   * - Immer speichern
     - Das Feld wird auch dann gespeichert, wenn sich sein Wert nicht geändert
       hat. Wird automatisch gesetzt, wenn "Aktualisierung erzwingen" aktiv ist.

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

Das Attribut "Kombinierte Einträge" kann mit folgenden Filterregeln verwendet werden:

.. list-table::
   :header-rows: 1
   :widths: 30 70

   * - Filterregel
     - Hinweis
   * - Textsuche
     - Freie Texteingabe zur Suche im kombinierten Wert.
   * - Einfache Abfrage
     - Filtert nach einem exakten oder partiellen Wert über einen URL-Parameter.
   * - Einzelauswahl
     - Auswahl eines Wertes aus einer Liste der vorhandenen kombinierten Einträge.
   * - Mehrfachauswahl
     - Mehrfachauswahl aus einer Liste der vorhandenen kombinierten Einträge.
   * - Register
     - Filtert nach Anfangsbuchstaben des kombinierten Wertes.
   * - Levenshtein-gestützte Suche
     - Ähnlichkeitssuche mit Tippfehlertoleranz; erfordert das Paket
       ``attribute_levenshtein``.
   * - Loupe
     - Volltext-Index-Suche; erfordert das Paket ``filter_loupe`` (ab MM 2.4).


Sonderfunktionen
-----------------

**Eindeutigkeit mit automatischer Nummerierung**

Ist "Eindeutige Werte" aktiv, prüft MetaModels nach der Generierung, ob der
kombinierte Wert bereits existiert. Wird ein Duplikat gefunden, wird automatisch
ein Zähler in Klammern angehängt: ``Müller, Hans (2)``, ``Müller, Hans (3)`` usw.

**Verhalten beim Kopieren eines Datensatzes**

Ist "Aktualisierung erzwingen" aktiv, wird beim Duplizieren eines Datensatzes
kein Wert übernommen. Der kombinierte Wert wird beim Speichern des neuen
Datensatzes automatisch neu generiert (``doNotCopy``-Verhalten).

**Format-Platzhalter**

Es können alle ``sprintf``-Platzhalter verwendet werden, nicht nur ``%s``.
Beispielsweise formatiert ``%05d`` eine Zahl mit führenden Nullen auf 5 Stellen.
Die Anzahl der Platzhalter muss der Anzahl der ausgewählten Felder entsprechen.

**Datenbank-Speicherung**

Der kombinierte Wert wird als ``text NULL`` gespeichert. Ein leerer Wert wird als
``NULL`` abgelegt (kompatibel mit MySQL Strict Mode).


.. |svg_attr_combinedvalues_22| image:: /_img/icons_svg/combinedvalues.svg
   :width: 22px
.. |img_combinedvalues| image:: /_img/icons/combinedvalues.png

.. |br| raw:: html

   <br />
