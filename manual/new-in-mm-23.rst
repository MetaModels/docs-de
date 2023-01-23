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
* Hinweis für Programmierer: es gibt eine neue Klasse, mit der die Attribute nach Namen sortiert werden
  können (src/CoreBundle/Sorter/AttributeSorter.php) - zum Einsatz kommt diese z. B. bei der Auswahl des
  Attributes bei der Sortierung (die sind nun aufsteigend sortiert)
* wenn die erste Sortierung angelegt wird, ist nun die Checkbox für "Standard" vorausgewählt
  (`#1472 <https://github.com/MetaModels/core/issues/1472>`_)
* wird bei der Eingabemaske der Render-Modus auf "Hierarchie" gestellt, erscheint nun ein Hinweis,
  dass die Sortierung auf "Manuell" einzustellen ist (`#1324 <https://github.com/MetaModels/core/issues/1324>`_)
* die Checkbox "Variante" bei den Attributen ist disabled, wenn das Model nicht-variant ist
  (`#884 <https://github.com/MetaModels/core/issues/884>`_)
* die Klasse "getSearchablePages" (Indexierung der Detailseiten) wurde komplett neu geschrieben und läuft nun
  effektiver/schneller


Attribute
---------


Filter
------

* beim CE-/FE-Modul Filter sind bei den Bezeichnungen der Filterregeln nun auch der Typ mit angegeben
  (`#1473 <https://github.com/MetaModels/core/issues/1473>`_)


Frontend-Editing (FEE)
----------------------
* Es wurde ein einfaches Rechtemanagement eingebaut welches nach Aktivierung ermöglicht, dass jedes
  eingeloggte Mitglied nur noch seine Einträge bearbeiten kann (`#14 <https://github.com/MetaModels/contao-frontend-editing/issues/14>`_)


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
