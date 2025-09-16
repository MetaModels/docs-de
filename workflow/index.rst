.. _workflow_index:

Arbeitsablauf bei MetaModels
============================

Der Arbeitsablauf zum Abbilden der eigenen Datentruktur in Metamodels untergliedert sich in einzelne Arbeitsschritte,
die nacheinander für jedes MetaModel durchgeführt werden müssen. Die folgende Beschreibung richtet sich an Einsteiger
in MetaModels, die aufgrund einer "best practices" wurde - versierte Benutzer werden bestimmte Schritte weiter
zusammenfassen und gleich ergänzen.

Schritt 0: Konzept der Datenstruktur
------------------------------------

Die Gesamtzahl der MetaModels und deren Verknüpfungen ergeben eine Datenbankstruktur, mit der die Daten in gewünschter
Weise gespeichert, ausgegeben und gefiltert werden kann. Insbesondere bei komplexeren Aufgabenstellungen kann eine gute
Planung nachträgliche Änderungen vermeiden.

Es ist zu empfehlen, dass die Struktur der MetaModels und deren Verknüpfungen grafisch festgehalten wird. Das hilft
sowohl bei der Erstellung als auch bei der Dokumentation.

In MetaModels stehen neben den klassischen Relationen wie Einfach- (1:n) oder Mehrfachverknüpfung (m:n) auch weitere
Optionen zur Verfügung - mehr dazu in dem Artikel :ref:`component_relations`.

Im einfachsten Fall kann man das Schema mit Papier und Stift aufzeichnen - es gib aber auch diverse Tools wie z. B.
`yEd <https://www.yworks.com/products/yed>`_ oder die Online-Variante `yEd live <https://www.yworks.com/yed-live/>`_.

Als Beispiel eine Struktur für Mitarbeiten inkl. Verknüpfungen zu Abteilung und Projekten sowie eine Eigenreferenz
für eine Urlaubsvertretung:

|img_db-schema_01|

Für die Datenspeicherung und Relationen werden in MetaModels entsprechend Attribute benötigt - welche dafür zur
Verfügung stehen, findet man auf :ref:`workflow_data-in-attributes`.

Damit kann man auch auswählen, welche Pakete von MM neben dem Core zusätzlich zu installieren sind.

Schritt 1: Basiseinstellungen für ein MetaModel
-----------------------------------------------

Für die Basiseinstellungen sind die wichtigsten Einstellungen vorausgewählt, so dass nur die notwendigsten Angaben und
Auswahlen erfolgen müssen. Für eine leichtere Übersicht wo was zu finden ist, gibt es den
:download:`"MM-Lageplan" </_download/MM_Lageplan_e-spin-Berlin.pdf>` zum Download.

* 1: |img_new| :ref:`Neues MetaModel anlegen <mm_first_new-mm>` |br|
  nach dem Speichern können die Icons von links nach rechts wie folgt angesteuert werden |img_workflow_01|
* 2: |img_fields| :ref:`Attribute anlegen <mm_first_attribute>` |br|
  nach dem Anlegen aller Attribute unbedingt :ref:`DB-Migration <component_schema-manager>` (Contao-Manager oder Konsole)
  ausführen und Cache leeren
* 3.a: |img_rendersettings| :ref:`Render-Einstellung anlegen <component_rendersettings>` |br|
  Grundeinstellung für die Listenansicht
* 3.b: |img_rendersetting| :ref:`Atttribute in Render-Einstellung hinzufügen <component_rendersettings>` |br|
  bestimmt, welche Attribute in der jeweiligen Liste für eine Ansicht zur Verfügung stehen
* 4.a: |img_dca| :ref:`Eingabemaske anlegen <component_dca>` |br|
  Grundeinstellung für Eingabemaske
* 4.b: |img_dca_setting| :ref:`Atttribute in für Eingabemaske anlegen <component_dca>` |br|
  bestimmt, welche Attribute in der jeweiligen Eingabemaske für eine Ansicht zur Verfügung stehen
* 5: |img_dca_combine| :ref:`Eingabe-/Render-Zuordnungen anlegen <component_dca-combine>` |br|
  angelegte Render-Einstellung und Eingabemaske auswählen und speichern

