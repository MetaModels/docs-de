.. _rst_extended_isotope:

MetaModels-2-Isotope
####################

.. warning:: MetaModels-2-Isotope ist noch im Fundraising und wird erst nach
   Erreichen der Zielsumme von 5.000€ freigeschaltet. |br|
   Eine Vorab-Installation über das "Early-Adopter-Programm" möglich – `siehe unten <#early-adopter-programm>`_

Mit dem Projekt "MetaModels-2-Isotope" werden verschiedene Komponenten für das
Projekt MetaModels (ab 2.1) zur Verfügung gestellt, um aus MetaModels heraus Items (Artikel, Produkt) an den
Onlineshop `Isotopeecommerce <https://isotopeecommerce.org>`_ (Isotope) für
einen Kauf (Checkout) zu übergeben.

Die Übergabe aus MetaModels heraus erfolgt über den Warenkorb von Isotope. Anschließend
wird der weitere Kaufprozess so durchgeführt, wie es in der Konfiguration von
Isotope eingestellt wurde.

Der Einsatz der Module für MetaModels schließt nicht aus, dass der Isotope-Shop
mit seinen normalen Produkten zum Einsatz kommt. Mit dem Projekt soll es möglich
sein, bei Verwendung von MetaModels eine zusätzliche Kaufoption anzubieten zu können
oder auch Isotope mit den umfangreichen Konfigurations- und Filtermöglichkeiten
aus MetaModels zu ergänzen.

Zum Testen und Vergleichen der Erweiterung gegenüber dem normalen Isotope, wurde
ein Demoshop eingerichtet: `https://isotope.metamodel.me <https://isotope.metamodel.me>`_

Das Projekt wurde von Richard Henkenjohann, Carsten Merz und Ingolf Steinhardt
umgesetzt.


Early-Adopter-Programm
----------------------

Das Projekt ist in Version 1.0 fertig aber aktuell noch nicht frei verfügbar.
Die Refinanzierung erfolgt über ein "Early-Adopter-Programm", d.h. man kann
die Erweiterung(en) bei Zahlung einer Spende sofort einsetzen. Die Zahlung
berechtigt zum Einsatz für ein Projekt. Rechtsansprüche jedweder Art sind
nach Zahlung einer Spende ausgeschlossen.

Für die Spende gibt es zwei Varianten:

* 1: Zugriff auf die drei Module des Projektes zur Installation: 390€*1 oder höher
* 2: zusätzlich zum Punkt 1 noch den `Demoshop <https://isotope.metamodel.me>`_: 490€*1 oder höher

Die Erweiterung kann über den Contao-Manager oder über die Konsole (composer)
installiert werden. Der Demoshop beinhaltet die composer.json,
Templates, Datenbank sowie die Demodateien (/files).

Für die Zuwendung zu dem Projekt wird eine Rechnung mit ausgewiesener MwSt. bzw. bei vorhandener
EU-Tax-ID für das EU-Ausland in Netto erstellt. |br|
Bei Interesse oder weiteren Fragen bitte eine E-Mail an info@e-spin.de - siehe auch
`MM-Fundrasing-Webseite <https://now.metamodel.me/de/unterstuetzer/fundraising#isotope>`_.

*1 Netto – ggf. zzgl. MwSt.


Funktionen
----------

Aus MetaModels können mit der Erweiterung Items an Isotope für einen
Kauf- und Bezahlvorgang übergeben werden – das können Produkte aus einem
Warenkatalog oder auch Dienstleistungen wie Reisen und Events sowie
Zugangsberechtigungen für Software oder Logins sein.

Bei der Übergabe an Isotope werden verschiedene Basisinformationen wie
Artikelnummer, Name und Preis als Pflichtangaben benötigt.

Werden Produkte mit Gewicht oder Mengenangaben an Isotope übergeben, steht
als Option ein Attribut für eine Grundpreisberechnung zur Verfügung – die
Grundpreisangaben werden aus der Isotope-Konfiguration angezeigt.

Es ist möglich, ein Attribut aus MetaModels für die Übergabe des Gewichtes
auszuwählen.

Über eine Filterfunktion können Items vom Versand ausgeschlossen werden.

Es ist ebenso möglich, ein Dateiattribut als Download für Isotope zu
definieren. Bei der Implementierung über die Isotope-Bridge werden im
Gegensatz zu Isotope die Werte für die Anzahl der möglichen Downloads
und das Enddatum für den Download nicht gesetzt.

Werden in MetaModels Varianten angelegt, so ist auch hier eine Übergabe
an Isotope möglich. Zu beachten ist hier, dass in MetaModels die
(Kind-)Varianten jeweils eigenständige Datensätze sind.


Komponenten
-----------

Mit dem Projekt werden drei verschiedene Komponenten zur Verfügung
gestellt:

* isotope-bridge: Hauptkomponente für die Konfiguration
* attribute_isotopeprice: Dezimalattribut für die Preiseingabe und Auswahl der Steuer
* attribute_isotopebaseprice: Attribut für die Auswahl des Grundpreistyps und Mengeneingabe


Konfiguration und Einsatz
-------------------------

Es wird vorausgesetzt, dass Isotope installiert und eingerichtet ist
ebenso wie MetaModels.

Für den Einsatz muss die Komponente isotope-bridge installiert werden –
das Attribut attribute_isotopeprice sollte auch zur Verfügung stehen. Das
Attribut attribute_isotopebaseprice ist nur notwendig, wenn Grundpreisangaben
Verwendung finden.

Nach der Installation gibt es in der Ansicht der MetaModel ein neues Icon
mit dem Isotope-Zeichen – dieses ist in der Standardkonfiguration grau (siehe Sweets),
d.h. die Isotope-Bridge ist hier noch nicht aktiviert.

