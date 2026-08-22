.. _component_searchable-pages:

|svg_searchable_pages_32| |img_searchable_pages_32| Sucheinstellungen
=====================================================================

.. note:: Detailseiten eines MetaModel in der sitemap.xml von Contao aufnehmen

Einleitung
----------

Mit den Sucheinstellungen können die Detailseiten eines MetaModel-Renderings (Liste) in die Generierung der sitemap.xml
eingebunden werden.

Diese "Sonderbehandlung" der Detailseiten gegenüber den normalen Listenanzeigen ergibt sich aus
dem Seitenaufruf selbiger. Die im Contao-Seitenbaum angelegten Detailseiten müssen immer mit
spezifischen GET- bzw. URL-Routing-Parameter aufgerufen werden, um eine (sinnvolle) Detailseite
mit Werten auszugeben. Die Contao-Funktion zur Generierung der sitemap.xml kann auf diese Parameter
aus MetaModels nicht zurückgreifen und benötigen somit entsprechende Unterstützung.

Die "normalen Listenansichten" benötigen diese Sonderbehandlung nicht und die Seiten werden
automatisch über die Contao-Funktionen korrekt in die Suche oder Sitemap aufgenommen.

Die "Basisseite" wie sie von Contao angelegt wurde, wird aus der sitemap.xml entfernt, d. h. die Seite
``domain.tld/mein-projekt/detail.html`` taucht in der sitemap.xml nicht auf sondern nur die URLs mit dem Filterparameter
also z. B. ``domain.tld/mein-projekt/detail/alias-1.html``, ``.../alias-2.html`` usw.

Die Detailseiten werden im FE-Modul "Sitemap" nicht eingebunden.

Zu beachten ist, dass von Contao URLs mit bestimmten Schlüsselwörtern als "Keys" wie `id`, `file`,
`year` usw. nicht indiziert werden; z.B. als URL details/id/meine-details-123.html - die Schlüsselwörter
sind im Array `$GLOBALS['TL_NOINDEX_KEYS'] <https://github.com/contao/core/blob/master/system/modules/core/config/config.php#L419>`_
aufgeführt.

Die Detailseiten werden mit den Verlinkungen in der sitemap.xml leichter in die (normale) Contao-Suche aufgenommen - siehe
`contao:crawl <https://docs.contao.org/manual/de/cli/crawl/>`_

Optionen
--------

* **Name**: |br|
  Bezeichnung für das Backend
* **Render-Einstellungen**: |br|
  Auswahl der Render-Einstellungen für die Listenansicht, die auch zur Detailansicht führt
* **Filterset**: |br|
  Auswahl eines  Filtersets für Eingrenzung der Detailseiten - z. B. um nur veröffentlichte Datensätze auszugeben bzw.
  in die sitemap.xml aufzunehmen

Ablauf
------

Eine neue Sucheinstellungen wird über das Icon "|img_new| Neue Sucheinstellungen" angelegt und nach der Eingabe des Namens die
Render-Einstellung ausgewählt. Die Render-Einstellung ist üblicherweise die gleiche, wie sie für das CE/Modul
MetaModel-Liste der Frontendausgabe der "Übersichtsliste" gewählt wird - es kann aber auch eine eigene
Render-Einstellungen angelegt werden.

Ein Filter muss ausgewählt werden, wenn bestimmte URLs von Detailseiten nicht mit in der sitemap.xml erscheinen
sollen - z. B. um nur veröffentlichte Datensätze aufzunehmen.

Die Erstellung der sitemap.xml erfolgt seit Contao 4.11 dynamisch beim Aufruf und wird nicht mehr im Ordner `share`
abgelegt.

Tipps
-----

* :ref:`rst_cookbook_filter_exclude-url-from-search-index`
* :ref:`rst_cookbook_tips_seo_structured-data` bzw.
* :ref:`rst_cookbook_templates_fe_template_schema_org`
* :ref:`rst_cookbook_specials_add_items_at_navigation`


.. |svg_searchable_pages_32| image:: /_img/icons_svg/searchable_pages.svg
   :width: 32px
.. |img_searchable_pages_32| image:: /_img/icons/searchable_pages_32.png
.. |img_searchable_pages| image:: /_img/icons/searchable_pages.png
.. |img_new| image:: /_img/icons/new.gif


.. |br| raw:: html

   <br />
