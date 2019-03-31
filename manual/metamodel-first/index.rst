.. _mm_first_index:

Das erste MetaModel
===================

.. warning:: Noch im Aufbau!

Mit dem Aufbau des ersten MetaModels soll ein leichter Einstieg in die Umsetzung
ermöglicht werden. Die Aufgabe für die erste Umsetzung ist eine einfache Mitarbeiterliste
mit nur wenigen Inhaltsangaben. Die Liste soll im Backend zu befüllen sein
und kann im Frontend als Tabelle ausgegeben werden. Auf einige Aspekte wie
Sortierungen, Filterungen usw. wurde absichtlich verzichtet.

Die Umsetzung orientiert sich an den :ref:`component_index`.

**Aufgabenstellung:**

* Erstellung einer im Backend pflegbaren Mitarbeiterliste
* Speicherung der Werte: Name, Vorname, E-Mail, Abteilung
* zusätzliches Feld für die Veröffentlichung eines Datensatzes
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
    conclusion
