.. _component_attribute:

|svg_fields_32| | |img_fields_32| Attribute
============================================

.. note:: eigene Spalten der Datenbanktabelle als Attribute erstellen und diese konfigurieren |br|
   Zum Anlegen der Attributsspalten in der mm_*-Tabelle eine DB-Migration durchführen - :ref:`siehe Schemamanager <component_schema-manager>`


Einleitung
----------

Die Komponente "Attribute" ist eine der grundlegendsten Einstellungen in einem MetaModel.
Mit den Attributen werden die eigenen, spezifischen Datenfelder definiert und in der
Datenbanktabelle als Spalten angelegt. Auf der Seite :ref:`component_data-in-attributes` ist aufgeführt, welches
Attribut für welchen Datentyp der Datenbank eingesetzt werden kann. Neben den üblichen Datentypen wie ``varchar``,
``int``, ``text`` usw. gibt es auch Attribute für spezielle Speicherungen - mehr dazu in der folgenden Aufstellung.

Bei der Erstellung eines Attributs "|img_new| Neues Attribut" sind als Pflichtfelder
die Auswahl des Attributtyps sowie die Eingabe des Spaltennamens definiert - der
Spaltenname definiert, wie der Name schon sagt, die Bezeichnung der Spalte in der
Datenbanktabelle. Als zusätzliche Eingaben können ein Name und eine Beschreibung
ausgefüllt werden, die auch als Bezeichnung und Beschreibung in der Eingabemaske
erscheinen.

.. warning:: Beim Ändern des Attributtyps werden, wie auch beim Löschen des Attributs,
  die bisher eingegebenen Werte in der Datenbank gelöscht! Muss dennoch ein Attributtyp
  bei Behalt der Werte geändert werden, sollte dies direkt auf der Datenbankebene z.B. über
  Export/Import der Attribut-Spalte per CSV begleitet werden. Ein geändertes Attribut
  sollte bei den Render-Einstellungen und Eingabemasken anschließend nochmal neu
  hinzugefügt werden.

.. seealso:: Checkliste beim Ändern eines Attributtyps: :ref:`rst_cookbook_checklists_attribut_change`

Je nach Attributtyp stehen nach einem Neu laden der Seite weitere Eingabemöglichkeiten bzw.
Optionen zur Verfügung. Folgend eine Aufstellung der Attributtypen mit Hinweisen zu den
spezifischen Optionen:

* **Alias**: Alias-Feld z. B. für URL-Parameter bei der Filterung |br|
  der Alias kann als Kombination von verschiedenen (vorhandenen) Attributen erstellt
  werden; als Option kann die Neuerstellung des Alias bei Änderungen der Ursprungs-Attribute
  erzwungen werden (Neuerstellung des Alias erzwingen); ein Alias wird nicht automatisch
  als eindeutiger Wert erstellt - dafür ist eine Aktivierung der Checkbox "Eindeutige Werte"
  notwendig - :ref:`mehr... <component_attribute_alias>`
* **Kontrollkästchen (Checkbox)**: einzelne Checkbox für Boolsche-Werte |br|
  mit der Checkbox können Boolsche-Werte (0|1) gesetzt werden; eine spezielle Variante
  ist das "Veröffentlichen" - damit erscheint im Backend das Icon "Auge" wobei die
  Filterung für die Veröffentlichung selbst erstellt werden muss; als Spaltenname
  für den Wert Veröffentlichung wird allgemein "published" verwendet; über die Option
  "Listview checkbox" kann ein eigenes Icon im Backend zur Anzeige des Status
  Verwendung finden - :ref:`mehr... <component_attribute_checkbox>`
