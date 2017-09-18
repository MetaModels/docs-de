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

Zu beachten ist, dass von Contao URLs mit bestimmten Schlüsselwörtern als "Keys" wie `id`, `file`,
`year` usw. nicht indiziert werden; z.B. als URL details/id/meine-details-123.html - die Schlüsselwörter
sind im Array `$GLOBALS['TL_NOINDEX_KEYS'] <https://github.com/contao/core/blob/master/system/modules/core/config/config.php#L419>`_
aufgeführt.

Optionen
--------

* **Name**: |br|
  Bezeichnung für das Backend
* **Filterset**: |br|
  Auswahl des Filtersets für die Listenansicht der Render-Einstellung
* **Render-Einstellungen**: |br|
  Auswahl der Render-Einstellungen für die Listenansicht, die auch zur Detailansicht führt

Ablauf
------

Eine neue Indexierung kann über das Icon "|img_new| Neue Indexierung" angelegt und die
nach der Eingabe des Namens die Optionen für das Filterset und die Render-Einstellung ausgewählt
werden. Render-Einstellung und Filterset sind üblicher Weise die Gleichen, wie sie für das
CE/Modul MetaModel-Liste der Frontendausgabe der "Übersichtsliste" gewählt werden. Die
Indizierung erfolgt über den automatischen Aktualisierungsmechanismus aus Contao oder
über die Neuerstellungen der Systemwartung.


.. |img_searchable_pages_32| image:: /_img/icons/searchable_pages_32.png
.. |img_searchable_pages| image:: /_img/icons/searchable_pages.png
.. |img_new| image:: /_img/icons/new.gif


.. |br| raw:: html

   <br />