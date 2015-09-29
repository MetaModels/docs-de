.. _component_index:

Komponenten eines MetaModel
===========================

.. warning:: Noch im Aufbau!

In den folgenden Kapiteln soll der Aufbau von MetaModels aufgezeigt werden, um die "Logik"
des Aufbaus der Erweiterung zu verstehen.

Zunächst eine Einordnung von zwei Begriffen: mit **MetaModel** (Singular) soll im
Folgenden eine Datentabelle mit ihren Attributen, Ein-/Ausgabe-Möglichkeiten,
Filtern usw. bezeichnet werden und mit **MetaModels** (Plural) der komplette Aufbau
mit dem Zusammenspiel mehrerer MetaModel untereinander. Ein MetaModel wird in den
folgenden Texten ohne "s" geschrieben, auch wenn dies z.B. durch den Genitiv
erforderlich wäre.

Nach dem Erstellen eines MetaModel stehen die folgenden Komponenten zur Bearbeitung zur Verfügung:

* |img_fields| Attribute
* |img_rendersettings| Rendereinstellungen
* |img_dca| Eingabemasken
* |img_searchable_pages| Seitensuche
* |img_filter| Filter
* |img_dca_combine| Eingabe- und Ausgabe-Optionen

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

.. |img_fields| image:: /_img/icons/fields.png
.. |img_rendersettings| image:: /_img/icons/rendersettings.png
.. |img_dca| image:: /_img/icons/dca.png
.. |img_searchable_pages| image:: /_img/icons/searchable_pages.png
.. |img_filter| image:: /_img/icons/filter.png
.. |img_dca_combine| image:: /_img/icons/dca_combine.png