* **Kombinierte Einträge**: Kombination verschiedener Attribute |br|
  alle vorhandenen Attribute sowie die "System-Attribute" wie ID, PID usw. können zu einem
  neuen Attribut kombiniert werden; die Kombination erfolgt über eine sprintf-Formatierung;
  z.B. können die beiden Attribute "Name" und "Vorname" per Anweisung "%s, %s" zu
  "Name, Vorname"; mit der Option "Aktualisierung erzwingen" wird die Neuerstellung bei
  Änderungen der Werte erzwungen - :ref:`mehr... <component_attribute_combinedvalues>`
* **Land**: Länderauswahl |br|
  mit dem Attribut steht eine Länderauswahl zur Verfügung; die Auswahl der Länder kann
  mit der Option "Verfügbare Länder filtern" eingegrenzt werden - :ref:`mehr... <component_attribute_country>`
* **Dezimal**: Dezimalzahlen |br|
  das Attribut ist zur Speicherung von Dezimalzahlen wie Geldbeträge einzusetzen; es
  gibt zwei Dezimalstellen - :ref:`mehr... <component_attribute_decimal>`
* **Datei**: Dateipicker |br|
  mit dem Attribute "Datei" steht ein Dateipicker zur Auswahl von einer Datei bzw.
  wenn die Option "Mehrfachauswahl" gesetzt ist von mehreren Dateien zur Verfügung;
  mit der Option "Passen Sie den Dateibaum an" können während der Auswahl weitere
  Dateioptionen gesetzt werden; bei der Verwendung bei Bildern ist zu beachten, dass
  für eine (direkte) Anzeige von Vorschaubildern im Backend bzw. im Frontend die
  Option "Als Bildfeld mit Vorschaubild benutzen" in den Render-Einstellungen des
  Dateiattributs gesetzt werden muss - :ref:`mehr... <component_attribute_file>`
* **Sprachschlüssel**: Auswahl von ISO-Sprachcodes |br|
  mit dem Attribut steht eine Auswahl von Sprachcodes zur Verfügung; die Sprachcodes
  können per Checkbox ausgewählt werden - :ref:`mehr... <component_attribute_langcode>`
* **Langtext**: Texteingabe |br|
  Attribut für längere Texteingaben - :ref:`mehr... <component_attribute_longtext>`
* **Numerisch**: Eingabe von ganzzahligen Werten (Integer) - :ref:`mehr... <component_attribute_numeric>`
* **Einzelauswahl [select]**: Relation (1:n) zu einer weiteren Tabelle von MetaModels oder Contao |br|
  mit dem Attribut "Auswahl" wird eine 1:n-Relation zu einer weiteren Tabelle
  erstellt; das kann sowohl eine MetaModels-Tabelle sein als auch jede andere Tabelle aus Contao z. B. tl_member - :ref:`mehr... <component_attribute_select>`
* **Text-Tabelle**: Eingabe von Werten als Tabelle |br|
  mit dem Attribut "Text-Tabelle" wird eine Anzahl von Spalten inkl. der
  Spaltenbezeichnung und Spaltenbreite definiert; in der Eingabemaske können dann
  beliebig viele Zeilen erzeugt werden z.B. um mehrere URLs oder Telefonnummern
  zu speichern - :ref:`mehr... <component_attribute_tabletext>`
* **Mehrfachauswahl [tags]**: Relation (m:n) zu einer weiteren Tabelle von MetaModels oder Contao |br|
  mit dem Attribut "Auswahl" wird eine m:n-Relation zu einer weiteren Tabelle
  erstellt; das kann sowohl eine MetaModels-Tabelle sein als auch jede andere Tabelle aus Contao z. B. tl_page;
  die Auflösung der Relation erfolgt in einer speziellen Tabelle von MetaModels, so dass
  für das Attribut keine Spalte in der MetaModel-Tabelle angelegt wird - :ref:`mehr... <component_attribute_tags>`
* **Text**: einfaches Textfeld - :ref:`mehr... <component_attribute_text>`
* **Datum**: Datum bzw. Datum und Uhrzeit |br|
  die Daten werden als Unix-Timestamp gespeichert; bei eigenen SQL-Filterungen müssen
  ggf. Konvertierungen vorgenommen werden - :ref:`mehr... <component_attribute_timestamp>`
