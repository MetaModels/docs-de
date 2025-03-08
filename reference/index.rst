.. _ref_api:

MetaModels Referenz und API
===========================

.. warning:: Noch im Aufbau!

Die MetaModels API bildet die Schnittstelle zur eigenen Programmierung und Erweiterung.


.. _ref_api_interf:
Interfaces MetaModels
---------------------

Die API von MetaModels hält Schnittstellen zum Ansprechen verschiedener Klassen
als "`Interfaces <http://php.net/manual/de/language.oop5.interfaces.php>`_" bereit.

Die Interfaces können zum Beispiel in eigenen Programmierungen bzw. Funktionen in
Events/Hooks oder in Templates eingesetzt werden. Mit den Interfaces können
leicht verschiedene Daten oder Eigenschaften abgerufen oder auch manipuliert
werden.

Folgende Gruppen von Interfaces stehen zur Verfügung:

.. _index_api_interfaces:

.. toctree::
    :maxdepth: 1

    interfaces/metamodels
    interfaces/attribute
    interfaces/filter
    interfaces/dcgeneral-datadefinition

In der Dokumentation der Gruppen sind grundlegende Beispiele aufgeführt. Weitere Beispiele sind u. a. im Bereich ":ref:`Kochbuch <rst_cookbook>`",
`Vortrag von Ingolf Steinhardt zur CK23 <https://www.e-spin.de/contao-metamodels/metamodels-vortrag-contao-konferenz-2023.html>`_ und
":ref:`rst_cookbook_specials_register-services`" zu finden.


.. _ref_api_dcg:
DC_General (DCG)
----------------

Der DC_General kümmert sich um die Darstellung und Datenverarbeitung im Backend und teilweise für das Frontend-Editing
(FEE). Mehr zum `DC_General <https://dc-general.readthedocs.io>`_.
