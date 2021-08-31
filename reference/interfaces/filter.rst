.. _ref_api_interf_filter:

Filter Interfaces
=================

Die Filter Interfaces erstellen einen Zugriff auf Filter bzw.
Filterregeln, die im Backend in einem MetaModel definiert sind.

Zusätzlich können in der Programmierung weitere Filter erzeugt
oder Filterparameter gesetzt werden. 


.. _ref_api_interf_filter_filterrule:

IFilterRule Interface
.....................

Aktuelle Informationen unter: `IFilterRule <https://github.com/MetaModels/core/blob/master/src/Filter/IFilterRule.php>`_

**Interfaces:**

``getMatchingIds()`` |br|
gibt alle IDs nach der gegebenen Filterregel zurück


.. _ref_api_interf_filter_filter:

IFilter Interface
.................

Aktuelle Informationen unter: `IFilter <https://github.com/MetaModels/core/blob/master/src/Filter/IFilter.php>`_

**Interfaces:**

``addFilterRule(IFilterRule $objFilterRule)`` |br|
fügt eine Filterregel zur Filterkette hinzu

``getMatchingIds()`` |br|
gibt alle IDs nach der gegebenen Filterregel zurück

``createCopy()`` |br|
erzeugt eine Kopie des Filters


Beispiele
.........

.. code-block:: php
   :linenos:

   <?php
   // Start
   $modelName = 'mm_employees';
   $factory   = \Contao\System::getContainer()->get('metamodels.factory');
   // alternativ
   //$factory = $this->getContainer()->get('metamodels.factory');
   $model  = $factory->getMetaModel($modelName);
   $filter = $model->getEmptyFilter();

   // Filterung nach fester ID (Liste):
   $idList = [1,2,3];
   $filter->addFilterRule(new \MetaModels\Filter\Rules\StaticIdList($idList);

   // Filterung nach Wert eines Attributes:
   $value      = 'marketing';
   $languages  = $model->getAvailableLanguages();
   $attribute  = $model->getAttribute('division');
   $filter->addFilterRule(new \MetaModels\Filter\Rules\SearchAttribute($attribute, $value, $languages));

   // eigenes SQL:
   $query = sprintf('SELECT * FROM %s WHERE published = 1', $modelName);
   $filter->addFilterRule(new \MetaModels\Filter\Rules\SimpleQuery($query));

   // Filterung mit mehreren Regeln:
   // Verknüpfung mit ConditionAnd() oder ConditionOr()
   // Vergleich mit GreaterThan, LessThan, NotEqual
   $attribute        = $model->getAttribute('price');
   $compareInclusive = true;
   $andRule          = new \MetaModels\Filter\Rules\Condition\ConditionAnd();
   $andRule
       ->addRule(new \MetaModels\Filter\Rules\Comparing\GreaterThan($attribute, 10, $compareInclusive)) // >= 10
       ->addRule(new \MetaModels\Filter\Rules\Comparing\LessThan($attribute, 20));                      // < 20
   $filter->addFilterRule($andRule);

   // Ende
   $items    = $model->findByFilter($filter);
   $arrItems = $items->parseAll('text');
   //dump($arrItems);


.. |br| raw:: html

   <br />
