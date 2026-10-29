.. _new_in_mm260:

Änderungen und Features von MM 2.6
==================================

Folgend eine Übersicht der Änderungen und Features zu MetaModels 2.6, die durch das
"**early adopter Programm**" (EAP) ermöglicht wurden/werden - mehr dazu unter **Fundraising** auf der
`MM Webseite <https://now.metamodel.me/de/unterstuetzer/fundraising#metamodels_2-6>`_.

Für einen **Check nach einem Upgrade** zu MM 2.6 sind :ref:`unten weitere Hinweise <check_upgrade_mm260>`.


Allgemein und Core
------------------

MetaModels 2.6 setzt **Contao 6.x** und **PHP 8.4** voraus - sowie aktuell noch einen
`EAP-Zugangskey <https://now.metamodel.me/de/unterstuetzer/fundraising#metamodels_2-6>`_.

Die wichtigsten neuen Features sind:

* **API und MCP für KI-Agenten**: Die Datensätze der MetaModels sind über die Contao-API erreichbar (lesen, anlegen,
  ändern, löschen - mit den Rechten und der Validierung des Backends), siehe :ref:`Contao-API <rst_extended_contao-api>`.
  Über den MCP-Server von Contao kann ein KI-Agent MetaModels auch auslesen und einrichten, siehe
  :ref:`MCP-Administration <rst_extended_mcp-admin>`.


Known-Issues
------------

* bei Umschaltung zu/vom Debugmodus im BE per Button stimmt die Referenzseite nicht mehr und man muss die Seite
  erneut ansteuern - z. B. mit „zurück" im Browser und Reload der Seite |br|
  Ursache ist der von Contao erzeugte Umschalt-Link ``?do=debug&key=enable&referer=…``: auf den route-basierten
  MetaModels-Backend-Seiten (z. B. ``/contao/metamodel/mm_employees``) bleibt der ``referer``-Parameter **leer**,
  sodass Contao nach dem Umschalten auf das Backend-Dashboard statt zur Ausgangsseite zurückführt. Das betrifft
  Contaos eigenen Debug-Umschalter und wird vom neuen Referer-Handling des DC_General (eigene „Zurück"-Buttons)
  nicht erfasst - Contao bietet an dieser Stelle keine Möglichkeit, den Referer zu beeinflussen. |br|
  Ein Fix wurde vorgeschlagen: `contao/contao PR #10206 <https://github.com/contao/contao/pull/10206>`_.


.. _check_upgrade_mm260:
Check für Upgrade auf MM 2.6
----------------------------

Grundsätzlich ist ein Upgrade innerhalb des MM 2.x-Zweiges problemlos möglich und ggf. notwendige Anpassungen an
Bezeichnungen und DB-Änderungen werden über Migrationen abgefangen. Es gibt aber ein paar Sachen, die damit nicht
oder nur sehr schwer abzufangen sind. Aus dem Grund sollten bei der Umstellungen auf MM 2.6 die folgenden Punkte
im Blick behalten werden:



Re-Finanzierung
---------------
.. seealso:: Für eine Re-Finanzierung der umfangreichen Arbeiten, bittet das MM-Team um finanzielle
   Zuwendung. Als Richtgröße sollte der Umfang des zu realisierenden Projektes genommen werden
   und etwa 10% einkalkuliert werden - aufgrund der Erfahrung der letzten Zuwendungen, sind
   das Beträge zwischen 100€ und 500€ (Netto) - eine Rechnung inkl. MwSt wird natürlich immer
   ausgestellt. `Mehr... <https://now.metamodel.me/de/unterstuetzer/spenden>`_



.. |br| raw:: html

   <br />
