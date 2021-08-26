.. _planning_mm30:

Planung von MM 3.0
==================

.. seealso:: Die Liste wird kontinuierlich erweitert

Folgend einige Punkte die in die Planung für MM 3.0. Mit der neuen Major-Version können wir grundlegendere Anpassungen
an MM durchführen und den Unterbau weiter modernisieren.

Vorschläge dazu gern als Ticket in `Github <https://github.com/MetaModels/core/issues>`_  - gern mit dem Titel-Präfix
"[MM 3.0]"

* Umstellung auf UUID (z.B. für Unterstützung für Export/Import)
* einzelne MMs sollen in einem "Projekt" geordnet werden können - die Projektebene steht somit "über" den
  MMs (z.Z. mache ich das mit einem "Projekt-Sub-Präfix" wie "mm__proj1*", "mm__proj2*")Die "Projektebenen"
  müssten sich dann auch durch alle Tabellen der Attribute ziehen, im Idealfall sollte man dann alle Tabellen von
  Projekt A und Projekt B getrennt von einander Ex- und Importieren können.
* Konfigurieren per YAML/XML - ähnlich wie CustomElements von RST (https://app.intco.it/rsce-visual-editor/index.html)
  - die bisherige "GUI" im Backend (per DCG?) bleibt bestehen...

  * notwendig für Ex-/Import
  * Speicherung/Tracking der Anpassungen (z.B. Git)
* Attribute in Klassen gesplittet:

  * Umbau der MM-API
  * virtuelle Attribute (für Sachen wie Geodistance)
  * strikte Trennung der Attribute und keine Abhängigkeiten mehr (insb. bei Sprachkeys usw.)
  * Alias aware interface https://github.com/MetaModels/core/issues/904, https://github.com/MetaModels/core/tree/feature-aliasaware
  * Templates in Twig
* Datenbankanpassungen:

  * weniger Queries
  * ACL auf Datenbankebene
  * Hierarchie/Trees => ggf. Nested Set
  * Logging/Audit Trail
  * Versionierung/Undo
  * Translations
  * z.B. => http://symfony.com/doc/master/bundles/StofDoctrineExtensionsBundle/index.html
* Schemamanagement (Extraktion der DB-Schema-Manipulationen der Attribute in eigenständige Klassen, ... + Updatehandler usw.)

  * Feature schema management: https://github.com/MetaModels/core/pull/1267
  * Aufteilung der Relationstabelle in separate Tabellen (auch wichtig für Ex-/Import)
* Symfony-Forms (DCG 3.0)
* API-Ansatz von MM um z.B. per REST, Hydra-LD, GraphQL zu kommunizieren
* Umbau Filter:

  * besseres Caching,
  * Mehrfachsortierung,
  * Sortierung von Select/Checkboxen/Radio,
  * Hierarchische Filterung,
  * Übergabe ID-Listen-Objekt statt Array
  * Optik/Usability BE: (inkl. DCG)
  * CSS/Templates
* Bereinigung/Umsortierung der Einstellungen
* Finanzierung:

  * EAP

.. |br| raw:: html

   <br />
