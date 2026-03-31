.. _extended_cowegis-layer-marker:

Cowegis-Layer Integration für Marker
====================================

Mit `Cowegis-Layer` wird die Darstellung von Markern aus MetaModels in der Contao-Erweiterung
`Cowegis <https://github.com/cowegis>`_ ermöglicht. Mit Cowegis können verschiedene Karten, Marker, Polygone usw.
konfiguriert und über `Leaflet <https://leafletjs.com/>`_ ausgegeben werden. Die Erweiterung arbeitet sowohl
mit einsprachigen als auch mit mehrsprachigen MetaModels zusammen.

.. note:: Diese Erweiterung steht ab MM 2.4 mit Contao 5.3 zur Verfügung - für eine Freischaltung bitte
   eine E-Mail an mail@metamodel.me senden. Aktuell offene Finanzierung: 3.981,25 €


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

Eine Karte besteht in Cowegis aus mehreren Layern (Schichten) die verschiedene Inhalte in der Gesamtansicht Karte
kombinieren. Grundlegend ist natürlich ein Layer mit den Kartendaten. Da diese Kartendaten aus einzelnen Kacheln (Tiles)
aufgebaut wird, ist häufig von `Kacheln` oder `Tiles` zu lesen. Auf diesem "Karten"-Layer können wiederum verschiedene
Elemente wie Marker, Polygone o. ä. über eigene Layer eingeblendet werden.

Der Ablauf für die Erstellung einer Karte mit Markern aus MetaModels-Daten ist wie folgt:

**Vorbereitung:**

* Layer für Kartendaten anlegen
* Karte anlegen und Layer einbinden
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
usw. in einem Select ausgewählt werden - die spezifischen Parameter der jeweiligen Provider werden hier automatisch mit
eingebunden.

Karte anlegen und Layer einbinden
.................................

Im nächsten Schritt wird im Punkt `Karten` eine neue Karte über "Karte erstellen" angelegt. Hier ist lediglich der Titel
ein Pflichtfeld.

Man kann Koordinaten für eine initiale Zentrierung und Zoomfaktor eingeben. Die Koordinaten für die Zentrierung
lassen sich über eine Adresse ermitteln. Dazu das Karten-Popup über das Karten-Icon
|img_map| öffnen, rechts oben bei Suche eine Adresse eingeben und mit Enter bestätigen. Mit Klick auf den Button
"Anwenden" werden die Koordinaten übernommen. Die weiteren Parameter können zu einem späteren Zeitpunkt eingestellt
bzw. angepasst werden.

Ist keine initiale Zentrierung angegeben, sollte man sicherstellen, dass die Karte durch andere Einstellungen sich
entsprechend positioniert. Zum Beispiel kann das erfolgen, wenn man bei den aktivierten Layern (Marker) einer Karte
die Option "Grenzen festlegen" aktiviert (s. u.).

Nach dem Speichern und Schließen gibt es einen neuen Listeneintrag mit der neuen Karte.

|img_screenshot_16|

Über das Icon für die Layeransicht |img_layers| gelangt man zur Liste der angelegten Layer.

|img_screenshot_17|

Mit dem grünen Plus-Icon |img_copy| wird der erstellte Karten-Layer hinzugefügt bzw. aktiviert. Das grüne Plus-Icon
wechselt zu einem roten X-Icon |img_delete| und die Icons Stift |img_edit| und Karte |img_map| kommen hinzu. Der Stift
öffnet die übliche Bearbeitungsmaske und über das Karten-Icon kann definiert werden, ob der Karten-Layer standardmäßig
eingeblendet werden soll oder nicht.

Sollen die Kartengrenzen auf einen Layer wie z. B. einen Marker-Layer reagieren, so ist die Option "Grenzen festlegen"
zu aktivieren (s.o.).

