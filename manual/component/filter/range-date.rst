.. _component_filter_range-date:

|img_filter_range| Wert von/bis für zwei Datumsfelder
======================================================

Die Filterregel "Wert von/bis für zwei Datumsfelder" (Paket ``filter_range``) filtert
Items anhand eines Datumsbereichs, der über zwei separate Datum-Attribute definiert
wird. Das erste Datum-Attribut enthält den Startzeitpunkt ("Von"), das zweite den
Endzeitpunkt ("Bis"). Ein Item wird in das Ergebnis aufgenommen, wenn ein gegebenes
Suchdatum innerhalb des durch die beiden Attributwerte definierten Zeitraums liegt.

Typische Einsatzbereiche: Veranstaltungszeiträume, Buchungszeiträume,
Gültigkeitszeiträume mit separaten Datum-Attributen.

Ein eigenes Template ``mm_filteritem_datepicker.html5`` steht für eine
browserbasierte Datumseingabe zur Verfügung. Für das HTML5-``date``-Inputfeld
muss das Datum im Format ``YYYY-MM-DD`` übergeben werden –
`mehr Informationen <https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/date>`_.

.. seealso:: Für numerische Zweifeldvergleiche steht die Filterregel
   :ref:`component_filter_range` zur Verfügung.


Installation
------------

Die Filterregel wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/filter_range


Einstellungen beim Anlegen der Filterregel
------------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - Typ
     - Auswahl des Filterregeltyps – hier: "Wert von/bis für zwei Datumsfelder".
   * - Aktiviert
     - Aktiviert oder deaktiviert diese Filterregel.
   * - Kommentar
     - Freitextfeld zur Beschreibung des Zwecks dieser Filterregel.
   * - Attribut (Von)
     - Das erste Datum-Attribut, das den Startzeitpunkt enthält.
   * - Attribut 2 (Bis)
     - Das zweite Datum-Attribut, das den Endzeitpunkt enthält.


Einstellungen für das Frontend-Widget
--------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - URL-Parameter
     - Der Schlüssel (Key) des URL-Parameters für die Übergabe des Filterwerts.
       Ohne Angabe wird der Spaltenname des Attributs verwendet. Mit ``auto_item``
       wird nur der Wert – ohne Schlüssel – in die URL eingebaut.
   * - URL-Typ für den Parameter
     - Legt fest, ob der Parameter als Slug (sprechende URL), als GET-Parameter übergeben wird (ab MM 2.4) - :ref:`siehe
       SEO <rst_cookbook_tips_seo_filter-url>`
   * - Datumsformat
     - Das Format, in dem das Datum erwartet wird (z. B. ``d.m.Y`` oder ``Y-m-d``).
   * - Zeittyp
     - Legt fest, ob Datum (``date``), Datum und Uhrzeit (``datim``) oder
       Uhrzeit (``time``) verglichen wird.
   * - Label
     - Beschriftung des Filterwidgets.
   * - Label beim Filterwidget ausblenden
     - Unterdrückt die Ausgabe des Labels.
   * - Template
     - Template für die Widget-Ausgabe. Für Datepicker: ``mm_filteritem_datepicker``.
   * - Platzhalter
     - Platzhaltertext in den Eingabefeldern.
   * - Filterbereich-Typ
     - Legt fest, wie der Suchdatumsbereich mit den Attributwerten verglichen wird
       (s1–s5, analog zur Filterregel
       :ref:`component_filter_range`).
   * - Mehr-als-Gleich (≥)
     - Das "Von"-Suchdatum wird inklusiv verglichen (``>=``).
   * - Weniger-als-Gleich (≤)
     - Das "Bis"-Suchdatum wird inklusiv verglichen (``<=``).
   * - Von-Feld anzeigen
     - Aktiviert die Anzeige des "Von"-Datumsfelds im Widget.
   * - Bis-Feld anzeigen
     - Aktiviert die Anzeige des "Bis"-Datumsfelds im Widget.
   * - CSS-ID/Klasse
     - Setzt eine CSS-ID oder -Klasse am Widget-Element.


Passende Attribute
------------------

Die Filterregel "Wert von/bis für zwei Datumsfelder" eignet sich für :ref:`Attribut Datum
<component_attribute_timestamp>` - soll die Filterung nur für Datumsangaben sein, sollte man bei der Option
"Handhabung von Datum und Uhrzeit" die Auswahl auf "Nur Datum ohne Uhrzeit speichern" stellen.



.. |img_filter_range| image:: /_img/icons/filter_range.png

.. |br| raw:: html

   <br />
