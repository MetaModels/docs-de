.. _component_searchable-pages:

|img_searchable_pages| Seitensuche
==================================

.. note:: Detailseiten eines MetaModel in der Suche, Sitemap und sitemap.xml von Contao einbinden

Einleitung
----------

Mit der Seitensuche können die Detailseiten eines MetaModel-Renderings (Liste)in die
Suche und Sitemap der Frontendmodule und in die Generierung der sitemap.xml eingebunden werden.

Diese "Sonderbehandlung" der Detailseiten gegenüber den normalen Listenanzeigen ergibt sich aus
dem Seitenaufruf selbiger. Die im Contao-Seitenbaum angelegten Detailseiten müssen immer mit
spezifischen GET- bzw. URL-Routing-Parameter aufgerufen werden, um eine (sinnvolle) Detailseite
mit Werten auszugeben. Die Contao-Funktionen zur Generierung der Suche oder der Sitemap können
auf diese Parameter aus MetaModels nicht zurückgreifen und benötigen somit entsprechende
Unterstützung.

Die "normalen Listenansichten" benötigen diese Sonderbehandlung nicht und die Seiten werden
automatisch über die Contao-Funktionen orrekt in die Suche oder Sitemap aufgenommen.

Optionen
--------

* **Name**: |br|
  Bezeichnung für das Backend
* **Filtersetting**: |br|
  Auswahl des Filters für die Detailansicht
* **Rendersetting**: |br|
  Auswahl der Renderingeinstellungen für die Detailansicht

Ablauf
------

Eine neue Seitensuche kann über das Icon "|img_new| New searchable page" angelegt und die
nach der Eingabe des Namens die Optionen für den Filter und das Rendering ausgewählt werden.
Die Indizierung erfolgt über den automatischen Aktualisierungsmechanismus aus Contao oder über
die Neuerstellungen über die Systemwartung.


.. |img_searchable_pages| image:: /_img/searchable_pages.png
.. |img_new| image:: /_img/new.gif


.. |br| raw:: html

   <br />