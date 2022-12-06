.. _rst_cookbook_panels_manipulate-select-values:

Eingabemaske: Einzelauswahl um zweite Wertespalte ergänzen
===========================================================

Standardmäßig ist die Wertespalte beim Attribut Einzelauswahl auf die Auswahl
eines Attributs einer beliebigen Contao Tabelle beschränkt. Möchte man in der
Eingabemaske im Attribut Einzelauswahl ein weiteres Attribut der referenzierten
Tabelle darstellen, kann das über verschiedene Wege erfolgen:

1. Attribut "Kombinierte Werte"

Man legt sich im referenzierten Model ein weiteres Attribut an, in dem die Werte
für die Anzeige kombiniert werden.

2. Event "GetPropertyOptionsEvent"

`Zum Beispiel <https://github.com/MetaModels/attribute_select/blob/master/src/EventListener/GetPropertyOptionsListener.php>`_

3. DCA-Callback "options_callback"

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

.. |br| raw:: html

   <br />