* **URL**: Linktext und URL |br|
  Eingabe von externen Links (inkl. "\http://" eingeben) oder über den Seitenpicker
  interne Links; optional kann mit "Titel entfernen" nur die URL ausgegeben werden - :ref:`mehr... <component_attribute_url>`
* **Token** (ab MM 2.4): Eindeutige Zeichenfolge |br|
  Erstellung von eindeutigen Zeichenfolgen, die sich nicht wieder ändern - :ref:`mehr... <component_attribute_token>`

Ist im MetaModel die Option "Übersetzung" aktiviert, sind die folgenden Attribute
zusätzlich für eine Mehrsprachigkeit vorhanden:

* Übersetzte Checkbox - :ref:`mehr... <component_attribute_translatedcheckbox>`
* Übersetzte kombinierte Werte - :ref:`mehr... <component_attribute_translatedcombinedvalues>`
* Übersetzte Datei - :ref:`mehr... <component_attribute_translatedfile>`
* Übersetzter Langtext - :ref:`mehr... <component_attribute_translatedlongtext>`
* Übersetzter Select - :ref:`mehr... <component_attribute_translatedselect>`
* Übersetzter Tabellen-Text - :ref:`mehr... <component_attribute_translatedtabletext>`
* Übersetzte Tags - :ref:`mehr... <component_attribute_translatedtags>`
* Übersetzter Text - :ref:`mehr... <component_attribute_translatedtext>`

Diese Attribute unterscheiden sich von ihren einsprachigen Attributen im Grunde durch
die Eingabe der mehrsprachigen Angaben für Name und Beschreibung. Für die übersetzten
Attribute werden spezielle Tabellen der Erweiterung verwendet und nicht die von der
MetaModel-Erstellung erzeugten Tabelle.

Zu beachten ist, dass bei Relationen per "Einfachauswahl" oder "Mehrfachauswahl" zwischen
zwei MetaModel mit Übersetzungen üblicher Weise *nicht* die Optionen "Übersetzter Einzelauswahl [select]"
und "Übersetzte Mehrfachauswahl [tags]" auszuwählen ist. Das Erkennen bzw. die Umschaltung der Sprache
macht MetaModels mit den Attributen "Einfachauswahl" und "Mehrfachauswahl" automatisch.

Die beiden "übersetzten Varianten" sind hauptsächlich für die Anbindung von Tabellen bestimmt,
die nicht zu MetaModels gehören und ein eigenständiges Feld für die Sprachvariante besitzen -
oder für den Spezialfall, dass bei dem referenzierten MetaModel je nach Sprache unterschiedliche
Items ausgewählt werden sollen. Mehr dazu auf einer Sonderseite zur Mehrsprachigkeit - Sponsoren
dazu gesucht!

Neben den aufgeführten Attributen können über zusätzliche Erweiterungen von MetaModels
auch weitere Attributtypen zur Verfügung stehen. Die Attribute werden über den Composer
installiert oder wie normale Contao-Erweiterungen per Kopie in den Ordner "modules"
(je nach Bereitstellung durch Programmierer).

Beispiele für zusätzliche Attribute sind:

* **Bewertung**: Bewertungsmodul mit Sternen |br|
  das Attributmodul dient zur Ausgabe einer "Sternchen-Bewertung" im Frontend;
  im Backend können verschiedene Optionen wie Anzahl der Sterne usw. gesetzt
  werden - :ref:`mehr... <component_attribute_rating>`
* **Color-Picker**: Auswahl von Webfarben und Transparenz - :ref:`mehr... <component_attribute_color>`
* **Levenshtein**: Wortsuche nach Levenshtein |br|
  mit dem Attribut wird eine Wortähnlichkeit für eine flexible Suche ermittelt - :ref:`mehr... <component_attribute_levenshtein>`
