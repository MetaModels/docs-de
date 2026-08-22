.. _component_attribute_color:

|svg_attr_color_22| |img_color| Farbwähler
==========================================

Das Attribut "Farbwähler" ermöglicht die Auswahl einer Webfarbe inkl. Sättigungswert
über ein integriertes Colorpicker-Widget. Typische Einsatzbereiche:

* Hintergrundfarben, Schriftfarben oder Akzentfarben für Designelemente
* Farbkennzeichnung von Kategorien oder Ereignissen
* Transparenzgesteuerte Farbwerte (Farbe + Sättigung)

Im Backend erscheinen zwei Eingabefelder: ein Textfeld für den Hex-Farbcode (6 Zeichen,
z. B. ``ff0000``) und ein zweites Feld für den Sättigungswert. Über das Colorpicker-Icon
kann die Farbe visuell gewählt werden.


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_color


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Das Farbwähler-Attribut besitzt keine eigenen spezifischen Einstellungen beim
Anlegen. Es werden die allgemeinen Attribut-Einstellungen verwendet:

* Name, Spaltenname, Beschreibung
* Varianten überschreiben

.. note:: Die Option "Eindeutige Werte" steht für dieses Attribut nicht zur
   Verfügung, da Farbwerte als serialisierte Daten gespeichert werden.


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
     - Auswahl eines eigenen Templates für die Ausgabe des Farbwerts.
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

Das Farbwähler-Attribut kann mit folgenden Filterregeln verwendet werden:

.. list-table::
   :header-rows: 1
   :widths: 30 70

   * - Filterregel
     - Hinweis
   * - Einfache Abfrage
     - Filtert nach einem exakten Farbwert über einen URL-Parameter.
   * - Einzelauswahl
     - Auswahl eines Farbwerts aus einer Liste vorhandener Werte.


Sonderfunktionen
-----------------

**Datenbank-Speicherung**

Der Farbwert wird als serialisiertes PHP-Array in einem ``TINYBLOB NULL``-Feld
gespeichert. Das Array enthält zwei Elemente: den Hex-Farbcode (ohne ``#``) und
den Sättigungswert. Ein leerer Wert wird als ``NULL`` abgelegt.

**Colorpicker-Widget**

Im Backend wird neben dem Textfeld ein Colorpicker-Wizard eingeblendet, über
den die Farbe visuell ausgewählt werden kann. Das erste Textfeld nimmt den
sechsstelligen Hex-Farbcode auf, das zweite den Sättigungswert.

**Sortierung nach Farbwert**

Die Sortierung nach Farbwerten erfolgt über eine Konvertierung der Hexadezimalwerte
in numerische Sortierschlüssel, sodass Farben sinnvoll nach ihrem numerischen
Farbwert geordnet werden können.


.. |svg_attr_color_22| image:: /_img/icons_svg/color.svg
   :width: 22px
.. |img_color| image:: /_img/icons/color.png
.. |br| raw:: html

   <br />