Auch wenn ein Kartenlayer nicht als Standardlayer definiert ist - das Ion ist disabled |img_map_1| - werden die
Kartendaten im Frontend ausgespielt. Die Anzeige ist aber unterbunden und kann über ein Layer Kontrollelement (s. u.)
ein- bzw. wieder ausgeblendet werden. Damit kann dem Seitenbesucher die Möglichkeit gegeben werden, aktiv verschiedene
Layer wie Kartentypen z. B. mit/ohne ÖPNV oder mit/ohne Markern oder Polygonen.

Das Karten-Icon ist also nicht das übliche "Auge-Icon" zur Deaktivierung eines Datensatzes. Um einen Layer zu
deaktivieren, muss man stattdessen die Bearbeitungsmaske über den Stift öffnen und über die Checkbox "Aktiv"
deaktivieren oder das roten X-Icon |img_delete| in der Listenansicht klicken.

|img_screenshot_15|

Karte anzeigen
..............

Im nächsten Schritt kann man die erstellte Karte als Content-Element oder Frontend-Modul anlegen. Dazu geht man in die
entsprechende Bearbeitungsmaske und wählt als Typ "Cowegis-Karte" aus. Nach Auswahl der Cowegis-Karte, Eingabe einer
Kartenbreite sowie -höhe und dem Speichern ist die Karte auf der entsprechenden Frontendausgabe sichtbar.

Für die Parameter "Zentrieren" mit ``52.510885,13.3989367`` und "Zoom-Faktor" ``14`` sieht die Ausgabe der Karte in
etwa wie folgt aus:

|img_screenshot_13|

Anzeige der MetaModels Daten
----------------------------

MetaModels Daten erstellen
..........................

Möchte man Datensätze als Marker auf einer Karte anzeigen, so sind verschiedene Daten in MetaModels zu pflegen. Für
folgende Angaben können bzw. sollten entsprechende Attribute in MM vorhanden sein (inkl. Angabe unterstützter Attribute):

* Koordinaten (Latitude und Longitude Pflicht, Altitude optional) - Dezimal bei Einzelangabe bzw. Text für
  kommaseparierte Angabe
* Title-Attribut (optional) - Text, Kombinierte Werte, Übersetzter Text, Übersetzte kombinierte Werte
* Alt-Attribut (optional) - Text, Kombinierte Werte, Übersetzter Text, Übersetzte kombinierte Werte
* Popup (optional) - Text, Langtext, Kombinierte Werte, Übersetzter Text, Übersetzter Langtext, Übersetzte
  kombinierte Werte

Die Koordinaten des Markers können in einem Wert als kommaseparierte Zahlen oder als Einzelwerte gespeichert werden. Für
den ersten Fall sollte ein Attribut Text angelegt sein, welches das Tupel (``52.510885,13.3989367``) oder Tripel
(``52.510885,13.3989367,36``) aufnimmt. Sollten die Koordinaten einzeln gespeichert werden, so sind zwei bzw. drei
Attribute "Dezimal" anzulegen. Die Variante mit einzelnen Koordinatenwerten ist zu verwenden, sofern die Datensätze
mit einer :ref:`Umkreissuche aus MetaModels <extended_perimetersearch>` gefiltert werden sollen.

Dem Marker-Icon kann optional ein Text für das Title- bzw. Alt-Attribut übergeben werden. Dafür wird ein entsprechendes
Attribut "Text" benötigt. Der Text darf keine HTML-Formatierung beinhalten, welches die HTML-Ausgabe stört.

Bei dem Marker ist es möglich, bei Klick eine Infobox als Popup anzeigen zu lassen. Der Inhalt kann aus einem Attribut
z. B. "Text" oder "Langtext" kommen und darf auch HTML-Formatierungen wie Links o. ä. beinhalten. Wie das Attribut gerendert
wird, bestimmt die Auswahl der Render-Einstellung - das Attribut sollte als Element in der Render-Einstellung
vorhanden sein.

