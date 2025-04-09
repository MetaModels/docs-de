===============================================
Automatisches Erzeugen und Speichern von Koordinaten
===============================================

Einleitung
----------
Diese Anleitung beschreibt, wie in einer MetaModels-Installation automatisch Koordinaten aus Adressdaten erzeugt und gespeichert werden können.

Voraussetzungen
---------------
* Contao 5.3 mit MetaModels 2.4, ebenfalls erfolgreich mit Contao 4.13 und MetaModels 2.3 getestet.
* Google Maps API-Key für Koordinaten-Erstellung → ``API_KEY_SERVER`` (Anwendung: IP-Adressen; API: Geocoding API)
* Felder im MetaModel: ``strasse``, ``plz``, ``ort``, ``latitude``, ``longitude``
* Die Felder ``latitude`` und ``longitude`` sind vom Typ "Dezimal" (metamodels/attribute_decimal)

Schritt 1: Anlegen des EventListeners
---------------------------------------
Erstellen der Datei ``src/EventListener/PrePersistModelEventListener.php`` mit folgendem Inhalt.
Achtung: ``API_KEY_SERVER`` muss durch den entsprechenden API-Schlüssel ersetzt werden.

.. code-block:: php

  <?php
  // src/EventListener/PrePersistModelEventListener.php
  namespace App\EventListener;
  
  use ContaoCommunityAlliance\DcGeneral\Event\PrePersistModelEvent;
  use App\Service\GoogleMaps;
  
  class PrePersistModelEventListener {
    public function __invoke(PrePersistModelEvent $event) {
      $model = $event->getModel();
      if (!$model->getProperty('latitude') || !$model->getProperty('longitude')) {
        $strasse = $model->getProperty('strasse');
        $plz = $model->getProperty('plz');
        $ort = $model->getProperty('ort');
        $address = $strasse . ', ' . $plz . ' ' . $ort;
        $googleMaps = new GoogleMaps();
        $apiToken = ‚API_KEY_SERVER‘;
        $coordinates = $googleMaps->getCoordinates($address, $apiToken);
        if ($coordinates !== null) {
          $model->setProperty('latitude', $coordinates->getLatitude());
          $model->setProperty('longitude', $coordinates->getLongitude());
        }
      }
    }
  }

Schritt 2: Anlegen der GoogleMaps-Klasse
-----------------------------------------
Erstellen der Datei ``src/Service/GoogleMaps.php`` mit folgendem Inhalt:

.. code-block:: php

  <?php
  // src/Service/GoogleMaps.php
  namespace App\Service;
  
  use App\Service\Coordinates;
  
  class GoogleMaps {
    public function getCoordinates($address, $apiKey) {
      $url = sprintf('https://maps.googleapis.com/maps/api/geocode/json?address=%s&key=%s', urlencode($address), $apiKey);
      $response = file_get_contents($url);
      $data = json_decode($response);
      if ($data->status === 'OK') {
        $loc = $data->results[0]->geometry->location;
        return new Coordinates($loc->lat, $loc->lng);
      }
      return null;
    }
  }

Schritt 3: Anlegen der Coordinates-Klasse
-------------------------------------------
Erstellen der Datei ``src/Service/Coordinates.php`` mit folgendem Inhalt:

.. code-block:: php

  <?php
  // src/Service/Coordinates.php
  namespace App\Service;
  
  class Coordinates {
    private $lat;
    private $lng;
    public function __construct($lat, $lng) {
      $this->lat = $lat;
      $this->lng = $lng;
    }
    public function getLatitude() {
      return $this->lat;
    }
    public function getLongitude() {
      return $this->lng;
    }
  }

Schritt 4: Registrieren des EventListeners
--------------------------------------------
Erstellen oder bearbeiten der Datei ``src/Resources/config/service.yml``:

.. code-block:: yaml

  # src/Resources/config/service.yml
  services:
    App\EventListener\PrePersistModelEventListener:
      public: true
      tags:
        - { name: kernel.event_listener, event: dc-general.model.pre-persist }

Sicherstellen, dass diese Datei in die Hauptkonfiguration eingebunden ist, z. B. in ``config/services.yaml``:

.. code-block:: yaml

  # config/services.yaml
  imports:
    - { resource: '../src/Resources/config/service.yml' }


Testen
-------
Einen bestehenden Datensatz im Back-End bearbeiten, die Felder ``strasse``, ``plz`` und ``ort`` ausfüllen und die Felder ``latitude`` und ``longitude`` leer lassen. Beim Speichern erfolgt die automatische Generierung der Koordinaten.

Hinweise
--------

* Der ``PrePersistModelEvent`` wird nur bei geänderten Datensätzen ausgelöst.
* Für serverseitige Geocoding-Anfragen muss der API-Schlüssel auf die Server-IP freigeschaltet sein.
* Für die Anzeige der Karte wird ein separater, auf Websites beschränkter API-Schlüssel benötigt.
* Wie die gespeicherten Koordinaten auf einer Karte als Marker angezeigt werden können, ist unter :doc:`Display Markers on Map <display-markers-on-map>` beschrieben. `Contao <https://www.contao.org>`_
