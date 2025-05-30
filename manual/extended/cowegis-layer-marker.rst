.. _extended_cowegis-layer-marker:

Cowegis-Layer Integration für Marker
===================================

Mit `Cowegis-Layer` wird die Darstellung von Markern aus MetaModels in der Contao-Erweiterung
`Cowegis <https://github.com/cowegis>`_ ermöglicht. Mit Cowegis können verschiedene Karten, Marker, Polygone usw.
konfiguriert und über `Leaflet <https://leafletjs.com/>`_ ausgegeben werden.

.. note:: Diese Erweiterung steht ab MM 2.4 mit Contao 5.3 zur Verfügung - für eine Freischaltung bitte
   eine E-Mail an mail@metamodel.me senden.

Installation
------------

Mit der Installation von `Cowegis-Layer` werden die notwendigen Basispakete von Cowegis automatisch installiert. Möchte
man Cowegis auch unabhängig von MetaModels nutzen, empfiehlt es sich eines der beiden folgenden Pakete zu
installieren:

* `Cowegis Contao Monolingual Pack <https://github.com/cowegis/cowegis-contao-monolingual-pack>`_
* `Cowegis Contao Multilingual Pack <https://github.com/cowegis/cowegis-contao-multilingual-pack>`_

Für die mehrsprachige Ausgabe von Daten aus MetaModels - z. B. für Texte in den Popups - reicht das Monolingual Pack.
Das Multilingual Pack ist für eigene Übersetzungen bei den Karten (verwendet die Erweiterung
`DC_Multilingual <https://github.com/terminal42/contao-DC_Multilingual>`_).

Nach der Installation und der DB-Migration gibt es im Backend einen neuen Abschnitt in der Navigation "COWEGIS". Über
die Navigationspunkte können die Karten und Marker erstellt werden.


Allgemeines Vorgehen
--------------------

Der Ablauf für die Erstellung einer Karte mit Markern aus MetaModels-Daten ist wie folgt:

**Vorbereitung:**

* Layer anlegen
* Karte anlegen
* Karte anzeigen

**Anzeige der MetaModels Daten**

* MetaModels Daten erstellen
* Marker Layer erstellen
* Marker Layer in Karte einbinden

**Optionale Einstellungen**

* Icons konfigurieren
* Popup konfigurieren
* Kontrollelemente anlegen
* weitere Layer anlegen

Die meisten Eingabewerte haben ihre Entsprechung bei dem Projekt `Leaflet <https://leafletjs.com/>`_ welches die
JavaScript-Bibliothek für die Kartendarstellung mitbringt. Bei unklaren Parametern ist es ratsam, dort einen Blick in
die Beispiele und die Dokumentation zu werfen.


Vorbereitung
------------

Layer anlegen
.............

Im Bereich Layer wird ein neuer Layer für die Kartendarstellung angelegt. Dazu stehen als Typen "Kachel-Layer" oder
"Vorkonfiguriere Karte" zur Verfügung.

Beim Typ "Kachel-Layer" muss man ein passendes URL-Template einfügen. Diese findet man z. B. bei den entsprechenden
Kartenanbietern oder kann die URLs aus den `Leaflet-Providern <https://github.com/leaflet-extras/leaflet-providers/blob/master/leaflet-providers.js>`_
auslesen. Die typische URL für OSM ist ``https://tile.openstreetmap.org/{z}/{x}/{y}.png``. Bei diesem Layertyp stehen
die möglichen Konfigurationsparameter für individuelle Einstellungen zur Verfügung.

Eine einfachere Variante ist der Typ "Vorkonfiguriere Karte". Hier können die typischen Kartenprovider wie OSM, MapBox,
usw. in einem Select ausgewählt werden - die spezifischen Parameter der jeweiligen Provider werden automatisch mit
eingebunden.

Karte anlegen und anzeigen
..........................

