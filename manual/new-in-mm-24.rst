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

Mit Contao 5 kommt eine Version von Symfony ins Spiel und wir haben die Mindestversion von PHP auf 8.2 gestellt. Bei
Contao 5 ist das leicht abgeänderte Backend mit der vollen Breite und neuen Icons am Auffälligsten. Die neuen
`Angaben zur Breite eines Widgets <https://docs.contao.org/dev/reference/dca/palettes/#arranging-fields>`_ in der
Eingabemaske wie "w25" oder "w66" können natürlich auch in MM verwendet werden. MetaModels unterstützt das
"Dunkle Design" (Dark-Mode) im Backend inkl. Iconvarianten mit Suffix "--dark".

Bei eigenen Anpassungen bzw. Programmierungen sind einige Dinge zu beachten, die sich in Contao geändert haben wie
z. B. die Deprecations aus `C 4.13 <https://github.com/contao/contao/blob/4.13/DEPRECATED.md>`_
bzw. `C 5 <https://github.com/contao/contao/blob/5.x/DEPRECATED.md>`_, absolute Pfadangaben für Dateien wie Icons
oder CSS/JS oder vollständige Angaben beim Aufruf von Methoden z. B. "\Contao\Input::get('myvariable')".


Attribute
---------

* Checkbox
    * Unterstützung des Dark-Mode bei den Icons - dazu eine weitere Icon-Datei mit dem Suffix "--dark" anlegen
* Datei
    * Anpassung der Templates für die Ausgabe `title`, `alt`, `caption` aus Knoten `metafile`
* Langtext
    * Migration für `basicEntities` - `siehe Contao-Handbuch <https://docs.contao.org/manual/de/artikelverwaltung/insert-tags/#basic-entities>`_
* Text
    * Migration für  `basicEntities` - `siehe Contao-Handbuch <https://docs.contao.org/manual/de/artikelverwaltung/insert-tags/#basic-entities>`_
* Übersetzte Checkbox
    * Unterstützung des Dark-Mode bei den Icons - dazu eine weitere Icon-Datei mit dem Suffix "--dark" anlegen
* Übersetzte Datei
    * Anpassung der Templates für die Ausgabe `title`, `alt`, `caption` aus Knoten `metafile`
* Übersetzter Langtext
    * Migration für  `basicEntities` - `siehe Contao-Handbuch <https://docs.contao.org/manual/de/artikelverwaltung/insert-tags/#basic-entities>`_
* Übersetzter Text
    * Migration für  `basicEntities` - `siehe Contao-Handbuch <https://docs.contao.org/manual/de/artikelverwaltung/insert-tags/#basic-entities>`_


Filter
------

* Volltextsuche mit "Loupe" (Neu - noch in Arbeit...)
    * Mit der neuen Filterregel wird ein Index über ausgewählte Attribute erstellt, über den anschließend gesucht
      werden kann - siehe `Loupe <https://github.com/loupe-php/loupe>`_


Frontend-Editing (FEE)
----------------------

* Änderung des Templates `form_textfield_multiple` zu `form_text_multiple` in "FormTextFieldMultipleBundle"
  (Angleichung an Contao 5)
* bei den Einstellungen der Eingabemaske für einen Datei-Upload werden bei den Widget-Modi je nach aktivierter
  Einstellung "Mehrfachbearbeitung" nur noch die passenden Einstellungen für Einzel- oder Mehrfachupload angezeigt - bei
  einer Umstellung beim Attribut muss das aber entsprechend beim Upload auch umgestellt werden


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

* bitte alle Hinweise aus :ref:`MM 2.3 <check_upgrade_mm230>` und :ref:`MM 2.2 <check_upgrade_mm220>` beachten
* Änderung der Templates vom DC_General
* Änderung des Templates `form_textfield_multiple` zu `form_text_multiple` in "FormTextFieldMultipleBundle" (FEE)
* Änderung der Templates bei Datei und übersetzte Datei für Ausgabe der Metadaten
* Check der eigenen Programmierungen an Contao 5 (s.o.)
* bei FEE mit Dateiupload, Widget-Modus bei Einstellungen des Atttributs in der Eingabemaske prüfen (s. o.)
* für Dark-Mode ggf. weitere Varianten der eigenen Icons mit Suffix "--dark" anlegen - z. B. zu
  `flag_enabled.svg` und `flag_disabled.svg` ein `flag_enabled--dark.svg` und `flag_disabled--dark.svg` - siehe
  `EAP-News Oktober II 2024 <https://now.metamodel.me/de/mm-eap-newsletter-2-4/details/eap-info-mm-2-4-oktober-ii-2024>`_


Re-Finanzierung
---------------
.. seealso:: Für eine Re-Finanzierung der umfangreichen Arbeiten, bittet das MM-Team um finanzielle
   Zuwendung. Als Richtgröße sollte der Umfang des zu realisierenden Projektes genommen werden
   und etwa 10% einkalkuliert werden - aufgrund der Erfahrung der letzten Zuwendungen, sind
   das Beträge zwischen 100€ und 500€ (Netto) - eine Rechnung inkl. MwSt wird natürlich immer
   ausgestellt. `Mehr... <https://now.metamodel.me/de/unterstuetzer/spenden>`_


.. |br| raw:: html

   <br />
