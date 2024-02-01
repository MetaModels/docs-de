.. _rst_cookbook_templates_fe_list_parameters:

Individuelle Parameter für die MM-Listenausgabe im Frontend
===========================================================

.. note:: Das Feature steht ab MM 2.2 zur Verfügung.

In den Einstellungen der Listenausgabe (CE/FE-Modul) gibt es die Option, eigne Werte an das Template übergeben zu
können. Das Können Texte oder Zahlenwerte sein. Damit ist es einem Redakteur leicht möglich, bei selbem FE-Template
der Listenausgabe dies mit Parametern zu steuern oder abzuwandeln. Damit kann man ein Listentemplate weiter
verallgemeinern und über das Backend z. B. mit Bezeichnungen, Übersetzungen oder Parameter für die Ausgabe
oder JavaScript-Inhalte steuern.

Über einen MCW können eigene „Key-Value-Pärchen“ erstellt werden, die im Template über „$this->params“ als Array zur
Verfügung stehen.

Die folgenden zwei Screenshots zeigen eine mögliche Eingabe im Backend und was beim Template ankommt:

|img_settings-wizard_01|

|img_settings-wizard_02|

Der folgende Code kann im Kopfbereich des Listentemplates eingebaut werden und zeigt als Beispiel den Zugriff auf
die Werte inklusive eines Defaultwertes:

.. code-block:: php
   :linenos:

   <?php
   // Get value for "key".
   $extract = fn(string $keyName, string $default = ''): string =>
       (false !== $index = \array_search($keyName, \array_column($this->parameter, 'key'), true))
       ? $this->parameter[$index]['value']
       : $default;
   $valueOne = $extract('key1', '7');
   $valueTwo = $extract('key2', '42');
   // dump($this->parameter, $valueOne, $valueTwo);


.. |img_settings-wizard_01| image:: /_img/screenshots/metamodel_new_features/settings-wizard_01.jpg
.. |img_settings-wizard_02| image:: /_img/screenshots/metamodel_new_features/settings-wizard_02.jpg


