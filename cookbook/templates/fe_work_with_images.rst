.. _rst_cookbook_templates_fe_work_with_images:

Arbeiten mit Bildern in Templates
=================================

Für die Ausgabe von einem oder mehreren Bildern in MetaModels steht das Attribut Datei zur Verfügung. Zur Auswahl einer
Datei oder mehrere Dateien gibt es in der Eingabemaske einen Button der ein Popup zur Ansicht der Dateiverwaltung.

In den Grundeinstellungen des Attributes kann man verschiedene Optionen setzen wie Basispfad, ein oder mehrere Auswahlen,
Dateitypen usw.

Bilddateien möchte man in den meisten Fällen auch als Bild ausgeben. Die Einstellungen hierfür finden sich für das
Attribut in den Rendersettings. Hier ist die Checkbox "Als Bildfeld mit Vorschaubild benutzen" zu setzen sowie eine
Bildgröße zu wählen. Optional ist die Auswahl eines Platzhalterbilds möglich als auch eine Ansicht in einer Lightbox.

In einem individuellen Template im FE ist für die Darstellung als Bild die Ausgabe des html5-Knotens notwendig - |br|
z. B. ``<?= $arrItem['html5']['my_image'] ?>``.

Über die Auswahl bzw. Anpassung des :ref:`Templates für das Attribut <component_templates>`, können weitere
Anforderungen für die Ausgabe gesetzt werden wie z. B. Auflistung als ``ul`` oder ``div``, Markup für Galerien oder
Slider usw.

Diese Ausgaben und Anpassungsmöglichkeiten reichen für eine Vielzahl an Ausgabewünschen aus. Wenn aber Bilder
ausgegeben werden sollten, die z. B. über eine :ref:`Relation <component_relations>` eingebunden sind - über den
``raw``-Knoten -, dann stehen diese nur als Originalbild über den Pfad bzw. UUID zur Verfügung.

Um auch diese Bilder im eigenen Template zu manipulieren, sollen die folgenden Snippets eine Hilfestellung geben.

Mehr zu den Methoden ist im Contao-Handbuch bei
`Image processing <https://docs.contao.org/dev/framework/image-processing/index.html>`_ zu finden.


Ausgabe eines Bildes, der per Einzelauswahl eingebunden ist
-----------------------------------------------------------

Insert-Tags
...........

siehe `Insert-Tags <https://docs.contao.org/manual/de/artikelverwaltung/insert-tags/#verschiedenes>`_

.. code-block:: php
   :linenos:

   <?php if (!empty($arrItem['raw']['speaker']['biography_image']): ?>
       {{image::<?= $arrItem['raw']['speaker']['biography_image'] ?>?width=180&height=180&mode=crop&class=img--circle}}
       <!-- ODER -->
       {{picture::<?= $arrItem['raw']['speaker']['biography_image'] ?>?size=_image_circle}}
   <?php endif; ?>

Beispiel für ``$size`` (`siehe <https://docs.contao.org/dev/framework/image-processing/image-sizes/index.html>`_):

.. code-block:: yaml
   :linenos:

   # config/config.yml
   contao:
       image:
           sizes:
               _defaults:
                   formats:
                       jpg: [webp, jpg]
                       webp: [webp, jpg]
                       png: [webp, png]
                   densities: 0.5x, 2x, 3x
                   lazy_loading: true
                   resize_mode: proportional
               image_circle:
                   width: 180
                   height: 180
                   resize_mode: crop
                   zoom: 100
                   css_class: img--circle


Image-Studio FigureRenderer
...........................

* ``$from``: Pfad zur Datei
* ``$size``: s. o.
* ``$configuration``: Konfigurationsangaben z. B. Metadaten
* ``$template``: Ausgabetemplate

.. code-block:: php
   :linenos:

   <?php
   if (!empty($arrItem['raw']['speaker']['biography_image'])) {
      $from          = $arrItem['raw']['speaker']['biography_image'];
      $size          = '_image_circle';
      $configuration = [];
      $template      = 'image';
      echo $container->get('contao.image.studio.figure_renderer')->render($from, $size, $configuration, $template);
   }
   ?>


Image-Studio FigureBuilder
..........................

siehe `FigureBuilder <https://docs.contao.org/dev/framework/image-processing/image-studio/index.html#using-the-figurebuilder>`_

* ``fromPath``: Pfad zur Datei
* ``setSize``: s. o.
* ``$configuration``: Konfigurationsangaben z. B. Metadaten
* ``$template``: Ausgabetemplate

.. code-block:: php
   :linenos:

   <?php
   if (!empty($arrItem['raw']['speaker']['biography_image'])) {
       $figure = $container
         ->get('contao.image.studio')
         ->createFigureBuilder()
         ->fromPath($arrItem['raw']['speaker']['biography_image'])
         ->setSize('_image_circle')
         ->build();

       $template = new FrontendTemplate('image');

       $figure->applyLegacyTemplateData($template);
       //$template->setData($figure->getLegacyTemplateData()); // Alternative
       echo $template->parse();
   }
   ?>


Image-Studio PictureFactory
...........................

siehe `PictureFactory <https://docs.contao.org/dev/framework/image-processing/image-picture-factory/index.html#picture-factory>`_

* ``setSize``: s. o.
* ``$data``: Bilddaten + Metadaten
* ``$pictureTemplate``: Ausgabetemplate

.. code-block:: php
   :linenos:

   <?php
   // würde man in Helper auslagern
   use Contao\FrontendTemplate;
   use Contao\StringUtil;
   use Contao\System;

   $container      = System::getContainer();
   $rootDir        = $container->getParameter('kernel.project_dir');
   $pictureFactory = $container->get('contao.image.picture_factory');

   // ...
   if (!empty($arrItem['raw']['speaker']['biography_image'])) {
      $staticUrl = $container->get('contao.assets.files_context')->getStaticUrl();
      $picture   = $pictureFactory->create($rootDir . '/' . $arrItem['raw']['speaker']['biography_image'], '_image_circle');

      $data = [
         'img'     => $picture->getImg($rootDir, $staticUrl),
         'sources' => $picture->getSources($rootDir, $staticUrl),
         'alt'     => StringUtil::specialcharsAttribute(''),
         'class'   => StringUtil::specialcharsAttribute(''),
      ];

      $pictureTemplate = new FrontendTemplate('picture_default');
      $pictureTemplate->setData($data);

      echo $pictureTemplate->parse();
   }
   ?>

.. note:: Die Seite kann gern um weitere Snippets ergänzt werden - sobald MM auch mit Twig-Templates arbeitet,
   wird die Seite angepasst


.. |br| raw:: html

   <br />
