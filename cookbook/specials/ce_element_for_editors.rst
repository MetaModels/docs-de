.. _rst_cookbook_specials_ce_element_for_editors:

Vordefiniertes Content-Element für Redakteure
=============================================

Für die Anzeige von Datensätzen eines MetaModel steht die MM-Liste als Content-Element bzw. FE-Modul zur
Verfügung. Hier muss man verschiedene Auswahlen wie das MetaModel, Rendersetting, Filterung usw. treffen - das kann
für Redakteure unter Umständen nicht gewünscht sein.

Gibt es den Wunsch, dass Redeakteure bei einem festgelegten MetaModel einfach ein oder mehrere Datensätze auswählen
und diese angezeigt werden sollen, kann man das zum Beispiel mit den folgenden Methoden durchführen.


Auswahl und Anzeige mit Erweiterung RockSolid Custom Elements
-------------------------------------------------------------

RockSolid Custom Elements (RST-CE) geben Ihnen die Möglichkeit, sämtliche im Contao Backend verfügbaren Eingabefelder nach
belieben als Content Element und/oder Modul zur Verfügung zu stellen. Mehr dazu auf der Webseite von
`RockSolid <https://rocksolidthemes.com/de/contao/plugins/custom-content-elements>`_ oder
`Vortrag der CK24 von Marcus Lelle <https://github.com/marcuslelle/contao-rsce>`_.

Im folgenden Beispiel soll ein einzelner Point-of-Interest (POI) durch den Redakteur ausgewählt werden können und
im FE angezeigt werden. In der Auswahl soll der Name und der Ort erscheinen.

Wie bei RST-CE üblich, muss eine Konfigurationsdatei für die Anzeige im BE sowie ein Template für die FE-Ausgabe
erstellt werden. Die Quelltexte sollen nur das Vorgehen verdeutlichen und wie angegeben ist eine Auslagerung der
API-Abfragen in separate Dateien zu empfehlen. Mehr zu den Abfragen bei :ref:`ref_api` oder dem
`Vortrag von Ingolf Steinhardt zur CK23 <https://www.e-spin.de/contao-metamodels/metamodels-vortrag-contao-konferenz-2023.html>`_

.. code-block:: php
   :linenos:

   <?php
   //rsce_mm_poi_single_config.php
   /**
    * Auswahl eines POI in RST-CE.
    *
    * Hinweis: Die Ermittlung der Options sollte man in eine Helper-Klasse auslagern - siehe Vortrag CK23 - bzw.
    * per options_callback (https://docs.contao.org/dev/reference/widgets/select/) holen.
    */
   use Contao\System;

   // POI-Liste.
   $options = [];

   // Name der MetaModel Tabelle.
   $modelName = 'mm_poi';
   // ID des Filters "BE POI Einzelansicht: Veröffentlicht".
   $filterId = 12;

   // Item ermitteln.
   $container        = System::getContainer();
   $factory          = $container->get('metamodels.factory');
   $model            = $factory->getMetaModel($modelName);
   $filter           = $model->getEmptyFilter();
   $filterFactory    = $container->get('metamodels.filter_setting_factory');
   $filterCollection = $filterFactory->createCollection($filterId);
   $items = $model->findByFilter($filter);

   if ($items->getCount()) {
       foreach ($items as $item) {
           $options[$item->get('id')] = \sprintf('%s - %s', $item->get('name'), $item->get('city'));
       }
   }

   return [
       'label'           => ['POI Einzelanzeige', 'POI Einzelanzeige'],
       'types'           => ['content'],
       'fields'          => [
           'poi' => [
               'label'     => ['POI-Auswahl', 'Wählen Sie ein POI aus, welches angezeigt werden soll.'],
               'inputType' => 'select',
               'options'   => $options,
               'eval'      => [
                   'chosen'             => true,
                   'mandatory'          => true,
                   'includeBlankOption' => true,
                   'tl_class'           => 'w50',
               ],
           ],
       ],
   ];

Für die Filterung nach der ausgwählten POI-Id kann man eine Filterregel "Eigenes SQL" anlegen und dort über den
übergebenen Parameter aus `$filterUrl` entsprechend filtern.

.. code-block:: SQL
   :linenos:

   SELECT id FROM {{table}}
   WHERE id = {{param::filter?name=poi}}

Weiterhin könnte man z. B. in dem SQL oder in einer weiteren Filterregel nach dem Veröffentlichungsstatus filtern.

.. code-block:: php
   :linenos:

   <?php
   // rsce_mm_poi_single.html5

   /**
    * Ausgabe eines POI - Auswahl mit RST-CE.
    *
    * Hinweis: Die Ermittlung der Items sollte man in eine Helper-Klasse auslagern - siehe Vortrag CK23.
    */

   // Check POI-Id.
   if (!$this->poi) {
       return;
   }

   // Name der MetaModel Tabelle.
   $modelName = 'mm_poi';
   // ID des Filters "FE POI Einzelansicht: POI-Auswahl + Veröffentlicht".
   $filterId = 11;
   // Filterwert POI-Id.
   $filterUrl = ['poi' => (int) $this->poi];
   // ID der Render-Einstellungen "FE Detailansicht - POI Einzelansicht ".
   $renderId = 20;

   // Item ermitteln.
   $factory          = $this->getContainer()->get('metamodels.factory');
   $model            = $factory->getMetaModel($modelName);
   $filter           = $model->getEmptyFilter();
   $filterFactory    = $this->getContainer()->get('metamodels.filter_setting_factory');
   $filterCollection = $filterFactory->createCollection($filterId);
   $filterCollection->addRules($filter, $filterUrl);
   $items = $model->findByFilter($filter);

   // Item rendern.
   $renderFactory = $this->getContainer()->get('metamodels.render_setting_factory');
   $arrItems      = $items->parseAll('html5', $renderFactory->createCollection($model, $renderId));
   ?>
   <?php if (count($arrItems)): ?>
       <div class="layout_full">
           <?php foreach ($arrItems as $arrItem): ?>
               <div class="poi_item">
                   <h2><?= $arrItem['text']['name'] ?></h2>
                   <p><?= $arrItem['text']['city'] ?></p>
                   <?= $arrItem['html5']['image'] ?>
                   <?php if($arrItem['actions']['jumpTo']['href']): ?>
                       <p><a href="<?= $arrItem['actions']['jumpTo']['href'] ?>" title="Details">Details</a></p>
                   <?php endif; ?>
               </div>
           <?php endforeach; ?>
       </div>
   <?php else : ?>
       <p class="info">Kein POI ausgewählt!</p>
   <?php endif; ?>


Auswahl und Anzeige mit eigenem Content-Element
-----------------------------------------------

... folgt je nach Finanzierung des Artikels/Handbuchs...
