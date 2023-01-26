.. _component_schema-manager:

Schemamanager
=============

.. note:: Der Schemamanager ist ab Version 2.3 implementiert.

Kurzinfo
--------

Mit dem Schemamanager werden die mm_*-Tabellen der Model und Spalten der Attribute nicht
sofort mir dem Speichern angelegt. Es ist notwendig, eine Datenbank-Migration mit der Konsole
CManager oder Installtool durchzuführen. Analog dem Vorgehen, wenn per DCA Änderungen an der Datenbank
anstehen. Entsprechende Hinweise sind bei der Eingabemaske des Models und Attribute hinterlegt.

Hintergründe
-------------

In MetaModels 2.3 wurde ein neuer Schemamanager eingebaut, der die Kommunikation zu Doctrine herstellt.
Doctrine ist Datenbankabstraktion in Symfony auf der auch Contao aufbaut. Der Einsatz des neuen Schemamanager
ergab sich durch Notwendigkeiten wie z. B. dass Contao die mm_*-Tabellen nicht als „Fremdartig“ ansieht und
löschen möchte. Vorteile aus dem Einsatz Ergeben sich z. B. durch einen sauberen und sicheren Tabellenaufbau da
dieser durch Doctrine überwacht wird. Auch das Ändern, Löschen oder Kopieren von Attributen muss nicht mehr von
MM übernommen werden, sondern erfolgt durch Doctrine.

Mit dem Wechsel ergibt sich aber auch eine grundlegende Änderung in der Arbeit mit MM: Beim Anlegen eines
Models und Attributes hat nun stets eine DB-Migration über die üblichen Wege (Install-Tool, Manager, Konsole)
zu erfolgen – so wie es auch bei Contao und Änderungen des DCA immer notwendig war und ist.

Diese Änderung nimmt nun etwas vorweg, was spätestens bei MM 3.0 erfolgt wäre. Hier soll es auch die
Möglichkeit geben, das Datenbankschema von MM über Dateien vorzugeben. Damit ist eine Versionierung,
Wiederverwendbarkeit und Ex-Import möglich. Mit dem Feature ist eine Anpassung des Schemas nur über
die Ausführung einer DB-Migration möglich.

Die Umstellung des eigenen „MM-Workflows“ benötigt sicher eine gewisse Eingewöhnungszeit, aber es wurde
mit dem Schemamanager eine technisch ausbaufähigere Grundlage des Datenbankhandlings geschaffen.

Da Doctrine Änderungen bei bestehenden Tabellen oder Spalten in zwei Aktionen aufteilt, gibt es die
Möglichkeit, bestehende Daten zu "retten" - siehe :ref:`Tipps <rst_cookbook_tips_change_table_column_name>`.

