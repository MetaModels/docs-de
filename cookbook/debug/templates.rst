.. _rst_cookbook_debug_templates:

Debug Templates
===============

Benötigt man für die Ausgabe z.B. einer Liste für das Frontend ein
eigenes Template oder möchte man bei einem vorhanden Template wissen,
welche Attributwerde an das Template übermittelt werden, kann man diese
sich in den HTML-Quelltext ausgeben lassen. Eine einfache Art ist die
Ausgabe des Array der Items über "print_r".

Das Standardtemplate ist "metamodel_prerendered", bzw. das Template,
welches in der Render-Einstellung für die Ausgabe ausgewählt wurde.

Ist noch kein eigens Template im Einsatz, muss eine Kopie von
"metamodel_prerendered" im Contao-Ordner "Templates" angelegt werden.

Das jeweilige Template wird mit den folgenden Zeilen ergänzt:

.. code-block:: php
   :linenos:

   <?php 
   echo "<!-- DEBUG START \n";
   echo "<pre>\n";
   print_r($this->items->parseAll($this->getFormat(), $this->view));
   echo "</pre>\n";
   echo "\n DEBUG ENDE -->";
   ?>

Das Template sollte anschließend mit den folgenden Zeilen beginnen:

 
.. code-block:: php
   :linenos:

   <?php 
   echo "<!-- DEBUG START \n";
   echo "<pre>\n";
   print_r($this->items->parseAll($this->getFormat(), $this->view));
   echo "</pre>\n";
   echo "\n DEBUG ENDE -->";
   ?>
   
   <?php $strRendersettings = isset($this->settings)? 'settings' : 'view'; ?>
   <?php if (count($this->data)): ?>
    
   <div class="layout_full">
    
   <?php foreach ($this->data as $arrItem): ?>
   <div class="item <?php echo $arrItem['class']; ?>">
    
   <?php foreach ($arrItem['attributes'] as $field => $strName): ?>
   //...

Wird die entsprechende Webseite mit derm Listing im Browser aufgerufen,
sollte sich im Quelltext die Debugausgabe befinden.

Die Ausgabe kann man wieder entfernen, in dem man den Ausgabeblock
auskommentiert, löscht oder zu einem anderen Template wechselt.


