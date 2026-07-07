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

Die Blocks "Filterung" zwischen "Start" und "Ende" sind als Alternativen zueinander zu betrachten. Die 
aufgerufenen Klassen sollten als qualifizierter Import per "use" eingebunden werden.

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
   $filter->addFilterRule(new \MetaModels\Filter\Rules\StaticIdList($idList));

   // Filterung nach Wert eines Attributes:
   $value      = 'marketing';
   $languages  = $model->getAvailableLanguages();
   $attribute  = $model->getAttribute('division');
   $filter->addFilterRule(new \MetaModels\Filter\Rules\SearchAttribute($attribute, $value, $languages));

   // eigenes SQL *1:
   $query = \sprintf('SELECT * FROM %s WHERE published = 1', $modelName);
   $filter->addFilterRule(new \MetaModels\Filter\Rules\SimpleQuery($query));
   // Alternativ siehe https://www.doctrine-project.org/projects/doctrine-dbal/en/4.2/reference/data-retrieval-and-manipulation.html
   $query = \sprintf('SELECT * FROM %s WHERE published = ?', $modelName);
   $filter->addFilterRule(new \MetaModels\Filter\Rules\SimpleQuery($query, [1]));

   // Filterung mit mehreren Regeln:
   // Verknüpfung mit ConditionAnd() oder ConditionOr()
   // Vergleich mit GreaterThan, LessThan, NotEqual möglich
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

*1: Eigenes SQL kann auch über den
`Doctrine DBAL queryBuilder <https://www.doctrine-project.org/projects/doctrine-dbal/en/4.4/reference/query-builder.html>`_
erzeugt und SimpleQuery übergeben werden. Mit dem queryBuilder kann ein Query elegant aufgebaut werden, wenn z. B.
verschiedene Abhängigkeiten abgefangen werden sollen. Folgend ein Beispiel:

.. code-block:: php
   :linenos:

   <?php

   use Doctrine\DBAL\Connection;
   use MetaModels\Filter\Rules\SimpleQuery;

   // ...

   $modelName = 'mm_employees';
   $model     = $factory->getMetaModel($modelName);
   $filter    = $model->getEmptyFilter();

   $builder = $this->connection->createQueryBuilder()
               ->select('t.id')
               ->from($metaModel->getTableName(), 't');

   if ($checkUpload) {
       $builder->andWhere('t.upload_allowed = 1');
   }

   $filter = $metaModel->getEmptyFilter();
   $filter->addFilterRule(SimpleQuery::createFromQueryBuilder($builder));
   $items = $metaModel->findByFilter($filter, 'name');


.. |br| raw:: html

   <br />
