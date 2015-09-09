.. _component_filter:

|img_filter| Filter
===================

.. note:: optionale Filter für Backend und Frontend erstellen;
  Filter erstellen und in Komponenten oder Inhaltselementen/Modulen
  aktivieren

Einleitung
----------

Mit der Komponente "Filter" steht ein umfangreiches Werkzeug zur Verfügung,
um die Ansicht und Auswahl der Datensätze (Items) eines MetaModel zu beeinflussen.
Die Filter reduzieren die Gesamtmenge der Items, d.h. nach einer Filterung steht
eine Teilmenge für die Ausgabe bereit. Es gilt zu beachten, dass jeder Filter
immer nur eine Liste mit IDs (der Items) ausgibt - eine Änderung der Itemwerte
ist z.B. über eine SQL-Query nicht möglich.

Die Filter können sowohl im Backend als auch im Frontend zum Einsatz kommen.

Die Filterparameter können zum Teil dynamisch z.B. über GET/POST-Parameter
beeinflusst werden, wodurch sich sehr umfangreiche Filterungen ergeben.

Optionen
--------

Ablauf
------

.. |img_filter| image:: /_img/filter.png