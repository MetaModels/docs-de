.. _rst_extended_filter_parent:

Filter-Parent für MetaModels
============================

.. warning:: Der FilterParent ist noch im Fundraising und wird erst nach
   Erreichen der Zielsumme von z.Z. 2.640,00 € frei geschaltet. |br|
   Eine Vorab-Installation über das "Early-Adopter-Programm" möglich – `siehe unten <#early-adopter-programm>`_

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


Early-Adopter-Programm
----------------------

Das Projekt ist in Version 1.0 fertig aber aktuell noch nicht frei verfügbar.
Die Refinanzierung erfolgt über ein "Early-Adopter-Programm", d.h. man kann
die Erweiterung(en) bei Zahlung einer Spende sofort einsetzen. Die Zahlung
berechtigt zum Einsatz für ein Projekt. Rechtsansprüche jedweder Art sind
nach Zahlung einer Spende ausgeschlossen.

Die Höhe der Spende sollte mindestens 200€*1 betragen.

Für den Zugriff auf das Module werden die Repositories per SSH-PublicKey für
eine Installation per composer frei gegeben.

Für die Spende wird eine Rechnung mit ausgewiesener MwSt. bzw. bei vorhandener
EU-Tax-ID für das EU-Ausland in Netto erstellt. |br|
Bei Interesse oder weiteren Fragen bitte eine E-Mail an info@e-spin.de

*1 Netto – ggf. zzgl. MwSt.


Installation per Composer
-------------------------

Voraussetzungen für die Installation:

* MetaModels core ab Version 2.1


Filterregel anlegen
-------------------

Die Filterregel wird wie üblich unter Filter angelegt. Die Einstellungen sind
von der Filterregel "Einfache Abfrage" abgeleitet. Als Filtertyp wird
"Filter on attribute of parent model" (Übersetzung folgt) ausgewählt. Dann 
erscheint folgende Maske:

|img_filterparameter|

Bei den Einstellungen ist das Eltern-MetaModel und das als Filter fungierende
Attribut auszuwählen.

Die übrigen Einstellungsparameter sind analog der Filterregel "Einfache Abfrage".


Spenden
-------

Ein Dank für die Spenden* für die Erweiterung an:

* N.N.: 400 €
* N.N.: 400 €


(Spenden in Netto)


.. |br| raw:: html

   <br />


.. |img_filterparameter| image:: /_img/screenshots/extended/filter_parent/filterparameter.jpg
