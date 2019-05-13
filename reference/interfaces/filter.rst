.. _ref_api_interf_filter:

Filter Interfaces
=================

.. warning:: Noch im Aufbau!

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

Aktuelle Informationen unter: `IFilterRule <https://github.com/MetaModels/core/blob/master/src/Filter/IFilter.php>`_

**Interfaces:**

``addFilterRule(IFilterRule $objFilterRule)`` |br|
fügt eine Filterregel zur Filterkette hinzu

``getMatchingIds()`` |br|
gibt alle IDs nach der gegebenen Filterregel zurück

``createCopy()`` |br|
erzeugt eine Kopie des Filters

.. |br| raw:: html

   <br />
