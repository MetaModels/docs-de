.. _component_searchable-pages:

|img_searchable_pages_32| Indexierungen
=======================================

.. note:: Detailseiten eines MetaModel in der Suche und sitemap.xml von Contao einbinden

Einleitung
----------

Mit den Indexierungen können die Detailseiten eines MetaModel-Renderings (Liste) in das
Frontendmodule der Suche und in die Generierung der sitemap.xml eingebunden werden.

Diese "Sonderbehandlung" der Detailseiten gegenüber den normalen Listenanzeigen ergibt sich aus
dem Seitenaufruf selbiger. Die im Contao-Seitenbaum angelegten Detailseiten müssen immer mit
spezifischen GET- bzw. URL-Routing-Parameter aufgerufen werden, um eine (sinnvolle) Detailseite
mit Werten auszugeben. Die Contao-Funktionen zur Generierung der Suche oder der sitemap.xml
können auf diese Parameter aus MetaModels nicht zurückgreifen und benötigen somit entsprechende
Unterstützung.

Die "normalen Listenansichten" benötigen diese Sonderbehandlung nicht und die Seiten werden
automatisch über die Contao-Funktionen korrekt in die Suche oder Sitemap aufgenommen.

Optionen
--------

* **Name**: |br|
  Bezeichnung für das Backend
* **Filterset**: |br|
  Auswahl des Filtersets für die Detailansicht
* **Render-Einstellungen**: |br|
  Auswahl der Render-Einstellungen für die Detailansicht

Ablauf
------

Eine neue Indexierung kann über das Icon "|img_new| Neue Indexierung" angelegt und die
nach der Eingabe des Namens die Optionen für das Filterset und die Render-Einstellung ausgewählt
werden. Die Indizierung erfolgt über den automatischen Aktualisierungsmechanismus aus Contao oder
über die Neuerstellungen der Systemwartung.


.. |img_searchable_pages_32| image:: /_img/icons/searchable_pages_32.png
.. |img_searchable_pages| image:: /_img/icons/searchable_pages.png
.. |img_new| image:: /_img/icons/new.gif


.. |br| raw:: html

   <br />