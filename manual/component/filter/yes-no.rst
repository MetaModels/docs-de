.. _component_filter_yes-no:

|svg_filt_yes_no_22| | |img_filter_checkbox| Ja / Nein
======================================================

Die Filterregel "Ja / Nein" (Paket ``filter_checkbox``) gibt ein Frontend-Widget
aus, über das Besucher zwischen zwei Zuständen wählen können: "Ja" (Wert ``1``)
oder "Nein" (Wert ``0`` bzw. leer). Je nach Modus erscheint das Widget als
Checkbox, als zwei separate Checkboxen (Ja/Nein) oder als Radio-Buttons.

Die Filterregel filtert Items anhand des gewählten Werts eines Checkbox-Attributs
und eignet sich für explizite Ja/Nein-Auswahlen im Frontend-Filterwidget.

.. note:: Im Backend-Auswahlmenü für den Filterregeltyp wird diese Regel als
   "Ja / Nein" angezeigt. Sie ist technisch identisch mit der
   :ref:`Checkbox-Status-Filterregel <component_filter_checkbox>`, wird
   aber mit dem Modus "Radio-Buttons" oder "Ja/Nein-Checkbox" konfiguriert.


Installation
------------

Die Filterregel wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/filter_checkbox


Einstellungen beim Anlegen der Filterregel
------------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - Typ
     - Auswahl des Filterregeltyps – hier: "Ja / Nein".
   * - Aktiviert
     - Aktiviert oder deaktiviert diese Filterregel.
   * - Kommentar
     - Freitextfeld zur Beschreibung des Zwecks dieser Filterregel.
   * - Attribut
     - Das Checkbox-Attribut, nach dessen Wert gefiltert werden soll.


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
   * - Statischer Parameter
     - Ist diese Option aktiv, wird der Filterwert aus einer Auswahlliste im
       Inhaltselement/Modul bezogen statt aus der URL.
   * - Label
     - Beschriftung des Filterwidgets.
   * - Label beim Filterwidget ausblenden
     - Unterdrückt die Ausgabe des Labels.
   * - Template
     - Template für die Widget-Ausgabe. Standard: ``mm_filteritem_default``;
       für Checkbox-spezifische Ausgaben: ``mm_filteritem_checkbox``.
   * - Modus
     - Wählt den Darstellungsmodus des Widgets:

       * **Ja-Checkbox** – Einzelne Checkbox; filtert auf ``1``, wenn angehakt
       * **Nein-Checkbox** – Einzelne Checkbox; filtert auf ``0``/leer, wenn angehakt
       * **Radio-Buttons** – Zwei Radio-Buttons (Ja/Nein); zusätzlich erscheint die
         Option "Leere Auswahl ermöglichen" für eine "Alle"-Option
   * - "Ja/Nein" anstatt Attribut-Name
     - Zeigt "Ja" und "Nein" als Optionsbezeichnungen anstelle des Attributnamens.
   * - Leere Auswahl ermöglichen
     - (nur bei Modus "Radio-Buttons") Fügt eine leere Option ("Alle") hinzu,
       mit der die Filterregel deaktiviert werden kann.
   * - Optionsbezeichnung als Parameter
     - Der URL-Parameterwert ist der Optionstext ("Ja"/"Nein") statt einer Zahl.
   * - CSS-ID/Klasse
     - Setzt eine CSS-ID oder -Klasse am Widget-Element.


Passende Attribute
------------------

Die Filterregel "Ja / Nein" ist ausschließlich für folgende Attribute geeignet:

* :ref:`Kontrollkästchen (Checkbox) <component_attribute_checkbox>`
* :ref:`Übersetzte Checkbox <component_attribute_translatedcheckbox>`


.. |svg_filt_yes_no_22| image:: /_img/icons_svg/filter_yes-no.svg
   :width: 22px
.. |img_filter_checkbox| image:: /_img/icons/filter_checkbox.png

.. |br| raw:: html

   <br />
