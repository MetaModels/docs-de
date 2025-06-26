.. _rst_extended_filter_by_related:

Filter-by-releated für MetaModels
=================================

.. note:: Der Filter-by-releated ist noch im Fundraising und wird erst nach Erreichen der Zielsumme von z. Z.
   3.575,00 € frei geschaltet. |br|
   Eine Vorab-Installation über das "Early-Adopter-Programm" möglich – `siehe unten <#early-adopter-programm>`_  |br|
   Die Filterregel "Filter-Parent" ist in dieser Filterregel mit aufgegangen - die Beschränkung der Relation
   auf Kindtabellen wurde aufgehoben.

Der Filter-by-releated ermöglicht es, Items nach Eigenschaften eines verknüpften (Relation) MetaModels zu filtern. Als
Relationen ist eine Einzelauswahl (Select) oder Kindtabelle möglich.

Beispiele: Wir haben Mitarbeiter und Dienstreisen - die Dienstreisen sind als Kindtabelle der Mitarbeiter definiert.
Wenn man nun z.B. alle Dienstreisen ausgeben möchte, deren Mitarbeiter der Abteilung xy zugehörig sind, benötigt
man einen speziellen Filter - insbesondere dann, wenn man die Filterung im Frontend variabel gestalten möchte.

Ein anderes Beispiel wären Termine von Seminaren, wenn die selben Seminare sich wiederholend an verschiedenen Tagen
stattfinden. Bei Seminar könnte alle grundlegenden Eigenschaften eines Seminars wie Titel, Inhalt aber auch Kategorie
usw. festgelegt sein und bei Termin gibt es eine Einzelauswahl zum Seminar sowie das Datum, Teilnehmerzahl usw. Möchte
man nun die Liste der Termine z. B. nach einer Kategorie der Seminare filtern, so ist das mit der Filterregel möglich.


Early-Adopter-Programm
----------------------

Die Refinanzierung erfolgt über ein "Early-Adopter-Programm", d.h. man kann die Erweiterung(en) bei Zahlung einer
Spende sofort einsetzen. Die Zahlung berechtigt zum Einsatz für ein Projekt. Rechtsansprüche jedweder Art sind
nach Zahlung einer Spende ausgeschlossen.

Die Höhe der Spende sollte mindestens 200€*1 betragen.

Für die Spende wird eine Rechnung mit ausgewiesener MwSt. bzw. bei vorhandener
EU-Tax-ID für das EU-Ausland in Netto erstellt. |br|
Bei Interesse oder weiteren Fragen bitte eine E-Mail an info@e-spin.de

*1 Netto – ggf. zzgl. MwSt.


Installation per Composer
-------------------------

Voraussetzungen für die Installation:

* MetaModels Core ab Version 2.4 mit mind. PHP 8.2

Das Modul kann per Konsole oder über den Contao-Manager installiert werden.

Filterregel anlegen
-------------------

Die Filterregel wird wie üblich unter Filter angelegt. Die Einstellungen sind von der Filterregel "Einfache Abfrage"
abgeleitet. Als Filtertyp wird "Filter auf Attribut des Modells mit einer Relation" ausgewählt. Dann erscheint folgende
Maske:

|img_filterparameter|

Bei den Einstellungen ist das "Modell für die Relation" und das als Filter fungierende Attribut als "Attribut des
Modells der Relation" auszuwählen. Bei "Spalte/Attribut der Relation" ist bei Kindtabellen die PID und bei Verknüpfung
per Einzelauswahl das entsprechende Attribut auszuwählen.

Die übrigen Einstellungsparameter sind analog der Filterregel "Einfache Abfrage".


Spenden
-------

Ein Dank für die Spenden* für die Erweiterung an:

* N.N.: 400 €
* N.N.: 400 €
* Agentur `Markenzoo <https://markenzoo.de/>`_: 200€


(Spenden in Netto)


.. |br| raw:: html

   <br />


.. |img_filterparameter| image:: /_img/screenshots/extended/filter-by-related/filterparameter.jpg
