.. _rst_cookbook_specials_ce_element_for_editors:

Vordefiniertes Content-Element für Redakteure
=============================================

Für die Anzeige von Datensätzen eines MetaModel steht die MM-Liste als Content-Element bzw. FE-Modul zur
Verfügung. Hier muss man verschiedene Auswahlen wie das MetaModel, Rendersetting, Filterung usw. treffen - das kann
für Redakteure unter Umständen nicht gewünscht sein.

Gibt es den Wunsch, dass Redeakteure bei einem festgelegten MetaModel einfach ein oder mehrere Datensätze auswählen
und diese angezeigt werden sollen, kann man das zum Beispiel mit den folgenden Methoden durchführen.


.. _rst_cookbook_specials_ce_element_for_editors_rstce:
Auswahl und Anzeige mit Erweiterung RockSolid Custom Elements
-------------------------------------------------------------

RockSolid Custom Elements (RST-CE) geben einem die Möglichkeit, sämtliche im Contao Backend verfügbaren Eingabefelder
nach belieben als Content Element und/oder Modul zur Verfügung zu stellen. Mehr dazu auf der Webseite von
`RockSolid <https://rocksolidthemes.com/de/contao/plugins/custom-content-elements>`_ oder
`Vortrag der CK24 von Marcus Lelle <https://github.com/marcuslelle/contao-rsce>`_.

Im folgenden Beispiel soll ein einzelner Point-of-Interest (POI) durch den Redakteur ausgewählt und im FE angezeigt
werden können. In der Auswahl soll der Name und der Ort erscheinen.

Konfiguration in RST-CE
.......................

Wie bei RST-CE üblich, muss eine Konfigurationsdatei für die Anzeige im BE sowie ein Template für die FE-Ausgabe
erstellt werden. Die Quelltexte sollen nur das Vorgehen verdeutlichen und wie angegeben ist eine Auslagerung der
API-Abfragen in separate Dateien zu empfehlen. Mehr zu den Abfragen bei :ref:`ref_api` oder dem
`Vortrag von Ingolf Steinhardt zur CK23 <https://www.e-spin.de/contao-metamodels/metamodels-vortrag-contao-konferenz-2023.html>`_

.. code-block:: php
   :linenos:

   <?php
   // rsce_mm_poi_single_config.php
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

Filter in MM
............

Für die Filterung nach der ausgewählten POI-Id kann man eine Filterregel "Eigenes SQL" anlegen und dort über den
übergebenen Parameter aus `$filterUrl` entsprechend filtern.

.. code-block:: SQL
   :linenos:

   -- Filterregel in Filter 11
   SELECT id FROM {{table}}
   WHERE id = {{param::filter?name=poi}}

Weiterhin könnte man z. B. in dem SQL oder in einer weiteren Filterregel nach dem Veröffentlichungsstatus filtern.

Ausgabetemplate in HTML5
........................

Für die Ausgabe muss noch ein entsprechendes Template angelegt werden - hier ist die Namenskonvention von RST-CE zu
beachten.

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

Ausgabe in Twig
...............

Für die Ausgabe in Twig muss man die auszugebenden Daten an das Template übergeben - eine Abfrage im Template wie bei
HTML5 ist in Twig nicht möglich.

Die Daten für Twig werden in einer `TwigFunktion` geholt und bereit gestellt:

.. code-block:: php
   :linenos:

   <?php
   // src/Twig/AppExtension.php
   namespace App\Twig;

   use MetaModels\Filter\Setting\FilterSettingFactory;
   use MetaModels\IFactory;
   use MetaModels\IMetaModel;
   use MetaModels\Render\Setting\RenderSettingFactory;
   use Twig\Extension\AbstractExtension;
   use Twig\TwigFunction;

   class AppExtension extends AbstractExtension
   {
       public function __construct(
           private readonly IFactory $factory,
           private readonly FilterSettingFactory $filterFactory,
           private readonly RenderSettingFactory $renderFactory,
       ) {
       }

       public function getFunctions(): array
       {
           return [
               new TwigFunction('getPoiById', [$this, 'getPoiById']),
           ];
       }

       public function getPoiById(int $id): array
       {
           // Name der MetaModel Tabelle.
           $modelName = 'mm_poi';
           // ID des Filters "FE POI Einzelansicht: POI-Auswahl + Veröffentlicht".
           $filterId = 11;
           // Filterwert POI-Id.
           $filterUrl = ['poi' => $id];
           // ID der Render-Einstellungen "FE Detailansicht - POI Einzelansicht ".
           $renderId = 20;

           // Item ermitteln.
           $model            = $this->factory->getMetaModel($modelName);
           $filter           = $model->getEmptyFilter();
           $filterCollection = $this->filterFactory->createCollection($filterId);
           $filterCollection->addRules($filter, $filterUrl);

           // Items rendern.
           return $model->findByFilter($filter)->parseAll(
               'html5',
               $this->renderFactory->createCollection($model, $renderId)
           );
       }
   }

