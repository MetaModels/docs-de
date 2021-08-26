Vorstellung von MetaModels
==========================

.. _introdution_was-ist-metamodels:

Was ist MetaModels?
-------------------

MetaModels ist eine Erweiterung für das CMS Contao. Mit der Erweiterung
ist es möglich, eine Vielzahl von strukturierten Daten einzugeben und diese
auf der Webseite nach verschiedenen Kriterien wie Listen- und Detailansicht,
Filterungen, Sortierungen, Paginierungen, Mehrsprachig u.v.a.m. wieder
auszugeben.

Mit "strukturierten Daten" sind Inhalte gemeint, wie sie üblicher Weise in
einem Datenbankschema mit verschiedenen Tabellen und Relationen abgelegt werden.
Sehr vereinfacht ausgedrückt könnte man sagen, Metamodels ist das "Access für
Contao".

MetaModels unterstützt dabei verschiedene Arten von Feldtypen (Attribute) wie z.B.
Text, Auswahlfelder (Select, Checkboxen, Radiobuttons), Integer/Dezimal, Ja/Nein-Felder,
Dateiauswahlen usw.

Die Möglichkeiten dieser Dateninhalte erstecken sich von Produktkatalogen,
Veranstaltungen/Events, Speisenpläne, Adress- oder Mitarbeiterlisten, Häuser, 
Mietobjekte bis zu Bildergalerien oder mehrsprachigen Text/Bild-Inhalten.

Die Datenmodelle können in MetaModels im Contao komplett über das Backend erstellt
werden und es bedarf keiner Programmierung wie für eine dezidierte Erweiterung.
Zur Erstellung der MetaModels gehört sowohl die Generierung der Eingabemasken 
für das Backend als auch die Ausgaben für das Frontend mit den optional
einzusetzenden Filtern.

Die MetaModels-Erweiterung zeichnet sich durch eine hohe Flexibilität in den
Möglichkeiten der Ein- und Ausgabe von Daten aus und deckt damit viele individuelle
Wünsche ab. Weitere Einzelheiten sind in der :ref:`rst_features` zu finden.
Was man mit MetaModels alles umsetzen kann, ist zum Beispiel auf der Webseite
`MetaModels Showcase <https://now.metamodel.me/de/showcase>`_ oder im `Contao
Forum <https://community.contao.org/de/showthread.php?40208-Stellt-eure-MetaModel-Websites-vor/>`_
zu finden.


Historie der MetaModels
-----------------------

MetaModels startete als die "next generation" der bekannten und vielfach geschätzten
Erweiterung 'Catalog'.

Der 'Catalog' ist im Laufe der Zeit zu einer sehr komplexen Erweiterung gewachsen und bot
viele Möglichkeiten beim Einsatz im Zusammenspiel mit Contao. Leider ist es mit der Zeit
immer schwieriger geworden, den Code zu pflegen oder neue Funktionen zu implementieren.

Aus den Erfahrungen, die bei der Entwicklung des Catalog 1 und Catalog 2 gemacht wurden,
wurde klar, dass für ein "Catalog 3" ein kompletter Neuanfang notwendig war.

Auf dieser Grundlage wurde unter dem Namen "MetaModels" eine komplett neue Erweiterung
entwickelt, in die viele moderne Programmierparadigmen eingeflossen sind. Ziel war es,
eine Erweiterung auf einer flexiblen und gut erweiterbaren Codebasis zu schaffen.

Mit der Version 2.0 von MetaModels für Contao 3.x lag das Ergebnis von vielen Stunden
der Diskussion um die "beste Lösung" und harter Programmierung vor.

Weiter ging es mit Version 2.1 als Migration von 2.0 für Contao 4.4 zur aktuellen Version
2.2 für Contao 4.9.

