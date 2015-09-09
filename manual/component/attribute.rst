.. _component_attribute:

|img_fields| Attribute
=========================

.. note:: eigene Spalten der Datenbanktabelle als Attribute erstellen und
  diese konfigurieren

Einleitung
----------

Die Komponente "Attribute" ist eine der grundlegensten Einstellung in einem MetaModel.
Mit den Attributen werden die eigene, spezifischen Datenfelder definiert und in der
Datenbanktabelle als Spalten angelegt.

Bei der Erstellung eines Attributs "|img_new| Neues Attribut" sind als Pflichtfelder 
die Auswahl des Attributtyps sowie die Eingabe des Spaltennamens definiert - der
Spaltenname definiert, wie der Name schon sagt, die Bezeichnung der Spalte in der
Datenbanktabelle. Als zusätzliche Eingaben können ein Name und eine Beschreibung
ausgefüllt werden.

.. warning:: Beim Ändern des Attributtyps werden, wie auch beim Löschen des Attributs,
  die bisher eingegebenen Werte in der Datenbank gelöscht! Muss dennoch ein Attributtyp
  bei Behalt der Werte geändert werden, sollte dies direkt auf der Datenbankebene z.B. über 
  Export/Import der Attribut-Spalte per CSV begleitet werden.

Je nach Attributtyp stehen nach einem Neuladen der Seite weitere Eingabemöglichkeiten bzw.
Optionen zur Verfügung. Folgend eine Aufstellung der Attributtypen mit Hinweisen zu den 
spezifischen Optionen:

* **Alias**: Alias-Feld z.B. für URLs |br|
  der Alias kann als Kombination von verschiednenen (vorhandenen) Attributen erstellt
  werden; als Option kann die Neuerstellung des Alias bei Änderungen der Urspungs-Attribute 
  erzwungen werden (Neuerstellung des Alias erzwingen); ein Alias wird automatisch als 
  eindeutiger Wert erstellt (???)
* **Kontrollkästchen (Checkbox)**: einzelne Checkbox für Boolsche-Werte |br|
  mit der Checkbox können Boolsche-Werte (0|1) gesetzt werden; eine spezielle Variante
  ist das   "Veröffentlichen" - damit erscheint im Backend das Icon "Auge" wobei die
  Filterung für die Veröffentlichung selbst erstellt werden muss; als Spaltenname
  für den Wert Veröffenlichung wird allgemein "published" verwendet; über die Option
  "Listview checkbox" kann ein eigenes Icon im Backend zur Anzeige des Status
  Verwendung finden
* **Kombinierte Einträge**: Kombination verschiedener Attribute |br|
  alle vorhandenen Attribute sowie die "System-Attribute" wie ID, PID usw. können zu einem
  neuen Attribut kombiniert werden; die Kombination erfolgt über eine sprintf-Formatierung;
  z.B. können die beiden Attribute "Name" und "Vorname" per Anweisung "%s, %s" zu
  "Name, Vorname"; mit der Option "Aktualisierung erzwingen" wird die Neuerstellung bei
  Änderungen der Werte erzwungen
* **Land**: Länderauswahl |br|
  mit dem Attribut steht eine Länderauswahl zur Verfügung; die Auswahl der Länder kann
  mit der Option "Verfügbare Länder filtern" eingegrenzt werden
* **Dezimal**: Dezimalzahlen |br|
  das Attribut ist zur Speicherung von Dezimalzahlen wie Geldbeträge einzusetzen; es
  gibt zwei Dezimalstellen
* **Datei**: Dateipicker |br|
  mit dem Attribute "Datei" steht ein Dateipicker zur Auswahl von einer Datei bzw.
  wenn die Option "Mehrfachauswahl" gesetzt ist von mehreren Dateien zur Verfügung;
  mit der Option "Passen Sie den Dateibaum an" können während der Auswahl weitere
  Dateioptionen gesetzt werden.
