.. _component_attribute_numeric:

|svg_attr_numeric_22| Numerisch
===============================

Das Attribut "Numerisch" speichert ganzzahlige Werte (Integer). Typische
Einsatzbereiche:

* Stückzahlen, Mengenangaben, Lagerbestände
* Jahreszahlen, Altersangaben
* Sortier- oder Prioritätswerte
* Zähler und Rankings

.. note:: Für Postleitzahlen oder Telefonnummern sollte das Attribut "Text"
   verwendet werden, da diese keine echten Zahlenwerte sind und führende Nullen
   verlieren würden.


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_numeric


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Das Numerisch-Attribut besitzt keine eigenen spezifischen Einstellungen. Es werden
nur die allgemeinen Attribut-Einstellungen verwendet:

* Name, Spaltenname, Beschreibung
* Eindeutige Werte
* Varianten überschreiben


Einstellungen bei den Render-Einstellungen
-------------------------------------------

Das Numerisch-Attribut besitzt keine eigenen Render-Einstellungen. In der Attributliste
einer Render-Einstellung stehen die üblichen Optionen zur Verfügung:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Template
     - Auswahl eines eigenen Templates für die Ausgabe des numerischen Wertes.
       Wird kein Template angegeben, erfolgt die Ausgabe als einfacher Text.
   * - CSS-Klasse
     - Optionale CSS-Klasse, die dem Ausgabeelement hinzugefügt wird.


Einstellungen bei der Eingabemaske
------------------------------------

Wird das Numerisch-Attribut einer Eingabemaske hinzugefügt, stehen folgende Optionen
zur Verfügung:

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

Das Numerisch-Attribut kann mit folgenden Filterregeln verwendet werden:

.. list-table::
   :header-rows: 1
   :widths: 30 70

   * - Filterregel
     - Hinweis
   * - Wert von/bis für ein Feld
     - Von/bis-Bereichsfilter für ein einzelnes Numerisch-Attribut; z. B.
       für eine Altersbereichssuche oder Stückzahlfilterung.
   * - Wert von/bis für zwei Felder
     - Bereichsfilter über zwei Numerisch-Attribute; z. B. wenn ein
       Wertebereich durch ein "von"- und ein "bis"-Attribut abgebildet wird.


Sonderfunktionen
-----------------

**Eingabe-Validierung**

Das Eingabefeld ist mit der Regex-Prüfung ``digit`` belegt und akzeptiert
ausschließlich ganzzahlige numerische Eingaben. Die maximale Länge beträgt
10 Zeichen (entspricht dem Wertebereich eines 32-Bit-Integer).

**Datenbank-Speicherung**

Der Wert wird als ``int(10) NULL default NULL`` gespeichert. Ein leerer Wert
wird als ``NULL`` abgelegt (kompatibel mit MySQL Strict Mode).


.. |svg_attr_numeric_22| image:: /_img/icons_svg/numeric.svg
   :width: 22px
.. |br| raw:: html

   <br />
