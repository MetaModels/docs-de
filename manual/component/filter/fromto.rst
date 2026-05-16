.. _component_filter_fromto:

|img_filter_fromto| Wert von/bis für ein Feld
===============================================

Die Filterregel "Wert von/bis für ein Feld" (Paket ``filter_fromto``) filtert Items
anhand eines Wertebereichs für ein einzelnes numerisches oder textbasiertes Attribut.
Besucher können im Frontend einen "Von"-Wert, einen "Bis"-Wert oder beides eingeben.
Die Filterregel liefert alle Items, deren Attributwert innerhalb des angegebenen
Bereichs liegt.

Typische Einsatzbereiche: Preisfilter (Preis von X bis Y), Größen- oder
Altersangaben, oder allgemeine numerische Bereichsfilter.

.. seealso:: Für den Vergleich über zwei separate Attribute (z. B. "Gültig von"
   und "Gültig bis") steht die Filterregel
   :ref:`component_filter_range` zur Verfügung. |br|
   Für Datumswerte steht die Filterregel
   :ref:`component_filter_fromto-date` zur Verfügung.


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
     - Auswahl des Filterregeltyps – hier: "Wert von/bis für ein Feld".
   * - Aktiviert
     - Aktiviert oder deaktiviert diese Filterregel.
   * - Kommentar
     - Freitextfeld zur Beschreibung des Zwecks dieser Filterregel.
   * - Attribut
     - Das Attribut, nach dessen Wert gefiltert werden soll (z. B. Preis, Alter).


Einstellungen für das Frontend-Widget
--------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - URL-Parameter
     - Der Schlüssel (Key) des URL-Parameters. Der "Von"-Wert erhält das Suffix
       ``__from``, der "Bis"-Wert das Suffix ``__to`` (z. B. ``preis__from``
       und ``preis__to``).
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
     - Platzhaltertext, der in den Eingabefeldern angezeigt wird, solange sie leer sind.
   * - Mehr-als-Gleich (≥)
     - Ist diese Option aktiv, gilt der "Von"-Wert als inklusiv (``>=``). Andernfalls
       exklusiv (``>``).
   * - Weniger-als-Gleich (≤)
     - Ist diese Option aktiv, gilt der "Bis"-Wert als inklusiv (``<=``). Andernfalls
       exklusiv (``<``).
   * - Von-Feld anzeigen
     - Aktiviert die Anzeige des "Von"-Eingabefelds im Widget.
   * - Bis-Feld anzeigen
     - Aktiviert die Anzeige des "Bis"-Eingabefelds im Widget.
   * - CSS-ID/Klasse
     - Setzt eine CSS-ID oder -Klasse am Widget-Element.


Passende Attribute
------------------

Die Filterregel "Wert von/bis für ein Feld" eignet sich für Attribute mit
numerischen oder vergleichbaren Werten:

* :ref:`Numerisch <component_attribute_numeric>`
* :ref:`Dezimal <component_attribute_decimal>`


.. |img_filter_fromto| image:: /_img/icons/filter_fromto.png

.. |br| raw:: html

   <br />
