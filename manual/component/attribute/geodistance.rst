.. _component_attribute_geodistance:

Geo-Entfernung
==============

Das Attribut "Geo-Entfernung" berechnet bei einer Umkreissuche die geografische
Entfernung zwischen dem gespeicherten Koordinatenpaar eines Items und einem
Suchpunkt. Das Ergebnis ermöglicht die Sortierung von Listen nach Entfernung.
Typische Einsatzbereiche:

* Händler- oder Filialsuche ("Finde alle Händler im Umkreis von 50 km")
* Veranstaltungssuche nach geografischer Nähe
* Sortierung von Ergebnissen nach Entfernung zum Standort des Nutzers

Das Attribut selbst speichert keine eigenen Datenwerte, sondern liest
Koordinaten aus anderen Attributen des MetaModels (Breiten- und Längengrad)
und berechnet die Entfernung auf Anfrage.

.. note:: Das Attribut "Geo-Entfernung" ist eine zusätzliche Erweiterung und
   muss separat über Composer installiert werden
   (``metamodels/attribute_geodistance``).


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Das Attribut bietet folgende spezifische Einstellungen, die in zwei Gruppen
aufgeteilt sind:

**Parameter**

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - GET-Parameter für Adresse
     - Name des URL-GET-Parameters, über den die Suchadresse übergeben wird
       (z. B. ``address``). Pflichtfeld.
   * - Ländervorgabe
     - Legt fest, wie das Land für die Adressauflösung ermittelt wird:

       * **Nichts** – Kein Land wird vorgegeben
       * **Voreinstellung** – Ein festes Land wird als Standard gesetzt
         (Eingabe des Ländercodes im Unterfeld "Vorgabe für Land")
       * **GET-Parameter verwenden** – Das Land wird über einen URL-Parameter
         übergeben (Eingabe des Parameternamens im Unterfeld "GET-Parameter
         für Land")

**Daten**

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Datenmodus
     - Legt fest, wie die Geokoordinaten in den MetaModels-Attributen gespeichert
       sind:

       * **Einzelmodus** – Breitengrad und Längengrad sind in einem einzigen
         Attribut (z. B. vom Typ "Geolocation") kombiniert gespeichert.
         Unterfeld: Auswahl des Attributs.
       * **Multimodus** – Breitengrad und Längengrad sind in zwei separaten
         Attributen gespeichert. Unterfelder: Attribut für Breite (Lat) und
         Attribut für Länge (Lng).
   * - LookUp-Services
     - Mehrspaltiger Assistent zur Konfiguration der Dienste, die eine
       Adresse in Geokoordinaten umwandeln. Verfügbare Dienste (je nach
       Installation):

       * **Koordinaten** – Direkte Koordinateneingabe
       * **Google Maps** – Adressauflösung über die Google Maps API
       * **OpenStreetMap** – Adressauflösung über die Nominatim-API

       Für dienste, die einen API-Token benötigen, kann dieser im Feld
       "API Token" eingetragen werden.


Einstellungen bei den Render-Einstellungen
-------------------------------------------

Das Attribut besitzt keine eigenen Render-Einstellungen. In der Attributliste
einer Render-Einstellung stehen die üblichen Optionen zur Verfügung:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Template
     - Auswahl eines eigenen Templates für die Ausgabe des Entfernungswerts.
   * - CSS-Klasse
     - Optionale CSS-Klasse, die dem Ausgabeelement hinzugefügt wird.


Einstellungen bei der Eingabemaske
------------------------------------

Das Geo-Entfernung-Attribut erscheint nicht als editierbares Eingabefeld in der
Eingabemaske — der Entfernungswert wird dynamisch berechnet und ist schreibgeschützt.


Filterregeln
------------

Das Attribut wird typischerweise zusammen mit der Filterregel "Umkreissuche"
(aus dem Paket ``filter_perimetersearch``) verwendet:

.. list-table::
   :header-rows: 1
   :widths: 30 70

   * - Filterregel
     - Hinweis
   * - Umkreissuche
     - Filtert Items anhand eines geografischen Umkreises um eine eingegebene
       Adresse. Das Geo-Entfernung-Attribut stellt dabei die berechneten
       Entfernungswerte zur Verfügung, nach denen anschließend sortiert werden
       kann.


Sonderfunktionen
-----------------

**Berechnung**

Die Entfernung zwischen Suchpunkt und gespeichertem Koordinatenpaar wird
mit der Haversine-Formel berechnet, die die Erdkrümmung berücksichtigt.
Das Ergebnis steht im Template als Entfernungswert (in km oder Meilen) zur
Verfügung.

**Caching**

Aufgelöste Koordinaten (Adresse → Lat/Lng) werden in der Tabelle
``tl_metamodel_perimetersearch`` zwischengespeichert, um wiederholte
API-Anfragen zu vermeiden.

**Speicherung**

Das Attribut legt keine eigene Spalte in der MetaModel-Tabelle an. Es
liest die Koordinaten aus den konfigurierten Quellattributen und berechnet
die Entfernung zur Laufzeit.

**Sortierung nach Entfernung**

Die berechneten Entfernungswerte können als Sortierkriterium in der
MetaModels-Listensicht verwendet werden, sodass die nächstgelegenen
Ergebnisse oben erscheinen.


.. |br| raw:: html

   <br />
