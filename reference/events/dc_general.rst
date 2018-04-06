.. _ref_api_events_dcg:

Events DC_General
=================

.. warning:: Noch im Aufbau!


.. _ref_api_events_dcg_event:

DCG Event:
..........

Aktuelle Informationen unter: `..\Event <https://github.com/contao-community-alliance/dc-general/tree/master/src/ContaoCommunityAlliance/DcGeneral/Event>`_

**PrePersistModelEvent:**

`PrePersistModelEvent: <https://github.com/contao-community-alliance/dc-general/blob/master/src/ContaoCommunityAlliance/DcGeneral/Event/PrePersistModelEvent.php>`_
wird Aufgerufen, bevor ein Model über den DataProvider gespeichert wird.

Mit dem Event können die Daten eines Model manipuliert werden oder ein
Vergleich zwischen den ursprünglichen und den neuen Daten erfolgen.

``$event->getEnvironment()->getDataDefinition()->getName()`` |br|
gibt den Namen des MetaModels zurück

``$event->getOriginalModel()`` |br|
gibt die ursprünglichen Daten des MetaModels zurück

``$event->getModel()`` |br|
gibt die neuen Daten des MetaModels zurück


.. _ref_api_events_dcg_factory_event:

DCG Factory Event:
..................

Aktuelle Informationen unter: `..\Event <https://github.com/contao-community-alliance/dc-general/tree/master/src/ContaoCommunityAlliance/DcGeneral/Factory/Event>`_

**BuildDataDefinitionEvent:**

`BuildDataDefinitionEvent: <https://github.com/contao-community-alliance/dc-general/blob/master/src/ContaoCommunityAlliance/DcGeneral/Factory/Event/BuildDataDefinitionEvent.php>`_
wird Aufgerufen, wenn die Datendefinition (DCA) für eine Liste oder Eingabemaske erzeugt wird.

Mit dem Event kann die Eingabemaske bzw. die Listenansicht manipuliert werden wie z.B. mit einer Filterung.

``$event->getContainer()->getName()`` |br|
gibt den Namen des MetaModels zurück


.. |br| raw:: html

   <br />
