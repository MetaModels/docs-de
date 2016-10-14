.. _rst_cookbook_sql-tips:

SQL-Tipps
=========

Auch wenn MetaModels einem viel reine Programmierarbeit abnimmt,
muss man doch hin und wieder direkt in die Datenbankeben
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
   