* **Länderauswahl**: Auswahlliste mit Ländern - :ref:`mehr... <component_attribute_country>`
* **ContentArtikel**: Möglichkeit Contao-Contentelemente analog wie ein Artikel in |br|
  einem Widget anzulegen - gibt es auch als übersetzte Variante - :ref:`mehr... <component_attribute_contentarticle>`
* **Multi-Tabelle**: Ähnlich Attribut "Text-Tabelle" nur das in jede "Zelle" ein eigener |br|
  Widgettyp wie Select, Radiobuttons, Checkboxen usw. eingebaut werden kann - gibt es |br|
  auch als übersetzte Variante - :ref:`mehr... <component_attribute_tablemulti>`
* **Geo-Entfernung**: berechnet bei einer Umkreissuche die geogr. Entfernung zum Suchpunkt |br|
  mit dem Wert können Listen nach der Entfernung sortiert werden - :ref:`mehr... <component_attribute_geodistance>`

Die Reihenfolge, wie die Attribute angelegt werden, ist frei wählbar -
lediglich bei Attributen, die sich auf andere Attribute beziehen wie z.B.
der "Alias" oder "Kombinierte Einträge" ist eine nachfolgende Erstellung sinnvoll.

Bei den Attributen "Auswahl" und "Mehrfachauswahl" müssen zudem erst die zu
referenzierenden MetaModel erstellt sein.


Optionen
--------

Zwei Optionen sind bei allen Attributen vorhanden: "Varianten überschreiben"
und "Eindeutige Werte".

Mit "Varianten überschreiben" steht das Attribut auch bei den Eingabemasken der
Varianteneingabe zur Verfügung. Voraussetzung dafür ist, dass beim MetaModel die
Option "Varianten" gesetzt ist - anderenfalls ist die Checkbox inaktiv.

Mit der Option "Eindeutige Werte" werden die Attributeingaben auf Eindeutigkeit
(unique) geprüft.


Ablauf
------

Ein neues Attribut wird über "|img_new| Neues Attribut" geöffnet. Nachdem
alle notwendigen Optionen eingetragen bzw. ausgewählt sind, wird die Einstellung
gespeichert und es erscheint in der Attributliste der vorhandenen MetaModels.
Die Reihenfolge in der Liste hat keinen weiteren Einfluss.
Datenbank-Migration durchführen!

.. seealso:: Im Kochbuch:

   * :ref:`rst_cookbook_checklists_attribut_new`
   * :ref:`rst_cookbook_tips_speedup_backend`


Details aller Attribute
-----------------------

.. toctree::
   :maxdepth: 1

   attribute/alias
   attribute/checkbox
   attribute/combinedvalues
   attribute/contentarticle
   attribute/country
   attribute/decimal
   attribute/file
   attribute/langcode
   attribute/longtext
   attribute/numeric
   attribute/select
   attribute/tabletext
   attribute/tablemulti
   attribute/tags
   attribute/text
   attribute/timestamp
   attribute/token
   attribute/url
   attribute/translatedalias
   attribute/translatedcheckbox
   attribute/translatedcombinedvalues
   attribute/translatedcontentarticle
   attribute/translatedfile
   attribute/translatedlongtext
   attribute/translatedselect
   attribute/translatedtabletext
   attribute/translatedtablemulti
   attribute/translatedtags
   attribute/translatedtext
   attribute/translatedurl
   attribute/color
   attribute/geodistance
   attribute/levenshtein
   attribute/rating


.. |svg_fields_32| image:: /_img/icons_svg/fields.svg
   :width: 32px
.. |img_fields_32| image:: /_img/icons/fields_32.png
.. |img_fields| image:: /_img/icons/fields.png
.. |img_new| image:: /_img/icons/new.gif

.. |br| raw:: html

   <br />

.. |nbsp| unicode:: 0xA0
   :trim:
