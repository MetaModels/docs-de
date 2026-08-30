.. _component_filter_perimeter-search:

|svg_filt_perimeter_search_22| |img_filter_perimetersearch| Umkreissuche
========================================================================

Die Filterregel "Umkreissuche" (Paket ``filter_perimetersearch``) filtert Items anhand
ihrer geografischen Position. Besucher geben eine Adresse oder Koordinaten ein und
wählen einen Suchradius; die Filterregel ermittelt alle Items, deren Geokoordinaten
(Latitude/Longitude) innerhalb des angegebenen Umkreises liegen.

Voraussetzung ist, dass die Items ihre Geokoordinaten entweder in einem einzelnen
:ref:`LatLong-Attribut <component_attribute_latlong>` oder in zwei separaten Dezimal-Attributen
(Latitude und Longitude) gespeichert haben. Für die Geocodierung von Adressen in Koordinaten werden
externe Lookup-Dienste verwendet (z. B. OpenStreetMap/Nominatim, Google Maps API).

.. seealso:: Detaillierte Dokumentation zur Umkreissuche:
   :ref:`extended_perimetersearch`

.. note:: **Ab MM 2.5:** Wird das Adressfeld geleert, verschwindet auch die zuvor gewählte
   Umkreisauswahl aus dem Widget - vorher blieb sie sichtbar stehen, obwohl sie ohne Adresse
   keine Wirkung mehr hatte (`Issue #31
   <https://github.com/MetaModels/filter_perimetersearch/issues/31>`_). In MM 2.4 bleibt das
   bisherige Verhalten bestehen.

.. note:: **Ab MM 2.5:** Wird ein :ref:`LatLong-Attribut <component_attribute_latlong>` mit
   aktiviertem räumlichen Index verwendet (Einzelnes Attribut), nutzt die Umkreissuche automatisch
   einen indexgestützten Bounding-Box-Vorfilter - je nach Datenmenge ein Vielfaches schneller als
   ohne Index. Details und Benchmark-Zahlen: :ref:`Sonderfunktionen beim LatLong-Attribut
   <component_attribute_latlong_special>`.


Installation
------------

Die Filterregel wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/filter_perimetersearch


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

       * **Einzelnes Attribut** – Die Koordinaten sind in einem einzigen
         :ref:`LatLong-Attribut <component_attribute_latlong>` gespeichert. Zusätzliche Option:
         **Attribut (Einzeln)** – Auswahl des Attributs (nur LatLong-Attribute wählbar).
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
   * - URL-Parameter
     - Der Schlüssel (Key) des URL-Parameters für die Übergabe des Filterwerts.
       Ohne Angabe wird der Spaltenname des Attributs verwendet. Mit ``auto_item``
       wird nur der Wert – ohne Schlüssel – in die URL eingebaut.
   * - URL-Typ für den Parameter
     - Legt fest, ob der Parameter als Slug (sprechende URL), als GET-Parameter übergeben wird (ab MM 2.4) - :ref:`siehe
       SEO <rst_cookbook_tips_seo_filter-url>`
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

Je nach gewähltem Datenmodus benötigt die Filterregel "Umkreissuche" eines der folgenden Attribute:

* :ref:`LatLong <component_attribute_latlong>` (Einzelnes Attribut – empfohlen, unterstützt einen
  räumlichen Index für eine deutlich schnellere Umkreissuche)
* :ref:`Dezimal <component_attribute_decimal>` (Zwei Attribute – für Latitude und Longitude separat)

Zusätzlich kann das Attribut :ref:`Geo-Entfernung <component_attribute_geodistance>`
für die Anzeige und Sortierung nach Entfernung verwendet werden.


.. |svg_filt_perimeter_search_22| image:: /_img/icons_svg/filter_perimetersearch.svg
   :width: 22px
.. |img_filter_perimetersearch| image:: /_img/icons/filter_default.png

.. |br| raw:: html

   <br />