Im nächsten Schritt wird im Punkt Karten eine neue Karte über "Karte erstellen" angelegt. Hier ist lediglich der Titel
ein Pflichtfeld. Man sollte aber Koordinaten för eine Zentrierung und einen initialen Zoomfaktor eingeben. Die
Koordinaten für die Zentrierung lassen sich über eine Adresse ermitteln. Dazu das Kartenpopup über das Karten-Icon
|img_map| öffnen, rechts oben bei Suche eine Adresse eingeben und mit Enter bestätigen. Mit Klick auf den Button
"Anwenden" werden die Koordinaten übernommen. Die weiteren Parameter können zu einem späteren Zeitpunkt eingestellt
bzw. angepasst werden.

Nach dem Speichern und Schließen ist in dem Listeneintrag der neuen Karte das Icon für die Liste der angelegten Layer
|img_layers| über welches diese Liste geöffnet wird. Mit dem grünen Plus-Icon |img_copy| wird der erstellte Karten-Layer
hinzugefügt.

Das grüne Plus-Icon wechselt zu einem roten X-Icon |img_delete| und ein Icon Stift |img_edit| und Karte |img_map| kommen
hinzu. Der Stift öffnet die übliche Bearbeitungsmaske und über das Karten-Icon kann definiert werden, ob der Karten-Layer
standardmäßig eingeblendet werden soll oder nicht. Auch wenn ein Kartenlayer nicht als Standardlayer definiert ist - das
Ion ist disabled |img_map_1| - werden die Kartendaten im Frontend ausgespielt. Die Anzeige ist aber unterbunden und kann
über ein Kontrollelement ein- bzw. wieder ausgeblendet werden. Damit kann dem Seitenbesucher die Möglichkeit gegeben
werden, aktiv verschiedene Layer wie Kartentypen z. B. mit/ohne OPNV oder nit/ohne Markern oder Polygonen.

Das Karten-Icon ist also nicht das übliche "Auge-Icon" zum Deaktivieren - um einen Layer zu deaktivieren, muss man die
Bearbeitungsmaske über den Stift öffnen und über die Checkbox "Aktiv" deaktivieren.

Karte anzeigen
..............

Im nächsten Schritt kann man die erstellte Karte als Content-Element oder Frontend-Modul anlegen. Dazu geht man in die
entsprechende Bearbeitungsmaske und wählt als Typ "Cowegis-Karte" aus. Nach Auswahl der Cowegis-Karte und Eingabe einer
Kartenbreite und -höhe ist nach dem Speichern die Karte auf der entsprechenden Frontendausgabe sichtbar.


Anzeige der MetaModels Daten
----------------------------

MetaModels Daten erstellen
..........................

Möchte man Datensätze als Marker auf einer Karte anzeigen, so sind verschiedene Daten in MetaModels zu pflegen. Für
folgende Angaben können bzw. sollten entsprechende Attribute in MM vorhanden sein:

* Koordinaten (Latitude und Longitude pflicht, Altitude optional)
* Title-Attribut (optional)
* Alt-Attribut (optional)
* Popup (optional)

Die Koordinaten des Markers können in einem Wert als kommaseparierte Zahlen oder als Einzelwerte gespeichert werden. Für
den ersten Fall sollte ein Attribut Text angelegt sein, welches das Tupel (52.510885,13.3989367) oder Tripel
(52.510885,13.3989367,35) aufnimmt. Sollten die Koordinaten einzeln gespeichert werden, so sind zwei bzw. drei
Attribute Dezimal anzulegen. Die Variante mit einzelnen Koordinatenwerten muss verwendet werden, sofern die Datensätze
mit einer :ref:`Umkreissuche aus MetaModels <extended_perimetersearch>` gefiltert werden sollen.

Dem Marker-Icon kann optional ein Text für das Title- bzw. Alt-Attribut übergeben werden. Dafür wird ein entsprechendes
Attribut Text benötigt. Der Text darf keine HTML-Formatierung beinhalten, welches die HTML-Ausgabe stört.

