.. _rst_cookbook_specials_picker-for-icons:

Icon-Picker
===========

Möchte man Datensätze mit einem Icon versehen, so kann man das Attribut Datei verwenden oder wenn die Icons per Font
eingebunden werden, die entsprechenden CSS-Klassen. Die Auswahl der Icons ist dann aber nicht sehr benutzerfreundlich.

Für Contao gibt es verschiedene Erweiterungen, die einen speziellen Icon-Picker zur Verfügung stellen.

Um diese Funktionalität auch in MM bereit zu stellen, könnte man ein eigenes Attribut erstellen. Die meisten
Icon-Picker speichern nur Strings bzw. serialisierte Array, so dass man auch mit kleinen DCA- und Template-Anpassungen
das Attribut Text verwenden kann.

Folgend werden die Anpassungen für gängige Picker-Erweiterungen vorgestellt:

- :ref:`RockSolid Icon Picker <picker_rst>`
- :ref:`Marco Cupic Font Awesome Icon Picker <picker_mcfa>`
- :ref:`NetGroup IconToolkit <picker_ng>`
- :ref:`Lukas Bableck SVG Icon-Picker <picker_lbsvg>`

Bitte die entsprechenden Lizenzbedingungen der Icons bzw. Fonts beachten!


Voraussetzung
-------------

Zunächst muss ein Attribut Text angelegt werden inklusive Migration und Einbindung in der Eingabemaske und bei den
Rendereinstellungen. In den Beispielen ist der Name des MetaModel ``mm_employees`` und der Spaltenname des Attributs
``*_icon``.

Für die DCA-Anpassungen ist eine PHP-Datei ``contao/dca/mm_employees.php`` anzulegen. Erscheint statt des Labels
"LABEL NOT SET", :ref:`bitte lt. Anleitung fixen <component_translations_lns>`.

Für die Ausgabe sind eigene Templates - abgeleitet von ``mm_attr_text`` - anzulegen und bei den Rendereinstellungen des
Attributs auszuwählen. Dort können auch zusätzliche CSS-Angaben für Größe oder Farbe hinterlegt werden.


.. _picker_rst:
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

CSS:

.. code-block:: css
   :linenos:

   /** Icon font */
   @font-face {
     font-family: "RockSolid Icons";
     src: url("../iconfont/rocksolid-icons.woff2") format("woff2"), url("../iconfont/rocksolid-icons.svg") format("svg");
     font-weight: normal;
     font-style: normal;
   }

   /* Icon attribute */
   *[data-icon]:before,
   *[class^="icon-"]:before,
   *[class*=" icon-"]:before {
     font: 100%/1 "RockSolid Icons";
     -webkit-font-smoothing: antialiased;
     font-smoothing: antialiased;
     text-rendering: geometricPrecision;
     text-indent: 0;
     display: inline-block;
     position: relative;
     margin-right: 0.26667em;
   }
   *[data-icon]:before {
     content: attr(data-icon);
   }
   *[data-icon].after:before {
     content: none;
   }
   *[data-icon].after:after {
     font: 100%/1 "RockSolid Icons";
     content: attr(data-icon);
     -webkit-font-smoothing: antialiased;
     font-smoothing: antialiased;
     text-rendering: geometricPrecision;
     text-indent: 0;
     display: inline-block;
     position: relative;
     margin-left: 0.26667em;
   }

Ausgabe BE & FE:

|img_rst_01.png|

|img_rst_02.png|


.. _picker_mcfa:
Marco Cupic Font Awesome Icon Picker
------------------------------------

`Erweiterung auf Github <https://github.com/markocupic/fontawesome-icon-picker-bundle>`_.

Ab Version 7 sind für das Widget keine Angaben in der ``config.yaml`` notwendig - jedoch werden die Icon-Daten direkt
vom Fontawesome-Server abgerufen. Wer das nicht möchte, kann die Dateien auch direkt auf dem Webserver einbinden.
Dazu kann man das Iconpaket  von der `Webseite downloaden <https://fontawesome.com/download>`_ und entpacken. Die
Ordner ``js/``, ``metadata/`` und ``webfonts/`` müssen auf dem Webserver in einen entsprechenden Ordner in ``files/``.

Die Konfiguration sieht dann z. B. wie folgt aus:

