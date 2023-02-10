.. _rst_extended_metadata_extractor:

File-Metadata-Extractor für MetaModels
======================================

.. warning:: Das Tool File-Metadata-Extractor ist noch im Fundraising 
   und wird erst nach Erreichen der Zielsumme von z.Z. 4.200,00 € frei
   geschaltet. |br|
   Eine Vorab-Installation über das "Early-Adopter-Programm" möglich – `siehe unten <#early-adopter-programm>`_

Der File-Metadata-Extractor liest aus Dateien s.g. Metadaten aus - Metadaten
sind zusätzliche Informationen, die in der Datei "versteckt" sind. Bekannt sind
zum Beispiel die EXIF- und IPTC-Daten, welche in Bildformaten wie JPG/PNG
verschiedene Informationen zum Aufnahmezeitpunkt, Belichtung, Kameratyp, Blitz
Autor, Geokoordinaten usw. enthalten. Metadaten sind aber auch in Textformaten
wie DOC/DOCX/PDF in Form von Autor, Beschreibung usw. vorhanden. Ebenso wie
Patientendaten in digitalen MRT/CT/Röntgenaufnahmen  im DICOM-Format.

Mit dem Tool lassen sich Eingaben z.B. für Bild- und Video-Datenbanken,
Literatursammlungen, Kataloge im PDF-Format sehr vereinfachen. Die Metadaten
müssen nicht manuell per "Copy&Paste" aus anderen Programmen übertragen werden.

Welche Metadaten möglich sind, ist durch das entsprechende Dateiformat bestimmt.

Mit dem File-Metadata-Extractor können diese spezifischen Daten aus einer Datei
ausgelesen und in ein oder verschiedene Attribute/Eingabefelder zum
Abspeichern in MetaModels übermittelt werden. Sind die Daten in MetaModels
gespeichert, können die standardmäßigen Werkzeuge von MM wie Filter oder Suche
zum Einsatz kommen.

Die Übernahme der Daten erfolgt transparent in der Eingabemaske, nachdem eine
Datei ausgewählt wurde. Für die Übernahme gibt es zwei Modi:

* Update metadata: hier werden nur leere Eingabefelder befüllt
* Override metadata: vorhandene Eingaben werden überschrieben

Für die Angabe, welches Metadatenfeld in welches Attribut-Eingabefeld landen
soll, gibt es eine entsprechende Mapping-Tabelle. In dieser Mapping-Tabelle
besteht die Möglichkeit, in jeder Mapping-Zeile eine Angabe zur Datenkonvertierung
zu machen. Zurzeit stehen zur Verfügung:

* substr: zum Extrahieren von Textteilen wie Dateiendung
* implode: zum Verknüpfen von Daten eines Arrays als String z.B. Komma-Separiert
* format: zum Umwandeln von Datums-Zeit-Angaben


Early-Adopter-Programm
----------------------

Das Projekt ist in Version 1.0 fertig aber aktuell noch nicht frei verfügbar.
Die Refinanzierung erfolgt über ein "Early-Adopter-Programm", d.h. man kann
die Erweiterung(en) bei Zahlung einer Spende sofort einsetzen. Die Zahlung
berechtigt zum Einsatz für ein Projekt. Rechtsansprüche jedweder Art sind
nach Zahlung einer Spende ausgeschlossen.

Die Höhe der Spende sollte mindestens 350€*1 betragen.

Für den Zugriff auf das Module werden die Repositories per SSH-PublicKey für
eine Installation per composer frei gegeben.

Für die Spende wird eine Rechnung mit ausgewiesener MwSt. bzw. bei vorhandener
EU-Tax-ID für das EU-Ausland in Netto erstellt. |br|
Bei Interesse oder weiteren Fragen bitte eine E-Mail an info@e-spin.de

*1 Netto – ggf. zzgl. MwSt.


Installation per Composer
-------------------------

Voraussetzungen für die Installation:

* MetaModels Core ab 2.1


Unterstützte Metadaten
----------------------

Dateiformate:

* jpg
* png

Metadaten:

* native Dateiinformationen wie Dateiname, Mime
* Exif
* GPS
* IFD
* IPTC
* MakerNote
* Thumbnail

Das Modul ist so konzipiert, dass weitere Dateiformate bzw.
MetaDaten leicht implementiert werden können.


File-Metadata-Extractor anlegen und konfigurieren
-------------------------------------------------

Für den File-Metadata-Extractor muss ein Attribut Datei vorhanden sein.
Hier müssen die Einstellungen so gewählt werden, dass nur eine Datei
auswählbar ist.

|img_attribute_file|

Die nächsten Einstellungen werden bei diesem Attribut bei der Eingabemaske
vor genommen. In den Einstellungen kann per Checkbox das Meta-Data-Mapping
aktiviert werden. In der Mapping-Tabelle wird jeweils ein Eintrag aus den
Metadaten als Quelle sowie ein Attribut als Ziel ausgewählt. Mit den
Eingaben des "Content modifier" können die Werte vor der Übernahme in das
Zielattribut manipuliert werden.

|img_inputmask_widget_file|

In der Eingabemaske des Items sind nun bei dem Datei-Attribut neben der
Dateiauswahl zwei weitere Buttons für den Datentransfer in die Eingabefelder
vorhanden. Wird einer der beiden geklickt, werden die Daten in die Eingabefelder
übertragen und können auch noch weiter korrigiert/ergänzt werden. Erst mit
dem Speichern des Datensatzes sind die Metadaten in MetaModels gespeichert.

|img_item_inputmask|


Spenden
-------

Ein Dank für die Spenden* für die Erweiterung an:

* N.N.: 350 €
* Liebchen+Liebchen: 1.210 €
* Liebchen+Liebchen: 300 €
* Liebchen+Liebchen: 500 €


(Spenden in Netto)


.. |br| raw:: html

   <br />


.. |img_attribute_file| image:: /_img/screenshots/extended/metadata_extractor/attribute_file.jpg
.. |img_inputmask_widget_file| image:: /_img/screenshots/extended/metadata_extractor/inputmask_widget_file.jpg
.. |img_item_inputmask| image:: /_img/screenshots/extended/metadata_extractor/item_inputmask.jpg