* **Sprachschlüssel**: ???
* **Langtext**: Texteingabe per WYSIWYG-Editor
* **Numerisch**: Eingabe von ganzzahligen Werten (Integer)
* **Bewertung**: Bewertungsmodul mit Sternen |br|
  das Attributmodul dient zur Ausgabe ein "Sternchen-Bewertung" im Frontend;
  im Backend können verschiedne Optionen wie Anzahl der Sterne usw. gesetzt
  werden
* **Auswahl**: Relation (1:n) zu einem weiteren MetaModel |br|
  mit dem Attribut "Auswahl" wird eine 1:n-Relation zu einem weiteren MetaModel
  erstellt; in den Optionen wird die MetaModel-Tabelle, das Attribut usw. eingestellt
* **Text-Tabelle**: Eingabe von Werten als Tabelle |br|
  mit dem Attribut "Text-Tabelle" wird eine Anzahl von Spalten inkl. der
  Spaltenbezeichnung und Spaltenbreite definiert; in der Eingabemaske können dann
  beliebig viele Zeilen erzeugt werden z.B. um mehrere URLs oder Telefonnummern
  zu speichern
* **Mehrfachauswahl**: Relation (m:n) zu einem weiteren MetaModel |br|
  mit dem Attribut "Auswahl" wird eine m:n-Relation zu einem weiteren MetaModel
  erstellt; in den Optionen wird die MetaModel-Tabelle, das Attribut usw. eingestellt;
  die Auflösung der Relation erfolgt in einer speziellen Tabelle von MetaModels, so dass
  für das Attribut keine Spalte in der MetaModel-Tabelle angelegt wird
* **Text**: einfaches Textfeld
* **Datum**: Datum bzw. Datum und Uhrzeit |br|
  die Daten werden als Unix-Timestamp gespeichert; bei eigenen SQL-Filterungen müssen
  ggf. Konvertierungen vorgenommen werden
* **URL**: Linktext und URL |br|
  Eingabe von externen Links (inkl. "http://" eingeben) oder über den Seitenpicker
  interne Links; optional kann mit "Titel entfernen" nur die URL ausgegeben werden
  
Ist im MetaModel die Option "Übersetzung" aktiviert, sind die folgenden Attribute
zusätzlich für eine Mehrsprachigkeit vorhanden:

* Übersetzte Checkbox
* Translated Combined values.
* Übersetzte Datei
* Übersetzter Langtext
* Übersetzter Select
* Übersetzter Tabellen-Text
* Übersetzte Tags
* Übersetzter Text

Diese Attribute unterscheiden sich von ihren einsprachigen Attributen lediglich durch
die Eingabe der mehrsprachigen Angaben für Name und Beschreibung. Für die übersetzten
Attribute werden spezielle Tabellen der Erweiterung verwendet und nicht die von der
MetaModel-Erstellung erzeugten Tabelle. 

Neben den aufgeführten Attributen könnenüber zusätzliche Erweiterungen von MetaModels
auch weitere Attributtypen zur Verfügung stehen.

Die Reihenfolge, wie die Attribute angelegt werden, ist frei wählbar -
lediglich bei Attributen, die sich auf andere Attribute beziehen wie z.B.
der "Alias" oder "Kombinierte Einträge" können erst nachfolgend angelegt werden.

Bei den Attributen "Auswahl" und "Mehrfachauswahl" müssen zudem erst die zu
referenzierenden MetaModel erstellt sein.

Optionen
--------

Zwei Optionen sind bei allen Attributen vorhanden: "Varianten überschreiben"
und "Eindeutige Werte".

Mit "Varianten überschreiben" steht das Attribut auch bei den Eingabemasken der
Varianteneingabe zur Verfügung. Voraussetzung dafür ist, dass beim MetaModel die
Option "Varianten" gesetzt ist.

Mit der Option "Eindeutige Werte" werden die Attributeingaben auf Eindeutigkeit
(unique) geprüft.


.. |img_fields| image:: /_img/fields.png
.. |img_new| image:: /_img/new.gif

.. |br| raw:: html

   <br />
   
.. |nbsp| unicode:: 0xA0 
   :trim:

