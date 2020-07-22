.. _rst_cookbook_debug_templates:

Debug Templates
===============

Benötigt man für die Ausgabe z.B. einer Liste für das Frontend ein
eigenes Template oder möchte man bei einem vorhanden Template wissen,
welche Attribute an das Template übermittelt werden, kann man diese
sich mit der Debug-Toolbar von Symfony sehr komfortabel ausgeben lassen.

Das Standardtemplate ist "metamodel_prerendered", bzw. das Template,
welches in der Render-Einstellung für die Ausgabe ausgewählt wurde.

Ist noch kein eigens Template im Einsatz, muss eine Kopie von
"metamodel_prerendered" im Contao-Ordner "/templates" angelegt werden.

Das jeweilige Template wird mit den folgenden Zeilen oben ergänzt:

.. code-block:: php
   :linenos:

   <?php
   // Debug items.
   if (\Contao\System::getContainer()->get('kernel')->isDebug()) {
       dump($this->data);
   }
   ?>

Anschließend muss man die Seite im Frontend im Debugmodus ansehen. Dazu im
Backend den Debugmodus im header einschalten, oder für einen dauerhaften Debugmodus
im Projektordner eine Datei `.env` mit dem Inhalt `APP_ENV=dev` anlegen.

Anschließend kann man das Array in der Debug-Toolbar über das "Fadenkreuz-Icon"
untersuchen:

|img_symfony-toolbar|

Mit der Prüfung "function_exist" stört das `dump` nicht den normalen Aufruf der Seite.

Für die leichte Übernahme der Array-Angaben in ein FE-Template, gibt es den
:ref:`rst_cookbook_frontend_array-helper`, die eine Ausgabe im Quelltext für ein
`Copy&Paste` erstellt.


Debug in MM 2.0
---------------

In Contao 3 steht die Symfony-Toolbar nicht zur Verfügung und man muss über ein
`print_r` gehen.

Das jeweilige Template wird mit einigen Ausgabezeilen ergänzt und sollte
anschließend wie folgt beginnen:

.. code-block:: php
   :linenos:

   <?php 
   echo "<!-- DEBUG START \n";
   echo "<pre>\n";
   print_r($this->items->parseAll($this->getFormat(), $this->view));
   echo "</pre>\n";
   echo "\n DEBUG ENDE -->";
   ?>

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


.. |img_symfony-toolbar| image:: /_img/screenshots/cookbook/debug/symfony-toolbar.jpg
