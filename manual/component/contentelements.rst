.. _component_contentelements:

Inhaltselemente/Module für die Frontendausgabe
==============================================

.. note:: zur Anzeige im Fontend die eine MetaModel-Liste
  als Contentelement oder FE-Modul erstellen; optional kann
  ebenfalls als Contentelement oder FE-Modul ein Filter
  erzeugt werden

Einleitung
----------

Für die Frontendausgabe stehen ein Listen- und ein Filterelement
zur Verfügung. Diese können sowohl als Inhaltselement als auch 
als FE-Modul in Contao genutzt werden. Einen Unterschied in den
Einstellungsoptionen zwischen Inhaltselement und Modul gibt es nicht.

Für die Listendarstellung gehört zu den wichtigsten Auswahloptionen
die Auswahl des MetaModel (wo kommen die Daten her), die Render-Einstellung
und die Templateauswahl (wie werden die Daten angezeigt) und ggf. noch 
die Filtereinstellung (welche Daten werden ausgegeben).

Zu beachten gilt, dass eine Detailansicht mit einem Item auch nur eine
"Listendarstellung" ist, aber mit entsprechnder Filterung für eine
Ausgabe.

Für die Filtereinstellungen sind die wichtigsten Auswahloptionen
die Wahl des MetaModel (auf welcher Basis soll gefiltert werden) und
die Wahl des Filtersets (welche Filterung soll zum Einsatz kommen).

Zusätzlich gibt es für die Filter ein Inhaltselement/Modul "Filterreset"
zum Zurücksetzen aller Filtereinstellungen im Frontend.

Optionen CE Liste
-----------------

* **MetaModel**: |br|
  Auswahl des MetaModel für die Datenherkunft
* **Elemente pro Seite, Offset und Limit** |br|
  Einstellungen für eine Paginierung bzw. maximale Anzahl
* **Filterset-Einstellungen**: |br|
  Auswahl des Filtersets sowie der Sortierung; ist bei einer
  Filterregel "Einfache Abfareg" die Option "Statischer Parameter"
  gesetzt, erscheint hier ein Selectfeld zur Wertauswahl; ist der
  Parameter "Überschreiben der Sortierung erlauben" gesetzt,
  kann die Sortierung per URL nach dem Schema
  /orderBy/<Spaltenname d. Attributs>/orderDir/<DESC || ASC>.html
  bzw. als GET-Parameter überschrieben werden
* **Render-Einstellungen**: |br|
  Auswahl der Render-Einstellung; möchte man Einfluss auf
  die Ausgabe der Items der Ausgabeliste haben, dann bietet sich
  das Template der Render-Einstellung (metamodel_prerendered)
  an und nicht das "Template der Ausgabe" (ce_metamodel_list)

Optionen CE Filter
------------------

* **MetaModel**: |br|
  Auswahl des MetaModel welche die Grundlage der Filterung darstellt
* **Anzuwendendes Filterset**: |br|
  Auswahl des Filtersets
* **Attribute**: |br|
  Attribute, die in dem Filter im Frontend angezeigt werden sollen
  
Ablauf
------

Die Erstellung des Inhaltselementes bzw. des FE-Moduls erfolgt analog
den klassischen Elementen von Contao inklusive der üblichen Möglichkeiten,
wie den Zugriffsschutz zu aktivieren oder CSS-ID/Klassen anzugeben.


.. |img_filter| image:: /_img/icons/filter.png

.. |br| raw:: html

   <br />