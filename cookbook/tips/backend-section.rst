.. _rst_cookbook_tips_backend-section:

Eigene Sektion in der Backend-Navigation
========================================

Den Zugriff auf die Eingabe der MetaModel-Daten möchte man häufig in einer eigenen Sektion in der Backendnavigation
unterbringen. Dafür muss man eine entsprechende Gruppe anlegen, der man in den Eigenschaften der Eingabe unter
"Backend-Bereich" das oder die gewünschten Model zuweisen kann.

Dafür benötigt man ein SVG-Icon sowie eine Zuweisung per Contao-MenuEvent - geplant ist, das zukünftig über einen
`Eintrag in der config.yaml konfigurieren <https://github.com/MetaModels/core/issues/1519>`_ zu können.

SVG-Icons kann man sich z. B. bei `material.io <https://material.io/tools/icons/>`_ downloaden - Breite (width),
Höhe (height) und Farbe (fill) sollte man wie in dem Beispiel in einem Text-Editor anpassen:

.. code-block:: svg
   :linenos:

    <svg xmlns="http://www.w3.org/2000/svg" fill="#91979c" width="15" height="15" viewBox="0 0 24 24">
        <path d="...."/>
    </svg>

Die Datei kann man z. B. unter ``files/backend/group_icon_mm-test.svg`` abspeichern (Ordner öffentlich machen).

Weiterhin benötigt man einen Event-Listener, der den Eintrag erstellt - über die folgenden Parameter kann die
Gruppe konfiguriert werden:

* $nodeName - Alias des Eintrags
* $nodeTitle - Titel
* $nodeIcon - Pfad zum Icon
* $targetNode - Suche nach einem vorhandenem Eintrag wie "content" für Inhalte
* $targetType - Angabe ob Eintrag vor ``before`` oder nach ``after`` dem "targetNode" erscheinen soll

Der Listener im Pfad ``src/EventListener/BackendMenuListener.php`` ablegen und ``composer install`` ausführen.

.. code-block:: php
   :linenos:

   <?php
   namespace App\EventListener;

   use Contao\CoreBundle\Event\MenuEvent;
   use Knp\Menu\Util\MenuManipulator;
   use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
   use Symfony\Component\HttpFoundation\RequestStack;
   use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBagInterface;

   #[AsEventListener(priority: -1)]
   class BackendMenuListener
   {
       private array $targetTypes = ['before' => 0, 'after' => 1];

       public function __construct(
           private readonly RequestStack $requestStack,
       ) {
       }

       public function __invoke(MenuEvent $event): void
       {
           $factory = $event->getFactory();
           $tree    = $event->getTree();

           if ('mainMenu' !== $tree->getName()) {
               return;
           }

           $nodeName   = 'mm-test';
           $nodeTitle  = 'Meine MM Kategorie';
           $nodeIcon   = '/files/backend/group_icon_mm-test.svg';
           $targetNode = 'content';
           $targetType = 'after';

           $categoryNode = $tree->getChild($nodeName);
           if (!$categoryNode) {
               $sessionBag  = $this->requestStack->getSession()->getBag('contao_backend');
               $status      = ($sessionBag instanceof AttributeBagInterface) ? $sessionBag->get('backend_modules') : [];
               $isCollapsed = ($status[$nodeName] ?? 1) < 1;

               $categoryNode = $factory
                   ->createItem($nodeName)
                   ->setLabel($nodeTitle)
                   ->setUri('/contao?mtg=' . $nodeName)
                   ->setLinkAttribute('class', 'group-' . $nodeName)
                   ->setLinkAttribute('title', $nodeTitle)
                   ->setLinkAttribute('data-action', 'contao--toggle-navigation#toggle:prevent')
                   ->setLinkAttribute('data-contao--toggle-navigation-category-param', $nodeName)
                   ->setLinkAttribute('aria-controls', $nodeName)
                   ->setLinkAttribute('aria-expanded', $isCollapsed ? 'false' : 'true')
                   ->setChildrenAttribute('id', $nodeName)
                   ->setLinkAttribute('style', \sprintf('background: url(%s) 3px 2px no-repeat;', $nodeIcon))
                   ->setExtra('translation_domain', false);

               if ($isCollapsed) {
                   $categoryNode->setAttribute('class', 'collapsed');
               }

               $tree->addChild($categoryNode);

               $targetPosition = \array_search($targetNode, \array_keys($tree->getChildren()), true);
               $targetPosition = false === $targetPosition ? 0 : $targetPosition + $this->targetTypes[$targetType];
               $manipulator    = new MenuManipulator();
               $manipulator->moveToPosition($categoryNode, $targetPosition);
           }
       }
   }
   ?>

Der Listener und ein Dummy-SVG steht :download:`hier zum Download </_download/BE-section.zip>` bereit.