Alternativ zu einem einzelnen Attribut, kann auch für das Popup eine eigene
:ref:`Render-Einstellung <component_rendersettings>` angelegt werden. Mit einer separaten Render-Einstellung ist es
möglich, die Ausgabe mehrerer Attribute zu kombinieren und mit einem eigenen Template auszugeben. Zudem ist die
einfache Ausgabe von Detaillinks (jumpTo) möglich.

Für die drei Textausgaben (Popup sowie Title- und Alt-Attribut) können sowohl einsprachige als auch übersetzte
MetaModels-Attribute zum Einsatz kommen - eine mehrsprachige Ausgabe wird unterstützt.

Sind alle Attribute angelegt und mit Daten befüllt, folgt im nächsten Schritt die Einbindung bzw. die automatische
Erstellung der Marker in Cowegis.

Marker Layer erstellen
......................

Nachdem alle Vorbereitungen in MM erfolgt sind, kann ein entsprechender Layer für die Ausgabe der Marker angelegt werden.

Dazu in Cowegis unter Layer mit "Layer erstellen" einen neuen Layer vom Typ "MetaModels Marker" anlegen. Mit der
Typauswahl werden die passenden Eingabewidgets in der Maske angezeigt. Im Abschnitt "MetaModel" ist das gewünschte
Model auszuwählen. Im Abschnitt Koordinaten ist die Auswahl zwischen einem oder mehreren Attributen für die Koordinaten
möglich. Je nach Auswahl stehen ein oder drei Selects zur Verfügung.

Die Anpassungen im Abschnitt Icon sind optional. Auf die Anpassungen des Icons wird weiter unten eingegangen. Die
Auswahl eines MetaModel-Attributes für das Title- bzw. Alt-Attribut des Icons kann nun vorgenommen werden.

Im optionalen Abschnitt Popup kann mit "Popup hinzufügen" bestimmt werden, ob ein Popup erscheinen soll und wenn ja,
ob der Inhalt aus einem MetaModel-Attribut oder über eine separate Render-Einstellung erfolgen soll.

Folgend ein Beispiel der Konfigurationseinstellungen:

|img_screenshot_14|

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

Die Ausgabe kann an den verschiedensten Stellen an die eigenen Wünsche und Anforderungen angepasst werden. Zum Beispiel
kann beim Layer mit den MetaModels Markern im Abschnitt Konfiguration die Transparenz gesetzt werden oder ob die Icons
per Tab ansteuerbar sind.

Icons konfigurieren
...................

Die Anpassung der Anzeige der Marker-Icons ist auf vielfältige Weise möglich. Als Standard wird das folgende Icon
von `Leaflet <https://leafletjs.com/>`_ in der Größe 25x41px ausgegeben:

|img_marker-icon|

Eigene Icons kann man bei Vorlagen mit "Icon erstellen" anlegen. Aktuell stehen die folgenden Typen zur Auswahl:

* Datei
* DIV
* SVG
* Font-Awesome

**Datei** |br|
Beim `Typ "Datei" <https://leafletjs.com/reference.html#icon>`_ kann man eine Datei aus der Dateiverwaltung auswählen.
Wer keine eigene Datei zur Verfügung hat, kann sich z. B. bei einigen Iconfonts wie
`Lucide <https://lucide.dev/icons/?search=map>`_ ein Icon holen. Der Typ Datei unterstützt neben PNG auch SVG. Die
Darstellung der Icongröße wird durch die Ursprungsdatei bestimmt oder kann bei
`iconSize mit Angabe von "Breite,Höhe" in Pixeln <https://leafletjs.com/reference.html#icon>`_ angepasst werden; z. B.
``42,42``.

|img_screenshot_03|

**DIV** |br|
Beim `Typ "DIV" <https://leafletjs.com/reference.html#divicon>`_ kann in das Feld "HTML" beliebiger HTML-Content
eingefügt werden - das kann auch ein SVG-Quelltext sein. Folgend ein Beispiel als Div-Container und CSS (iconSize
``80,40``);

|img_screenshot_12|