.. code-block:: php
   :linenos:

   # config/config.yaml
   markocupic_fontawesome_icon_picker:
     fontawesome_source_path: 'files/themes/fa7_icons/js/all.min.js'
     fontawesome_allowed_styles:
       - fa-regular
       - fa-solid
       - fa-brands
     fontawesome_meta_file_path: 'files/themes/fa7_icons/metadata/icons.yml'

Bei den Icons stehen je nach Konfiguration von ``fontawesome_allowed_styles`` und vorhandenen Icons die Label
R Regular, S Solid, B Brands als Auswahlbutton zur Verfügung - die Reihenfolge bestimmt den angezeigten Iconstyle im
Widget.

Benutzer einer FA-Pro-Variante orientieren sich an der Beschreibung der
`Readme <https://github.com/markocupic/fontawesome-icon-picker-bundle?tab=readme-ov-file#configuration>`_.

Es ist für beide Varianten zu beachten, dass man die Icon-Fonts für das FE selbst per CSS einbinden muss.

DCA-Anpassung:

.. code-block:: php
   :linenos:

   <?php
   // contao/dca/mm_employees.php
   $GLOBALS['TL_DCA']['mm_employees']['fields']['mcfa_icon']['inputType'] = 'fontawesomeIconPicker';

Template:

Da die Speicherung als serialisiertes Array erfolgt, muss sowohl das Template für ``html5`` als auch für ``text``
angelegt werden.

.. code-block:: php
   :linenos:

   <?php
   // templates/mm_attr_text_mcfa_icon.html5
   <?php
   /** Nach Deserialisierung steht ein Array mit drei Angaben zur Verfügung z. B.
   * Array
   * (
   *     [0] => circle-check
   *     [1] => fa-solid
   *     [2] => f058
   * )
   */

   $mcfaData = \Contao\StringUtil::deserialize($this->raw, true);
   ?>
   <i class="<?= $mcfaData[1] ?? '' ?> fa-<?= $mcfaData[0] ?? '' ?><?= $this->additional_class ?>"></i>


.. code-block:: php
   :linenos:

   <?php
   // templates/mm_attr_text_mcfa_icon.text
   <?php
   $mcfaData = \Contao\StringUtil::deserialize($this->raw, true);
   ?>
   <?= $mcfaData[1] ?? '' ?> fa-<?= $mcfaData[0] ?? '' ?>

Ausgabe BE & FE:

|img_mcfa_01.png|

|img_mcfa_02.png|


.. _picker_ng:
NetGroup IconToolkit
--------------------

`Erweiterung auf Github <https://github.com/netgroupgmbh/contao-icontoolkit>`_.

Die Erweiterung ist für `Font Awesome <https://fontawesome.com/>`_ konzipiert und liefert diese in der Version 7.1
mit. Es ist aber auch möglich, eigene Iconfonts zu laden oder einen aktuelleren Iconsatz. Für die Einbindung des
Fonts, gibt es ein FE-Modul.

DCA-Anpassung:

.. code-block:: php
   :linenos:

   <?php
   // contao/dca/mm_employees.php
   use NetGroup\IconToolkit\Classes\Contao\Widgets\IconPickerWidget;

   $GLOBALS['TL_DCA']['mm_employees']['fields']['ng_icon']['inputType'] = IconPickerWidget::TYPE;

Template:

.. code-block:: php
   :linenos:

   <?php
   // templates/mm_attr_text_ng_icon.html5
   <i class="<?= $this->raw ?><?= $this->additional_class ?>"></i>

CSS:

.. code-block:: css
   :linenos:

   // /* Klassen 'fa-2x fa-green' in Rendersettings */
   .fa-green {
     color: #6bb710;
   }

Ausgabe BE & FE:

|img_ng_01.png|

|img_ng_02.png|


.. _picker_lbsvg:
Lukas Bableck SVG Icon-Picker
-----------------------------

`Erweiterung auf Github <https://github.com/lukasbableck/contao-svg-icon-picker-bundle>`_.

Die Erweiterung ist für `Font Awesome <https://fontawesome.com/>`_ konzipiert - es ist aber auch möglich, eigene
SVG-Icons wie z. B. `Lucide <https://lucide.dev/icons/>`_ zu laden.

Die Icons werden als "echte" SVGs ausgespielt, so dass Anpassungen an Farbgebung usw. möglich sind.

DCA-Anpassung:

