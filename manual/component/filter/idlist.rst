.. _component_filter_idlist:

|svg_filt_idlist_22| |img_filter_default| Vordefiniertes Itemset
================================================================

Die Filterregel "Vordefiniertes Itemset" ermöglicht es, eine fest definierte Liste
von Item-IDs als Filtergrundlage anzugeben. Das Filterset gibt nur jene Items aus,
deren ID in der angegebenen Liste enthalten ist. Diese Filterregel eignet sich für
statische Auswahlen, bei denen die anzuzeigenden Datensätze vorab bekannt sind,
z. B. für "Empfohlene Einträge" oder "Highlights".

Diese Filterregel hat keine Frontend-Widgetausgabe und wird ausschließlich im
Backend konfiguriert.


Installation
------------

Diese Filterregel ist Bestandteil von ``metamodels/core`` und nach der
MetaModels-Grundinstallation ohne weitere Pakete verfügbar.


Einstellungen beim Anlegen der Filterregel
------------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - Typ
     - Auswahl des Filterregeltyps – hier: "Vordefinierter Satz von Items".
   * - Aktiviert
     - Aktiviert oder deaktiviert diese Filterregel.
   * - Kommentar
     - Freitextfeld zur Beschreibung des Zwecks dieser Filterregel.
   * - Items
     - Komma-separierte Liste der Item-IDs, nach denen gefiltert werden soll.
       Nur Items mit diesen IDs werden in der Ausgabe berücksichtigt.


Passende Attribute
------------------

Die Filterregel "Vordefiniertes Itemset" arbeitet nicht attributbezogen, sondern
direkt mit den Item-IDs der MetaModels-Tabelle. Daher ist keine Attributauswahl
erforderlich.


Sonderfunktionen
----------------

Die Filterregel kann mit anderen Filterregeln kombiniert werden. Da sie immer
eine feste Menge von IDs zurückgibt, eignet sie sich besonders als UND-Bedingung
in Kombination mit dynamischen Filterregeln, um die Gesamtmenge der durchsuchbaren
Items vorab einzuschränken.


.. |svg_filt_idlist_22| image:: /_img/icons_svg/filter_idlist.svg
   :width: 22px
.. |img_filter_default| image:: /_img/icons/filter_default.png

.. |br| raw:: html

   <br />
