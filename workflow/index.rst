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

* 1: |img_new| :ref:`Neues MetaModel anlegen <mm_first_new-mm>`
    * :ref:`Mehrsprachigkeit <component_multi-language>` einstellen sofern notwendig
    * nach dem Speichern können die Icons von links nach rechts wie folgt angesteuert werden |img_workflow_01|
* 2: |img_fields| :ref:`Attribute anlegen <mm_first_attribute>`
    * nach dem Anlegen aller Attribute unbedingt :ref:`DB-Migration <component_schema-manager>` (Contao-Manager oder Konsole)
      ausführen und Cache leeren
* 3.a: |img_rendersettings| :ref:`Render-Einstellung anlegen <component_rendersettings>`
    * Grundeinstellung für die Listenansicht
* 3.b: |img_rendersetting| :ref:`Atttribute in Render-Einstellung hinzufügen <component_rendersettings>`
    * bestimmt, welche Attribute in der jeweiligen Liste für eine Ansicht zur Verfügung stehen
* 4.a: |img_dca| :ref:`Eingabemaske anlegen <component_dca>`
    * Grundeinstellung für Eingabemaske
* 4.b: |img_dca_setting| :ref:`Atttribute in für Eingabemaske anlegen <component_dca>`
    * bestimmt, welche Attribute in der jeweiligen Eingabemaske für eine Ansicht zur Verfügung stehen
* 5: |img_dca_combine| :ref:`Eingabe-/Render-Zuordnungen anlegen <component_dca-combine>`
    * angelegte Render-Einstellung und Eingabemaske auswählen und speichern

Ist Punkt 5 abgeschlossen, sollte das neue MetaModel links in der Contao-Navigation in der Sektion "METAMODELS"
erscheinen.

**Nun können bzw. sollten die ersten Test-Datensätze eingegeben werden.**

Schritt 2: Basisausgabe
-----------------------

- 1: Seite und Artikel in Contao anlegen
- 2.a: In dem Artikel ein :ref:`Inhaltselement "MetaModel-Liste" <component_contentelements>` anlegen
- 2.b: In der MetaModel-Liste das angelegte MetaModel sowie die Render-Einstellung auswählen und speichern

**Im Frontend sollte nun auf der angelegten Seite eine Liste mit den eingegebenen Test-Datensätzen aus Schritt 1 zu
sehen sein.**

Schritt 3: Einstellungen aus Schritt 1 anpassen
-----------------------------------------------

* 1: |img_new| :ref:`MetaModel <mm_first_new-mm>`
    * :ref:`Varianten <component_relations_variants>` aktivieren, wenn für Datenstruktur erforderlich
* 3.a: |img_rendersettings| :ref:`Render-Einstellung <component_rendersettings>`
    * spezifische Render-Einstellung anlegen z. B. für Listenausgabe im FE
    * :ref:`Variante des Templates "metamodels_prerendered" <component_templates>` auswählen für individuelle Ausgabe
    * Einstellung der "jumpTo"-Seite für :ref:`Detailansicht <component_contentelements>`
* 3.b: |img_rendersetting| :ref:`Atttribute in Render-Einstellung <component_rendersettings>`
    * spezifische Einstellungen bei den Attributen vornehmen - z. B. :ref:`Ausgabe von Bildern inkl. Bildgröße <rst_cookbook_templates_fe_work_with_images>`
    * :ref:`Variante des Templates "mm_atr_<typ>" <component_templates>` auswählen für individuelle Ausgabe
* 4.a: |img_dca| :ref:`Eingabemaske anlegen <component_dca>`
    * Keys für Ausgabe von Filter, Suche, Sortierung, Limit angeben
    * Auswahl des Backendbereiches, wo das MetaModel auftauchen soll z. B. Inhalte oder eigener Bereich
    * Anzeige als Tabelle im Backend
    * Berechtigungen für Bearbeitung
* 4.b: |img_dca_setting| :ref:`Atttribute für Eingabemaske <component_dca>`
    * CSS-Klasse wie w50
    * Pflichtfeld, Nur lesen (Readonly)
    * Option, ob das Attribut in BE-Liste filterbar und/oder suchbar sein soll
    * Legenden hinzufügen, um größere Eingabemasken logisch zu unterteilen
* 4.c: |img_dca_groupsortsettings| :ref:`Sortierung/Gruppierung anlegen <component_dca>`
    * Standard-Sortierung anlegen oder weitere Sortierungen für Auswahl in Liste