Bei diesen Umstellungen wurde vieles im "Unterbau" angepasst und "alte Zöpfe" abgeschnitten,
viele kleine Bugs gefixt sowie die DB-Abfragen Symfony-like umgestellt. Eine Zusammenstellung
für MM 2.2 ist :ref:`hier zu finden <new_in_mm220>`.

Für MM 3.0 gibt es auch schon Planungen - :ref:`siehe <planning_mm30>`.


MetaModels im Vergleich zu anderen Tools
----------------------------------------

MetaModels eignet sich sehr gut für die in vielen Bereichen eingesetzte Arbeitsteilung
zwischen "Administrator" und "Redakteuren" - soll heißen: der Administrator oder Entwickler
erstellt das oder die MetaModels mit den Eingabemasken und Ausgabefunktionen und der/die
Redakteur(e) können die Inhalte pflegen, wie sie das von anderen Bereichen von Contao
gewohnt sind.

Mit den Eingabemasken kann sehr genau festgelegt werden, wie und welche Daten eingeben 
werden können oder müssen. Ähnliche Funktionen gibt es z.B. bei den Erweiterungen des
"[dma_elementgenerator]" oder der "[rocksolid-custom-elements]". Der Unterschied zu 
diesen Erweiterungen liegt z.B. in der Möglichkeit in MetaModels auch komplexe
Datenstrukturen abzubilden oder auch in den vielfältigen Ausgaben- und Filterfunktionen.

Inzwischen gibt es weitere Erweiterungen, die sich aus der Idee des 'Catalog' entwickelt
haben. Nach unserer Einschätzung liegen die Vorteile von MetaModels in dessen wohlstrukturiertem
und modernen Unterbau (inkl. des DC_General) und der damit einhergehenden umfangreichen
Anpassbarkeit. Weiterhin sind viele Funktionen wie z.B. die Mehrsprachigkeit im MM-Core
fest verankert.

Vor der Umsetzung einer Aufgabenstellung steht häufig die Frage "Eigene Erweiterung oder
Einsatz von MetaModels?". Die Frage kann nicht pauschal beantwortet werden, denn mit beiden
"geht Vieles" - dennoch folgend einige Aspekte für die Entscheidungsfindung:

**Pro eigene Erweiterung:** Besteht der Wunsch oder die Forderung ein "vertreibbares Paket" zu
erstellen z.B. um eine kommerzielle Erweiterung zu entwickeln bzw. diese anderen Contao-Benutzern
"per Knopfdruck" zur Verfügung zu stellen, sollte eher über eine eigene dezidierte Erweiterung
nachgedacht werden. Für die Erstellung einer eigenen Erweiterung sind aber entsprechende Kenntnisse
der PHP-Programmierung und der Contao-API Grundvoraussetzung.

**Pro MetaModels:** Besteht der Wunsch oder die Forderung eine sehr individuelle und schnell
anpassbare Lösung in Contao zu implementieren, ist MetaModels eine gute Wahl. Wenn zudem
spezifische Funktionen wie die sehr gute Unterstützung der Mehrsprachigkeit gefordert sind,
kann MetaModels seine Stärken hervorragend ausspielen. Mit MetaModels können auch diejenigen
Benutzer Lösungen erarbeiten, die ohne Programmierung auskommen wollen oder müssen. Es ist
aber dennoch anzumerken, dass nur mit einem Grundwissen an PHP, HTML und SQL/Datenbankschema
die Möglichkeiten von MetaModels ausgeschöpft werden können.

Ressourcen
----------

* `MetaModels Projektseite <https://now.metamodel.me>`_
* `MetaModels auf Github <https://github.com/MetaModels>`_
* `MetaModels Handbuch auf Github <https://github.com/MetaModels/docs-de>`_
* `MetaModels Contao Wiki <http://de.contaowiki.org/MetaModels>`_
* `MetaModels Contao Community Subforum <https://community.contao.org/de/forumdisplay.php?149-MetaModels>`_
* `MetaModels IRC Channel on freenode #contao.mm <irc://chat.freenode.net/#contao.mm>`_
