.. _workflow_index:

Arbeitsablauf bei MetaModels
============================

Der Arbeitsablauf zum Abbilden der eigenen Datentruktur in Metamodels untergliedert sich in einzelne Arbeitsschritte,
die nacheinander für jedes MetaModel durchgeführt werden müssen. Die folgende Beschreibung richtet sich an Einsteiger
in MetaModels, die aufgrund einer "best practices" wurde - versierte Benutzer werden bestimmte Schritte weiter
zusammenfassen und ergänzen.

Schritt 0: Konzept der Datenstruktur
------------------------------------

Die Gesamtzahl der MetaModels und deren Verknüpfungen ergeben eine Datenbankstruktur, mit der die Daten in gewünschter
Weise gespeichert, ausgegeben und gefiltert werden kann. Insbesondere bei komplexeren Aufgabenstellungen kann eine gute
Planung nachträgliche Änderungen vermeiden.

Es ist zu empfehlen, dass die Struktur der MetaModels und deren Verknüpfungen grafisch festgehalten wird. Das hilft sowohl
bei der Erstellung als auch bei der Dokumentation.

Im einfachsten Fall kann man das Schema mit Papier und Stift aufzeichnen - es gib aber auch diverse Tools wie z. B.
`yEd <https://www.yworks.com/products/yed>`_ oder die Online-Variante `yEd live <https://www.yworks.com/yed-live/>`_.

Als Beispiel eine Struktur für Mitarbeiten inkl. Verknüpfungen zu Abteilung und Projekten sowie eine Eigenreferenz
für eine Urlaubsvertretung:

|img_db-schema_01|

Schritt 1: Basiseinstellungen für ein MetaModel
-----------------------------------------------

* 1: |img_new| :ref:`Neues MetaModel anlegen <mm_first_new-mm>` |br|
  nach dem Speichern können die Icons wie folgt angesteuert werden |br|
  |img_workflow_01|
* 2: |img_fields_32| :ref:`Attribute anlegen <mm_first_attribute>` |br|
  Ein Mapping, welche Attribute für welche Daten zur Verfügung stehen, findet man auf :ref:`workflow_data-in-attributes`




.. |br| raw:: html

   <br />

.. |img_db-schema_01| image:: /_img/screenshots/metamodel_first/db-schema_01.png
   :width: 400px

.. |img_new| image:: /_img/icons/new.gif
.. |img_fields_32| image:: /_img/icons/fields_32.png
.. |img_workflow_01| image:: /_img/screenshots/workflow/workflow_01.png
