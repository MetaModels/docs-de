.. _rst_cookbook_templates_fe_work_with_images:

Arbeiten mit Bildern in Templates
=================================

.. note:: Das Feature .

https://community.contao.org/de/showthread.php?74016-Thumbnail-mit-wichtigem-Teil-erstellen

/home/lenovo/Projects/Firma/Monotomic/Projekte/Bilder-in-MM/metamodel_prerendered_article_detail_headerimage.html5

.. code-block:: php
   :linenos:

    <?php
    use Contao\FrontendTemplate;
    use Contao\StringUtil;
    use Contao\System;

    $container      = System::getContainer();
    $rootDir        = $container->getParameter('kernel.project_dir');
    $pictureFactory = $container->get('contao.image.picture_factory');


        // siehe https://github.com/contao/contao/blob/ab81c7aebc14b671e0a5127804460d5a9709c62f/core-bundle/src/InsertTag/Resolver/LegacyInsertTag.php#L590-L603
        // würde man in Helper auslagern oder eher das verwenden https://docs.contao.org/dev/framework/image-processing/image-studio/#using-the-figurebuilder
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

            // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            // oder eher das verwenden https://docs.contao.org/dev/framework/image-processing/image-studio/#using-the-figurebuilder
            $figure = $container
                ->get('contao.image.studio')
                ->createFigureBuilder()
                ->fromPath($arrItem['raw']['speaker']['biography_image'])
                ->setSize('_image_circle')
                ->build();

            $template = new FrontendTemplate('image');

            $figure->applyLegacyTemplateData($template);
            //$template->setData($figure->getLegacyTemplateData());
            echo $template->parse();

            // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            // oder
            $from          = $arrItem['raw']['speaker']['biography_image'];
            $size          = '_image_circle';
            $configuration = [];
            $template      = 'image';
            echo $container->get('contao.image.studio.figure_renderer')->render($from, $size, $configuration, $template);
        }
       ?>
