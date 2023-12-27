.. _extended_perimetersearch:

Umkreissuche
============


Einleitung
----------

Mit der Umkreissuche können Datensätze nach ihrer geografischen Position
im Bezug auf eine vorgegebene Adresse und Radius gefiltert werden. Mit dem Filter
wird bestimmt, ob sich der entsprechende Datensatz innerhalb des vorgegebenen
Radius befindet bzw. ob der geografische Abstand zwischen dem Punkt der Filtereingabe
und dem des Datensatzes unterhalb eines gegebenen Schwellwertes ist. Bezugspunkt
("Mittelpunkt") des "Filterkreises" ist die im Filter eingegebene Adresse. Der sphärische
Abstand zwischen den zwei Punkten wird mit der `Haversine-Formel <https://en.wikipedia.org/wiki/Haversine_formula>`_
ermittelt.

Die Berechnung der Entfernung der Datensätze zur eingegebenen Adresse
erfolgt auf der Grundlage des Längen- und Breitengerades. Diese beiden Werte
müssen jeweils für die im MetaModel gespeicherte Adresse als auch für die
eingegebene Adresse vorliegen.

Für die im MetaModel gespeicherten Adressen muss jeweils ein Attribut für
den Längengrad (longitude) und den Breitengrad (latitude) z.B. als "geo_lat"
und "geo_long" mit dem Typ "Text" angelegt werden.

Die Auflösung der eingegebenen Adresse in Längen- und Breitengerad erfolgt
direkt beim Absenden der Filteranfrage im Frontend über einen "Lookup" -
für diesen stehen die Services von Google-Maps oder OpenStreetMap zur
Verfügung.

Es folgt eine Kurzanleitung zur Konfiguration der Umkreissuche, die weiter
ergänzt wird.


Filter installieren
-------------------

Mit dem Contao Manager oder auf Konsole das Paket "metamodels/filter_perimetersearch"
installieren. Nach der Installation sollte es eine weitere Filterregel "Umkreissuche"
geben.


Attribute anlegen
-----------------

Für den Längengrad (longitude) und den Breitengrad (latitude) ist jeweils ein
Attribut vom Typ "Dezimal" oder "Text" anzulegen z.B. als "geo_lat" und "geo_long". Die
Attribute werden nur für die Filterung benötigt und müssen für die Fronendausgabe nicht
eingerichtet werden.

|img_attribute_01|

Nach dem Anlegen der beiden Attribute können diese mit Werten befüllt werden z.B. mit
geo_lat: 52.517365 und geo_long: 13.353159 für die Adresse des Schloss Bellevue in 
Berlin (Spreeweg 1, 10557 Berlin, Deutschland).


Filter anlegen
--------------

Unter Filtersets wird ein neues Filterset z.B. mit der Bezeichnung
"Umkreissuche" angelegt und anschließend eine Filterregel vom Typ
"Umkreissuche" mit den folgenden Einstellungen:

* Typ: Umkreissuche
* Datenmodus: Multimodus (z. Z. nur Multimodus verfügbar)
* Attribute für Breite und Länge: entsprechende Attribute auswählen
* Label: Bezeichnung für die Eingabe der Adresse ("Mittelpunkt") - z.B. "Adresse"
* Bereichslabel: Bezeichnung für die Angabe der Größe des Radius - z.B. "Radius in km"
* Bereichsmodus: Auswahl, ob freies Eingabefeld oder feste Werte (Auswahlmodus)
* Ländermodus: Vorgabe ob und wenn ja welches Land der Adresse für die Lookup-
  Suche hinzugefügt werden soll (z.B. Voreinstellung mit "Deutschland")
* LookUp Service: Auswahl ob Google-Map, OpenStreetMap oder direkte Koordinaten - es
  können auch mehere Services angelegt werden; diese werden nacheinander abgearbeitet

|img_filter_01|


Filter im Frontend einrichten
-----------------------------

Im Frontend sollte eine zu filternde MetaModel-Liste mit aktiviertem Filterset
(z.B. "Umkreissuche") vorhanden sein.

Im MetaModel-Frontendfilter wir das entsprechende MetaModel sowie das
Filterset "Umkreissuche" aktiviert. Ebenso erfolgt eine Aktivierung bei
den Attributen des Filters Umkreissuche.

Die Einstellung "Bei Änderung aktualisieren" sollte nicht angewählt werden,
da ansonsten das Formular schon startet, wenn erst ein Wert von Adresse/Radius
geändert wurde.

|img_fe-filter_01|

In der Frontend-Ausgabe sollte nun ein Filter mit zwei Eingabemöglichkeiten
zu sehen sein, mit denen die Liste gefiltert werden kann.

|img_fe-filter_02|


Hinweise
--------

Für die Filterung muss die Adresse möglichst genau eingegeben werden. Aktuell
wird nicht abgefangen, ob es zu einer Adresseingabe mehrere "Fundorte" bei dem
LookUp-Service gibt.

Wird bei der Datenübergabe im Frontendfilter neben der Adresse auch die konkreten
Koordinaten übergeben - z. B. mit einer GPS-Bestimmung per JavaScript - sollte bei
den LookUp-Services die Auswahl Koordinaten an erster Stelle stehen.

Die Auflösung einer Adresse zu Längen- und Breitengerad bei der Eingabe im Backend
ist auch über den LookUp-Service realisierbar -
`siehe Vortrag zur CK23 <https://www.e-spin.de/contao-metamodels/metamodels-vortrag-contao-konferenz-2023.html`_

In einem weiteren Ausbau der Erweiterung werden die Bezeichnungen Mehrsprachig
werden.

Fehler und Hinweise bitte bei `Github einpflegen <https://github.com/MetaModels/filter_perimetersearch>`_
- auch Finanzierungen weiterer Funktionen bzw. der Weiterentwicklung sind willkommen.



.. |img_attribute_01| image:: /_img/screenshots/extended/perimetersearch/attribute_01.png
.. |img_filter_01| image:: /_img/screenshots/extended/perimetersearch/filter_01.png
.. |img_fe-filter_01| image:: /_img/screenshots/extended/perimetersearch/fe-filter_01.png
.. |img_fe-filter_02| image:: /_img/screenshots/extended/perimetersearch/fe-filter_02.png



