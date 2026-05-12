.. _component_attribute_decimal:

|img_decimal| Dezimal
=====================

Das Attribut "Dezimal" speichert Dezimalzahlen (Gleitkommazahlen doppelter
Genauigkeit). Typische Einsatzbereiche:

* Geldbeträge und Preise (z. B. ``19.99``)
* Maße und Gewichte (z. B. ``1.75``, ``0.5``)
* Geografische Koordinaten (Latitude/Longitude)
* Prozentwerte oder Bewertungswerte

.. note:: Für Postleitzahlen oder Telefonnummern sollte das Attribut "Text"
   verwendet werden, da diese keine echten Zahlenwerte sind und führende Nullen
   verlieren würden. Für die Umkreissuche sind je ein Dezimal-Attribut für
   Latitude und Longitude anzulegen.

.. note:: Die Eingabe erfolgt mit einem **Punkt** als Dezimaltrennzeichen
   (nicht Komma).


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_decimal


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Das Dezimal-Attribut besitzt keine eigenen spezifischen Einstellungen. Es werden
nur die allgemeinen Attribut-Einstellungen verwendet:

* Name, Spaltenname, Beschreibung
* Eindeutige Werte
* Varianten überschreiben


Einstellungen bei den Render-Einstellungen
-------------------------------------------

Das Dezimal-Attribut besitzt keine eigenen Render-Einstellungen. In der Attributliste
einer Render-Einstellung stehen die üblichen Optionen zur Verfügung:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Template
     - Auswahl eines eigenen Templates für die Ausgabe des Dezimalwertes.
       Wird kein Template angegeben, erfolgt die Ausgabe als einfacher Text.
   * - CSS-Klasse
     - Optionale CSS-Klasse, die dem Ausgabeelement hinzugefügt wird.


Einstellungen bei der Eingabemaske
------------------------------------

Wird das Dezimal-Attribut einer Eingabemaske hinzugefügt, stehen folgende Optionen
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

Das Dezimal-Attribut kann mit folgenden Filterregeln verwendet werden:

.. list-table::
   :header-rows: 1
   :widths: 30 70

   * - Filterregel
     - Hinweis
   * - Wert von/bis für ein Feld
     - Von/bis-Bereichsfilter für ein einzelnes Dezimal-Attribut; z. B. für
       eine Preisbereichssuche mit Minimal- und Maximalwert.
   * - Wert von/bis für zwei Felder
     - Bereichsfilter über zwei Dezimal-Attribute; z. B. wenn ein Wertebereich
       durch "von"-Attribut und "bis"-Attribut abgebildet wird
       (z. B. Preisbereich eines Angebots).
   * - Umkreissuche
     - Für Geokoordinaten: Filtert nach Umkreis um einen Suchpunkt, wenn
       Latitude und Longitude als je ein Dezimal-Attribut gespeichert sind.


Sonderfunktionen
-----------------

**Datenbank-Speicherung**

Der Wert wird als ``double NULL default NULL`` gespeichert. Ein leerer Wert wird
als ``NULL`` abgelegt (kompatibel mit MySQL Strict Mode).

**Eingabe-Validierung**

Das Eingabefeld ist mit der Regex-Prüfung ``digit`` belegt, die ausschließlich
numerische Eingaben (inkl. Dezimalpunkt und Vorzeichen) akzeptiert.


.. |img_decimal| image:: /_img/icons/decimal.png

.. |br| raw:: html

   <br />
