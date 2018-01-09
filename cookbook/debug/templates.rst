.. _rst_cookbook_debug_templates:

Debug Templates
===============

Benötigt man für die Ausgabe z.B. einer Liste für das Frontend ein
eigenes Template oder möchte man bei einem vorhanden Template wissen,
welche Attribute an das Template übermittelt werden, kann man diese
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

Ist die Ausgabe sehr umfangreich, kann die Darstellung im Browser sehr
langsam werden - Abhilfe schafft z.B. sich nur ein Item-Knoten ausgeben
zu lassen:

.. code-block:: php
   :linenos:

   <?php 
   echo "<!-- DEBUG START \n";
   echo "<pre>\n";
   // nur 0.-Knoten
   print_r($this->items->parseAll($this->getFormat(), $this->view)[0]);
   echo "</pre>\n";
   echo "\n DEBUG ENDE -->";
   ?>

Ist in den Render-Einstellungen die Weiterleitung und Filter für die Detailseite
eingestellt, wird die Ausgabe des Arrays im Quelltext sehr umfangreich und führt
häufig zu einem Error "Allowed memory size...". Abhilfe schafft hier z.B. das 
kurzzeitige Abschalten des Filters für die Weiterleitung.

Die Ausgabe kann man wieder entfernen, in dem man den Ausgabeblock
auskommentiert, löscht oder zu einem anderen Template wechselt.

Für die leichte Übernahme der Array-Angaben in ein FE-Template, gibt es den
:ref:`rst_cookbook_frontend_array-helper`.


Debug in MM 2.1
---------------

Das Debugging in MM 2.1 ist durch die Möglichkeiten der Debug-Toolbar von
Symfony sehr komfortabel geworden.

In den Templates kann z.B. folgendes Code-Snipped eingebaut werden:

.. code-block:: php
   :linenos:

   <?php
   // Debug items.
   if (function_exists('dump')) {
       dump($this);
   }
   ?>

Wird die Seite über "app_dev" aufgerufen z.B. "domain.tld/app_dev.php/meine-mm-listenansicht.html",
kann man das Array in der Debug-Toolbar über das "Fadenkreuz-Icon" untersucht werden:

|img_symfony-toolbar|

Mit der Prüfung "function_exist" stört das `dump` nicht den normalen Aufruf der Seite.


.. |img_symfony-toolbar| image:: /_img/screenshots/cookbook/debug/symfony-toolbar.jpg