.. code-block:: html
   :linenos:

   <style>
   /* http://projects.verou.me/bubbly/ */
   .marker-bubble {
       position: relative;
       background: #00aabb;
       border-radius: .4em;
       text-align: center;
       padding: .6rem;
       color: #FFFFFF;
   }

   .marker-bubble:after {
       content: '';
       position: absolute;
       bottom: 0;
       left: 50%;
       width: 0;
       height: 0;
       border: 1.719em solid transparent;
       border-top-color: #00aabb;
       border-bottom: 0;
       border-left: 0;
       margin-left: -0.859em;
       margin-bottom: -1.7em;
   }
   </style>
   <div class="marker-bubble">
       Moin!
   </div>

**SVG** |br|
Beim Typ "SVG" wird ein Standardmarker ausgegeben der neben der Größe (iconSize) auch in der Farbe angepasst werden kann;
der Inhalt des Feldes "Content" wird im Icon ausgegeben z. B. ``#42``.

|img_screenshot_04|

**Font-Awesome** |br|
Beim `Typ "Font-Awesome" <https://github.com/lennardv2/Leaflet.awesome-markers>`_ wird ein Standardmarker inklusive
einem Icons von Font-Awesome ausgegeben. Der Marker kann neben der Größe (iconSize) auch in der Farbe angepasst werden.
Die Icons von Font-Awesome werden mit der Erweiterung Cowegis schon mitgeliefert - die Auswahl erfolgt über die
entsprechende Eingabe des Iconnamens bzw. CSS-Klasse.

In dem Marker stehen aktuell stehen die Icons aus
`Font-Awesome Free Version 6 zur Verfügung <https://fontawesome.com/v6/search?ic=free>`_ zur Verfügung
z. B. "`fa-envelope <https://fontawesome.com/icons/envelope?f=classic&s=solid>`_".

|img_screenshot_18|

Dabei ist zu beachten, dass der Iconname bei "Icon-CSS-Klasse" ohne den Präfix z. B. "fa-" eingegeben werden muss - also
``envelope``. Zudem muss eine Auswahl des passenden Sets aus "Regular, Solid, Brands" des gewünschten Icons erfolgen.

Die Größe des Markers wird mit der Angabe "Icon-Größe" angepasst und bezieht sich auf den kompletten Div-Container, der
das SVG für den "Tropfen" als auch für das Font-Awesome-SVG umschliesst. Der Div-Container hat als Standard eine Größe
von ``26,40`` in Pixeln - für eine Vergrößerung um 50% wäre ``39,60`` einzugeben.

**Icon-Vorlage in MetaModels auswählen**
In MetaModels steht ein neues Attribut "Cowegis Marker" zur Verfügung, mit dem man eine Icon-Vorlage aus Cowegis
in MM speichern kann. Dazu wird wie üblich das entsprechende Attribut angelegt und in der Eingabemaske freigeschaltet.
Wenn ein Datensatz bearbeitet wird, kann über ein Select eine Icon-Vorlage ausgewählt werden; gespeichert wird die
ID der Vorlage. In der Listenausgabe der Render-Einstellung wird als Standard der Name der Vorlage ausgegeben -
ändert man das Template des Attributes auf ``mm_attr_marker_icon_image``, wird neben dem Namen auch eine Vorschau
des Icons ausgegeben (aktuell nur für Typ "Datei").

|img_screenshot_05|

Anschließend kann man in den Einstellungen von Layer vom Typ „MetaModels Marker“ die Anzeige der individuellen Icons
anpassen. Im Abschnitt Icon gibt es die Auswahl "Icon-Attribut" mit dem man das angelegte Attribut "Cowegis Marker"
auswählen kann. Als Fallback zu der Einstellung kann ein eigenes Standardicon definiert werden - hier ist in dem
Select die Auswahl einer angelegten Icon-Vorlage möglich. Sollte diese Einstellung auch nicht greifen, wird das
Standard-Icon von Leaflet ausgespielt.

