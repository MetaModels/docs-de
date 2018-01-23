.. _cookbook_install_update-file-attribute-v1-to-v2:

Update von File-Feldern beim Umstieg von MetaModels 1.x auf 2.x
===============================================================

Wer den Umstieg von Contao 2.x / MetaModels 1.x auf Contao 3.x / MetaModels 2.x
noch nicht erledigt hat, sieht sich mit dem Problem konfrontiert, dass nach einem
erfolgreichen Update eingebundene Bilder oder Dateien nicht im Frontend angezeigt
werden. Dies liegt daran, dass die entsprechenden Felder in der Datenbank noch
vom Typ text sind (Contao 2.x / MetaModels 1.x), für Contao 3.x / MetaModels 2.x
aber vom Typ blob sein müssen. Zudem müssen die als Text abgelegten Verweise auf
Dateien oder Ordner in die entsprechenden UUIDs umgewandelt werden.

Die folgende Anleitung beschreibt, wie man File-Felder aktualisiert, bei denen
entweder Einzeldateien oder Ordner als Ziele verlinkt sind. Wir gehen dabei
beispielhaft davon aus, dass wir eine Installation mit einer Tabelle **mm_movies**
haben und darin die beiden Spalten **image** (Einzeldatei) und **assets** (Ordner)
aktualisieren wollen.

#. Contao updaten, bspw. nach dieser Anleitung: |br|
   `Update Contao von 2.11 auf 3.5 <https://community.contao.org/de/showthread.php?59748-Update-von-2-11-auf-3-5-Schritt-f%C3%BCr-Schritt>`_
   Dabei darauf achten, dass beim Update der Datenbank die MM-Tabellen nicht entfernt werden.
#. MM updaten: |br|
   Zunächst sind alle MM-Ordner unter */system/modules/* zu löschen. Stellen Sie
   anschließend die Erweiterungsverwaltung auf Composer um und installieren Sie
   die aktuelle MM-Version, bspw. komplett über das Paket *metamodels/bundle_all*. |br|
   Nach der Aktualisierung der Datenbank sollte MetaModels 2.x im Backend wie gewohnt
   zur Verfügung stehen.
#. Dateiverwaltung |br|
   Sofern noch nicht geschenen, sollten Sie in der Dateiverwaltung die Funktion
   "Synchronisieren" aufrufen, um die vorhandenen Dateien mit der Datenbank zu
   synchronisieren.
#. Attribute aktualisieren |br|
   Rufen Sie nun in MetaModels das entsprechende File-Attribute auf, und aktualisieren
   bzw. korrigieren Sie dort die Angaben für den Wurzelordner auf die Angabe vor dem Update.
#. Datenbank-Backup anlegen


Datenbank-Felder für Einzel-Auswahlen aktualisieren
...................................................

* Öffnen Sie Ihre Datenbank in phpMyAdmin oder einem vergleichbaren Tool und rufen
  Sie die Strukturansicht Ihres MetaModels auf (Bsp.: mm_movies).
* Erstellen Sie dort eine Backup-Spalte der entsprechende File-Spalte mit der
  folgenden SQL-Anweisung: ``UPDATE mm_movies SET image_backup=image``
* Ändern Sie danach den Typ der Spalte des File-Attributs zu blob: |br|
  ``ALTER TABLE `mm_movies` CHANGE `image` `image` BLOB NULL DEFAULT NULL``
* Danach fügen Sie mit dem folgenden Befehl die UUID der betreffenden
  Dateien in die entsprechenden Felder ein: |br|
  ``UPDATE mm_movies SET image=(SELECT uuid FROM `tl_files` WHERE tl_files.path=mm_movies.image_backup)``
* Löschen Sie nach dem erfolgreichem Update die Backupspalte.


Datenbank-Felder für Ordner-Auswahlen aktualisieren
...................................................

* Rufen Sie in MetaModels das entsprechende File-Attribute auf, und aktualisieren
  bzw. korrigieren Sie dort die Angaben für den Wurzelordner auf die Angabe vor
  dem Update.
* Öffnen Sie Ihre Datenbank in phpMyAdmin oder einem vergleichbaren Tool und
  rufen Sie die Strukturansicht Ihres MetaModels auf. Erstellen Sie dort wiederum
  eine Backup-Spalte der entsprechende File-Spalte und kopieren Sie mit der
  folgenden SQL-Anweisung den Inhalt der Spalte dort hinein: |br|
  ``UPDATE mm_movie SET assets_backup=assets``
* Ändern Sie danach den Typ der Spalte des File-Attributs zu blob: |br|
  ``ALTER TABLE `mm_movies` CHANGE `assets` `assets` BLOB NULL DEFAULT NULL``
* Suchen Sie nun in der Spalte `backup_assets` die ersten fünfzehn Zeichen
  heraus (inkl. Anführungszeichen, bis zum Beginn des Pfads zum entsprechenden
  Ordner), die in etwa so aussehen: ``a:1:{i:0;s:83:"``
* Passen Sie nun den nachfolgenden SQL-Befehl so an, dass der Teil von `CONCAT`
  Ihren Angaben entspricht: |br|
  ``UPDATE mm_movies SET assets=CONCAT('a:1:{i:0;s:83:"', (`` |br|
  ``SELECT uuid FROM tl_files WHERE path=SUBSTRING(assets_backup, 16, LENGTH(assets_backup)-16-2)), '";}'``  |br|
  ``) WHERE (``  |br|
  ``SELECT uuid FROM tl_files WHERE path=SUBSTRING(assets_backup, 16, LENGTH(assets_backup)-16-2)``  |br|
  ``) IS NOT NULL``
* Anschließend sollten auch die Verweise auf Ordner wieder korrekt funktionieren.


.. |br| raw:: html

   <br />