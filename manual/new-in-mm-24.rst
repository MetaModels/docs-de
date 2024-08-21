.. _new_in_mm240:

Änderungen und Features von MM 2.4
==================================

Folgend eine Übersicht der Änderungen und Features zu MetaModels 2.4, die durch das
"early adopter Programm" ermöglicht wurden - mehr dazu unter Fundraising auf der
`MM Webseite <https://now.metamodel.me/de/unterstuetzer/fundraising#metamodels_2-4>`_.

Für einen Check nach einem Upgrade zu MM 2.4 sind :ref:`unten weitere Hinweise <check_upgrade_mm240>`.

.. note:: Zum Anlegen von mm_*-Tabellen und Spalten der Attribute muss eine DB-Migration durchgeführt werden -
   siehe :ref:`Schemamanager <component_schema-manager>`. |br|
   Nach Anlegen oder Änderungen der Bezeichnungen von Models, Attributen oder Legenden bitte den (Translation-)-Cache
   löschen - siehe :ref:`component_translations`.


Allgemein und Core
------------------


Attribute
---------

* Datei
    * Anpassung der Templates für die Ausgabe `title`, `alt`, `caption` aus Knoten `metafile`
* Übersetzte Datei
    * Anpassung der Templates für die Ausgabe `title`, `alt`, `caption` aus Knoten `metafile`


Filter
------


Frontend-Editing (FEE)
----------------------

* Änderung des Templates `form_textfield_multiple` zu `form_text_multiple` in "FormTextFieldMultipleBundle"
  (Angleichung an Contao 5)


Known-Issues
------------

* bei Umschaltung zu/vom Debugmodus im BE per Button stimmt die Referenzseite nicht mehr und man muss die Seite
  erneut ansteuern - z. B. mit "zurück" im Browser und Reload der Seite |br|
  Contao bietet aktuell keine Möglichkeit, an der Stelle den Referer zu beeinflussen


.. _check_upgrade_mm240:
Check für Upgrade auf MM 2.4
----------------------------

Grundsätzlich ist ein Upgrade innerhalb des MM 2.x-Zweiges problemlos möglich und ggf. notwendige Anpassungen an
Bezeichnungen und DB-Änderungen werden über Migrationen abgefangen. Es gibt aber ein paar Sachen, die damit nicht
oder nur sehr schwer abzufangen sind. Aus dem Grund sollten bei der Umstellungen auf MM 2.4 die folgenden Punkte
im Blick behalten werden:

* Änderung des Templates `form_textfield_multiple` zu `form_text_multiple` in "FormTextFieldMultipleBundle" (FEE)
* Änderung der Templates bei Datei und übersetzte Datei für Ausgabe der Metadaten


Re-Finanzierung
---------------
.. seealso:: Für eine Re-Finanzierung der umfangreichen Arbeiten, bittet das MM-Team um finanzielle
   Zuwendung. Als Richtgröße sollte der Umfang des zu realisierenden Projektes genommen werden
   und etwa 10% einkalkuliert werden - aufgrund der Erfahrung der letzten Zuwendungen, sind
   das Beträge zwischen 100€ und 500€ (Netto) - eine Rechnung inkl. MwSt wird natürlich immer
   ausgestellt. `Mehr... <https://now.metamodel.me/de/unterstuetzer/spenden>`_


.. |br| raw:: html

   <br />
