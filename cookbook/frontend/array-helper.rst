.. _rst_cookbook_frontend_array-helper:

Array-Helper
===============

In vielen Fällen baut man sich sein Template für die Frontend-
Ausgabe aus HTML und "echo" der PHP-Variablen des Ausgabe-Arrays
zusammen.

Hat man eine Debug-Ausgabe wie in :ref:`rst_cookbook_debug_templates`
sieht man, dass in Template zur Verfügung stehende Array mit seinen
Knoten als baumartige Struktur.

Für die Übernahme in das Template kann das insbesondere bei vielen
Relationen zu anderen MetaModels recht mühsam werden.

Mit dem folgenden "Array-Helper" werden die Array-Knoten so ausgegeben, 
dass man diese leicht per "Copy&Paste" in das Template übernehmen kann.

Das jeweilige Template wird mit den folgenden Zeilen an erster Position
ergänzt:

.. code-block:: php
   :linenos:

    <?php
    // http://stackoverflow.com/a/14518402
    function printArray($array, $path=false, $top=true) {
    	$data = ""; $delimiter = "~~|~~"; $p = null;
    	if(is_array($array)){
    	  foreach($array as $key => $a){
    	    if(!is_array($a) || empty($a)){
    	      if(is_array($a)){
    	      	$data .= $path."['{$key}'] = array();".$delimiter;
    	      } else {
    	        $data .= $path."['{$key}'] = \"".addslashes($a)."\";".$delimiter;
    	      }
    	    } else {
    	      $data .= printArray($a, $path."['{$key}']", false);
    	    }    
    	  }
    	}
    	if($top){
    	  $return = "";
    	  foreach(explode($delimiter, $data) as $value){
    	    if(!empty($value)){ $return .= '$arrItem'.$value."\n"; }
    	  };
    	  return $return;
    	}
    	return $data;
    }
    
    echo "<!-- DEBUG START\n";
    echo "<pre>\n";
    // nur 0.-Knoten
    //print_r($this->items->parseAll($this->getFormat(), $this->view)[0]);
    echo printArray($this->items->parseAll($this->getFormat(), $this->view)[0]);
    echo "</pre>\n";
    echo "DEBUG ENDE -->\n";
    ?>

Das Template sollte anschließend mit den folgenden Zeilen beginnen:

 
.. code-block:: html
   :linenos:

   <html> 
    <!-- DEBUG START
    <pre>
    $arrItem['raw']['id'] = "93";
    $arrItem['raw']['pid'] = "0";
    $arrItem['raw']['sorting'] = "0";
    $arrItem['raw']['tstamp'] = "1484897086";
    $arrItem['raw']['name'] = "0";
    $arrItem['raw']['vorname'] = "Amir";
    $arrItem['raw']['email'] = "Amir.Avery@mmtest.com";
    $arrItem['raw']['abteilung']['__SELECT_RAW__']['id'] = "4";
    $arrItem['raw']['abteilung']['__SELECT_RAW__']['pid'] = "0";
    $arrItem['raw']['abteilung']['__SELECT_RAW__']['sorting'] = "0";
    $arrItem['raw']['abteilung']['__SELECT_RAW__']['tstamp'] = "1442499032";
    $arrItem['raw']['abteilung']['__SELECT_RAW__']['name'] = "Marketing";
    $arrItem['raw']['abteilung']['__SELECT_RAW__']['alias'] = "marketing";
    $arrItem['raw']['abteilung']['name'] = "Marketing";
    $arrItem['raw']['abteilung']['alias'] = "marketing";
    $arrItem['text']['name'] = "Avery";
    $arrItem['text']['vorname'] = "Amir";
    $arrItem['text']['email'] = "Amir.Avery@mmtest.com";
    $arrItem['text']['abteilung'] = "Marketing";
    $arrItem['attributes']['name'] = "Name";
    $arrItem['attributes']['vorname'] = "Vorname";
    $arrItem['attributes']['email'] = "E-Mail";
    $arrItem['attributes']['abteilung'] = "Abteilung";
    $arrItem['html5']['name'] = "<span class=\"text\">0</span>";
    $arrItem['html5']['vorname'] = "<span class=\"text\">Amir</span>";
    $arrItem['html5']['email'] = "<span class=\"text\">Amir.Avery@mmtest.com</span>";
    $arrItem['html5']['abteilung'] = "Marketing";
    $arrItem['class'] = "first even";
    $arrItem['jumpTo'] = array();
    </pre>
    DEBUG ENDE -->
   </html>

Im Template könnte dann z.B. die Ausgabe der Abteilung so aussehen:

.. code-block:: html
   :linenos:
   
   <html>
   ...
   <p><span class="label"><?= $arrItem['attributes']['abteilung'] ?>:</span> <?= $arrItem['raw']['abteilung']['name'] ?></p>
   ...
   </html>

Die Ausgabe kann man wieder entfernen, in dem man den Ausgabeblock
auskommentiert, löscht oder zu einem anderen Template wechselt.


