.. _rst_extended_erd-viewer:

MetaModels ERD
===============

Zeigt eine automatisch generierte `Entity-Relationship-Grafik
<https://de.wikipedia.org/wiki/Entity-Relationship-Modell>`_ aller MetaModels-Tabellen und ihrer
Beziehungen im Backend an - als Ergänzung zu der unter :ref:`Datenbankstruktur
<component_relations_database_structure>` empfohlenen, von Hand gepflegten Skizze. Die Grafik wird
bei jedem Aufruf frisch aus der Datenbank erzeugt und ist damit immer aktuell.

Die Ansicht ist hilfreich um z. B. bei einem übernommenen Projekt oder an einem Projekt, an dem man
lange nicht gearbeitet hat, schnell den Überblick der vorhanden Tabellen und deren Relationen zu gewinnen.

Es ist zu beachten, dass nicht alle Tabellen aus der Datenbank hier dargestellt werden - z. B. ist beim
Attribut Tags (Mehrfachauswahl) zwischen den beiden verknüpften Tabellen eine Relationstabelle - diese wird nicht
mit in der Grafik dargestellt.


Voraussetzungen
----------------

* ab MetaModels 2.5
* eigenes Composer-Paket, keine Abhängigkeit von anderen Erweiterungen außer MetaModels selbst


Installation per Contao-Manager oder Composer
----------------------------------------------

.. code-block:: bash

   composer require metamodels/erd-viewer


Aufruf
------

Nach der Installation erscheint in der Liste "Alle MetaModels" oben rechts ein zusätzlicher
Menüpunkt "ERD-Ansicht" neben "Neues MetaModel" und "Mehrere bearbeiten".

|img_erd-button|

Der "Zurück"-Pfeil auf der ERD-Seite führt wieder auf genau diese Liste zurück.

Wie die gesamte MetaModel-Administration ist auch die **ERD-Ansicht nur für Admins erreichbar**.


Die Ansicht
-----------

|img_erd-overview|

**Grafik:** Jede MetaModels-Tabelle erscheint als blaues Kästchen, jede referenzierte
Contao-Tabelle (z. B. ``tl_member`` oder ``tl_page``), die selbst kein MetaModel ist, als
graues, gestricheltes Kästchen mit dem Zusatz "extern". Ein Klick auf ein Kästchen öffnet rechts
ein Detail-Panel mit dem MetaModel-Namen, Eltern-/Kindbeziehung und der vollständigen
Attributliste; gleichzeitig werden alle nicht direkt verbundenen Kästchen abgeblendet. Escape
oder ein Klick daneben hebt das wieder auf.

Dargestellt werden zwei Arten von Beziehungen:

* **Attribut-Beziehungen** über die Attribute Auswahl, Tags sowie deren übersetzte Varianten
  (Einzelauswahl, Mehrfachauswahl) - beschriftet mit dem Attributnamen und der Kardinalität in
  eckigen Klammern: ``[1:n]`` für Auswahl/Übersetzte Auswahl, ``[m:n]`` für Tags/Übersetzte Tags.
* **Eltern-Kind-Beziehungen** (:ref:`Kind-Tabellen <component_relations_child-tables>`) als
  gestrichelter, orangener Pfeil mit der Beschriftung "Kind von [n:1]".

**Filter:** Über das Suchfeld oder die Checkbox-Liste links lässt sich die Grafik auf einen
Ausschnitt der Tabellen einschränken - beides wirkt gemeinsam und live auf die Grafik. Die
Schaltflächen "Alle"/"Keine" setzen alle Haken auf einmal.

**Ansichten:** Eine gerade eingestellte Tabellenauswahl lässt sich unter einem selbstgewählten
Namen speichern. Gespeicherte Ansichten sind **für alle Admins im Backend** sichtbar und nutzbar,
mit Klick auf den Namen anwendbar und über das "×" daneben für den **erstellenden Benutzer** wieder löschbar.

**Pan/Zoom:** Mit dem Mausrad wird gezoomt, bei gedrückter Maustaste im leeren Bereich verschoben
(Cursor wird zur Hand); zusätzlich stehen Zoom-Buttons und ein "Alles zurücksetzen"-Symbol zur
Verfügung. Die Übersichtskarte oben rechts zeigt den kompletten Graphen samt einem Rahmen für den
aktuell sichtbaren Ausschnitt.

**Export:** Der aktuell sichtbare Kartenausschnitt lässt sich als SVG oder PNG herunterladen, die
aktuell gefilterte Tabellenauswahl zusätzlich als Graphviz-``.dot``-Datei oder als GraphML.

.. tip:: Die GraphML-Datei lässt sich kostenlos und ohne Installation in `yEd Live
   <https://www.yworks.com/yed-live/>`_ öffnen und dort frei weiterbearbeiten - z. B. für ein
   sauber von Hand nachjustiertes Layout oder eine Dokumentation außerhalb des Backends.


.. |img_erd-button| image:: /_img/screenshots/extended/erd-viewer/erd-button.png
.. |img_erd-overview| image:: /_img/screenshots/extended/erd-viewer/erd-overview.png
