.. _rst_cookbook_specials_add_items_at_navigation:

Detailseiten in der Contao-Navigation anzeigen
==============================================

In dem FE-Modul der Contao-Navigation werden nur die Seiten als Navigationspunkt ausgegeben, die sich auch im Seitenbaum
befinden z. B. ``/produkte/uebersicht``. Möchte man zusätzlich zu den Contao-Seiten z. B. auch Detailseiten wie zum
Beispiel ``/produkt/detail/artikelnummer/1364`` anzeigen, obwohl es nur die Seite ``/produkt/detail`` im Seitenbaum gibt,
kann man verschiedene Wege dafür gehen.


Eigene Seiten im Seitenbaum mit Alias für Weiterleitung
-------------------------------------------------------

Wenn es die Seite ``/produkt/detail`` als Contao Seite gibt bei der über die Slugparameter ``artikelnummer/1364`` der
gewünschte Artikel angezeigt wird, kann man eine neue Seite im Seitenbaum an der gewünschten Stelle für die
Navigation einbauen z. B. mit dem Titel "Artikel 1364". Der Alias der Seite wird aber manuell auf den Alias der
Detailansicht gesetzt ``/produkt/detail/artikelnummer/1364``. Damit beim Aufruf des Navigationslinks für "Artikel 1364"
auch der gewünschte Inhalt angezeigt wird, muss die Seite ``/produkt/detail`` eine höhere Routenpriorität (10) als die
Seite ``artikelnummer/1364`` (0) bekommen.

:ref:`Weitere Tipps zur Routenpriorität <rst_cookbook_tips_set-route-priority>`.


ParseTemplateListener zum Anpassen der Navigation
-------------------------------------------------

Mit dem `ParseTemplateListener <https://docs.contao.org/5.x/dev/reference/hooks/parseTemplate/>`_ kann das Template
``nav_default`` vor der "Auslieferung" noch manipuliert werden. Damit ist es möglich, an gewünschter Position eigene
Navigationslinks (siehe ``getSublinks()``) einzubauen. Folgend ein Beispielcode:

.. code-block:: php
   :linenos:

   <?php
   // src/EventListener/ParseTemplateListener.php

   namespace App\EventListener;

   use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
   use Contao\Template;
   use MetaModels\Filter\Setting\IFilterSettingFactory;
   use MetaModels\IFactory;
   use MetaModels\IMetaModel;
   use MetaModels\Render\Setting\IRenderSettingFactory;
   use Symfony\Component\HttpFoundation\RequestStack;

   use function sprintf;
   use function str_replace;
   use function trim;

   #[AsHook('parseTemplate')]
   class ParseTemplateListener
   {
       public function __construct(
           private readonly IFactory $factory,
           private readonly IFilterSettingFactory $filterFactory,
           private readonly IRenderSettingFactory $renderFactory,
           private readonly RequestStack $requestStack,
       ) {
       }

       public function __invoke(Template $template): void
       {
           if ('nav_default' === $template->getName()) {
               $levelData = $template->getData();

               // Check only level 1.
               if ('level_1' !== $levelData['level']) {
                   return;
               }

               $items = $levelData['items'];
               foreach ($items as &$item) {
                   // Check only page id 7.
                   if (7 !== ($item['id'] ?? null)) {
                       continue;
                   }

                   // Add subitems as level 2 at page id 7 and mark parent as trail.
                   if ([] !== ($subLinks = $this->getSublinks())) {
                       $item['subitems'] = $subLinks['subitems'];
                       $item['class']    =
                           trim(
                               'submenu ' . ($subLinks['trail'] ? str_replace('sibling', 'trail', $item['class']) : '')
                           );
                   }
               }
               unset($item);
               $levelData['items'] = $items;

               $template->setData($levelData);
           }
       }

       private function getSublinks(): array
       {
           // Begin configuration.
           $modelName = 'mm_employees';
           $renderId  = 4;
           $filterId  = 3;
           // End configuration.

           if (!(($model = $this->factory->getMetaModel($modelName)) instanceof IMetaModel)) {
               return [];
           }

           $filter           = $model->getEmptyFilter();
           $filterCollection = $this->filterFactory->createCollection($filterId);
           $filterCollection->addRules($filter, []);
           $items = $model->findByFilter($filter);

           if (!$items->getCount()) {
               return [];
           }

           $parsed = $items->parseAll('text', $this->renderFactory->createCollection($model, $renderId));
           unset($items, $filterCollection, $filter, $model);

           $request = $this->requestStack->getCurrentRequest();
           if (null === $request) {
               return [];
           }
           $path        = $request->getRequestUri();
           $isTrail     = false;
           $subLinkList = '<ul class="level_2">';
           foreach ($parsed as $item) {
               $href = $item['actions']['jumpTo']['href'];
               if ($path !== $href) {
                   $subLinkList .= sprintf(
                       '<li><a href="%1$s" title="%2$s">%2$s</a></li>',
                       $href,
                       $item['text']['name']
                   );
               } else {
                   $isTrail     = true;
                   $subLinkList .= sprintf(
                       '<li class="active"><strong class="active" aria-current="page">%s</strong></li>',
                       $item['text']['name']
                   );
               }
           }
           $subLinkList .= '</ul>';

           return ['trail' => $isTrail, 'subitems' => $subLinkList];
       }
   }

Mehr zum Registrieren von Services in dem :ref:`verlinkten Artikel <rst_cookbook_specials_register-services>`.


Erweiterung "hofff/contao-navigation" und "TreeEvent"
-----------------------------------------------------

Die Erweiterung "`Contao-Navigation <https://github.com/hofff/contao-navigation>`_" stellt ein eigenes FE-Modul für
die Navigation zur Verfügung. Zudem hat die Erweiterung verschiedene Events, bei dem die Manipulation der Ausgabe
gegenüber dem ``ParseTemplateListener`` eleganter durchzuführen ist. Folgend ein Beispielcode zum Anfügen eines
zusätzlichen Links in der Navigation - das kann aber auch zur Ausgabe von MM-Detailseiten entsprechend angepasst werden.

.. code-block:: php
   :linenos:

   <?php
   // src/EventListener/NavigationMenuListener.php

   namespace App\EventListener;

   use Hofff\Contao\Navigation\Event\TreeEvent;
   use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

   use function array_keys;

   #[AsEventListener('Hofff\Contao\Navigation\Event\TreeEvent')]
   class NavigationMenuListener
   {
       public function __invoke(TreeEvent $treeEvent): void
       {
           $moduleId  = $treeEvent->moduleModel()->id; // Module id for checking if it's the correct module.
           $pageId    = $treeEvent->items()->currentPage->id; // Page id for checking if it's the correct page.
           $pageItems = $treeEvent->items(); // Get the page items for the navigation tree.
           $rootIds   = $pageItems->roots;

           // Add a new item to the first root as the last one.
           $pageItems->subItems[array_keys($rootIds)[0]][] = 9999;

           // Item data.
           $pageItems->items[9999] = [
               'class'     => 'mm-page',
               'isInTrail' => false,
               'isActive'  => false,
               'pageTitle' => 'MetaModels',
               'accesskey' => '',
               'target'    => 'target="_blank"',
               'link'      => 'MetaModels',
               'href'      => 'https://now.metamodel.me',
           ];
       }
   }

Mehr zum Registrieren von Services in dem :ref:`verlinkten Artikel <rst_cookbook_specials_register-services>`.