|img_isotope_mm|

Zur Aktivierung klickt man bei dem entsprechenden MetaModel auf den
Bearbeitungsstift und klickt die Checkbox "Enable Isotope bridge" in
der Sektion "Erweiterte Einstellungen" an. Nach dem Speichern und
Schließen ändert sich das Isotope-Icon und wird farbig (siehe Cars) und steht
für die Konfiguration zur Verfügung.

Vor der Konfiguration der Isotope-Bridge sollten die Attribute des
MetaModels geprüft bzw. ergänzt werden. Folgende Attribute sollten
vorhanden sein:

Pflichtfelder:

* Name (Attribut Text, CombinedValues od. vgl.)
* Beschreibung (Attribut Langtext)
* SKU/Artikelnummer (Attribut Alias, Text, Numerisch od. vgl.)
* Preis (Attribut Price (Isotope) oder Dezimal (dann sind keine Steuern möglich))

Optional:

* Bild (Attribut Datei)
* Grundpreis (Attribut Baseprice (Isotope))
* Download (Attribut Datei)
* Gewicht (Attribut Dezimal)

Ist die Prüfung der Attribute erfolgt, kann in der Anzeige der
MetaModels mit Klick auf das Isotope-Icon die Konfiguration geöffnet
werden. Hier werden die eben genannten Attribute den Vorgaben und
Optionen von Isotope zugeordnet.

|img_isotope_config|

Zu den Grundeinstellungen können noch zwei weitere Einstellungen
vorgenommen werden:

* "Exempt from shipping" definiert einen Filter für Items, die
  nicht versendet werden sollen wie z.B. Downloads – analog der
  Isotope-Einstellung
* "Jump to render settings" definiert die Render-Einstellungen
  von MetaModels, welche für die Listendarstellung angelegt sind,
  um die "jumpTo-Adresse" für eine Detaildarstellung zu ermitteln;
  die Einstellung ist dann notwendig, wenn es von den Items auch
  eine Detailseite gibt

Für die Anzeige der Kaufoption in der CE/FE-Modul MetaModels-Liste,
muss noch die Freischaltung der Isotope-Bridge erfolgen. Dazu die
entsprechende MM-Liste anlegen oder öffnen und die Option "Enable Isotope bridge"
aktivieren. Anschließend stehen die Optionen für Warenkorb, Artikelanzahl
usw. wie beim Isotopeshop zur Verfügung.

|img_isotope_enable_bridge|

Damit sind die Einstellungen abgeschlossen und in der Listenansicht
im Frontend sollten nun bei jedem Item die eingestellten Buttons für
die Übergabe an den Warenkorb zu sehen sein. Alle weiteren Konfigurationen
wie Warenkorb und Checkout erfolgen in Isotope.

|img_isotope_fe-addtocart|

Wurde ein Item gekauft, ist dieses im Backend wie bei Isotope nicht mehr löschbar.

Demoshop
--------

Zum Testen und Vergleichen der Erweiterung gegenüber dem normalen
Isotope, wurde ein Demoshop eingerichtet: `https://isotope.metamodel.me <https://isotope.metamodel.me>`_

Die Produkte und Produktgruppen wurden für eine bessere Vergleichbarkeit
im "MM-Shop" und im "Isotope-Shop" gleich angelegt. Für eine Unterscheidung
im Warenkorb und bei den Bestellungen haben die Artikelnummern jeweils
ein Präfix mit "MM-" bzw. "ISO-".

Folgend noch einige Hinweise zu den einzelnen Produktgruppen:

* die Süßigkeiten/Sweets sind als einsprachiges MetaModel angelegt,
  daher gibt es keine Änderung der Texte beim Umschalten der FE-Sprache;
  bei der Produktgruppe wurde der Basispreis implementiert
* die Autos/Cars sind als mehrsprachiges MetaModel angelegt, d.h. die
  Texte und Bilder (Flaggen!) ändern sich beim Umschalten der Sprache;
  im Warenkorb und im Checkout sind die Verlinkungen zur Detailseite
  entsprechend den "jumpTo" aus den Render-Einstellungen je Sprache;
  bei dem Mercedes wurden Varianten angelegt und das Ausgabetemplate
  so angepasst, dass nur der Elterndatensatz angezeigt und die
  Kinddatensätze über ein Select wählbar sind
* die Downloads sind ebenfalls mehrsprachig


Voraussetzungen
---------------

Für die Installation der Module gelten aktuell folgende
Voraussetzungen:

* Contao 4.4.x/4.9.x
* Isotope ab 2.5 und MetaModels 2.1/2.2
* PHP ab 7.2/7.4


Known Issues and Next Features
------------------------------

* Übersetzungen in DE (wenn Projekt freigeschaltet per Transifex)


Spenden
-------

Ein Dank für die Spenden* für die Erweiterung an:

* NN: 342 €
* Carsten Merz - `Fitkurs <https://www.fitkurs.de>`_: 390 €
* Oliver Willmes - `oliverwillmes.de <https://www.oliverwillmes.de>`_: 390 €
* iD visuelle Kommunikation - `id-kommunikation.ch <http://www.id-kommunikation.ch>`_: 390 €
* ghost.company - `ghostcompany.com <http://www.ghostcompany.com>`_: 490 €

(*Spenden in Netto)


.. |br| raw:: html

   <br />


.. |img_isotope_mm| image:: /_img/screenshots/extended/isotope/isotope_mm.jpg
.. |img_isotope_config| image:: /_img/screenshots/extended/isotope/isotope_config.jpg
.. |img_isotope_enable_bridge| image:: /_img/screenshots/extended/isotope/isotope_enable_bridge.jpg
.. |img_isotope_fe-addtocart| image:: /_img/screenshots/extended/isotope/isotope_fe-addtocart.jpg
