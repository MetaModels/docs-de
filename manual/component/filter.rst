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
eine Teilmenge von diesen für die Ausgabe bereit. Es gilt zu beachten, dass 
jeder Filter immer nur eine Liste mit IDs (der Items) ausgibt bzw. ein 
Filterattribut eine Liste mit IDs an ein nächstes Filterattribut weiter reicht
- eine Änderung der Itemwerte ist z.B. über eine SQL-Query nicht möglich.

Die Erstellung der Filter erfolgt in einer zweistufigen Hierarchie, in dem
zunächst ein bezeichneter Filter "als Container" erstellt wird, der wiederum
ein oder mehrere Filtereinstellungen (Attribute) beinhalten kann. Sind mehrere
Filterattribute auf dieser Ebene vorhanden, sind diese per UND verknüpft. Für
eine ODER-Verknüpfung muss ein Filterattribut ODER erstellt werden welches wiederum
weitere Filterattribute aufnehmen kann. Mit den Möglichkeiten der Verschachtelung
können nahezu alle UND/ODER-Angaben eines nativen SQL-Query nachgebildet werden.

Einige Filterattribute haben die auswählbare Option, nur zugeordnete bzw. nur
verbleibende Filtereinträge anzuzeigen, um eine dynamische Anzeige der Filter zu
gewährleisten.

Die Filter können sowohl im Backend als auch im Frontend zum Einsatz kommen.

Die Filterparameter können zum Teil dynamisch z.B. über GET/POST-Parameter
beeinflusst werden, wodurch sich sehr umfangreiche Filterungen ergeben.

Filterattribute
---------------

* **Vordefiniertes Filterset**: |br|
  Eingabe einer Liste mit IDs, nach denen gefiltert werden soll
* **Einfache Abfrage**: |br|
  erzeugt eine Filterung nach einem Attribut; für die Filterung
  kann ein URL-Parameter angegeben werden; mit Option "Statischer Parameter"
  kann in den Inhaltselementen/FR-Modulen aus einer Select-Liste ein Wert
  zum Filtern aktiviert werden
* **Eigenes SQL**: |br|
  eigene SQL-Bedingungen zur Filterung; den |img_about| Hilfe-Assistenten (Popup) beachten
* **UND-Bedingung (AND)**: |br|
  Container für weitere Filterattribute mit UND-Verknüpfung
* **ODER-Bedingung (OR)**: |br|
  Container für weitere Filterattribute mit ODER-Verknüpfung
* **Veröffentlichungsstatus**: |br|
  prüft ein Attributwert auf 1; kann Attribut "published" sein
* **Übersetzter Veröffentlichungsstatus**: |br|
  prüft ein übersetzten Attributwert auf 1; kann Attribut
  "published" sein
* **Ja / Nein**: |br|
  Ja/Nein-Auswahl z.B. als Radio-Buttons
* **Wert von/bis**: |br|
  von/bis-Auswahl für Werte
* **Value from/to for date**: |br|
  von/bis-Auswahl für Datum
* **2 Felder mit Werten**: |br|
  zwei Felder mit Werten
* **Value within 2 fields for date**: |br|
  zwei Felder mit Datum
* **Einzelauswahl**: |br|
  einzelne Auswahl eines Wertes z.B. einer Select-Liste
* **Mehrfachauswahl**: |br|
  mehrfache Auswahl von Werten z.B. einer Select-Liste
* **Textfilter**: |br|
  filtert nach einer Texteingabe

Ablauf
------

Ein neuer Filter wird über "|img_new| Neu" geöffnet und es muss ein Name vergeben werden.

Über das Icon "|img_filter_setting| Filterattribute" gelangt man zur Eingabeliste der
Filterattribute, wo wiederum über "|img_new| Neu" ein neues Filterattribut eingerichtet
werden kann. Über die "Klemmmappen-Icons" kann während der Erstellung eines Filterattributes
die Hierarchie beeinflusst werden und das Attribut z.B. innerhalb eines ODER-Filters
eingefügt werden.


.. |img_filter| image:: /_img/icons/filter.png
.. |img_filter_setting| image:: /_img/icons/filter_setting.png
.. |img_new| image:: /_img/icons/new.gif
.. |img_about| image:: /_img/icons/about.png

.. |br| raw:: html

   <br />