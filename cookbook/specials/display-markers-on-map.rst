Standorte als Marker auf einer Google-Map ausgeben
===================================================

Ziel
----
Auf einer Seite sollen die (ggf. gefilterten) Einträge eines MetaModels (z. B. Dienstleister) als Marker auf einer Google-Karte dargestellt werden.
Die Geo-Koordinaten wurden dabei bereits in den Feldern ``latitude`` und ``longitude`` gespeichert (siehe :doc:`geocode-address-on-save`).

Voraussetzungen
---------------
* Contao 5.3 mit MetaModels 2.4, ebenfalls erfolgreich mit Contao 4.13 und MetaModels 2.3 getestet.
* Google Maps API-Key für Kartenanzeige → ``API_KEY_WEBSITE`` (Anwendung: Websites; API: Maps JavaScript API)
* MetaModels-Template mit Zugriff auf ``latitude``, ``longitude`` und optional individuellen Feldern wie z. B. ``name``

Die Ausgabe erfolgt im MetaModels-Template, als Grundlage nutze ich ``metamodel_prerendered.html5``. Dabei handelt es sich um das Template, mit dem die MetaModels-Liste im Frontend ausgegeben wird.

Marker vorbereiten
------------------
Im Template wird zunächst ein Array mit allen Koordinaten erstellt:

.. code-block:: php

  <?php $markers = []; ?>
  <?php foreach ($this->data as $arrItem): ?>
    <?php
      if (!empty($arrItem['text']['latitude']) && !empty($arrItem['text']['longitude'])) {
          $markers[] = [
              'lat' => (float) $arrItem['text']['latitude'],
              'lng' => (float) $arrItem['text']['longitude'],
              'title' => htmlspecialchars($arrItem['text']['name'], ENT_QUOTES, 'UTF-8'),
          ];
      }
    ?>
    <?php //Weitere Listen-Ausgaben … ?>
  <?php endforeach; ?>

Map einbinden
-------------
Die Map wird im gleichen Template ausgegeben, nach der foreach-Schleife. Der verwendete API-Key muss für die Kartenanzeige im Frontend freigegeben sein (API_KEY_WEBSITE). Hier ein minimales Beispiel:

.. code-block:: html

      <div class="dienstleister-map">
      <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBkOCCggA1fsmogpSjk-rxUEQv6uQYQFyc&callback=initMap&language=de&region=DE"></script>

      <div id="map" style="height: 400px; width: 100%;"></div>

      <script>
        function initMap() {
          const mapOptions = {
            center: { lat: 52.553807, lng: 13.405007 }, // Standard für Berlin
            zoom: 10,
            zoomControl: true,
            streetViewControl: true,
            mapTypeControl: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: [
              {
                "featureType": "poi.business",
                "stylers": [
                  { "visibility": "off" }
                ]
              },
              {
                "featureType": "poi.park",
                "elementType": "labels.text",
                "stylers": [
                  { "visibility": "off" }
                ]
              }
            ]
          };

          const map = new google.maps.Map(document.getElementById("map"), mapOptions);
          var markers = <?php echo json_encode($markers, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;

          var bounds = new google.maps.LatLngBounds();
          var infowindow = new google.maps.InfoWindow();
          var minZoom = 11;

          if (markers.length === 0) {
            map.setCenter({ lat: 52.553807, lng: 13.405007 });
            map.setZoom(minZoom);
            return;
          }

          markers.forEach(function(markerData) {
            let marker = new google.maps.Marker({
              position: { lat: markerData.lat, lng: markerData.lng },
              map: map,
              title: markerData.title,
              clickable: true
            });

            marker.addListener("click", function() {
              let content = "<strong>" + markerData.title + "</strong>";
              if (markerData.website) {
                content += "<br>" + markerData.website;
              }
              infowindow.setContent(content);
              infowindow.open(map, marker);
            });

            bounds.extend(marker.position);
          });

          map.fitBounds(bounds);

          google.maps.event.addListenerOnce(map, 'zoom_changed', function() {
            if (map.getZoom() > minZoom) {
              map.setZoom(minZoom);
            }
          });
        }
      </script>
    </div>

Hinweise
--------
* Für eine datenschutzkonforme Nutzung sollte die Karte über ein Consent-Tool eingebunden werden.
