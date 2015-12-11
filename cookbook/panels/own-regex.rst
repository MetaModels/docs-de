.. _rst_cookbook_panels_regex:

Eingabemaske: eigene RegEx-Prüfung
==================================

Benötigt man eine eigene Regex-Validierung für ein Text-Eingabefeld
in einer Eingabemaske, so kann das über den folgenden Event-Listener
eingebaut werden.

Um diesen einzubauen bzw. für das Feld in der Eingabemaske zu aktivieren,
muss die Prüfung mit "Contao-Boardmitteln" zunächst zur Verfügung stehen.

Dafür wird der Hook "addCustomRegex" wie folgt angelegt - siehe `API: addCustomRegex <https://docs.contao.org/books/api/extensions/hooks/addCustomRegexp.html>`_

* einen Ordner für das eigene Modul unter /sytsem/modules anlegen - z.B. "/metamodels_mycustoms"
* in dem Ordner metamodels_mycustoms zwei weitere Ordner "/config" und "/classes" anlegen
* im Ordner /classes die Datei "MyClass.php" anlegen wie in der Contao API beschrieben
* im Ordner /config die Datei "config.php" anlegen wie in der Contao API beschrieben
* zusätzlich im Ordner /config die Datei "event_listeners.php"
* wenn alle Dateien angelegt und mit Quelltext gefüllt sind, kann über die Entwickler-Tools
  im Contao-Backend im Punkt "Autoload-Creator" die "autoload.php" erstellt werden

In den Einstellungen eines Eingabefeldes eines Attributes vom Typ "Text" sollte anschließend
bei der Auswahl der RegEx-Prüfung der Eintrag "PLZ" zur Verfügung stehen. Sollte das nicht der
Fall sein, ggf. alle Caches im Backend löschen und die Dateien kontrollieren.

|img_own-regex|

Quelltexte
----------

In den Dateien gefindet sich der folgende Quelltext:

Datei /sytsem/modules/metamodels_mycustoms/classes/MyClass.php

.. code-block:: php
   :linenos:
   
   <?php
   class MyClass
   {
       public function myAddCustomRegexp($strRegexp, $varValue, Widget $objWidget)
       {
           if ($strRegexp == 'plz')
           {
               if (!preg_match('/^[0-9]{4,6}$/', $varValue))
               {
                   $objWidget->addError('Feld ' . $objWidget->label . ' sollte eine gültige PLZ enthalten.');
               }
       
               return true;
           }
       
           return false;
       }
   }


Datei /sytsem/modules/metamodels_mycustoms/config/config.php

.. code-block:: php
   :linenos:
   
   <?php
   $GLOBALS['TL_HOOKS']['addCustomRegexp'][] = array('MyClass', 'myAddCustomRegexp');


Datei /sytsem/modules/metamodels_mycustoms/classes/MyClass.php

.. code-block:: php
   :linenos:

   <?php 
   use ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\Event\GetPropertyOptionsEvent;
   
   return array
   (
       GetPropertyOptionsEvent::NAME => array(
           array(
               function (GetPropertyOptionsEvent $event) {
                   if (($event->getEnvironment()->getDataDefinition()->getName() !== 'tl_metamodel_dcasetting')
                       || ($event->getPropertyName() !== 'rgxp')) {
                       return;
                   }
       
                   $options = $event->getOptions();
       
                   $options['plz'] = 'PLZ';
       
                   $event->setOptions($options);
               },
               -1
           )
       )
   );


Die autoload.php sollte nach der Erzeugung so aus sehen

.. code-block:: php
   :linenos:

   <?php 
   ClassLoader::addClasses(array
   (
       // Classes
       'MyClass' => 'system/modules/metamodels_mycustoms/classes/MyClass.php',
   ));


.. |img_own-regex| image:: /_img/screenshots/cookbook/panels/own-regex.jpg