Registrierung in der ``service.yml``:

.. code-block:: yaml
   :linenos:

   # config/services.yml
   services:
     _defaults:
       autoconfigure: true

     App\Twig\AppExtension:
       arguments:
         $factory: '@metamodels.factory'
         $filterFactory: '@metamodels.filter_setting_factory'
         $renderFactory: '@metamodels.render_setting_factory'

Mehr Informationen zum Thema ":ref:`rst_cookbook_specials_register-services`".

Ausgabe im Twig-Template:

.. code-block:: twig
   :linenos:

   {{ rsce_mm_poi_single.html.twig }}
   {% set pois = getPoiById(poi) %}
   <div{% if id %} id={{ id }}{% endif %}{% if class %} class="{{ class }}"{% endif %}>
       {% if pois|length > 0 %}
           <div class="layout_full">
               {% for poi in pois %}
                   <div class="poi_item">
                       <h2>{{ poi.html5.name|raw }}</h2>
                       <p>{{ poi.html5.city|raw }}</p>
                       {{ ... }}
                   </div>
               {% endfor %}
           </div>
       {% else %}
           <p class="info">Kein POI ausgewählt!</p>
       {% endif %}
   </div>


.. _rst_cookbook_specials_ce_element_for_editors_ce:
Auswahl und Anzeige mit eigenem Content-Element
-----------------------------------------------

Möchte man die Funktionalität mit "Contao-Boardmitteln" statt mit einer Erweiterung implementieren, so kann man ein
eigenes Inhaltselement erstellen.

In dem Beispiel soll eine Liste von MM-Datensätzen als Produkte auswählbar sein und auf der Webseite dargestellt werden.
Die Reihenfolge der Ausgabe soll individuell einstellbar sein.


Contentelement und Callback
...........................

Zunächst wird eine DCA-Konfiguration und die Übersetzungen angelegt. Für die individuelle Reihenfolge wird der
``inputType`` als ``checkboxWizard`` definiert. Nach dem Anlegen der DCA-Definition muss eine Migration der Datenbank
erfolgen.

.. code-block:: php
   :linenos:

   <?php
   // contao/dca/tl_content.php
   use Doctrine\DBAL\Platforms\MySQLPlatform;

   $GLOBALS['TL_DCA']['tl_content']['palettes']['mm_products'] = '
       {type_legend},type,headline;
       {mm_products_legend},mm_products;
       {protected_legend:hide},protected;
       {expert_legend:hide},guests,cssID;
       {invisible_legend:hide},invisible,start,stop;';

   $GLOBALS['TL_DCA']['tl_content']['fields']['mm_products'] = [
       'label'            => &$GLOBALS['TL_LANG']['tl_content']['mm_products'],
       'inputType'        => 'checkboxWizard',
       //'options_callback' => See attribute config in MmProductsCallbackListener
       'eval'             => [
           'mandatory' => true,
           'multiple'  => true,
           'tl_class'  => 'w50',
       ],
       'sql'              => [
           'type'    => 'blob',
           'length'  => MySQLPlatform::LENGTH_LIMIT_BLOB,
           'notnull' => false,
       ],
   ];

.. code-block:: php
   :linenos:

   <?php
   // contao/languages/en/tl_content.php

   // CTE
   $GLOBALS['TL_LANG']['CTE']['mm_products'] = ['CE Product selection', 'CE Product selection for MM products'];
   // Legends
   $GLOBALS['TL_LANG']['tl_content']['mm_products_legend'] = 'Product selection';
   // Fields
   $GLOBALS['TL_LANG']['tl_content']['mm_products'] = ['Product selection', 'Select several products.'];


Für die Generierung der Auswahlliste für das neue ContentElement müssen die Datensätze aus MM ausgelesen werden.

