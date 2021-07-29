.. _component_filter:

|img_filter_32| Filtersets
==========================

.. note:: optionale Filtersets für Backend und Frontend erstellen;
  Filterset erstellen und in Komponenten oder Inhaltselementen/Modulen
  aktivieren

Einleitung
----------

Mit der Komponente "Filterset" steht ein umfangreiches Werkzeug zur Verfügung,
um die Ansicht und Auswahl der Datensätze (Items) eines MetaModel zu beeinflussen.
Die Filtersets reduzieren die Gesamtmenge der Items, d.h. nach einer Filterung steht
eine Teilmenge von diesen für die Ausgabe bereit. Es gilt zu beachten, dass 
jedes Filterset immer nur eine Liste mit IDs (der Items) ausgibt bzw. eine 
Filterregel eine Liste mit IDs an eine nächste Filterregel weiter reicht
- eine Änderung der Itemwerte ist z.B. über eine SQL-Query nicht möglich.

Die Erstellung eines Filterset erfolgt in einer zweistufigen Hierarchie, in dem
zunächst ein bezeichnetes Filterset "als Container" erstellt wird, der wiederum
ein oder mehrere Filterregeln beinhalten kann. Sind mehrere Filterregeln auf
dieser Ebene vorhanden, sind diese automatisch per UND verknüpft. Für eine 
ODER-Verknüpfung muss eine Filterregel ODER erstellt werden, welche wiederum
weitere Filterregeln aufnehmen kann. Mit den Möglichkeiten der Verschachtelung
können nahezu alle UND/ODER-Angaben eines nativen SQL-Query nachgebildet werden.

Einige Filterregeln haben die auswählbare Option, nur zugeordnete bzw. nur
verbleibende Filtereinträge anzuzeigen, um eine dynamische Anzeige des Filtersets zu
gewährleisten.

Die Filtersets können sowohl im Backend als auch im Frontend zum Einsatz kommen.

Die Filterregeln können zum Teil dynamisch z.B. über GET/POST-Parameter
beeinflusst werden, wodurch sich sehr umfangreiche Filterungen ergeben.

Typen von Filterregeln
----------------------

* **Vordefiniertes Itemset** (core): |br|
  Eingabe einer Liste mit IDs, nach denen gefiltert werden soll
* **Einfache Abfrage** (core): |br|
  erzeugt eine Filterung nach einem Attribut; für die Filterung
  kann ein URL-Parameter angegeben werden; mit Option "Statischer Parameter"
  kann in den Inhaltselementen/FE-Modulen aus einer Select-Liste ein Wert
  zum Filtern aktiviert werden
* **Eigenes SQL** (core): |br|
  eigene SQL-Bedingungen zur Filterung; den |img_about| Hilfe-Assistenten (Popup) beachten |br|
  siehe auch im "Kochbuch" :ref:`rst_cookbook_filter_custom-sql`
* **UND-Bedingung (AND)** (core): |br|
  Container für weitere Filterregeln mit UND-Verknüpfung
* **ODER-Bedingung (OR)** (core): |br|
  Container für weitere Filterregeln mit ODER-Verknüpfung
* **Veröffentlichungsstatus** (filter_checkbox): |br|
  prüft ein Attributwert auf 1; kann Attribut "published" sein
* **Übersetzter Veröffentlichungsstatus** (filter_checkbox): |br|
  prüft ein übersetzten Attributwert auf 1; kann Attribut
  "published" sein
* **Ja / Nein** (filter_checkbox): |br|
  Ja/Nein-Auswahl z.B. als Radio-Buttons
* **Wert von/bis für ein Feld** (filter_fromto): |br|
  von/bis-Auswahl für Werte eines Attributwerts
* **Wert von/bis für ein Datumsfeld** (filter_fromto): |br|
  von/bis-Auswahl für Datum eines Attributwerts
* **Wert von/bis für zwei Felder** (filter_range): |br|
  zwei Felder mit Werten
* **Wert von/bis für zwe Datumsfelder** (filter_range): |br|
  zwei Felder mit Werten für Datum
* **Einzelauswahl** (filter_select): |br|
  einzelne Auswahl eines Wertes z.B. einer Select-Liste
* **Mehrfachauswahl** (filter_tags): |br|
  mehrfache Auswahl von Werten z.B. einer Select-Liste
* **Textfilter** (filter_text): |br|
  filtert nach einer Texteingabe
* **Umkreissuche** (filter_perimetersearch): |br|
  filtert nach einer Adresse/Geokoordinaten und einem Umkreis bezogen auf Lat/Long-Werte in den Datensätzen
* **Register** (filter_register): |br|
  filtert nach Anfangsbuchstaben; generiert eine Liste mit allen oder vorhandenen Anfangsbuchstaben

Ablauf
------

Ein neues Filterset wird über "|img_new| Neu" geöffnet und es muss ein Name vergeben werden.

Über das Icon "|img_filter_setting| Filterregeln" gelangt man zur Eingabeliste der
Filterregel, wo wiederum über "|img_new| Neu" eine neue Filterregel eingerichtet
werden kann. Über die "Klemmmappen-Icons" kann während der Erstellung einer Filterregel
die Hierarchie beeinflusst werden und die Filterregel z.B. innerhalb einer ODER-Regel
eingefügt werden.


.. |img_filter_32| image:: /_img/icons/filter_32.png
.. |img_filter| image:: /_img/icons/filter.png
.. |img_filter_setting| image:: /_img/icons/filter_setting.png
.. |img_new| image:: /_img/icons/new.gif
.. |img_about| image:: /_img/icons/about.png

.. |br| raw:: html

   <br />
