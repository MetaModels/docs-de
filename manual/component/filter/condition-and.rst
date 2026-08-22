.. _component_filter_condition-and:

|svg_filt_condition_and_22| | |img_filter_and| UND-Bedingung (AND)
==================================================================

Die Filterregel "UND-Bedingung" ist ein Container, der mehrere Unterfilterregeln
aufnehmen kann. Alle enthaltenen Filterregeln werden mit einer UND-Verknüpfung
kombiniert: Ein Item muss alle Teilbedingungen erfüllen, um in der Ergebnismenge
zu erscheinen.

Da Filterregeln auf gleicher Ebene innerhalb eines Filtersets ohnehin automatisch
per UND verknüpft sind, wird die UND-Bedingung hauptsächlich zur strukturellen
Gliederung innerhalb einer ODER-Bedingung benötigt. Damit lassen sich komplexe
Filterkombinationen wie ``(A UND B) ODER (C UND D)`` aufbauen.

Diese Filterregel hat keine Frontend-Widgetausgabe.


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
     - Auswahl des Filterregeltyps – hier: "UND-Bedingung (AND)".
   * - Aktiviert
     - Aktiviert oder deaktiviert diese Filterregel.
   * - Kommentar
     - Freitextfeld zur Beschreibung des Zwecks dieser Filterregel.


Passende Attribute
------------------

Die UND-Bedingung ist kein attributgebundener Filter, sondern ein struktureller
Container. Die enthaltenen Unterfilterregeln können beliebige Attribute verwenden.


Sonderfunktionen
----------------

**Hierarchische Filterstruktur**

Über die Klemmmappen-Icons in der Filterregelliste kann eine Filterregel in eine
UND-Bedingung (oder ODER-Bedingung) eingefügt werden. So entsteht eine
verschachtelte Filterstruktur, die nahezu beliebig komplexe logische Ausdrücke
abbilden kann.


.. |svg_filt_condition_and_22| image:: /_img/icons_svg/filter_and.svg
   :width: 22px
.. |img_filter_and| image:: /_img/icons/filter_and.png

.. |br| raw:: html

   <br />
