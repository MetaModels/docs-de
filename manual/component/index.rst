.. _component_index:

Komponenten eines MetaModel
===========================

In den folgenden Kapiteln soll der Aufbau von MetaModels aufgezeigt werden, um die "Logik"
des Aufbaus der Erweiterung zu verstehen.

Zunächst eine Einordnung von zwei Begriffen: mit **MetaModel** (Singular) soll im
Folgenden eine Datentabelle mit ihren Attributen, Ein-/Ausgabe-Möglichkeiten,
Filtern usw. bezeichnet werden. Ein MetaModel wird in den folgenden Texten 
ohne "s" geschrieben, auch wenn dies z.B. durch den Genitiv erforderlich wäre.

Der Begriff **MetaModels** (Plural) steht allein als Bezeichnung für das
Erweiterungspaket für Contao.


Nach dem Erstellen eines MetaModel stehen die folgenden Komponenten zur Bearbeitung zur Verfügung:

 |img_fields|  :ref:`component_attribute` |br|
 |img_rendersettings|  :ref:`component_rendersettings` |br|
 |img_dca|  :ref:`component_dca` |br|
 |img_searchable_pages|  :ref:`component_searchable-pages` |br|
 |img_filter|  :ref:`component_filter` |br|
 |img_dca_combine|  :ref:`component_dca-combine`

Bei der Erstellung eines (einfachen) MetaModel können die Komponenten in der aufgeführten 
Reihenfolge abgearbeitet werden. Mit zunehmender Komplexität des MetaModels - also im
Zusammenspiel mehrerer MetaModel miteinander - kommt man nicht umhin, einzelne Eingaben
in einem vorhandenen MetaModel weiter zu ergänzen oder abzuändern.

Mit der Erweiterung MetaModels erhält Contao jeweils zwei neue Inhaltselemente und Module
für die Frontendausgabe. Mit dem Inhaltselement/Modul "MetaModel-Liste" können
Datensätze einzeln oder als Liste auf der Webseite ausgegeben werden und mit dem
Inhaltselement/Modul "MetaModel-Frontendfilter" steht ein Filter für das Frontend
zur Verfügung - mehr dazu unter :ref:`component_contentelements`.

.. toctree::
    :hidden:
    :maxdepth: 1
    
    new-mm
    attribute
    rendersettings
    dca
    searchable-pages
    filter
    dca-combine
    contentelements


.. |br| raw:: html

   <br />
   
.. |nbsp| unicode:: 0xA0 
   :trim:

.. |img_fields| image:: /_img/icons/fields.png
.. |img_rendersettings| image:: /_img/icons/rendersettings.png
.. |img_dca| image:: /_img/icons/dca.png
.. |img_searchable_pages| image:: /_img/icons/searchable_pages.png
.. |img_filter| image:: /_img/icons/filter.png
.. |img_dca_combine| image:: /_img/icons/dca_combine.png
