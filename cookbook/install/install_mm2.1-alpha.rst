.. _cookbook_install_mm2.1-alpha:

MetaModels 2.1 für alpha-Test installieren
==========================================

Für die Installation von MM 2.1 gelten die in :ref:`manual_install` aufgeführten
Bedingungen.

Aktuell gibt es noch Probleme mit dem ``strict mode``, der in neueren MariaDB-
Installationen per default gesetzt ist. Derzeit muss entweder der `strict mode`
abgeschaltet werden oder man muss in der Datenbank manuell bei den Feldern der
eigenen MM-Tabellen, die einen Defaultwert haben, das ``NOT NULL`` entfernen.

Für die Installation stehen während des alpha-Tests die Bundles `bundle_start` oder
`bundle_all` noch nicht zur Verfügung. Neben dem Core sind die notwendigen Pakete
für die Attribute und Filter separat zu installieren.

Entweder erfolgt die Auswahl über den Contao-Manager oder man aktualisiert die
`composer.json` direkt.

Als Basisimplementierung sind sowohl für die composer.json direkt als auch für
den Contao-Managern folgende Pakete inkl. den Versionsangaben zu installieren:

* MM-Core ``^2.1.0@dev``
* DC_General mit ``dev-feature/contao4-release as 2.1.0``
* MultiColumnWizard (MCW) mit ``^3.4.0@beta``

Als Vorlage für die `composer.json` können folgende Angaben bei "require" übernommen
werden:

.. code-block:: json
   :linenos:
   
   "require": {
     "php": "^7.1",
     "contao-community-alliance/dc-general": "dev-feature/contao4-release as 2.1.0",
     "contao/manager-bundle": "<4.5",
     "contao/installation-bundle": "<4.5",
     "menatwork/contao-multicolumnwizard-bundle": "^3.4.0@beta",
     "metamodels/core": "^2.1.0@dev",
     "metamodels/attribute_alias": "^2.1.0@dev",
     "metamodels/attribute_checkbox": "^2.1.0@dev",
     "metamodels/attribute_color": "^2.1.0@dev",
     "metamodels/attribute_combinedvalues": "^2.1.0@dev",
     "metamodels/attribute_country": "^2.1.0@dev",
     "metamodels/attribute_decimal": "^2.1.0@dev",
     "metamodels/attribute_file": "^2.1.0@dev",
     "metamodels/attribute_langcode": "^2.1.0@dev",
     "metamodels/attribute_levensthein": "^2.1.0@dev",
     "metamodels/attribute_longtext": "^2.1.0@dev",
     "metamodels/attribute_numeric": "^2.1.0@dev",
     "metamodels/attribute_rating": "^2.1.0@dev",
     "metamodels/attribute_select": "^2.1.0@dev",
     "metamodels/attribute_tabletext": "^2.1.0@dev",
     "metamodels/attribute_tags": "^2.1.0@dev",
     "metamodels/attribute_text": "^2.1.0@dev",
     "metamodels/attribute_timestamp": "^2.1.0@dev",
     "metamodels/attribute_url": "^2.1.0@dev",
     "metamodels/attribute_translatedalias": "^2.1.0@dev",
     "metamodels/attribute_translatedcheckbox": "^2.1.0@dev",
     "metamodels/attribute_translatedcombinedvalues": "^2.1.0@dev",
     "metamodels/attribute_translatedfile": "^2.1.0@dev",
     "metamodels/attribute_translatedlongtext": "^2.1.0@dev",
     "metamodels/attribute_translatedselect": "^2.1.0@dev",
     "metamodels/attribute_translatedtabletext": "^2.1.0@dev",
     "metamodels/attribute_translatedtags": "^2.1.0@dev",
     "metamodels/attribute_translatedtext": "^2.1.0@dev",
     "metamodels/attribute_translatedurl": "^2.1.0@dev",
     "metamodels/filter_checkbox": "^2.1.0@dev",
     "metamodels/filter_fromto": "^2.1.0@dev",
     "metamodels/filter_range": "^2.1.0@dev",
     "metamodels/filter_select": "^2.1.0@dev",
     "metamodels/filter_tags": "^2.1.0@dev",
     "metamodels/filter_text": "^2.1.0@dev",
     "metamodels/filter_register": "^2.1.0@dev"
   },

Es ist zu beachten, dass nur die Pakete installiert werden müssen, die auch wirklich
zum Einsatz kommen - insbesondere wenn vorher mit `bundle_all` gearbeitet wurde.

Über eine Abfrage in der Datenbank, sind schnell die genutzten Attribute und Filter
zu ermitteln:

.. code-block:: sql
   :linenos:
   
   -- Attribute
   SELECT type FROM `tl_metamodel_attribute` GROUP BY type ORDER BY type
   
   -- Filter
   SELECT type FROM `tl_metamodel_filtersetting` GROUP BY type ORDER BY type