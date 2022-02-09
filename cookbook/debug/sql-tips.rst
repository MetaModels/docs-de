.. _rst_cookbook_sql-tips:

SQL-Tipps
=========

Auch wenn MetaModels einem viel reine Programmierarbeit abnimmt,
muss man doch hin und wieder direkt in die Datenbankebene
einsteigen. Entweder um Daten zu prüfen oder auch um Daten zu verändern.

Vorausgesetzt wird für die Tipps der sichere Umgang mit Tools wie phpMyAdmin
und die Grundlagen von (My)SQL.

Folgend einige Tipps, wie man Daten zur Ansicht bringt oder verändern
kann:

BLOB-Felder anzeigen:
*********************

.. code-block:: sql
   :linenos:
   
   SELECT CONVERT(my_blob_attribute USING utf8) AS 'blob_as_text' FROM table
   
   > a:5:{s:9:"invoiceid";s:1:"8";s:8:"balance";i:5;s:14:"broughtforward";i:3;s:6:"userid";s:5:"13908";s:10:"customerid";s:1:"3";}


Serialisierte Daten extrahieren:
********************************

.. code-block:: sql
   :linenos:
   
   SELECT 
   SUBSTRING_INDEX(SUBSTRING_INDEX(blob_as_text,';',1),':',-1) AS fieldname1,
   SUBSTRING_INDEX(SUBSTRING_INDEX(blob_as_text,';',2),':',-1) AS fieldvalue1,
   SUBSTRING_INDEX(SUBSTRING_INDEX(blob_as_text,';',3),':',-1) AS fieldname2,
   SUBSTRING_INDEX(SUBSTRING_INDEX(blob_as_text,';',4),':',-1) AS fieldvalue2,
   SUBSTRING_INDEX(SUBSTRING_INDEX(blob_as_text,';',5),':',-1) AS fieldname3,
   SUBSTRING_INDEX(SUBSTRING_INDEX(blob_as_text,';',6),':',-1) AS fieldvalue3,
   SUBSTRING_INDEX(SUBSTRING_INDEX(blob_as_text,';',7),':',-1) AS fieldname4,
   SUBSTRING_INDEX(SUBSTRING_INDEX(blob_as_text,';',8),':',-1) AS fieldvalue4,
   SUBSTRING_INDEX(SUBSTRING_INDEX(blob_as_text,';',9),':',-1) AS fieldname5,
   SUBSTRING_INDEX(SUBSTRING_INDEX(blob_as_text,';',10),':',-1) AS fieldvalue5
   FROM table;


Hier stehen die Ziffern 1 bis 10 für die Anzahl bzw. Position der Semikolons in
einem serialisierten String. Nimmt man das erste Beispiel zu Grunde, wäre
``blob_as_text,';',2`` das zweite Semikolon also bei ``..."8";s:8...`` und ergibt
als "fieldvalue1" ein ``"8"``.

Anführungszeichen Trimmen:
**************************
 
.. code-block:: sql
   :linenos:
   
   SELECT TRIM(BOTH '"' FROM fieldvalue1) AS 'fieldvalue1_pure' FROM table

Mit dem Befehl werden die Anführungszeichen aus dem vorhergehenden Beispiel
an erster und letzter Stelle entfernt - das Ergebnis wäre dann ``8``.

Eingrenzung auf serialisierten Wert in WHERE:
*********************************************

Hat man zum Beispiel im Attribut Mehrfachauswahl ([tags]) eine Relation zur
Tabelle der Benutzer (tl_user) und möchte aber nur Benutzer einer bestimmten
Benutzergruppe, so muss man nach der Spalte ``groups`` filtern. In ``groups``
ist die Gruppenzugehörigkeit aber als serialisiertes Array abgelegt, so dass
in dem serialisierten String gesucht werden muss.

In den Einstellungen des Attributes Mehrfachauswahl kann man eine SQL-Filterung
wie folgt vornehmen:

.. code-block:: sql
   :linenos:
   
   CONVERT(tl_users.groups USING utf8) LIKE '%"2"%'

Damit werden in der Eingabemaske nur noch Benutzer der Benutzergruppe ``2``
angezeigt.

Dateien anhand der UUID suchen:
*********************************************

Die UUID einer Datei oder Ordners kann man in der Dateiverwaltung über den Infobutton ablesen.
Die Suche in der DB ist etwas schwieriger, da die UUIDs nicht im "Klartext in der DB stehen.
Für die Suche muss die UUID erst umgewandelt werden

.. code-block:: sql
   :linenos:
   
   SELECT * FROM tl_files
   WHERE LOWER(CONCAT(
        LEFT(HEX(uuid), 8),
        '-', MID(HEX(uuid), 9,4),
        '-', MID(HEX(uuid), 13,4),
        '-', MID(HEX(uuid), 17,4),
        '-', RIGHT(HEX(uuid), 12))
      ) = '2abbf0c1-e76f-43e5-a123-00ac10d40e00';

   -- oder
   
   SELECT * FROM tl_files
   WHERE LCASE(CONCAT_WS('-',
          HEX(SUBSTR(uuid,  1, 4)),
          HEX(SUBSTR(uuid,  5, 2)),
          HEX(SUBSTR(uuid,  7, 2)),
          HEX(SUBSTR(uuid,  9, 2)),
          HEX(SUBSTR(uuid, 11))
      )) = '2abbf0c1-e76f-43e5-a123-00ac10d40e00';
 
