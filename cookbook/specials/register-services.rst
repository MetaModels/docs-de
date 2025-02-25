.. _rst_cookbook_specials_register-services:

Registrierung von Services
==========================

.. note:: Die im Folgenden vorgestellten Möglichkeiten sind lediglich Vorschläge bzw. Beispiele - für die eigene
   Arbeit sollte man sich seine optimale Konfiguration entwickeln - mehr zu dem Thema ist in der
   `Symfony-Dokumentation <https://symfony.com/doc/6.4/index.html>`_ zu finden.

MetaModels bringt viele Funktionen mit, die man lediglich im Backend aktivieren oder konfigurieren muss. Dennoch
können damit nicht alle erdenklichen Einstellungen und Funktionen abgedeckt werden. Bei individuellen Projektaufgaben
können die implementierten Möglichkeiten nicht ausreichen und müssen um eigene Anpassungen ergänzt werden.

Hier stehen verschiedene Methoden von MM oder auch von DC_General (DCG) zur Verfügung, um mit wenigen Zeilen diese
Aufgaben umzusetzen.

Insbesondere die zur Verfügung gestellten Events bieten dabei eine einfache Möglichkeit, eine eigene Logik zu
implementieren bzw. in die vorhandene einzugreifen. Ein Einstieg in die Arbeit mit der :ref:`ref_api` bietet z. B. der
`Vortrag von Ingolf Steinhardt zur CK23 <https://www.e-spin.de/contao-metamodels/metamodels-vortrag-contao-konferenz-2023.html>`_

Folgend werden verschiedene Varianten zur Implementierung anhand des PrePersistModelEvents aufgeführt. Das Event
wird von der Eingabemaske "kurz vor dem Speichern in die DB" aufgerufen, sofern sich ein Feldwert geändert hat. Mit dem
Event können z. B. eingegebene Daten manipuliert oder neue dynamisch generiert werden.

Die EventListener oder auch andere Services werden analog den
`Contao-Hooks registriert <https://docs.contao.org/dev/framework/hooks/#registering-hooks>`_ registriert.

.. note:: Vorausgesetzt wird mind. Contao 4.13 und PHP 8


.. _register-services-with-attribute:
1. Registrierung per Attribut
-----------------------------

Die Registrierung per Attribut bieter die einfachste Variante der Implementierung - es muss lediglich folgende
Datei angelegt und der Cache geleert werden.

.. code-block:: php
   :linenos:

   <?php
   // src/EventListener/PrePersistModelEventListener.php
   namespace App\EventListener;

   use ContaoCommunityAlliance\DcGeneral\Event\PrePersistModelEvent;
   use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

   #[AsEventListener(PrePersistModelEvent::NAME)]
   class PrePersistModelEvent1Listener
   {
       public function __invoke(PrePersistModelEvent $event)
       {
           if ('mm_employees' !== $event->getEnvironment()->getDataDefinition()?->getName()) {
               return;
           }

           $model = $event->getModel();
       }
   }

Nach dem leeren des Caches kann die Registrierung wie folgt überprüft werden

``php vendor/bin/contao-console debug:event-dispatcher dc-general.model.pre-persist``

Der Key ``dc-general.model.pre-persist`` steht in der jeweiligen Klasse und kann ebenfalls als Parameter in dem Attribut
verwendet werden. War die Registrierung erfolgreich, sollte der markierte Eintrag zu finden sein.

|img_register-services_01.png|

Sollte das noch nicht der Fall sein, kann die Ausführung eines ``composer install`` Abhilfe schaffen.

Wenn die ausführende Methode den Namen ``__invoke`` hat, kann der Attributsschlüssel wie in dem Beispiel an den
Klassennamen geschrieben werden - wenn man einen individuellen Methodennamen einsetzen möchte z. B. wenn mehrere
Methoden in einer Klasse zu verschiedenen Events vorhanden sind, muss der Attributsschlüssel an den jeweiligen
Methodennamen.

Diese Variante funktioniert in dieser einfachen Form nur, wenn nicht weitere Events o. ä. über die ``services.yml``
registiert werden. Ist dies der Fall, kann man entweder ganz auf die Registrierung über die ``services.yml`` umsteigen -
siehe Punkt 2 - oder man fügt folgende Zeilen in die ``services.yml``, um ein automatisches Laden zu erwirken:

.. code-block:: yaml
   :linenos:

   # config/services.yml
   services:
     _defaults:
       autowire: true
       autoconfigure: true
       public: false

     App\:
       resource: '../src/*'


.. _register-services-with-services:
2 Registrierung per services.yml
--------------------------------

Als Alternative zur Registrierung per Attribut kann man den Aufruf über die `services.yml` einbinden - insbesondere,
wenn man verschiedene Einstellungen hat und sich auf die automatische Registrierung nicht verlassen möchte.

Die Klasse sieht dann wie folgt aus:

.. code-block:: php
   :linenos:

   <?php
   // src/EventListener/PrePersistModelEventListener.php
   namespace App\EventListener;

   use ContaoCommunityAlliance\DcGeneral\Event\PrePersistModelEvent;

   class PrePersistModelEvent2Listener
   {
       public function __invoke(PrePersistModelEvent $event)
       {
           if ('mm_employees' !== $event->getEnvironment()->getDataDefinition()?->getName()) {
               return;
           }

           $model = $event->getModel();
       }
   }

