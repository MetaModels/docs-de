.. _rst_cookbook_panels_manipulate-select-values:

Eingabemaske: Einzelauswahl um weitere Wertes ergänzen
======================================================

Standardmäßig ist die Wertespalte beim Attribut Einzelauswahl auf die Auswahl
eines Attributs einer beliebigen Contao Tabelle beschränkt. Möchte man in der
Eingabemaske im Attribut Einzelauswahl ein oder mehrere Attribute/Werte der
referenzierten Tabelle darstellen, kann das über verschiedene Wege erfolgen:

**1. Attribut "Kombinierte Werte"**

Man legt sich im referenzierten Model ein weiteres Attribut an, in dem die Werte
für die Anzeige kombiniert werden.

**2. Event "GetPropertyOptionsEvent"**

.. code-block:: php
   :linenos:

   <?php
   // src/EventListener/GetPropertyOptionsListener.php

   namespace App\EventListener;

   use Contao\MemberModel;
   use ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\Event\GetPropertyOptionsEvent;
   use MetaModels\AttributeSelectBundle\Attribute\AbstractSelect;
   use MetaModels\DcGeneral\Data\Model;
   use Terminal42\ServiceAnnotationBundle\Annotation\ServiceTag;

   /**
    * @ServiceTag("kernel.event_listener", event="dc-general.view.contao2backend.get-property-options")
    */
   class GetPropertyOptionsListener
   {
       public function __invoke(GetPropertyOptionsEvent $event)
       {
           // Check if options set.
           if ($event->getOptions() !== null) {
               return;
           }

           // Check if right model table and type.
           if ('mm_my_model' !== $event->getEnvironment()->getDataDefinition()->getName()) {
               return;
           }

           $model = $event->getModel();
           if (!($model instanceof Model)) {
               return;
           }

           // Check if right attribute and type.
           if ('member' !== $event->getPropertyName()) {
               return;
           }

           $attribute = $model->getItem()->getAttribute($event->getPropertyName());
           if (!($attribute instanceof AbstractSelect)) {
               return;
           }

           // Generate own options list.
           $members     = MemberModel::findAll();
           $aliasColumn = $attribute->get('select_alias');

           $options = [];

           foreach ($members as $member) {
               $options[$member->{$aliasColumn}] =
                   \sprintf('%s, %s [%s]', $member->lastname, $member->firstname, $member->email);
           }

           $event->setOptions($options);
       }
   }

Ergebnis: |br|
|img_manipulate-select-values_01|

Referenz: |br|
`GetPropertyOptionsListener <https://github.com/MetaModels/attribute_select/blob/master/src/EventListener/GetPropertyOptionsListener.php>`_

**3. DCA-Callback "options_callback"**

.. code-block:: php
   :linenos:
   
   <?php
   // contao/dca/<MM-Table-Name>.php
   $GLOBALS['TL_DCA']['<MM-Table-Name>']['fields']['<MM-Spalten-Name-Select>'] = [ 
    'options_callback' => function () { 
        $modelName = '<MM-Table-Name-Select>'; 
        $factory   = $this->getContainer()->get('metamodels.factory'); 
        $model     = $factory->getMetaModel($modelName); 
        $filter    = $model->getEmptyFilter(); 
        $items     = $model->findByFilter($filter); 
        $arrItems  = $items->parseAll('text'); 

        $options = []; 
        foreach ($arrItems as $arrItem) { 
            $options[$arrItem['text']['<MM-Select-Spalten-Name-Alias>']] = \sprintf(
            '%s [%s]',
            $arrItem['text']['<MM-Select-Spalten-Name-1>'], 
            $arrItem['text']['<MM-Select-Spalten-Name-2>'] 
            ); 
        } 

        return $options;
       }, 
   ];

Die Keys des Array ``$options`` müssen mit der Einstellung "Alias" aus den
Einstellungen des Attributes übereinstimmen.

Im Attribut "Select" eingestellte Filter für das Backend werden hiermit
übergangen.


.. |img_manipulate-select-values_01| image:: /_img/screenshots/cookbook/panels/manipulate-select-values_01.jpg

.. |br| raw:: html

   <br />