.. code-block:: php
   :linenos:

   <?php
   // contao/dca/mm_employees.php
   $GLOBALS['TL_DCA']['mm_employees']['fields']['lbsvg_icon']['inputType']                 = 'svgIconPicker';
   $GLOBALS['TL_DCA']['mm_employees']['fields']['lbsvg_icon']['eval']['sourceDirectory']   = '/files/themes/svg-icons/svgs-full/regular';
   $GLOBALS['TL_DCA']['mm_employees']['fields']['lbsvg_icon']['eval']['metadataDirectory'] = '/files/themes/svg-icons/metadata';

Template:

.. code-block:: php
   :linenos:

   <?php
   // templates/mm_attr_text_lbsvg_icon.html5
   use Contao\System;
   use Lukasbableck\ContaoSVGIconPickerBundle\Twig\Extension;

   $rootDir = System::getContainer()->getParameter('kernel.project_dir');
   $svgTool = new Extension($rootDir);

   $svg = \str_replace('class="', 'class="' . \trim($this->additional_class) . ' ', $svgTool->renderSVG($this->raw));
   ?>

   <?= $svg ?>

CSS:

.. code-block:: css
   :linenos:

   /* Klassen 'lbsvg_icon lbsvg_green' in Rendersettings */
   svg.lbsvg_icon {
     width: 33px;
     height: 33px;
   }

   svg.lbsvg_green {
     color: #6bb710;
   }


Ausgabe BE & FE:

|img_lbsvg_01.png|

|img_lbsvg_02.png|


Hinweise zu Fontawesome
-----------------------

Das Fontawesome-Iconpack kann man von der `Webseite downloaden <https://fontawesome.com/download>`_. Die "Free-Variante"
enthält die Regular, Solid und Brands. Will man die SVG-Icons einsetzen, empielt sich den Ordner ``svg-full/``
einzubinden - hier sind alle Icons quadratisch mit entsprechendem Rand.

Wird im FE das CSS von Fontawesom mit ausgespielt wie z. B. bei NG IconToolkit, dann können die entsprechenden
Stylingklassen wie ``fa-2x`` für doppelte Größe bei den Rendersettings angegeben werden. Eine Übersicht dieser Angaben
ist in der `FA-Dokumentation <https://docs.fontawesome.com/web/style/style-cheatsheet>`_ zu finden.


Hinweise zu Lucide-Icons
------------------------

Contao setzt ab Version 5.5 im Backend Icons aus dem Paket `Lucide <https://lucide.dev/icons/>`_ ein. Um diese auch im
FE zu verwenden, gelingt dies am einfachsten mit der Erweiterung :ref:`SVG Icon-Picker <picker_lbsvg>`.

Das gesamte Paket kann man sich von Github über
`"Code > Download ZIP" <https://github.com/lucide-icons/lucide/archive/refs/heads/main.zip>`_ downloaden und entpacken.
Der Ordner ``icons/`` enthält alle SVG-Icons und muss auf den Webserver in einen geeigneten Ordner unter ``files``.

Anschließend muss der Ordner in der Konfiguration angegeben werden - z. B.

.. code-block:: php
   :linenos:

   <?php
   // contao/dca/mm_employees.php
   $GLOBALS['TL_DCA']['mm_employees']['fields']['lbsvg_icon']['inputType']                 = 'svgIconPicker';
   $GLOBALS['TL_DCA']['mm_employees']['fields']['lbsvg_icon']['eval']['sourceDirectory']   = '/files/themes/lucide-icons';
   //$GLOBALS['TL_DCA']['mm_employees']['fields']['lbsvg_icon']['eval']['metadataDirectory'] = '/files/themes/svg-icons/metadata';

Lucide stellt die Icons nicht automatisch als Font zur Verfügung. Die Dateien können aber in einen Font überführt werden.
Die SVG-Dateien müssen vorher von Strichen in Füllungen umgewandelt werden - z. B. mit Hilfe des
`Iconly-Tools „Convert SVG Strokes to Fills” <https://iconly.io/tools/svg-convert-stroke-to-fill>`_ oder dem
`npm-Paket "svg-outline-stroke" <https://www.npmjs.com/package/svg-outline-stroke>`_. Anschließend kann die
Lucide-Icon-Schriftart mit `IcoMoon <https://icomoon.io/>`_ oder
`npm-Paket "fantasticon" <https://github.com/tancredi/fantasticon>`_ generiert werden.



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
