Komponenten eines MetaModel
===========================

In den folgenen Kapiteln soll der Aufbau von MetaModels aufgezeigt werden, um die "Logik"
des Aufbaus der Erweiterung zu verstehen. Zunächst eine Einordnung von zwei Begriffen:
mit MetaModel (Singular) soll im Folgenden eine Datentabelle mit ihren Attributen, Ein-/Ausgabe
-Möglichkeiten, Filtern usw. bezeichnet werden und mit MetaModels (Plural) der komplette Aufbau
mit dem Zusammenspiel mehrerer MetaModel untereinander.

Nach dem Erstellen eines MetaModel stehen die folgenden Komponenten zur Bearbeitung zur Verfügung:

* |img_fields| Attribute
* |img_rendersettings| Rendereinstellungen
* |img_dca| Eingabemasken
* |img_searchable_pages| Seitensuche
* |img_filter| Filter
* |img_dca_combine| Eingabe- und Ausgabe-Optionen

Bei der Erstellung eines (einfachen) MetaModel können die Komponenten in der aufgeführten 
Reihenfolge abgearbeitet werden. Mit zunehmender Komplexität des MetaModels kommt man
nicht umhin, einzelne Eingaben in einem vorhandenen MetaModel weiter zu ergänzen
oder abzuändern.

Mit der Erweiterung MetaModels erhält Contao jeweils zwei neue Inhaltselemente und Module
für die Frontendausgabe. Mit dem Inhaltselement/Modul "MetaModel-Liste" können
Datensätze einzeln oder als Liste auf der Webseite ausgegeben werden und mit dem
Inhaltselement/Modul "MetaModel-Frontendfilter" steht ein Filter für das Frontend
zur Verfügung - mehr dazu unter :ref:`component_contentelements`.


Übersicht
^^^^^^^^^

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

.. |img_fields| image:: /_img/fields.png
.. |img_rendersettings| image:: /_img/rendersettings.png
.. |img_dca| image:: /_img/dca.png
.. |img_searchable_pages| image:: /_img/searchable_pages.png
.. |img_filter| image:: /_img/filter.png
.. |img_dca_combine| image:: /_img/dca_combine.png
