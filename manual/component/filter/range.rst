.. _component_filter_range:

|img_filter_range| Wert von/bis für zwei Felder
================================================

Die Filterregel "Wert von/bis für zwei Felder" (Paket ``filter_range``) filtert Items
anhand eines Wertebereichs, der über zwei separate Attribute definiert wird. Das erste
Attribut stellt den Startwert ("Von") dar, das zweite Attribut den Endwert ("Bis").
Ein Item wird in das Ergebnis aufgenommen, wenn ein gegebener Suchwert innerhalb des
durch die beiden Attributwerte definierten Bereichs liegt.

Typische Einsatzbereiche: Gültigkeitszeiträume ("Gültig von" / "Gültig bis"),
Preisspannen mit separaten Feldern für Mindest- und Höchstpreis, oder
Veranstaltungszeiträume.

.. seealso:: Für den Vergleich eines einzelnen Attributs gegen einen vom Besucher
   eingegebenen Bereich steht die Filterregel
   :ref:`component_filter_fromto` zur Verfügung. |br|
   Für zwei Datumsfelder steht die Filterregel
   :ref:`component_filter_range-date` zur Verfügung.


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
     - Auswahl des Filterregeltyps – hier: "Wert von/bis für zwei Felder".
   * - Aktiviert
     - Aktiviert oder deaktiviert diese Filterregel.
   * - Kommentar
     - Freitextfeld zur Beschreibung des Zwecks dieser Filterregel.
   * - Attribut (Von)
     - Das erste Attribut, das den Startwert des Bereichs enthält.
   * - Attribut 2 (Bis)
     - Das zweite Attribut, das den Endwert des Bereichs enthält.


Einstellungen für das Frontend-Widget
--------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - URL-Parameter
     - Der Schlüssel (Key) des URL-Parameters für die Suchwertübergabe.
   * - URL-Typ für den Parameter
     - Legt fest, ob der Parameter als Slug (sprechende URL), als GET-Parameter übergeben wird (ab MM 2.4) - :ref:`siehe
       SEO <rst_cookbook_tips_seo_filter-url>`
   * - Label
     - Beschriftung des Filterwidgets.
   * - Label beim Filterwidget ausblenden
     - Unterdrückt die Ausgabe des Labels.
   * - Template
     - Template für die Widget-Ausgabe. Standard: ``mm_filteritem_default``.
   * - Platzhalter
     - Platzhaltertext in den Eingabefeldern.
   * - Filterbereich-Typ
     - Legt fest, wie der Suchbereich mit den Attributwerten verglichen wird:

       * **s1** – Suchwert liegt vollständig innerhalb des Attributbereichs
       * **s2** – Suchwert überlappt mit dem Attributbereich
       * **s3** – Suchwert beginnt innerhalb des Attributbereichs
       * **s4** – Suchwert endet innerhalb des Attributbereichs (Standard)
       * **s5** – Suchwert enthält den Attributbereich vollständig
   * - Mehr-als-Gleich (≥)
     - Der "Von"-Suchwert wird inklusiv verglichen (``>=``).
   * - Weniger-als-Gleich (≤)
     - Der "Bis"-Suchwert wird inklusiv verglichen (``<=``).
   * - Von-Feld anzeigen
     - Aktiviert die Anzeige des "Von"-Eingabefelds im Widget.
   * - Bis-Feld anzeigen
     - Aktiviert die Anzeige des "Bis"-Eingabefelds im Widget.
   * - CSS-ID/Klasse
     - Setzt eine CSS-ID oder -Klasse am Widget-Element.


Passende Attribute
------------------

Die Filterregel "Wert von/bis für zwei Felder" eignet sich für Attribute mit
numerischen Werten:

* :ref:`Numerisch <component_attribute_numeric>`
* :ref:`Dezimal <component_attribute_decimal>`


.. |img_filter_range| image:: /_img/icons/filter_range.png

.. |br| raw:: html

   <br />
