.. _rst_cookbook_tips_backend-section:

Eigene Sektion in der Backend-Navigation
========================================

Den Zugriff auf die Eingabe der MetaModel-Daten möchte man häufig in einer eigenen Sektion in der Backendnavigation
unterbringen. Dafür muss man eine entsprechende Gruppe anlegen, der man in den Eigenschaften der Eingabemaske unter
"Backend-Bereich" das oder die gewünschten Model zuweisen kann.

|img_be-section|


Per Konfiguration (ab MM 2.5, empfohlen)
-----------------------------------------

Seit MetaModels 2.5 lässt sich eine solche Gruppe direkt über die ``config.yaml`` anlegen - ganz ohne eigenen
Code:

.. code-block:: yaml

   meta_models_core:
       be_sections:
           products:
               name:
                   de: 'Produkte'
                   en: 'Products'
               tooltip:
                   de: 'Produkte erstellen'
                   en: 'Create products'
               icon: 'files/theme/mm/products.svg'
               add:
                   before: design

``products`` ist dabei der eindeutige Alias des Bereichs - er wird später bei der Eingabemaske unter
"Backend-Bereich" ausgewählt.

* ``name`` (Pflicht) - Sprachkarte für die Beschriftung. Angezeigt wird die aktuelle Backend-Sprache, sonst
  Englisch, sonst der erste vorhandene Eintrag.
* ``tooltip`` (optional) - Sprachkarte für den Tooltip, genauso aufgelöst wie ``name``. Ohne Angabe wird
  ``name`` verwendet.
* ``icon`` (optional) - Web-Pfad zu einem Icon, typischerweise unterhalb der Contao-Dateiverwaltung
  ``files/…``. Ohne Angabe - oder wenn die angegebene Datei nicht gefunden wird - erscheint das graue
  MetaModels-Standardicon.
* ``add`` (Pflicht) - legt die Position relativ zu einem bestehenden Navigationseintrag fest, über genau eine
  der beiden Angaben ``before`` oder ``after``.
* ``collapsed`` (optional, Standard ``false``) - lässt den Bereich beim ersten Aufruf eingeklappt starten.

.. note:: Der Ziel-Alias unter ``add`` ist der **interne** Contao-Gruppenname, nicht die angezeigte
   Beschriftung - der Bereich „Layout" heißt intern seit Contao 4/5 ``design``, nicht ``layout``. Gebräuchliche
   Ziele sind ``content``, ``design``, ``accounts``, ``system`` oder der Alias eines anderen, selbst per
   Konfiguration angelegten Bereichs. Findet sich der angegebene Alias nicht in der Navigation, wird der eigene
   Bereich stattdessen ans Ende gehängt.

Diese Konfiguration legt ausschließlich die **leere Gruppe** an. Befüllt wird sie wie gewohnt: in den
Eigenschaften der Eingabemaske eines MetaModels unter "Backend-Bereich" den gewählten Alias (hier ``products``)
eintragen.

.. seealso:: `core#1519 <https://github.com/MetaModels/core/issues/1519>`_, sowie der Abschnitt
   „Eigene Backend-Bereiche per Konfiguration" in :ref:`new_in_mm250`.


Manuell per Event-Listener (für Sonderfälle)
----------------------------------------------

Reicht die Konfiguration oben nicht aus - etwa weil die Sichtbarkeit oder Beschriftung des Bereichs von
Laufzeitbedingungen abhängen soll (angemeldeter Benutzer, Datenbankinhalt o. ä.) - lässt sich derselbe Bereich
weiterhin per eigenem ``MenuEvent``-Listener bauen, so wie es vor MM 2.5 der einzige Weg war.

Dafür benötigt man ein SVG-Icon sowie eine Zuweisung per Contao-MenuEvent.

SVG-Icons kann man sich z. B. bei `material.io <https://material.io/tools/icons/>`_ downloaden - Breite (width),
Höhe (height) und Farbe (fill) sollte man wie in dem Beispiel in einem Text-Editor anpassen:

.. code-block:: svg
   :linenos:

    <svg xmlns="http://www.w3.org/2000/svg" fill="#91979c" width="15" height="15" viewBox="0 0 24 24">
        <path d="...."/>
    </svg>

Die Datei kann man z. B. unter ``files/backend/group_icon_mm-test.svg`` abspeichern (Ordner öffentlich machen).

Weiterhin benötigt man einen Event-Listener, der den Eintrag erstellt - über die folgenden Parameter kann die
Gruppe konfiguriert werden (Zeile 30 bis 34):

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


.. |img_be-section| image:: /_img/screenshots/cookbook/tips/be-section_01.png
