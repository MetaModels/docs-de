.. _rst_cookbook_tips_speedup_backend:

Beschleunigung der Ansicht im Backend bei vielen Datensätzen
============================================================

Bei sehr vielen Datensätzen - ab ca. 5k oder mehr - kann der Aufbau der Listenansicht
oder Eingabemaske sehr lang dauern und sehr speicherintensiv sein. Das hängt von verschiedenen Faktoren
wie den vorhandenen Attributstypen oder den Paneleinstellungen der Liste bzw. Eingabemaske ab. Folgend einige
einige Tipps, wie die Ansicht beschleunigt werden kann:

1. Limit einstellen |br|
   In den Einstellungen der Eingabemaske im Feld "Panel-Layout" den Key "limit" eintragen.
   Damit wird die Listenansicht paginiert.
2. Filter entfernen/umstellen |br|
   Sind einzelne Attribute für eine Filterung aktiviert, so sollte man bei sehr großen
   Datenmengen diese nicht verwenden. Die Filter arbeiten nicht unabhängig voneinander, so
   dass hier die auszuführenden Queries mit steigender Anzahl der Filter und Datensätze sehr
   lang zur Ausführung brauchen. Als Alternative zur Filterung können die Attribute für eine
   Suche aktiviert werden. Die Eingrenzung der Liste bleibt gleich - nur das eben keine vorgegebenen
   Daten im Panel vorhanden sind.
   Für MM 3.x soll es an der Stelle eine weitere Optimierung geben.
3. Tabelle in DB mit Index versehen |br|
   Die Anzeige bei großen Datenmengen kann durch das Anlegen eines oder mehrerer Indexe beschleunigt werden.
   Bei wenigen Datensätzen kann das auch zu einer langsameren Ausführung der Queries führen, so dass diese
   nicht automatisch durch MM erzeugt werden. Es sollten die Spalten der Tabelle einen Index bekommen,
   die in einer Suche verwendet werden z. B. Spalte "surname" in Tabelle "mm_employees". Das kann mit dem folgenden
   Query angelegt werden: |br|
   ```create index mm_employees_surname_id_index on mm_employees (surname, id);``` |br|
   Ebenso kann es bei Eingabemasken zu einem verzögerten Aufbau kommen - z. B. bei Referenzierungen auf andere Tabellen
   wie ein Select auf Mitglieder - dann auch hier einen Index auf die entsprechende Spalte anlegen |br|
   ```create index mm_employees_member_index on mm_employees (member);```

.. |br| raw:: html

   <br />
