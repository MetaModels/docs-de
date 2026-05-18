.. _rst_features:

Funktionsübersicht
==================

Datenmodelle
-------------

MetaModels ermöglichen die komfortable und (nahezu) unbeschränkte Definition von Datenmodellen im Backend von Contao –
ganz ohne Programmierung. Zum Aufbau komplexer Datenmodelle stehen verschiedene :ref:`Relationen <component_relations>`
zur Verfügung, um Daten in eigene Tabellen zu speichern und diese zu verknüpfen - siehe
`Normalisierung <https://de.wikipedia.org/wiki/Normalisierung_(Datenbank)>`_.

In den Datenmodellen stehen verschiedene Datentypen für die Datenfelder (Attribute) zur Verfügung wie z.B. Text, Bilder,
Zahlen, Datum, Dateien - :ref:`hier eine Übersicht von Datentypen zu Attributen <component_data-in-attributes>` bzw.
eine :ref:`Auflistung aller Attribute <component_attribute_index>`. Sollte eine Beschränkung erreicht werden, indem
der gewünschte Datentyp nicht verfügbar ist, ist eine eigene Implementierung mit der :ref:`MM-API <ref_api>` möglich.

Es ist auch möglich, die Tabellen an andere Tabellen des Contao Core anzuknüpfen, :ref:`"Eltern-Kind-Verbindungen"
<component_relations_child-tables>` herzustellen oder die Umsetzung von :ref:`Varianteneingaben
<component_relations_variants>`.


Eingabemasken
-------------

Für das Backend können komplexe Eingabemasken definiert werden, welche die "Redakteure" im gewohnten "Look&Feel" von
Contao belassen. Innerhalb einer Eingabemaske kann auf die Eingabe von Werten oder Checkboxen reagiert werden
um wahlweise verschiedene Sub-Paletten einzublenden - siehe :ref:`component_dca_visibility-conditions`.

Für eine leichte Orientierung in den Daten kann die Anzeige mit verschiedenen Filtern, Such- und Gruppierungsfunktionen
ausgebaut werden.

Das flexible Rechtesystem welches für MetaModels entwickelt wurde, gestattet es, unterschiedliche Backendansichten
für Redakteur- und Administrator-Benutzergruppen zu definieren.

Das Backend kann weiterhin dahingehend angepasst werden, dass nur bestimmte Gruppen Zugriff auf einzelne Eingabefelder
erhalten und obendrein kann auch deren Reihenfolge individuell pro Benutzergruppe angepasst werden.


Mehrsprachigkeit
----------------

MetaModels wurden von Anfang an mit dem Anspruch der Mehrsprachigkeit entwickelt.
Daher können Attribute die Übersetzung der von ihnen gespeicherten Daten in
mehrere Sprachen unterstützen. Man muss im Backend lediglich mittels des
Sprachenwählers in die gewünschte Sprache wechseln und kann sofort den Datensatz
in der gewählten Sprache bearbeiten.

Das Beste hierbei ist, dass Attribute, die nicht übersetzbar sind, auch nicht
übersetzt werden. Dies ermöglicht es beispielsweise lediglich die Namen und
Beschreibungstexte von Produkten übersetzbar zu machen, die Produktnummer und Maßangaben
jedoch nicht. Diese Arbeitsweise verringert die Redundanz der einzugebenden
Daten.

:ref:`Mehr zu den Einstellungen und Handhabung der Mehrsprachigkeit, bei den Komponenten eines
MetaModel. <component_multi-language>`


Filter
------

MetaModels verfügt über ein mächtiges Filterkonzept, mit dem sich auch komplexe Aufgabenstellungen umsetzen lassen.
Der Websiteadministrator kann die Filterinteraktionen vollkommen frei an seine Bedürfnisse anpassen. Dies
gelingt durch die Konfiguration und Kombination von Filtereinstellungen und deren Parametern.

MetaModels wird mit verschiedenen Filtereinstellungen ausgeliefert, um Filter-Eingabefelder im Frontend wie
beispielsweise Auswahlboxen, Bereichsfilter, Freitext-Suche usw. zu erzeugen - :ref:`eine Übersicht ist hier
zu finden <component_filter_list>` bzw. :ref:`hier, welche Attribute wie gefiltert werden können
<component_data-in-attributes>`.

Kombiniert man diesen Filter mit Filtereinstellungen wie UND/ODER-Bedingungen, oder individuelle SQL-Abfragen, entstehen
komplexe und interaktive Filter.

MetaModels legt keine Beschränkungen bei der Kombination von Filtern fest und beherrscht auch äußerst
komplexe Filterszenarien. Dank der offenen Struktur der :ref:`MM-API <ref_api>`, können auch eigene Filterregeln mit
geringem Aufwand programmiert werden.


Dynamische Ansichten
--------------------

Mittels der Ausgabeeinstellungen wurde in MetaModels das "partial"-Template Konzept von
Contao in einer erweiterten Form umgesetzt. Der Anwender kann jeglichen Aspekt
der Ansichten auf der Ebene der Attribute und Datensätze anpassen.

Etliche allgemeine Einstellungen können in der Backend-Konfiguration festgelegt
werden. Diese können jedoch auch überschrieben, feingranular angepasst oder gar gänzlich
ignoriert werden, indem man ein eigenes Template auf Ebene der Attribute oder Datensätze
festlegt. Diese Ausgabeeinstellungen bieten den flexibelsten Weg 'Daten-Views' zu
definieren.

Der Designer kann für jeden Zweck eine komplett andere Ansicht definieren, sei es eine
simple Listenausgabe, einen Teaser für die Startseite oder eine Detailansicht eines
Datensatzes, und ebenso wann und wo sie eingesetzt werden soll.

Auf der Seite ":ref:`component_templates`" ist die Hierarchie und der Aufbau der Templates erklärt.


Erweiterungen
-------------

Für spezielle Aufgabenstellungen gibt es weitere Pakete, die MetaModels in seinem Funktionsumfang wie z. B. eine
Umkreissuche, Merkliste, Frontend-Editing oder Schnittstelle zum Shop `Isotope` ergänzen bzw. erweitern.

Eine Übersicht ist hier zu finden: :ref:`extended_index`


Ausblick
--------

An der Funktionsvielfalt von MetaModels wird kontinuierlich weiter gearbeitet. Eine schnelle Umsetzung von weiteren
Funktionen ist nur mit finanzieller Unterstützung oder der Freigabe von Auftrags-Programmierungen möglich -
Informationen dazu auf der `Projektwebseite von MetaModels <https://now.metamodel.me>`_ oder das MM-Team direkt
kontaktieren: `mail@metamodels.me <mailto:mail@metamodels.me>`_.