* 4.d: |img_dca_condition| :ref:`Ansichtsbedingungen anlegen <component_dca_visibility-conditions>`
    * Eingabewidgets können anhand von Werten anderer Widgets ein bzw. ausgeblendet werden
* 5: |img_dca_combine| :ref:`Eingabe-/Render-Zuordnungen anlegen <component_dca-combine>`
    * Auswahl an Render-Einstellungen und Eingabemasken für Benutzergruppen (BE) oder Mitgliedergruppen (FE) zuweisen
* 6.a: |img_filter| :ref:`Filter anlegen <component_filter>`
    * Name für Filter vergeben
* 6.b: |img_filter_setting| :ref:`Filterregeln anlegen <component_filter>`
    * Filterregeln einfügen
    * Verschachtelungen mit AND bzw. OR möglich
    * ohne weitere Angabe sind alle Filterregeln automatisch mit AND verknüpft

**Mit den erfolgten Anpassungen sollte die Anzeige im Backend und Frontend den individuellen Wünschen entsprechen.**

Neben den aufgeführten Optionen gibt es weitere Möglichkeiten, die auf den verlinkten Seiten nachzulesen sind.

Schritt 4: Weitere Optionen für Ausgabe aus Schritt 2
-----------------------------------------------------

- 2.c: Inhaltselement "MetaModel-Liste" aus Schritt 2
    - Filter auswählen
    - Sortierung nach einem Attribut definieren - :ref:`siehe auch Sondersortierung <rst_cookbook_filter_custom-sql_sortierung-der-ausgabe-nach-mehr-als-einem-attribut-fest>`
      oder :ref:`Sortierlinks <rst_cookbook_templates_fe_list_sorting>`
    - Limit und Paginierung einstellen
- 3.a: In dem Artikel ein :ref:`Inhaltselement "MetaModel-Filter" <component_contentelements>` anlegen
- 3.b: MetaModel auswählen sowie den Filter (meist identisch dem aus der MM-Liste) mit den gewünschten Filterregeln

**Auf der Seite sollte im Frontend ein Filter mit entsprechenden Filterwidgets zu sehen sein und die Liste auf die
Filterung reagieren.**

Die Ausgabe im Frontend kann mit verschiedenen Einstellungen für eine :ref:`rst_cookbook_tips_seo` angepasst werden.

Tipps:
------

* für "MM-Starter" ist zu empfehlen, das Beispiel :ref:`"Das erste MetaModel" <mm_first_index>` aufzubauen
* den :download:`"MM-Lageplan" </_download/MM_Lageplan_e-spin-Berlin.pdf>` ggf. ausdrucken und bereit legen
* Datentruktur grafisch darstellen - es müssen nicht alle Attribute eingetragen werden - es hilft beim Aufbau und
  Kommunikation mit Kunden und Annfragen zum Support
* beim Anlegen der Models "von Außen nach Innen" vorgehen - im Beispiel oben also erst Abteilung und Projekte und dann
  Mitarbeiter - damit sind die Models beim Anlegen der Attribute für die Referenzen (hier die Einzelauswahl) schon
  in der Auswahl vorhanden
* bei größeren Datenstrukturen kann man zusammengehörige Models mit einem eigenen "Präfix" wie "events" versehen, so
  dass die Tabellen z. B. lauten "mm_events_categories", "mm_events_contacts" usw. - die Tabelle der Models kann dann
  nach "mm_events_" gefiltert werden und ist übersichtlicher bei der Bearbeitung
* gleichartige Attribute nacheinander anlegen - bei "Speichern und neu" wird vorheriger Attributstyp beibehalten und
  spart die Auswahl
* nach Anlegen eines Models oder Attributes DB-Migration durchführen und Cache leeren
* vor dem Start prüfen, ob man die Model bzw. Attribute mehrsprachig benötigt - ein späterere Wechsel ist nicht leicht
  möglich
* das Anlegen der Attribute bei Render-Einstellung und Eingabemaske wird mit den Button "Alle hinzufügen" vereinfacht
* es gibt eine Reihe von :ref:`Checklisten <rst_cookbook_checklists_index>`, die bei der Arbeit helfen
* Hilfe gibt es im `Forum <https://community.contao.org/de/forumdisplay.php?149-MetaModels>`_
  und auf `Slack (#metamodels) <https://contao.slack.com/archives/CKGEBDV60>`_ - man kann sich auch bei Projekten vom
  MM-Team coachen lassen (`mail@metamodels.me <mailto:mail@metamodels.me>`_)


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
.. |img_filter| image:: /_img/icons/filter.png
.. |img_filter_setting| image:: /_img/icons/filter_setting.png

