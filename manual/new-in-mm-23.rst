.. _new_in_mm230:

Änderungen und Features von MM 2.3
==================================

Folgend eine Übersicht der Änderungen und Features zu MetaModels 2.3, die durch das
"early adopter Programm" ermöglicht wurden - mehr dazu unter Fundraising auf der
`MM Webseite <https://now.metamodel.me/de/unterstuetzer/fundraising#metamodels_2-3>`_.

Für einen Check nach einem Upgrade zu MM 2.3 sind :ref:`unten weitere Hinweise <check_upgrade_mm230>`.

Allgemein und Core
------------------

* Einbau eines neuen Schema-Managers - damit werden die Tabellen "mm_*" von Contao nicht mehr zum Löschen
  angeboten (`#1297 <https://github.com/MetaModels/core/issues/1279>`_)
* Einträge für Sortierung/Gruppierung haben einen Toggle-Button und können damit aktiviert/deaktiviert
  werden (`#1380 <https://github.com/MetaModels/core/issues/1380>`_)



Attribute
---------


Filter
------

* beim CE-/FE-Modul Filter sind bei den Bezeichnungen der Filterregeln nun auch der Typ mit angegeben
  (`#1473 <https://github.com/MetaModels/core/issues/1473>`_)


Frontend-Editing (FEE)
----------------------


.. _check_upgrade_mm230:
Check für Upgrade auf MM 2.3
----------------------------

Grundsätzlich ist ein Upgrade innerhalb des MM 2.x-Zweiges problemlos möglich und ggf. notwendige Anpassungen an
Bezeichnungen und DB-Änderungen werden über Migrationen abgefangen. Es gibt aber ein paar Sachen, die damit nicht
oder nur sehr schwer abzufangen sind. Aus dem Grund sollten bei der Umstellungen auf MM 2.3 die folgenden Punkte
im Blick behalten werden:

* bei einem Upgrade kleiner 2.2 bitte die :ref:`Checkliste für MM 2.2 beachten <check_upgrade_mm220>`


Re-Finanzierung
---------------
.. seealso:: Für eine Re-Finanzierung der umfangreichen Arbeiten, bittet das MM-Team um finanzielle
   Zuwendung. Als Richtgröße sollte der Umfang des zu realisierenden Projektes genommen werden
   und etwa 10% einkalkuliert werden - aufgrund der Erfahrung der letzten Zuwendungen, sind
   das Beträge zwischen 100€ und 500€ (Netto) - eine Rechnung inkl. MwSt wird natürlich immer
   ausgestellt. `Mehr... <https://now.metamodel.me/de/unterstuetzer/spenden>`_


.. |br| raw:: html

   <br />
