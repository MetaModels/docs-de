.. _component_attribute_timestamp:

Datum
=====

Das Attribut "Datum" speichert Datum, Uhrzeit oder beides als Unix-Zeitstempel
(``bigint``). Im Backend wird ein Datumspicker mit dem konfigurierten Contao-
Datumsformat angezeigt. Typische Einsatzbereiche:

* Erscheinungsdatum, Veranstaltungsdatum, Ablaufdatum
* Öffnungszeiten (nur Uhrzeit)
* Buchungszeitraum mit Start- und Enddatum (zwei Datum-Attribute)
* Zeitstempel für Ereignisse

.. note:: Datum-Werte werden als Unix-Zeitstempel gespeichert. Bei eigenen
   SQL-Filterungen oder -Abfragen müssen ggf. Konvertierungen vorgenommen
   werden (z. B. ``FROM_UNIXTIME()`` in MySQL).

.. seealso:: Für einen modernen Datumspicker im Frontend:
   :ref:`rst_cookbook_templates_flatpickr-integration`


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_timestamp


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Neben den allgemeinen Attribut-Einstellungen (Name, Spaltenname, Beschreibung,
Varianten überschreiben) bietet das Datum-Attribut folgende spezifische Option:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Schema
     - Legt fest, welcher Eingabe-Typ im Backend verwendet wird:

       * **Datum** – Nur das Datum (ohne Uhrzeit)
       * **Datum und Uhrzeit** – Datum zusammen mit Uhrzeit
       * **Zeit** – Nur die Uhrzeit (ohne Datum)


Einstellungen bei den Render-Einstellungen
-------------------------------------------

Das Datum-Attribut besitzt eine eigene Render-Einstellung:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Format
     - Eigenes Datumsformat für die Ausgabe, das mit der PHP-Funktion ``date()``
       formatiert wird (z. B. ``d.m.Y``, ``H:i``, ``d.m.Y H:i``). Wird das
       Feld leer gelassen, wird das im Contao-System konfigurierte
       Standardformat verwendet.
   * - Template
     - Auswahl eines eigenen Templates für die Ausgabe des Datumswerts.
   * - CSS-Klasse
     - Optionale CSS-Klasse, die dem Ausgabeelement hinzugefügt wird.


Einstellungen bei der Eingabemaske
------------------------------------

Wird das Datum-Attribut einer Eingabemaske hinzugefügt, stehen folgende Optionen
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
   * - Handhabung von Datum und Uhrzeit
     - Legt fest, welcher Teil des Zeitstempels beim Speichern auf 0 gesetzt
       wird. Wichtig für eine korrekte Filterung:

       * **Nur Datum ohne Uhrzeit speichern** – Die Uhrzeit wird auf
         ``00:00:00`` zurückgesetzt. Sinnvoll bei reinen Datumsfiltern.
       * **Nur Uhrzeit ohne Datum speichern** – Das Datum wird auf den
         Unix-Epochen-Starttag (01.01.1970) zurückgesetzt.

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

Das Datum-Attribut kann mit folgenden Filterregeln verwendet werden:

.. list-table::
   :header-rows: 1
   :widths: 30 70

   * - Filterregel
     - Hinweis
   * - Wert von/bis für ein Datumsfeld
     - Von/bis-Bereichsfilter für ein einzelnes Datum-Attribut; z. B. alle
       Veranstaltungen in einem Zeitraum. Eigenes Template:
       ``mm_filteritem_datepicker.html5`` für einen HTML5-Datumspicker
       (Format ``YYYY-MM-DD``).
   * - Wert von/bis für zwei Datumsfelder
     - Bereichsfilter über zwei Datum-Attribute; z. B. wenn Start- und
       Enddatum als separate Attribute gespeichert sind.


Sonderfunktionen
-----------------

**Datenbank-Speicherung**

Datum- und Uhrzeitwerte werden als Unix-Zeitstempel in einem ``bigint(10) NULL``-Feld
gespeichert. Ein leerer Wert wird als ``NULL`` abgelegt.

**Formatierung**

Die Ausgabe wird über den Contao-Event ``ParseDateEvent`` gesteuert. Das Format
aus den Render-Einstellungen hat Vorrang vor dem systemweiten Contao-Format. In
Templates steht der formatierte Wert direkt als ``$arrData['html5']`` oder
``$arrData['text']`` zur Verfügung.


.. |br| raw:: html

   <br />
