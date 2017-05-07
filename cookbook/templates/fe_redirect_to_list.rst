.. _rst_cookbook_templates_fe_redirect_to_list:

Automatische Umleitung von Detailseite zur Listenseite
======================================================

Die Datenausgabe auf der Detailseite wird häufig über einen oder mehrere
Parameter gesteuert bzw. die Ausgabe gefiltert - meist über das `auto_item`.

Die Detailseite auch ohne Angabe des (Filter)Parameters in der URL aufrufbar
und es erscheint eine Ausgebe wie "Es konnten keine Daten gefunden werden".

Ist dies nicht gewünscht, und es soll dann gleich zur Listenansicht gesprungen
werden, kann das mit dem folgenden Code im Template der Deatilansicht erreicht werden:

.. code-block:: php
   :linenos:

    // redirect if data empty
    if (count($this->data) == 0) {
        $intPageId = 192; // Page id 
    	$objPage   = \PageModel::findByPK(intPageId); //Page objekt
    	$pageURL   = \Controller::generateFrontendUrl($objPage->row()); //URL
	    \Controller::redirect($pageURL); //redirect
    }