Bei dem Marker ist es möglich, kei Klick eine Infobox als Popup anzeigen zu lassen. Der Inhalt kann aus einem Attribut
Text oder Langtext kommen und darf auch HTML-Formatierungen wie Links o. ä. beinhalten.

Alternativ dazu kann auch für das Popup eine eigene :ref:`Render-Einstellung <component_rendersettings>` angelegt werden.
Mit einer separaten Render-Einstellung ist es möglich, die Ausgabe mehrerer Attribute zu kombinieren und mit einem
eigenen Template auszugeben. Zudem ist die einfache Ausgabe von Detaillinks (jumpTo) möglich.

Sind alle Attribute angelegt und mit Daten befüllt, folgt im nächsten Schritt die Einbindung bzw. die automatische
Erstellung der Marker in Cowegis.

Marker Layer erstellen
......................

Nachdem alle Vorbereitungen in MM erfolgt sind, kann ein entsprechender Layer für die Ausgabe der Marker angelegt werden.
Dazu in Cowegis unter Layer mit "Layer erstellen" einen neuen Layer vom Typ "MetaModels Marker" anlegen. Mit der
Typauswahl werden die passenden Eingabewidgets in der Maske angezeigt. Im Abschnitt "MetaModel" ist das gewünschte
Model auszuwählen. Im Abschnitt Koordinaten ist die Auswahl zwischen einem oder mehreren Attributen für die Koordinaten
möglich. Je nach Auswahl steht ein oder drei Select zur Verfügung.

Die Anpassungen im Abschnitt Icon sind optional. Auf die Anpassungen des Icons wir weiter unten eingegangen. Die
Auswahl eines MetaModel-Attributes für das Title- bzw. Alt-Attribut des Icons kann nun vorgenommen werden.

Im optionalen Abschnitt Popup kann mit "Popup hinzufügen" bestimmt werden, ob ein Popup erscheinen soll und wenn ja,
ob der Inhalt aus einem MetaModel-Attribut oder über eine separate Render-Einstellung erfolgen soll.


Marker Layer in Karte einbinden
...............................

Sind alle Eingaben getätigt und gespeichert, wechselt man wieder zur angelegten Karte auf die Anzeige der Layer
|img_layers|.

Dort ist der angelegte Layer für die Marker mit dem Icon |img_metamodels_marker.svg| zu sehen und wird mit |img_copy|
eingebunden. Der Layer sollte damit auch als sichtbarer Standardlayer eingestellt sein - ggf. über die Bearbeitung oder
das Karten-Icon aktivieren. Die Liste der Layer könnte etwa wie folgt aussehen:

|img_screenshot_01|

Folgend ein Beispiel, wie die Marker auf einer Karte aussehen könnten:

|img_screenshot_02|


Optionale Einstellungen
-----------------------

Icons konfigurieren
...................

Popup konfigurieren
...................

Kontrollelemente anlegen
........................

weitere Layer anlegen
.....................




.. |img_copy| image:: /_img/screenshots/extended/cowegis_layer/copy.svg
.. |img_delete| image:: /_img/screenshots/extended/cowegis_layer/delete.svg
.. |img_edit| image:: /_img/screenshots/extended/cowegis_layer/edit.svg
.. |img_layers| image:: /_img/screenshots/extended/cowegis_layer/layers.svg
.. |img_map| image:: /_img/screenshots/extended/cowegis_layer/map.svg
.. |img_map_1| image:: /_img/screenshots/extended/cowegis_layer/map_1.svg
.. |img_metamodels_marker.svg| image:: /_img/screenshots/extended/cowegis_layer/metamodels_marker.svg
.. |img_screenshot_01| image:: /_img/screenshots/extended/cowegis_layer/screenshot_01.png
.. |img_screenshot_02| image:: /_img/screenshots/extended/cowegis_layer/screenshot_02.png
