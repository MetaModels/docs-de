.. _rst_cookbook_panels_default-values:

Eingabemaske: automatische Wertevorgaben
========================================

Die Eingabefelder der Eingabemasken können mit Standardwerten automatisch vorbelegt werden. Damit kann das Ausfüllen der
Eingabemasken erleichtert werden, wenn ein Datensatz neu angelegt wird.

Über den `BuildDataDefinitionEvent <https://github.com/contao-community-alliance/dc-general/blob/efe5e2de934946e1d51df56797b18d74b1683d12/src/Factory/Event/BuildDataDefinitionEvent.php>`_
des DCG kann der Deafultwert gesetzt werden - folgend ein Beispiel für einen entsprechenden EventListener um bei dem
Model ``mm_employees`` das Attribut ``name`` mit "Moin" vorzubelegen.

.. code-block:: php
   :linenos:

   <?php
   // src/EventListener/SetDefaultValueListener.php
   namespace App\EventListener;

   use ContaoCommunityAlliance\DcGeneral\DataDefinition\Palette\PaletteInterface;
   use ContaoCommunityAlliance\DcGeneral\Factory\Event\BuildDataDefinitionEvent;

   class SetDefaultValueListener
   {
       public function __invoke(BuildDataDefinitionEvent $event): void
       {
           // Get container.
           $container = $event->getContainer();
           // Check right table present.
           if ('mm_employees' !== $container->getName()) {
               return;
           }
           // Set default value.
           $container->getPropertiesDefinition()->getProperty('name')->setDefaultValue('Moin');
       }
   }

.. code-block:: yml
   :linenos:

   services:
   # src/Resources/config/services.yml
     App\EventListener\SetDefaultValueListener:
       public: true
       tags:
         - { name: kernel.event_listener, event: dc-general.factory.build-data-definition }


Vorgaben mit Legacy-Code
------------------------

.. note:: Die Vorgaben mit dem Legacy-Code sollten nicht mehr verwendet werden. Ab MM 2.3 muss für eine korrekte
          Ausgabe des Labels bei dem Feld zusätzlich ein Eintrag mit Leerstring angelegt werden - z. B.  |br|
          ``$GLOBALS['TL_DCA']['<MM-Table-Name>']['fields']['<Field-Column-Name>']['label'] = '';``

Die Eingabefelder von MetaModels sind (fast) identisch den Feldern vom Contao-Core oder den üblichen Erweiterungen zu
behandeln, die mit einem DCA-Array erstellt wurden. Unterschiede ergeben sich teilweise durch die dynamische Generierung
der Felder in MetaModels durch den DC-General.

Die Vorgaben für die Felder können durch die Ergänzung des DC-Array mit dem Key "default" erreicht
werden - `siehe Contao-Handbuch <https://docs.contao.org/dev/reference/dca/fields/>`_.

Für einen Eintrag einer Vorgabe muss der (interne) Name des MetaModel und der Spaltenname des Attributes bekannt sein.
Diese Angaben können in einem Arrayeintrag mit der allgemeinen Form

.. code-block:: php
   :linenos:
   
   <?php
   // contao/dca/<MM-Table-Name>.php
   $GLOBALS['TL_DCA']['<MM-Table-Name>']['fields']['<Field-Column-Name>']['default'] = <Value>;

ergänzt werden.

Für ein das E-Mail-Feld ([text]) aus :ref:`mm_first_index` könnte die Vorgabe wie folgt aussehen:

.. code-block:: php
   :linenos:
   
   <?php
   // contao/dca/mm_mitarbeiterliste.php
   $GLOBALS['TL_DCA']['mm_mitarbeiterliste']['fields']['email']['default'] = '@mmtest.com';

Für die einzelnen Attributarten gibt es spezifische Vorgaben, in welcher Form die Werte
erwartet werden:

* **Text**: Text in Hochkomma z.B. '@mmtest.com' |br|
  ``...['default'] = '@mmtest.com';``
* **Timestamp**: Integer für den Timestamp z.B. 1463657005 oder PHP-Funktion time() |br|
  ``...['default'] = 1463657005;`` oder |br|
  ``...['default'] = time();``
* **Einzelauswahl [Select]**: Integer der ID des Wertes in Hochkomma |br|
  ``...['default'] = '2';``
* **Mehrfachauswahl [Tags]**: Array mit den Alias-Werten aus der eingestellten Alias-Spalte |br|
  ``...['default'] = ['einkauf', 'marketing'];``
* **Kontrollkästchen (Checkbox)**: true |br|
  ``...['default'] = true;``

Wie man an dem Attribut "Timestamp" sieht, sind auch dynamische Vorgaben umsetzbar. So wäre es auch möglich, auf
vorhandene Werte aus MetaModels zurück zu greifen und diese - ggf. mit einer Berechnung - als Standard auszugeben.
Für einen Zugriff auf MetaModels stehen die Methoden der API (:ref:`ref_api_interf_mm`) zur Verfügung.

.. |br| raw:: html

   <br />
