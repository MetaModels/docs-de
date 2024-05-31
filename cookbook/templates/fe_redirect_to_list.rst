.. _rst_cookbook_templates_fe_redirect_to_list:

Automatische Umleitung von Detailseite zur Listenseite oder "Error 404"
=======================================================================

Die Datenausgabe auf der Detailseite wird häufig über einen oder mehrere
Parameter gesteuert bzw. die Ausgabe gefiltert - meist über das `auto_item`.

Kann aufgrund der Filterung kein Datensatz gefunden werden oder wird die Detailseite ganz ohne Angabe des
(Filter)Parameters in der URL aufgerufen, und es erscheint eine Ausgebe wie "Es konnten keine Daten gefunden werden".

Ist dies nicht gewünscht, und es soll dann gleich zur Listenansicht gesprungen
werden, kann das mit dem folgenden Code im Template der Detailansicht erreicht werden:

.. code-block:: php
   :linenos:

    // redirect if data empty
    if (!count($this->data)) {
        $pageId  = 192; // Page id 
        $page    = \PageModel::findByPK($pageId);
        $pageURL = $page->getFrontendUrl();
        \Controller::redirect($pageURL);
    }

Wird die Basisseite von Contao ohne Angabe des (Filter)Parameters aufgerufen, kann man auch automatisch ein "Error 404"
ausliefern lassen. Dazu muss man in den Seiteneinstellungen die Checkbox "Element erforderlich" setzen. 
