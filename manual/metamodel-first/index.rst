.. _mm_first_index:

Das erste MetaModel(s)
======================

Mit dem Aufbau des ersten Metamodels soll ein leichter Einstieg in die Umsetzung
ermöglicht werden. Die Aufgabe für die Umsetzung soll eine einfache Telefonliste
mit nur wenigen Inhaltsangaben sein. Die Liste soll im Backend zu befüllen sein
und kann im Frontend in als Tabelle ausgegeben werden.

Die Bezeichnung "MetaModels" ist in dem Zusammenhang schon etwas zu weit geführt,
da nur eine Tabelle - also ein "MetaModel" - angelegt wird.

Die Umsetzung orientiert sich an den :ref:`component_index`.

**Aufgabenstellung:**

* Erstellung einer im Backend pflegbaren Telefonliste
* Speicherung der Werte: Name, Vorname, E-Mail, Abteilung, Telefon
* zusaätzliches Feld für die Veröffentlichung eines Datensatzes
* Ausgabe der Liste als Tabelle im Frontend

**Voraussetzungen:**

* aktuelles Contao - möglichst LTS
* aktuelles MetaModels - siehe :ref:`manual_install`
* sicherer Umgang von Contao
* Verständnis der :ref:`component_index`

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
