.. _rst_extended_leaflet:

Leaflet-Maps Integration
########################

Mit der Leaflet-Maps Integration wird die Darstellung von MetaModels in der Erweiterung `netzmacht/contao-leaflet-maps`_ ermöglicht.

.. note:: Diese Dokumentation beszieht sich ausschließlich auf Contao 4, auch wenn die Erweiterung auch für Contao 3.5. bereitgestellt wird.


Funktionen
----------

 * MetaModels Item als Marker auf Karte rendern
 * Im MetaModels Item Layer referenzieren und auf der Karte darstellen
 * Im MetaModels Item GeoJson-Dateien verlinken und auf der Karte darstellen
 * Attribut Leaflet-Karte: Direkt eine Karte im MetaModels Item rendern


Voraussetzungen
---------------

Contao 4
~~~~~~~~

 - min. Contao 4.4
 - MetaModels 2.1
 - `netzmacht/contao-leaflet-maps`_ 3.0
 - min. PHP 7.1
 - min. Symfony 3.4

Contao 3.5
~~~~~~~~~~

*(Bugfixsupport auslaufend im Mai 2019)*

 - MetaModels 2.0
 - `netzmacht/contao-leaflet-maps`_ 2.0
 - min. PHP 5.4

Installation
------------

Über Composer/Contao Manager lässt sich `netzmacht/contao-leaflet-metamodels`_ in der Version **~3.0.0-beta1** *(Stand 08.02.2019)* installieren.


MetaModel auf Karte integrieren
-------------------------------

In dieser Anleitung wird gezeigt, wie man ein MetaModels, welches Geokoordinaten besitzt, auf einer Karte von Leaflet für Contao dargestellt werden kann.


Koordinaten-Attribute
~~~~~~~~~~~~~~~~~~~~~

Die Geokoordinaten können als getrennte Attribute oder in einem Attribut (Latitude und Longitude mit komma getrennt) im MetaModel definiert werden. Als Attributstyp
eignet sich z.B. ein einfaches Textattribut.

.. figure:: /_img/screenshots/extended/leaflet/mm_attribute.png
   :alt: Attribute im MetaModel

   Attribute Latitude und Longitude im MetaModel

.. _netzmacht/contao-leaflet-maps: https://github.com/netzmacht/contao-leaflet-maps
.. _netzmacht/contao-leaflet-metamodels: https://github.com/netzmacht/contao-leaflet-metamodels


MetaModels Layer anlegen
~~~~~~~~~~~~~~~~~~~~~~~~

Als nächsten Schritt legen wir unter Karten-Layer einen neuen Layer vom Typ "MetaModels" an. Folgende Einstellungen sind
hier vorzunehmen:

 * **Typ** MetaModel auswählen
 * **MetaModel** Das gewünschte MetaModel
 * **Bounds relation** Legt fest, welche Abhängigkeiten zwischen den Elementen des Layers und den Kartengrenzen bestehen soll. Wir stellen wir *extend* ein. Die Kartengrenzen werden durch die definierten Marker also erweitert.
 * **Anzuwendende Filtereinstellung** Hier wird wie bei MetaModels gewohnt eine Filtereinstellung ausgewählt, die die anzuzeigenden Items beeinflusst

.. figure:: /_img/screenshots/extended/leaflet/leaflet_layer.png
   :alt: Konfiguration des Layers MetaModels

   Konfiguration des Layers MetaModels


MetaModels Layer Renderer anlegen
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Als nächstes Schritt müssen wir definieren, wie das MetaModels Item auf der Karte dargestellt werden soll. Wie eingangs erwähnt, möchten wir diese als Marker darstellen. Dazu können nun über das Bearbeiten-Icon des Karten-Layers *Renderer* angelegt werden.

.. figure:: /_img/screenshots/extended/leaflet/leaflet_layer_2.png
   :alt: Übersicht der Karten-Layer

   Übersicht der Karten-Layer

In der Ansicht können neue Renderer definiert werden. Folgende Einstellungen sind
hier vorzunehmen:

 * **Typ** Hier wählen wir *marker* aus, da die MetaModel Items ja als Marker dargestellt werden sollen
 * **Koordinaten** Hier wählen wir *separate* aus, da die Werte für Latitude und Longitude in separaten Attributen vorliegen
 * **Breite-Attribut** Hier wälen wir das Attribut für *Latitude* aus
 * **Länge-Attribut** Hier wälen wir das Attribut für *Longitude* aus
 * **Rendererinstellung aktivieren** Nun aktivieren wir die Rendereinstellung
 * **Verzögertes Laden** Bei größeren Listen empfiehlt sich das dynamische Nachladen der Kartendaten über eine API. Sie werden also nicht direkt als Javascript gerendert

Zusätzlich zu der Grundkonfiguration, kann das MetaModel auch als Popup zum Marker hinzugefügt werden. Hier werden zwei
Modi unterstützt:

 * **render** Eine Rendereinstellung wird ausgewählt und gerendert
 * **attribute** Es wird nun ein Attribut gerendert. Auch hierfür muss eine Rendererinstellung ausgewählt werden

Weiterhin ist es möglich die Darstellung als Icon zu beeinflussen. Hier kann eines der vordefinierten Icons ausgewählt werden. Alterantiv kann auch über ein MetaModels-Attribut ein Icon bestimmt werden.

.. figure:: /_img/screenshots/extended/leaflet/layer_renderer.png
   :alt: Einstellung des Renderers

   Einstellung des Renderers


Layer in Karte aktivieren
~~~~~~~~~~~~~~~~~~~~~~~~~

Als letzten Schritt müssen wir den Layer noch einer Karte zuweisen, sodass dieser dargestellt wird. Dies kann über die Standardlayer einer Karte erfolgen.

Außerdem aktivieren wir bei der Funktion *Grenzen festlegen* die Optionen *bei Karteninitialisierung* und
 *Nach dem Laden des verzögerten Features* sodass unsere Karte nun dynamisch den Bereich anzeigt, indem die Marker existieren.

.. figure:: /_img/screenshots/extended/leaflet/leaflet_map.png
   :alt: Karteneinstellungen

   Karteneinstellungen

.. note:: Ist auf der Seite nun ein Filter eingebunden, der die oben ausgewählte Filtereinstellung bedient, wir die Kartenansicht entsprechend gefiltert.
