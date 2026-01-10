.. _rst_cookbook_specials_picker-for-icons:

Icon-Picker
===========

Möchte man Datensätze mit einem Icon versehen, so kann man das Attribut Datei verwenden oder wenn die Icons per Font
eingebunden werden, die entsprechenden CSS-Klassen. Die Auswahl der Icons ist dann aber nicht sehr benutzerfreundlich.

Für Contao gibt es verschiedene Erweiterungen, die einen speziellen Icon-Picker zur Verfügung stellen.

Um diese Funktionalität auch in MM bereit zu stellen, könnte man ein eigenes Attribut erstellen. Die meisten
Icon-Picker speichern nur Strings bzw. serialisierte Arrays, so dass man auch mit kleinen DCA- und Template-Anpassungen
das Attribut Text verwenden kann.

Folgend werden die Anpassungen für gängige Picker-Erweiterungen vorgestellt.


Voraussetzung
-------------

Zunächst muss ein Attribut Text angelegt werden inklusive Migration und Einbindung in der Eingabemaske und bei den
Rendereinstellungen. In den Beispielen ist der Name des MetaModel ``mm_employees`` und der Spaltenname des Attributs
``*_icon``.

Für die DCA-Anpassungen muss eine PHP-Datei ``contao/dca/mm_employees.php`` angelegt werden.

Für die Ausgabe sind eigene Templates - abgeleitet von ``mm_attr_text`` - anzulegen und bei den Rendereinstellungen des
Attributs auszuwählen. Dort können auch zusätzliche CSS-Angaben für Größe oder Farbe hinterlegt werden.

RockSolid Icon Picker
---------------------

`Erweiterung auf Github <https://github.com/madeyourday/contao-rocksolid-icon-picker>`_.

Die Erweiterung arbeitet mit einem eigenen `Icon-Font <https://github.com/madeyourday/RockSolid-Icon-Font>`_ - die
SVG-Dateien kann man mit dem `SVG-Font-Generator <https://github.com/madeyourday/SVG-Icon-Font-Generator>`_ umwandeln
und ggf. auch eigene SVG-Icons hinzufügen. Wer ein `Theme von RST <https://rocksolidthemes.com/de/contao-themes>`_ im
Einsatz hat, findet die fertigen Font-Dateien im dem entsprechenden Theme-Paket.

DCA-Anpassung:

.. code-block:: php
   :linenos:

   <?php
   // contao/dca/mm_employees.php
   $GLOBALS['TL_DCA']['mm_employees']['fields']['rst_icon']['inputType']        = 'rocksolid_icon_picker';
   $GLOBALS['TL_DCA']['mm_employees']['fields']['rst_icon']['eval']['iconFont'] = '/files/themes/iconfont/rocksolid-icons.svg';

Template:

.. code-block:: php
   :linenos:

   <?php
   // templates/mm_attr_text_rst_icon.html5
   <span class="<?= $this->additional_class ?>" data-icon="&#x<?= $this->raw ?>;"></span>

Ausgabe BE & FE:

|img_rst_01.png|

|img_rst_02.png|



.. |img_lbsvg_01.png| image:: /_img/screenshots/cookbook/specials/icon_picker/lbsvg_01.png
.. |img_lbsvg_02.png| image:: /_img/screenshots/cookbook/specials/icon_picker/lbsvg_02.png
.. |img_mcfa_01.png| image:: /_img/screenshots/cookbook/specials/icon_picker/mcfa_01.png
.. |img_mcfa_02.png| image:: /_img/screenshots/cookbook/specials/icon_picker/mcfa_02.png
.. |img_ng_01.png| image:: /_img/screenshots/cookbook/specials/icon_picker/ng_01.png
.. |img_ng_02.png| image:: /_img/screenshots/cookbook/specials/icon_picker/ng_02.png
.. |img_rst_01.png| image:: /_img/screenshots/cookbook/specials/icon_picker/rst_01.png
.. |img_rst_02.png| image:: /_img/screenshots/cookbook/specials/icon_picker/rst_02.png

.. |br| raw:: html

   <br />
