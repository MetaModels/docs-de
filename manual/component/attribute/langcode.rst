.. _component_attribute_langcode:

Sprachschlüssel
===============

Das Attribut "Sprachschlüssel" stellt eine Auswahlliste von ISO-Sprachcodes
(Locales) zur Verfügung. Die Sprachnamen werden in der jeweils aktiven Backend-Sprache
angezeigt. Gespeichert wird der Sprachcode (z. B. ``de``, ``en``, ``fr`` oder auch
``de_DE``, ``en_US``). Typische Einsatzbereiche:

* Sprache eines Dokuments, Artikels oder Produkts
* Zielsprache bei Übersetzungsaufträgen
* Sprachpräferenz bei Benutzer- oder Mitgliederdaten

Die verfügbaren Sprachcodes können eingeschränkt werden, wenn nur eine bestimmte
Auswahl von Sprachen sinnvoll ist. Die Eingabe erfolgt über Checkboxen.


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Neben den allgemeinen Attribut-Einstellungen (Name, Spaltenname, Beschreibung,
Varianten überschreiben) bietet das Sprachschlüssel-Attribut folgende spezifische
Option:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Sprachschlüssel
     - Einschränkung der Sprachauswahl auf bestimmte Sprachcodes. Die verfügbaren
       Sprachen werden als Checkbox-Liste angezeigt. Ist keine Auswahl getroffen,
       stehen alle in Contao verfügbaren Sprachen zur Auswahl.


Einstellungen bei den Render-Einstellungen
-------------------------------------------

Das Sprachschlüssel-Attribut besitzt keine eigenen Render-Einstellungen. In der
Attributliste einer Render-Einstellung stehen die üblichen Optionen zur Verfügung:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Template
     - Auswahl eines eigenen Templates für die Ausgabe. Wird kein Template
       angegeben, wird der lokalisierte Sprachname in der aktiven Sprache ausgegeben.
   * - CSS-Klasse
     - Optionale CSS-Klasse, die dem Ausgabeelement hinzugefügt wird.


Einstellungen bei der Eingabemaske
------------------------------------

Wird das Sprachschlüssel-Attribut einer Eingabemaske hinzugefügt, stehen folgende
Optionen zur Verfügung:

**Darstellung**

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Backend-Klasse
     - CSS-Klassen für die Darstellung des Feldes im Backend-Formular (z. B.
       ``w50`` für halbe Breite).
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
     - Macht das Feld zu einem Pflichtfeld.
   * - Leere Option anzeigen
     - Zeigt eine leere Auswahloption an, damit kein Sprachcode vorausgewählt ist.

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

Für das Sprachschlüssel-Attribut steht aktuell keine eigene Filterregel zur
Verfügung. Für eine Filterung nach einem Sprachcode kann die Filterregel
"Einfache Abfrage" mit dem Sprachcode (z. B. ``de``) als Parameter verwendet werden.


Sonderfunktionen
-----------------

**Lokalisierte Ausgabe**

Der gespeicherte Sprachcode (z. B. ``de``) wird bei der Ausgabe automatisch in
den lokalisierten Sprachnamen der aktiven Sprache umgewandelt. Das Attribut
verwendet dafür den Contao-Dienst ``contao.intl.locales`` und cacht das
Ergebnis je Sprache.

**Fallback-Sprachen**

Ist ein Sprachname für die aktive Sprache nicht verfügbar, greift das Attribut
automatisch auf Fallback-Sprachen zurück, um dennoch einen lesbaren Namen
anzuzeigen.

**Datenbank-Speicherung**

Der Sprachcode wird als ``varchar(5) NULL`` gespeichert (bis zu 5 Zeichen,
z. B. ``de_DE``). Ein leerer Wert wird als ``NULL`` abgelegt (kompatibel mit
MySQL Strict Mode).


.. |br| raw:: html

   <br />
