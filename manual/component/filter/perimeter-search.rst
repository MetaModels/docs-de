.. _component_filter_perimeter-search:

|img_filter_perimetersearch| Umkreissuche
==========================================

Die Filterregel "Umkreissuche" (Paket ``filter_perimetersearch``) filtert Items anhand
ihrer geografischen Position. Besucher geben eine Adresse oder Koordinaten ein und
wählen einen Suchradius; die Filterregel ermittelt alle Items, deren Geokoordinaten
(Latitude/Longitude) innerhalb des angegebenen Umkreises liegen.

Voraussetzung ist, dass die Items Geokoordinaten in zwei separaten Dezimal-Attributen
(Latitude und Longitude) gespeichert haben. Für die Geocodierung von Adressen in
Koordinaten werden externe Lookup-Dienste verwendet (z. B. OpenStreetMap/Nominatim,
Google Maps API).

.. seealso:: Detaillierte Dokumentation zur Umkreissuche:
   :ref:`extended_perimetersearch`


Einstellungen beim Anlegen der Filterregel
------------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - Typ
     - Auswahl des Filterregeltyps – hier: "Umkreissuche".
   * - Aktiviert
     - Aktiviert oder deaktiviert diese Filterregel.
   * - Kommentar
     - Freitextfeld zur Beschreibung des Zwecks dieser Filterregel.
   * - Datenmodus
     - Legt fest, wie die Geokoordinaten der Items gespeichert sind:

       * **Einzelnes Attribut** – Die Koordinaten sind in einem einzigen kombinierten
         Attribut gespeichert (z. B. "lat,long" als Text). Zusätzliche Option:
         **Attribut (Einzeln)** – Auswahl des Attributs.
       * **Zwei Attribute** – Latitude und Longitude sind in zwei separaten
         Attributen gespeichert. Zusätzliche Optionen:
         **Erstes Attribut (Lat)** und **Zweites Attribut (Long)**.
   * - URL-Parameter
     - Der Schlüssel (Key) des URL-Parameters für die Adress-/Koordinateneingabe.


Einstellungen für das Frontend-Widget
--------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - Label
     - Beschriftung des Adress-Eingabefelds.
   * - Platzhalter
     - Platzhaltertext im Adress-Eingabefeld.
   * - Template (Adressfeld)
     - Template für die Ausgabe des Adress-Eingabefelds.
   * - Label (Umkreis)
     - Beschriftung des Umkreis-Auswahl-Widgets.
   * - Template (Umkreis)
     - Template für die Ausgabe des Umkreis-Widgets. Standard: ``mm_filteritem_default``.
   * - Umkreismodus
     - Legt fest, wie der Suchradius bestimmt wird:

       * **Frei** – Der Besucher gibt den Radius als Zahlenwert ein. Zusätzliche
         Option: **Platzhalter (Umkreis)**.
       * **Vorgabe** – Ein fester Radius wird verwendet. Zusätzliche Option:
         **Radius-Vorgabe** (Kilometerwert).
       * **Auswahl** – Der Besucher wählt aus einer vordefinierten Liste von Radien.
         Zusätzliche Option: **Radius-Auswahl** (MCW-Tabelle mit Wert und Standard-Flag).
   * - Ländermodus
     - Legt fest, ob und wie ein Land für die Geocodierung vorgegeben wird:

       * **Kein Land** – Kein Länderfilter.
       * **Vorgabe** – Festes Land (ISO-Code). Zusätzliche Option: **Land-Vorgabe**.
       * **GET-Parameter** – Das Land wird über einen URL-Parameter übergeben.
         Zusätzliche Option: **Land-GET-Parameter**.
   * - Lookup-Dienst
     - Konfiguration des Geocodierungsdienstes (MCW-Tabelle):

       * **Dienst** – Auswahl des Geocodierungsdienstes (z. B. Nominatim, Google Maps).
       * **API-Token** – Optionaler API-Schlüssel für kostenpflichtige Dienste.


Passende Attribute
------------------

Die Filterregel "Umkreissuche" benötigt Geokoordinaten in Dezimalform:

* :ref:`Dezimal <component_attribute_decimal>` (für Latitude und Longitude separat)

Zusätzlich kann das Attribut :ref:`Geo-Entfernung <component_attribute_geodistance>`
für die Anzeige und Sortierung nach Entfernung verwendet werden.


.. |img_filter_perimetersearch| image:: /_img/icons/filter_default.png

.. |br| raw:: html

   <br />