|img_screenshot_06|

In der Karte sieht das dann wie folgt aus:

|img_screenshot_07|

Popup konfigurieren
...................

Die Anzeige der Popups kann ebenfalls unter Vorlagen konfiguriert werden. Dazu zur Ansicht "Popups verwalten"
wechseln und "Popup erstellen" ausführen - anschließend die gewünschten Einstellungen vornehmen.

Danach ist in den Einstellungen von Layer vom Typ „MetaModels Marker“ die Anzeige der individuellen Popups
möglich. Im Abschnitt Popup bei "Popup-Voreinstellung" die gewünschte Vorlage aktivieren. Folgend eine Anzeige mit
geöffnetem Popup und Tooltipp.

|img_screenshot_08|

Kontrollelemente anlegen
........................

Unter den Karten ist in der Zeile jeder Karte das Icon |img_control| für das Anlegen der Kontrollelemente verfügbar. Über
"Kontrollelement erstellen" können verschiedene Kontrollelemente angelegt werden wie z. B.:

* Copyright-Leiste: Das `Kontrollelement zur Namensnennung <https://leafletjs.com/reference.html#control-attribution>`_
  erlaubt es, Urheber in einer kleinen Textbox auf der Karte anzuzeigen.
* Fullscreen-Kontrollelement: Diese Einstellung fügt einen Button hinzu, der den
  `Fullscreen-Modus <https://github.com/brunob/leaflet.fullscreen>`_ umschaltet.
* Layer-Kontrollelement: Das `Layer-Kontrollelement <https://leafletjs.com/reference.html#control-layers>`_ gibt
  Frontend Besuchern die Möglichkeit, zwischen verschiedenen Layern zu wechseln und Overlays an- oder auszuschalten.
* Lade-Indikator: `Leaflet.loading <https://github.com/ebrelsford/Leaflet.loading>`_ ist ein einfacher Ladeindikator
  als Kontrollelement.
* Maßstabs-Kontrollelement: Einfaches `Maßstabs-Kontrollelement <https://leafletjs.com/reference.html#control-scale>`_,
  das den aktuellen Maßstab der Kartenmitte anzeigt.
* Zoom-Kontrollelement: Diese Komponente ermöglicht eine `Kontrolle des Zoomverhaltens
  <https://leafletjs.com/reference.html#control-zoom>`_.


weitere Layer anlegen
.....................

Zum Abschluss können weitere Layer angelegt werden die z. B. fixe Marker anzeigen, deren Daten nicht aus MetaModels
stammen oder weitere Kartentypen. Ist das Layer-Kontrollelement eingerichtet, kann darüber der Frontend Besuchern die Layer ein bzw.
ausschalten.

Ein Layertyp ist der `"Marker Cluster" <https://github.com/Leaflet/Leaflet.markercluster>`_ mit dem mehrere Marker bei
kleinem Zoomlevel zu einem Kreis-Icon mit Angabe der Anzahl dargestellt werden. Nach dem Anlegen des Marker Cluster
werden ein oder mehrere Marker-Layer als Unterebene des Marker-Cluster eingefügt - schon vorhandene Marker-Layer werden
dahin verschoben.

|img_screenshot_09|

Der neue Layer Marker-Cluster muss auch in der Karte unter Layer aktiviert werden.

|img_screenshot_10|

Je nach Zoomlevel werden nahe beieinander liegende Marker zusammen gefasst. Die Farbe des Cluster-Icons richtet sich
nach der `Anzahl der enthaltenen Elemente <https://github.com/Leaflet/Leaflet.markercluster/blob/c0f055bd5dcd1d6a733090d0cf024d7362d77bc8/src/MarkerClusterGroup.js#L824-L831>`_ und
`kann per CSS angepasst werden <https://github.com/Leaflet/Leaflet.markercluster/blob/c0f055bd5dcd1d6a733090d0cf024d7362d77bc8/dist/MarkerCluster.Default.css#L1-L20>`_.
Klickt man auf einen Cluster, wird der Zoom so verändert, dass der Inhalt zu sehen ist.

