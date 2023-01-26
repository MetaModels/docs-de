.. _rst_cookbook_tips_change_table_column_name:

Ändern von Tabellen- oder Spaltennamen
======================================

.. note:: Der Schemamanager ist ab Version 2.3 implementiert.

Die Namen für Tabellen und Spalten sollten gut überlegt sein, da eine nachträgliche
Anpassung ein eher kritischer Vorgang ist und vermieden werden sollte.

Eine Änderung eines Tabellen- oder Spaltennamens ist aber durchaus möglich. Mit dem
Schemamanager wird die Aufgabe der Datenbankanpassung an Doctrine übergeben, welches
das im Zuge einer Datenbankmigration durchführt. Bei Doctrine ist es so vorgesehen,
dass bei einer Änderung des Tabellen- oder Spaltennamens kein einfaches überschreiben
der Namen erfolgt, sondern jeweils das neue Element angelegt wird und das alte gelöscht.

Sofern noch keine Nutzdaten in der Tabelle bzw. Spalte vorhanden sind, kann die Anpassung
problemlos erfolgen.

Sofern schon Nutzdaten vorhanden sind und diese erhalten bleiben sollen, muss bei der
Anpassung mit eingegriffen und die Daten gesichert werden. Vorteil bei dem Schemamanager
ist, dass die beiden Aktionen (Anlegen/Create und Löschen/Drop) nacheinander erfolgen und man die
Gelegenheit hat, die Daten von "Alt nach Neu" zwischen den beiden zu transferieren.

Bei Spalten ist das nur bei Attributen relevant, die eine eigene Spalte in der mm_*-Tabelle
anlegen wie z. B. Text oder Alias (Simple Attribute).

Dieser Transfer kann in einem der üblichen Datenbanktools wie phpMyAdmin oder auch direkt
auf der Konsole erfolgen. Nach dem Anlegen der neuen Tabelle oder Spalte können die Daten
mit den folgenden Befehlen kopiert werden:

Tabelle: |br|
``php vendor/bin/contao-console doctrine:query:sql 'INSERT mm_test_neu SELECT * FROM mm_test_alt'``

Spalte: |br|
``php vendor/bin/contao-console doctrine:query:sql 'UPDATE mm_test SET col_neu=col_alt'``

Hinweis: starten der Migration: |br|
``php vendor/bin/contao-console contao:migrate``

Anschließend kann das Löschen/Drop erfolgen.

.. note:: MySQl arbeitet unter Windows bei den Tabellen- und Spaltennamen "case-insensitive" -
   daher ist eine Änderung der Groß/Klein-Schreibweise über MM generell nicht möglich.

.. |br| raw:: html

   <br />
