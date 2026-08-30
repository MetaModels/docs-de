.. _component_attribute_latlong:

|svg_attr_latlong_22| LatLong (ab MM 2.5)
=======================================================

Das Attribut "LatLong" speichert ein Koordinatenpaar (Breiten- und Längengrad) in einer
einzigen Spalte vom nativen MySQL/MariaDB-Datentyp ``POINT``. Im Gegensatz zu zwei
separaten Dezimal-Attributen oder einem Text-Attribut mit kommaseparierten Werten steht
damit ein echter räumlicher Spaltentyp zur Verfügung, auf dem die Datenbank bei Bedarf
einen räumlichen Index anlegen kann.

Typische Einsatzbereiche:

* Speicherung des Standorts eines Datensatzes (Filiale, Veranstaltungsort, Marker auf einer Karte)
* Grundlage für eine :ref:`Umkreissuche <component_filter_perimeter-search>` oder das Attribut
  :ref:`Geo-Entfernung <component_attribute_geodistance>`
* Marker-Position bei der :ref:`Cowegis-Layer Integration <extended_cowegis-layer-marker>`

.. seealso::

   * :ref:`component_filter_perimeter-search`
   * :ref:`component_attribute_geodistance`
   * :ref:`extended_cowegis-layer-marker`


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_latlong


Einstellungen beim Anlegen des Attributs
-----------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Räumlichen Index anlegen
     - Legt einen ``SPATIAL INDEX`` auf der Spalte an, damit Abfragen (z. B. die
       :ref:`Umkreissuche <component_filter_perimeter-search>`) ihn für eine deutlich schnellere
       Umkreissuche nutzen können - siehe :ref:`Sonderfunktionen <component_attribute_latlong_special>`
       unten. Setzt voraus, dass die Spalte ``NOT NULL`` ist - das Attribut wird deshalb automatisch
       zur Pflichtangabe, sowohl beim Speichern eines Datensatzes als auch sichtbar bei der
       Eingabemaske (siehe unten). Ist ein Attribut bereits mit leeren Werten befüllt, schlägt das
       Aktivieren fehl, bis diese aufgefüllt sind.


Einstellungen bei den Render-Einstellungen
-------------------------------------------

Das Attribut besitzt keine eigenen Render-Einstellungen. In der Attributliste einer
Render-Einstellung stehen die üblichen Optionen zur Verfügung:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Template
     - Auswahl eines eigenen Templates für die Ausgabe des Koordinatenpaares.
   * - CSS-Klasse
     - Optionale CSS-Klasse, die dem Ausgabeelement hinzugefügt wird.


Einstellungen bei der Eingabemaske
------------------------------------

In der Eingabemaske erscheinen standardmäßig zwei Felder nebeneinander (Breite, Länge). Ist
"Räumlichen Index anlegen" beim Attribut aktiviert, ist das Feld zusätzlich als Pflichtfeld
markiert - das ist nicht änderbar, solange der Index aktiv ist.

**Adressermittlung über das Geocode-Widget**

Ist das Paket `cowegis/cowegis-contao-geocode-widget-bundle
<https://github.com/cowegis/cowegis-contao-geocode-widget-bundle>`_ installiert, steht bei der
Eingabemaske eine zusätzliche Legende zur Verfügung, mit der die manuelle Koordinateneingabe durch
eine Adresssuche mit Kartenauswahl ersetzt bzw. ergänzt werden kann:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Feld-Layout
     - Legt unabhängig von der Adressermittlung fest, ob die Koordinaten in zwei getrennten Feldern
       (Breite, Länge - Standard) oder in einem einzelnen Feld als kommaseparierter Wert
       (``Breite,Länge``) angezeigt werden.
   * - Koordinaten anhand einer Adresse ermitteln |br| (Cowegis Geocode-Widget notwendig)
     - Fügt ein Popup mit Adresssuche und Karte hinzu, über das sich die Koordinaten anhand einer
       eingegebenen Adresse ermitteln und auf der Karte anpassen lassen (``submitOnChange`` - blendet
       die folgenden Optionen sofort ein).
   * - Attribut Straße / Hausnummer / |br| Postleitzahl / Ort / Land
     - Auswahl der Attribute desselben MetaModels, aus deren Werten die Suchanfrage für die
       Adressermittlung zusammengesetzt wird. Alle fünf Felder sind optional und unabhängig
       voneinander wählbar - es muss mindestens eines ausgefüllt sein, damit das Popup erscheint.
   * - Kachelserver-URL (optional) |br| Kartenquellenangabe (optional)
     - Beide Felder können leer bleiben - dann verwendet das Widget seinen eigenen
       Standard-Kachelserver samt Quellenangabe. Nur auszufüllen, wenn ein anderer Kartenanbieter
       verwendet werden soll (z. B. wegen dessen Nutzungsbedingungen für den eigenen Datenverkehr).

.. note:: Das Geocode-Widget ist ein eigenständiges, von MetaModels unabhängiges Paket - siehe
   dessen `Dokumentation <https://github.com/cowegis/cowegis-contao-geocode-widget-bundle>`_ für
   weitere Details zur Bedienung des Popups.


Filterregeln
------------

.. list-table::
   :header-rows: 1
   :widths: 30 70

   * - Filterregel
     - Hinweis
   * - :ref:`Umkreissuche <component_filter_perimeter-search>`
     - Beim "Datenmodus" der Filterregel steht die Option "Einzelnes Attribut" zur Verfügung - dort
       ist ausschließlich ein Attribut vom Typ LatLong wählbar. Ist auf dem Attribut ein räumlicher
       Index angelegt, wird dieser für die Umkreissuche automatisch genutzt.


.. _component_attribute_latlong_special:

Sonderfunktionen
-----------------

**Speicherformat**

Die Koordinaten werden als natives ``POINT`` gespeichert (WKB-Binärformat inkl. SRID), nicht als
zwei Dezimalwerte oder als Text. Damit stehen alle räumlichen Funktionen von MySQL/MariaDB (z. B.
``ST_Distance_Sphere()``, ``ST_X()``, ``ST_Y()``) direkt auf der Spalte zur Verfügung.

**Performance mit räumlichem Index**

Ein einfaches ``WHERE ST_Distance_Sphere(...) <= x`` kann grundsätzlich **keinen** räumlichen Index
nutzen - die Umkreissuche kombiniert deshalb bei aktiviertem Index einen groben,
indexfähigen Bounding-Box-Vorfilter (``MBRContains``) mit der exakten
``ST_Distance_Sphere()``-Berechnung. Gemessen an einer Tabelle mit 500.000 Datensätzen und einer
50-km-Umkreissuche (Median aus 5 Läufen):

.. list-table::
   :header-rows: 1
   :widths: 50 25 25

   * - Variante
     - Zeit
     - Faktor
   * - Alt: Haversine-Näherung, zwei separate Dezimal-Attribute, kein Index
     - 0,402 s
     - Basis
   * - Neu: ``ST_Distance_Sphere()``, LatLong-Attribut ohne Index
     - 0,181 s
     - ~2,2× schneller
   * - Neu: ``ST_Distance_Sphere()`` + Bounding-Box-Vorfilter + räumlicher Index
     - 0,014 s
     - ~28× schneller

Die Formel-Umstellung allein bringt bereits gut das Doppelte, der räumliche Index mit
Bounding-Box-Vorfilter obendrauf nochmal etwa das 13-fache.


.. |svg_attr_latlong_22| image:: /_img/icons_svg/latlong.svg
   :width: 22px

.. |br| raw:: html

   <br />