Ist Punkt 5 abgeschlossen, sollte das neue MetaModel links in der Contao-Navigation in der Sektion "METAMODELS"
erscheinen.

**Nun können bzw. sollten die ersten Test-Datensätze eingegeben werden.**

Schritt 2: Basisausgabe
-----------------------

* 1: Seite und Artikel in Contao anlegen
* 2.a: In dem Artikel ein :ref:`Inhaltselement "MetaModel-Liste" <component_contentelements>` anlegen
* 2.b: In der MetaModel-Liste das angelegte MetaModel sowie die Render-Einstellung auswählen und speichern

Im Frontend sollte nun auf der angelegten Seite eine Liste mit den eingegebenen Test-Datensätzen aus Schritt 1 zu
sehen sein.

Schritt 3: Einstellungen aus Schritt 1 anpassen
-----------------------------------------------

* 1: |img_new| :ref:`MetaModel <mm_first_new-mm>` |br|
  :ref:`Mehrsprachigkeit <component_multi-language>`  einstellen, :ref:`Varianten <component_relations_variants>` aktivieren
* 3.a: |img_rendersettings| :ref:`Render-Einstellung <component_rendersettings>` |br|
  * spezifische Render-Einstellung anlegen z. B. für Listenausgabe im FE
  * :ref:`Variante des Templates "metamodels_prerendered" <component_templates>` auswählen für individuelle Ausgabe
  * Einstellung der "jumpTo"-Seite für :ref:`Detailansicht <component_contentelements>`
* 3.b: |img_rendersetting| :ref:`Atttribute in Render-Einstellung <component_rendersettings>` |br|
  * spezifische Einstellungen bei den Attributen vornehmen - z. B. :ref:`Ausgabe von Bildern inkl. Bildgröße <rst_cookbook_templates_fe_work_with_images>`
  * :ref:`Variante des Templates "mm_atr_<typ>" <component_templates>` auswählen für individuelle Ausgabe
* 4.a: |img_dca| :ref:`Eingabemaske anlegen <component_dca>` |br|
  * Keys für Ausgabe von Filter, Suche, Sortierung, Limit angeben
  * Auswahl des Backendbereiches, wo das MetaModel auftauchen soll z. B. Inhalte oder eigener Bereich
  * Anzeige als Tabelle im Backend
  * Berechtigungen für Bearbeitung
* 4.b: |img_dca_setting| :ref:`Atttribute <component_dca>` |br|
  * CSS-Klasse wie w50
  * Pflichtfeld, Nur lesen (Readonly)
  * Option, ob das Attribut filterbar und/oder suchbar sein soll
* 4.c: |img_dca_groupsortsettings| :ref:`Sortierung/Gruppierung anlegen <component_dca>` |br|
* 4.d: |img_dca_condition| :ref:`Ansichtsbedingungen anlegen <component_dca_visibility-conditions>` |br|
* 5: |img_dca_combine| :ref:`Eingabe-/Render-Zuordnungen anlegen <component_dca-combine>` |br|
  Auswahl an Render-Einstellungen und Eingabemasken für Benutzergruppen (BE) oder Mitgliedergruppen (FE) zuweisen



.. |br| raw:: html

   <br />

.. |img_db-schema_01| image:: /_img/screenshots/metamodel_first/db-schema_01.png
   :width: 400px

.. |img_new| image:: /_img/icons/new.gif
.. |img_fields| image:: /_img/icons/fields.png
.. |img_workflow_01| image:: /_img/screenshots/workflow/workflow_01.png
.. |img_rendersettings| image:: /_img/icons/rendersettings.png
.. |img_rendersetting| image:: /_img/icons/rendersetting.png
.. |img_dca| image:: /_img/icons/dca.png
.. |img_dca_setting| image:: /_img/icons/dca_setting.png
.. |img_dca_groupsortsettings| image:: /_img/icons/dca_groupsortsettings.png
.. |img_dca_condition| image:: /_img/icons/dca_condition.png
.. |img_dca_combine| image:: /_img/icons/dca_combine.png