|img_screenshot_11|


Filterungen aus MM in Karte übernehmen
--------------------------------------

Häufig wird eine Karte in Verbindung mit einer gefilterten MM-Liste eingebaut - dann möchte man natürlich, dass sich die
Filterung auch auf die angezeigten Marker auswirkt.

Die Cowegis bezieht seine Daten für die Generierung der Karte und aller weiterer Elemente nicht direkt über das
Inhaltselement, sondern das Kartenelement holt sich die Daten über einen eigenen Pfad. Dieser Aufruf bekommt aber
von den Filterdaten aus der URL aber nichts mit.

Daher muss aktuell diesem Aufruf die Filterparameter mit auf den Weg gegeben werden. Je nach Finanzierung der Erweiterung
kännte man auch allgemeingültige Aufrufe versuchen - bis dahin muss man selbständig die Parameter über ``map-uri``
übergeben.

Für die Übergabe kann das Template des Cowegis-Content-Elements wie folgt angepasst werden:

.. code-block:: html
   :linenos:

   <!-- templates/ce_cowegis_map.html5 -->
   <?php $this->extend('ce_cowegis_map'); ?>

   <?php $this->block('content') ?>
   <?php
   $params  = [];
   $keyList = ['address', 'address_range'];
   foreach ($keyList as $key) {
     $params[$key] = \Contao\Input::get($key);
   }
   $paramString = http_build_query($params);
   ?>
   <cowegis-map id="<?= $this->mapId ?>" style="<?= $this->mapStyle ?>"
                map-uri="<?= $this->mapUri . '&' . $paramString ?>">
   </cowegis-map>

   <?php $this->endblock() ?>


Individuelle Anpassungen per JavaScript
---------------------------------------

Die Karte kann per JavaScript manipuliert werden z. B. um weitere Marker oder Polygone anzuzeigen. Dabei ist zu beachten,
das bestimmte Aufrufe ggf. vom Cowegis-JavaScript "überschrieben" werden. Das ist z. B. der Fall, wenn bei den
Karteneinstellungen "Grenzen festlegen" eine Option angewählt ist, hat die Methode ``fitBounds()`` keine Auswirkung.

Die Option muss dann in den Einstellungen deaktiviert werden und über das eigene Script erfolgen. Mit dem folgenden
Snippet kann man seine Anpassungen starten.

.. code-block:: html
   :linenos:

   <script>
       const element = document.getElementById("<?= $this->mapId ?>");

       const initializeMarker = function () {
           const map     = element.map;
           const leaflet = element.leaflet;

           // Own code...
       }

       if (element.map) {
           initializeMarker();
       } else {
           element.addEventListener('cowegis:ready', initializeMarker);
       }
   </script>

Ein Beispiel wäre eine Angepasste Anzeige nach einer Umkreissuche mit Anzeige des Suchpunktes und Umkreises.

|img_screenshot_19|


Debuging
--------

Während der Entwicklung bzw. Einrichtung des Layers kann es vorkommen, dass die Karte nicht mehr angezeigt wird. Häufig
besteht der Fehler darin, dass das übermittelte JSON-Array nicht geparst werden kann. In den Dev-Tools des Browsers
ist dann häufig die Meldung ``SyntaxError: JSON.parse: unexpected character at line 1 column 1 of the JSON data``.

In der Netzwerkanalyse sollte der Aufruf an die Cowegis-API zu finden sein - der lautet etwa wie folgt
``https://domain.tld/cowegis/api/map/3?_locale=de&es5=1&=`` wobei die Zahl die ID der Karte ist. Diesen Aufruf kann man
in einen eigenen Tab im Browser öffnen und analysieren.


Umbau von Leaflet-Maps Integration
----------------------------------