.. code-block:: php
   :linenos:

   <?php
   // src/EventListener/DataContainer/MmProductsCallbackListener.php
   namespace App\EventListener\DataContainer;

   use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
   use Contao\DataContainer;
   use MetaModels\Filter\Setting\FilterSettingFactory;
   use MetaModels\IFactory;
   use MetaModels\IMetaModel;

   use function sprintf;

   #[AsCallback(table: 'tl_content', target: 'fields.mm_products.options')]
   class MmProductsCallbackListener
   {
       public function __construct(
           private readonly IFactory $factory,
           private readonly FilterSettingFactory $filterFactory,
       ) {
       }

       public function __invoke(DataContainer|null $dc = null): array
       {
           // Produkt-Liste.
           $options = [];

           // Name der MetaModel Tabelle.
           $modelName = 'mm_products';
           // ID des Filters "Liste Veröffentlicht".
           $filterId = 4;

           // Items ermitteln - sortiert nach Name.
           $model = $this->factory->getMetaModel($modelName);
           assert($model instanceof IMetaModel);
           $filter           = $model->getEmptyFilter();
           $filterCollection = $this->filterFactory->createCollection($filterId);
           $filterCollection->addRules($filter, []);
           $items = $model->findByFilter($filter, 'name');

           if ($items->getCount()) {
               foreach ($items as $item) {
                   $options[$item->get('id')] =
                       \sprintf('%s - %s [%s]', $item->get('name'), $item->get('measures'), $item->get('articleno'));
               }
           }

           return $options;
       }
   }

Ausgabe in Twig mit eigenem Controller
......................................

Im nächsten Schritt wird die Ausgabe der Produkte erstellt. Dazu wird ein Controller benötigt, ein Ausgabetemplate in
Twig sowie eine zugehörige Twig-Funktion.

.. code-block:: php
   :linenos:

   <?php
   // src/Controller/ContentElement/MmProductsElement.php
   namespace App\Controller\ContentElement;

   use Contao\BackendTemplate;
   use Contao\ContentModel;
   use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
   use Contao\CoreBundle\Routing\ScopeMatcher;
   use Contao\CoreBundle\ServiceAnnotation\ContentElement;
   use Contao\CoreBundle\Twig\FragmentTemplate;
   use Contao\PageModel;
   use Contao\StringUtil;
   use MetaModels\Filter\Setting\FilterSettingFactory;
   use MetaModels\IFactory;
   use MetaModels\IMetaModel;
   use MetaModels\Render\Setting\RenderSettingFactory;
   use Symfony\Component\HttpFoundation\Request;
   use Symfony\Component\HttpFoundation\RequestStack;
   use Symfony\Component\HttpFoundation\Response;

   use function implode;
   use function is_array;

   /**
    * @ContentElement("mm_products",
    *   category="texts",
    *   template="ce_mm_products",
    * )
    */
   class MmProductsElement extends AbstractContentElementController
   {
       public function __construct(
           private readonly IFactory $factory,
           private readonly FilterSettingFactory $filterFactory,
           private readonly RenderSettingFactory $renderFactory,
           private readonly ScopeMatcher $scopeMatcher,
           private readonly RequestStack $requestStack,
       ) {
       }

       protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
       {
           $arrHeadline = StringUtil::deserialize($model->headline, true);
           $headline    = is_array($arrHeadline) ? $arrHeadline['value'] ?? '' : $arrHeadline;
           $template->set('headline', $headline);
           $template->set('hl', $arrHeadline['unit'] ?? 'h2');

           $productsList = StringUtil::deserialize($model->mm_products, true);

           if ($this->isBackend()) {
               $template = new BackendTemplate('be_wildcard');
               $template->title    = $headline;
               $template->wildcard = 'Produkte: ' . \implode(', ', $productsList);

               return $template->getResponse();
           }

           $arrCssId = StringUtil::deserialize($model->cssID, true);
           $template->set('id', $arrCssId[0] ?? '');
           $template->set('class', $arrCssId[1] ?? '');

           $template->set('products', $this->getProductsByIds($productsList));

           // ID des AnfrageFormulars in DE.
           $template->set('pageAlias', PageModel::findById(5)->alias);

           return $template->getResponse();
       }

       protected function getProductsByIds(array $ids): array
       {
           // Name der MetaModel Tabelle.
           $modelName = 'mm_products';
           // ID des Filters "Liste Veröffentlicht + Produkt-Ids".
           $filterId = 5;
           // Filterwert products.
           $filterUrl = ['products' => $ids];
           // ID der Render-Einstellungen "Produkt-Liste".
           $renderId = 4;

           // Items ermitteln.
           $model = $this->factory->getMetaModel($modelName);
           assert($model instanceof IMetaModel);
           $filter           = $model->getEmptyFilter();
           $filterCollection = $this->filterFactory->createCollection($filterId);
           $filterCollection->addRules($filter, $filterUrl);

           // Items rendern.
           return $model->findByFilter($filter)->parseAll(
               'html5',
               $this->renderFactory->createCollection($model, $renderId)
           );
       }

       public function isBackend(): bool
       {
           if ($request = $this->requestStack->getCurrentRequest()) {
               return $this->scopeMatcher->isBackendRequest($request);
           }

           return false;
       }
   }