Zudem muss in die ``services.yml`` folgender Eintrag:

.. code-block:: yaml
   :linenos:

   # config/services.yml
   services:
     App\EventListener\PrePersistModelEventListener:
       tags:
         - { name: kernel.event_listener, event: dc-general.model.pre-persist }

Sofern die Methode nicht die Bezeichnung ``__invoke`` hat, muss bei den Tags der ``services.yml`` der Methodenname
ergänzt werden - zudem ist die Angabe einer Priorität möglich. Mehr dazu bei
`Symfony <https://symfony.com/doc/6.4/event_dispatcher.html>`_


.. _register-services-with-attribute-and-other:
3. Registrierung per Attribut und Einbindung weiterer Services
--------------------------------------------------------------

Benötigt man in seiner Klasse den Zugriff auf weitere Services, kann man die über den ``constructor``
automatisch einbinden.

.. code-block:: php
   :linenos:

   <?php
   // src/EventListener/PrePersistModelEventListener.php
   namespace App\EventListener;

   use ContaoCommunityAlliance\DcGeneral\Event\PrePersistModelEvent;
   use MetaModels\IFactory;
   use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

   #[AsEventListener(PrePersistModelEvent::NAME)]
   class PrePersistModelEvent3Listener
   {
       public function __construct(private readonly IFactory $factory)
       {
       }

       public function __invoke(PrePersistModelEvent $event)
       {
           if ('mm_employees' !== $event->getEnvironment()->getDataDefinition()?->getName()) {
               return;
           }

           $model = $event->getModel();

           $anotherMetaModel = $this->factory->getMetaModel('mm_another_model');
       }
   }


.. _register-services-with-services-and-other:
4. Registrierung per services.yml und Einbindung weiterer Services
---------------------------------------------------------------

Benötigt man in seiner Klasse den Zugriff auf weitere Services, kann man die über den ``constructor`` einbinden, indem
man den Service in der ``services.yml`` als Argument übergibt.

.. code-block:: php
   :linenos:

   <?php
   // src/EventListener/PrePersistModelEventListener.php
   namespace App\EventListener;

   use ContaoCommunityAlliance\DcGeneral\Event\PrePersistModelEvent;
   use MetaModels\IFactory;

   class PrePersistModelEvent4Listener
   {
       public function __construct(private readonly IFactory $factory)
       {
       }

       public function __invoke(PrePersistModelEvent $event)
       {
           if ('mm_employees' !== $event->getEnvironment()->getDataDefinition()?->getName()) {
               return;
           }

           $model = $event->getModel();

           $anotherMetaModel = $this->factory->getMetaModel('mm_another_model');
       }
   }

.. code-block:: yaml
   :linenos:

   # config/services.yml
   services:
     App\EventListener\PrePersistModelEventListener:
     arguments:
       - '@metamodels.factory'
       tags:
         - { name: kernel.event_listener, event: dc-general.model.pre-persist }


.. _register-services-all-in-src:
5. Alle Dateien in src/ und Namespace App
-----------------------------------------

Möchte man zur einfacheren Datenpflege alle Dateien - also auch z. B. die `service.yml` - kompakt im Ordner `src`
haben aber dennoch mit dem Namespace `App` arbeiten, so kann man sich das Beispiel vom Vortrag cd CK23 auf
`Github <https://github.com/e-spin/vortrag-contao-konferenz-2023/tree/main/src>`_ ansehen.

Zu beachten ist der Eintrag
`foo <https://github.com/e-spin/vortrag-contao-konferenz-2023/blob/main/src/Resources/config/foo.yml>`_ -
der ist notwendig um einige "Contao-Magic" für den Namespace zu umgehen...


.. _register-services-all-in-src-own-namespace:
6. Alle Dateien in src/ und eigener Namespace
---------------------------------------------

Möchte man mit einem eigenen Namespace arbeiten und weniger Contao- bzw. Symfony-Magic, so müssen einige Dateien mehr
in ``src/`` angelegt werden. Das kann z. B. dann sinnvoll sein, wenn man mit mehreren separaten Bundles und ihren
Namespaces arbeiten möchte. In dem Fall, würde man weitere Unterordner z. B. ``src/ProjectOneBundle`` anlegen.

Ist dies nicht der Fall, können alle Dateien direkt in ``src/`` mit dem Namespace z. B. ``AppBundle``.

Folgend ein beispielhafter Aufbau

|img_register-services_02.png|

Damit die Dateien und der Namespace korrekt gefunden werden, muss die ``composer.json`` wie folgt ergänzt werden:


.. code-block:: json
   :linenos:

   "autoload": {
     "psr-4": {
         "AppBundle\\": "src/"
     },
     "classmap": [
         "src/ContaoManager/ContaoManagerPlugin.php"
     ]
   },



.. |img_register-services_01.png| image:: /_img/screenshots/cookbook/specials/register-services_01.png
.. |img_register-services_02.png| image:: /_img/screenshots/cookbook/specials/register-services_02.png
