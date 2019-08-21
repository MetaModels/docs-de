.. _rst_extended_filter_parent:

Filter-Parent für MetaModels
============================

.. warning:: Der FilterParent ist noch im Fundraising und wird erst nach
   Erreichen der Zielsumme von z.Z. 2.640,00 € frei geschaltet. |br|
   Eine Vorab-Installation ist nach Absprache möglich.
   Kontakt: info@e-spin.de

Der Filter-Parent ermöglicht es, Items einer vorhandenen Kind-Tabellen
nach Eigenschaften der Elterntabelle zu filtern.

Beispiele: Wir haben Mitarbeiter und Dienstreisen - die Dienstreisen sind als
Kindtabelle der Mitarbeiter definiert. Wenn man nun z.B. alle Dienstreisen
ausgeben möchte, deren Mitarbeiter der Abteilung xy zugehörig sind, benötigt
man einen speziellen Filter - insbesondere dann, wenn man die Filterung im
Frontend variabel gestalten möchte.

Ein anderes Beispiel wären Events, die als Kindtabelle von Veranstaltungen
fungieren und diese nach den Kategorien der Veranstaltung gefiltert werden
sollen.


Installation per Composer
-------------------------

Voraussetzungen für die Installation:

* MetaModels core 2.1

Während des Fundrasings benötigt man einen SSH-Key für die Freischaltung -
weitere Infos zur Installation per E-Mail.


Filterregel anlegen
-------------------

Die Filterregel wird wie üblich unter Filter angelegt. Die Einstellungen sind
von der Filterregel "Einfache Abfrage" abgeleitet. Als Filtertyp wird
"Filter on attribute of parent model" (Übersetzung folgt) ausgewählt. Dann 
erscheint folgende Maske:

|img_filterparameter|

Bei den Einstellungen wird das Eltern-MetaModel und das zu filternde Attribut
ausgewählt.

Die übrigen Einstellungsparameter sind analog der Filterregel "Einfache Abfrage".


Known Issues and Next Features
------------------------------

* 


Spenden
-------

Ein Dank für die Spenden* für die Erweiterung an:

* N.N.: 400 €


(Spenden in Netto)


.. |br| raw:: html

   <br />


.. |img_filterparameter| image:: /_img/screenshots/extended/filter_parent/filterparameter.jpg
