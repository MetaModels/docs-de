.. _component_filter_fromto-date:

|img_filter_fromto| Wert von/bis für ein Datumsfeld
=====================================================

Die Filterregel "Wert von/bis für ein Datumsfeld" (Paket ``filter_fromto``) filtert
Items anhand eines Datumsbereichs für ein einzelnes Datum-Attribut. Besucher können
im Frontend ein "Von"-Datum, ein "Bis"-Datum oder beides eingeben. Die Filterregel
vergleicht die als UNIX-Timestamp gespeicherten Datumswerte mit dem angegebenen
Bereich.

Typische Einsatzbereiche: Terminfilter (Veranstaltungen von Datum X bis Datum Y),
Gültigkeitszeiträume, oder allgemeine Datumsbereichsfilter.

Ein eigenes Template ``mm_filteritem_datepicker.html5`` steht für eine
browserbasierte Datumseingabe zur Verfügung. Für das HTML5-``date``-Inputfeld
muss das Datum im Format ``YYYY-MM-DD`` übergeben werden –
`mehr Informationen <https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/date>`_.

.. seealso:: Für den Vergleich über zwei separate Datumsattribute steht die
   Filterregel :ref:`component_filter_range-date` zur
   Verfügung. |br|
   Für numerische Werte steht die Filterregel
   :ref:`component_filter_fromto` zur Verfügung.


Installation
------------

Die Filterregel wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/filter_fromto


Einstellungen beim Anlegen der Filterregel
------------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - Typ
     - Auswahl des Filterregeltyps – hier: "Wert von/bis für ein Datumsfeld".
   * - Aktiviert
     - Aktiviert oder deaktiviert diese Filterregel.
   * - Kommentar
     - Freitextfeld zur Beschreibung des Zwecks dieser Filterregel.
   * - Attribut
     - Das Datum-Attribut, nach dessen Wert gefiltert werden soll.


Einstellungen für das Frontend-Widget
--------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - URL-Parameter
     - Der Schlüssel (Key) des URL-Parameters.
   * - Datumsformat
     - Das Format, in dem das Datum im Frontend-Eingabefeld erwartet wird
       (z. B. ``d.m.Y`` oder ``Y-m-d``). Standard: Contao-Datumsformat aus
       den Systemeinstellungen.
   * - Zeittyp
     - Legt fest, ob nur das Datum (``date``), Datum und Uhrzeit (``datim``)
       oder nur die Uhrzeit (``time``) verglichen wird.
   * - Label
     - Beschriftung des Filterwidgets.
   * - Label beim Filterwidget ausblenden
     - Unterdrückt die Ausgabe des Labels.
   * - Template
     - Template für die Widget-Ausgabe. Standard: ``mm_filteritem_default``;
       für Datepicker-Eingabe: ``mm_filteritem_datepicker``.
   * - Platzhalter
     - Platzhaltertext in den Eingabefeldern.
   * - Mehr-als-Gleich (≥)
     - Ist diese Option aktiv, gilt das "Von"-Datum als inklusiv (``>=``).
   * - Weniger-als-Gleich (≤)
     - Ist diese Option aktiv, gilt das "Bis"-Datum als inklusiv (``<=``).
   * - Von-Feld anzeigen
     - Aktiviert die Anzeige des "Von"-Datumsfelds im Widget.
   * - Bis-Feld anzeigen
     - Aktiviert die Anzeige des "Bis"-Datumsfelds im Widget.
   * - CSS-ID/Klasse
     - Setzt eine CSS-ID oder -Klasse am Widget-Element.


Passende Attribute
------------------

Die Filterregel "Wert von/bis für ein Datumsfeld" eignet sich für :ref:`Attribut Datum
<component_attribute_timestamp>`  - soll die Filterung nur für Datumsangaben sein, sollte man bei der Option
"Handhabung von Datum und Uhrzeit" die Auswahl auf "Nur Datum ohne Uhrzeit speichern" stellen.


.. |img_filter_fromto| image:: /_img/icons/filter_fromto.png

.. |br| raw:: html

   <br />
