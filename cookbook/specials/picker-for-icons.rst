.. _rst_cookbook_specials_picker-for-icons:

Icon-Picker
===========

Möchte man Datensätze mit einem Icon versehen, so kann man das Attribut Datei verwenden oder wenn die Icons per Font
eingebunden werden, die entsprechenden CSS-Klassen. Die Auswahl der Icons ist dann aber nicht sehr benutzerfreundlich.

Für Contao gibt es verschiedene Erweiterungen, die einen speziellen Icon-Picker zur Verfügung stellen.

Um diese Funktionalität auch in MM bereit zu stellen, könnte man ein eigenes Attribut erstellen. Die meisten
Icon-Picker speichern nur Strings bzw. serialisierte Arrays, so dass man auch mit kleinen DCA- und Template-Anpassungen
das Attribut Text verwenden kann.

Folgend werden die Anpassungen für gängige Picker-Erweiterungen vorgestellt - bitte die entsprechenden Lizenzbedingungen
beachten.


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


Marco Kupic Font Awesome Icon Picker
------------------------------------

`Erweiterung auf Github <https://github.com/markocupic/fontawesome-icon-picker-bundle>`_.

Für diese Erweiterung muss man sich ein `Icon-Kit bei Font Awesome <https://fontawesome.com/start>`_: anlegen - es reicht
eine kostenfreies Kit. Anschließend müssen die Angaben in der config.yaml eingetragen werden - `siehe Readme
<https://github.com/markocupic/fontawesome-icon-picker-bundle?tab=readme-ov-file#configuration>`_.

Bei den Icons stehen je nach Konfiguration die Label R Regular, S Solid, B Brands als Auswahlbutton zur Verfügung.

DCA-Anpassung:

.. code-block:: php
   :linenos:

   <?php
   // contao/dca/mm_employees.php
   $GLOBALS['TL_DCA']['mm_employees']['fields']['mcfa_icon']['inputType'] = 'fontawesomeIconPicker';

Template:

Da die Speicherung als serialisiertes Array erfolgt, muss sowohl das Template für ``html5`` als auch für ``text``
angelegt werden

.. code-block:: php
   :linenos:

   <?php
   // templates/mm_attr_text_mcfa_icon.html5
   <?php
   $mcfaData = \Contao\StringUtil::deserialize($this->raw, true);
   $faType   = 'fa-regular';

   switch ($mcfaData[1] ?? '') {
       case 'fas':
           $faType = 'fa-solid';
           break;
       case 'far':
           $faType = 'fa-regular';
   }
   ?>
   <i class="<?= $faType ?> fa-<?= $mcfaData[0] ?? '' ?><?= $this->additional_class ?>"></i>

   <?php
   // templates/mm_attr_text_mcfa_icon.text
   <?php
   $mcfaData = \Contao\StringUtil::deserialize($this->raw, true);
   $faType   = 'fa-regular';

   switch ($mcfaData[1] ?? '') {
       case 'fas':
           $faType = 'fa-solid';
           break;
       case 'far':
           $faType = 'fa-regular';
   }
   ?>
   <?= $faType ?> fa-<?= $mcfaData[0] ?? '' ?>

Ausgabe BE & FE:

|img_mcfa_01.png|

|img_mcfa_02.png|


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