.. code-block:: twig
   :linenos:

   {# templates/orion/ce_mm_products.html.twig #}
   {% if headline %}
       <{{ hl }}>{{ headline }}</{{ hl }}>
   {% endif %}
   <div{% if id %} id={{ id }}{% endif %}{% if class %} class="{{ class }}"{% endif %}>
       {% if products|length > 0 %}
       <div class="product__list">
           {% for product in products %}
               <div class="product">
                   <div class="product__image">
                       {{ product.html5.list_image|raw }}
                   </div>
                   <div class="product__features">
                       <div class="product__name"><a href="{{ product.actions.jumpTo.href }}">{{ product.text.name }}</a></div>
                       {% if product.text.sub_headline %}
                           <div class="product__subheadline">({{ product.text.sub_headline }})</div>
                       {% endif %}
                       {% if product.text.measures %}
                           <div class="product__measures">{{ product.text.measures }}</div>
                       {% endif %}
                   </div>
                   {% if product.text.inquiry %}
                       <div class="inquiry">
                           <a href="{{ pageAlias }}?articlno={{ product.text.articleno }}&name={{ product.text.name }}" class="inquiry__button">Anfragen</a>
                       </div>
                   {% endif %}
               </div>
           {% endfor %}
       </div>
       {% else %}
           <p class="info">Kein Produkt ausgewählt!</p>
       {% endif %}
   </div>


.. code-block:: php
   :linenos:

   <?php
   // src/Twig/AppExtension.php
   namespace App\Twig;

   use MetaModels\Filter\Setting\FilterSettingFactory;
   use MetaModels\IFactory;
   use MetaModels\IMetaModel;
   use MetaModels\Render\Setting\RenderSettingFactory;
   use Twig\Extension\AbstractExtension;
   use Twig\TwigFunction;

   class AppExtension extends AbstractExtension
   {
       public function __construct(
           private readonly IFactory $factory,
           private readonly FilterSettingFactory $filterFactory,
           private readonly RenderSettingFactory $renderFactory,
       ) {
       }

       public function getFunctions(): array
       {
           return [
               new TwigFunction('getProductsByIds', [$this, 'getProductsByIds']),
           ];
       }

       public function getProductsByIds(array $ids): array
       {
           // Name der MetaModel Tabelle.
           $modelName = 'mm_products';
           // ID des Filters "Liste Veröffentlicht".
           $filterId = 5;
           // Filterwert products.
           $filterUrl = ['products' => $ids];
           // ID der Render-Einstellungen "Produkt-Liste".
           $renderId = 4;

           // Items ermitteln.
           $model = $this->factory->getMetaModel($modelName);
           assert($model instanceof IMetaModel);
           $filter           = $model->getEmptyFilter();
           $filterCollection = $this->filterFactory->createCollection($filterId);
           $filterCollection->addRules($filter, $filterUrl);

           // Items rendern.
           return $model->findByFilter($filter)->parseAll(
               'html5',
               $this->renderFactory->createCollection($model, $renderId)
           );
       }
   }


Services laden
..............

Damit die Klassen alle geladen werden, gibt es verschiedene Wege - siehe ":ref:`rst_cookbook_specials_register-services`.
Mit einer eigenen ``services.yml`` sieht das wie folgt aus:


.. code-block:: yaml
   :linenos:

   # config/services.yml
   services:
     _defaults:
       autoconfigure: true

     App\Controller\ContentElement\MmProductsElement:
       arguments:
         $factory: '@metamodels.factory'
         $filterFactory: '@metamodels.filter_setting_factory'
         $renderFactory: '@metamodels.render_setting_factory'
         $scopeMatcher: '@contao.routing.scope_matcher'
         $requestStack: '@request_stack'

     App\EventListener\DataContainer\MmProductsCallbackListener:
       arguments:
         $factory: '@metamodels.factory'
         $filterFactory: '@metamodels.filter_setting_factory'

     App\Twig\AppExtension:
       arguments:
         $factory: '@metamodels.factory'
         $filterFactory: '@metamodels.filter_setting_factory'
         $renderFactory: '@metamodels.render_setting_factory'


Ob alles geladen wird, kann per Konsolenaufruf getestet werden - Cache leeren und ggf. "composer install" ausführen.