Wer von :ref:`Leaflet-Maps Integration <rst_extended_leaflet>` auf Cowegis-Layer umstellt, sollte folgende Punkte
beachten:

* für Lat-/Long-Werte sind bei Einzelangabe als Attributstyp nur noch Dezimal zugelassen (s. o. "MetaModels Daten
  erstellen") - wer vorher die Werte in Attributstyp Text gespeichert hatte, muss
  :ref:`diesen Typ anpassen <rst_cookbook_tips_change_table_column_name>`


Spenden
-------

Ein Dank für die Spenden* für die Erweiterung an:

* `AntwortInternet <https://www.antwortinternet.com/>`_: 200 €
* `P-Kreativ <https://p-kreativ.at/>`_: 200 €
* `Biades <https://biades.de/>`_: 200 €
* `AntwortInternet <https://www.antwortinternet.com/>`_: 200 €
* `External IT Solutions <https://external.at/>`_: 200 €

(*Spenden in Netto)


.. |br| raw:: html

   <br />

.. |img_control| image:: /_img/screenshots/extended/cowegis_layer/control.png
.. |img_copy| image:: /_img/screenshots/extended/cowegis_layer/copy.svg
.. |img_delete| image:: /_img/screenshots/extended/cowegis_layer/delete.svg
.. |img_edit| image:: /_img/screenshots/extended/cowegis_layer/edit.svg
.. |img_layers| image:: /_img/screenshots/extended/cowegis_layer/layers.png
.. |img_marker-icon| image:: /_img/screenshots/extended/cowegis_layer/marker-icon.png
.. |img_map| image:: /_img/screenshots/extended/cowegis_layer/map.png
.. |img_map_1| image:: /_img/screenshots/extended/cowegis_layer/map_1.png
.. |img_metamodels_marker.svg| image:: /_img/screenshots/extended/cowegis_layer/metamodels_marker.svg
.. |img_screenshot_01| image:: /_img/screenshots/extended/cowegis_layer/screenshot_01.png
.. |img_screenshot_02| image:: /_img/screenshots/extended/cowegis_layer/screenshot_02.png
.. |img_screenshot_03| image:: /_img/screenshots/extended/cowegis_layer/screenshot_03.png
.. |img_screenshot_04| image:: /_img/screenshots/extended/cowegis_layer/screenshot_04.png
.. |img_screenshot_05| image:: /_img/screenshots/extended/cowegis_layer/screenshot_05.png
.. |img_screenshot_06| image:: /_img/screenshots/extended/cowegis_layer/screenshot_06.png
.. |img_screenshot_07| image:: /_img/screenshots/extended/cowegis_layer/screenshot_07.png
.. |img_screenshot_08| image:: /_img/screenshots/extended/cowegis_layer/screenshot_08.png
.. |img_screenshot_09| image:: /_img/screenshots/extended/cowegis_layer/screenshot_09.png
.. |img_screenshot_10| image:: /_img/screenshots/extended/cowegis_layer/screenshot_10.png
.. |img_screenshot_11| image:: /_img/screenshots/extended/cowegis_layer/screenshot_11.png
.. |img_screenshot_12| image:: /_img/screenshots/extended/cowegis_layer/screenshot_12.png
.. |img_screenshot_13| image:: /_img/screenshots/extended/cowegis_layer/screenshot_13.png
.. |img_screenshot_14| image:: /_img/screenshots/extended/cowegis_layer/screenshot_14.png
.. |img_screenshot_15| image:: /_img/screenshots/extended/cowegis_layer/screenshot_15.png
.. |img_screenshot_16| image:: /_img/screenshots/extended/cowegis_layer/screenshot_16.png
.. |img_screenshot_17| image:: /_img/screenshots/extended/cowegis_layer/screenshot_17.png
.. |img_screenshot_18| image:: /_img/screenshots/extended/cowegis_layer/screenshot_18.png
.. |img_screenshot_19| image:: /_img/screenshots/extended/cowegis_layer/screenshot_19.png
