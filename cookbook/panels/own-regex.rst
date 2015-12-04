.. _rst_cookbook_panels_regex:

Eingabemaske: eigene RegEx-Prüfung
==================================

Benötigt man eine eigene Regex-Validierung für ein Text-Eingabefeld
in einer Eingabemaske, so kann das über den folgenden Event-Listener
eingebaut werden.

... weiterer Text folgt noch ...
 
.. code-block:: php
   :linenos:

   <?php 
   use ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\Event\GetPropertyOptionsEvent;
   
   return array
   (
       GetPropertyOptionsEvent::NAME => array(
           function (GetPropertyOptionsEvent $event) {
               if (($event->getEnvironment()->getDataDefinition()->getName() !== 'tl_metamodel_dcasetting')
                   || ($event->getPropertyName() !== 'rgxp')) {
                   return;
               }
   
               $options = $event->getOptions();
   
               $options['myRgxp'] = 'myRgxp';
   
               $event->setOptions($options);
           },
           -1
       )
   );


