.. _component_new-mm:

|img_new| Neues MetaModel
===========================

.. note:: neues MetaModel (Datenbanktabelle) erstellen
  ggf. Übersetzung oder Varianten aktivieren

Einleitung
----------
Mit Klick auf das Icon "|img_new| Neues MetaModel" wird eine Eingabemaske zum Erstellen
eines neuen MetaModel geöffnet. Mit dem Speichern des neuen MetaModel wird in der Datenbank
eine neue, eigene Tabelle zur Aufnahme der abzuspeichernden Werte angelegt.

Für die Speicherung des neuen MetaModel sind deshalb zwei Eingaben Pflichtfelder: der Name des
MetaModel sowie der Tabellenname.

Der Name des Metamodel dient der Bezeichnung im Backend und kann frei gewählt werden. Die
Bezeichnung sollte jedoch für die weitere Arbeit sinnvoll auf den Inhalt schließen z.B.
"Adressen".

Gleiches gilt für den Tabellenname, wobei der Präfix "mm\_" im Tabellennamen mit eingegeben
werden kann bzw. automatisch angefügt wird. Die Tabelle könnte dann z.B. "mm_address"
heißen - ob der Name im Singular oder Plural stehen sollte, gibt es unterschiedliche
"Meinungslager".

Mit der Erstellung der Tabelle werden in dieser nur einige, für das Zusammenspiel mit der Erweiterung
MetaModels notwendige, Spalten wie id, pid, timestamp usw. angelegt. Die weiteren, individuellen Spalten
werden als s.g. "Attribute" angelegt und mit ihren spezifischen Optionen versehen. Mehr dazu unter dem
Punkt :ref:`component_attribute`.

Optionen
--------

Bei der Erstellung eines neuen MetaModel gibt es die weiteren Optionen "Übersetzung" und "Varianten".

Wurde die Option "Übersetzung" ausgewählt, stehen nach einem Neuladen der Seite mehrere Sprachen als
Auswahl zur Verfügung. Eine der Sprachen sollte als "Fallback" aktiviert werden - erfolgt dies nicht,
wird die als erste ausgewählte Sprache als Fallback verwendet. Ist die Option "Übersetzung" im 
MetaModel aktiviert, werden spezielle, mehrsprachige Attribute zusätzlich als Auswahl angeboten.

Bei einer nachträglichen Aktivierung der Mehrsprachigkeit, werden die vorhandenen Attribute
bzw. die eingegeben Werte nicht austomatisch übernommen. Ob eine Mehrsprachigkeit notwendig ist,
sollte daher möglichst im Vorfeld geklärt werden.

Wurde die Option "Varianten" ausgewählt, sieht man zunächste keine weiter Veränderung des MetaModel. Ist
die Option gesetzt, ist bei den Attributen die Aktivierung der Option "Varianten überschreiben" möglich.
Mit allen Attributen, bei denen die Option "Varianten überschreiben" gesetzt ist, können weitere Eingabe-
Masken für die Varianteneigabe, z.B. zum "Überschreiben" von "Elternwerten", erstellt werden. Die 
Eingabemasken der Varianten erreicht man über das Icon "|img_variants| Neue Variante" in der
Listendarstellung der Eltern-Elemente.

Mit den Varianten entsteht eine "Eltern-Kind-Beziehung" innerhalb einer MetaModel-Datenbanktabelle, die
über verschiedene Werte in der Tabelle nachvollzogen werden können - z.B. bei einem eigenen SQL-Filter.
Die Eltern-Datensätze sind dadurch gekennzeichnet, das in der Datenbanktabelle der Eltern-Datensätze
die Werte für varbase gleich 1 und vargroup gleich der eigenen ID haben. Die Kind-Datensätze haben
die Werte varbase gleich 0 und vargroup gleich der ID des Eltern-Datensatzes.


.. |img_variants| image:: /_img/variants.png
.. |img_new| image:: /_img/new.gif

   
.. |nbsp| unicode:: 0xA0 
   :trim: