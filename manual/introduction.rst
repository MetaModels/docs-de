Vorstellung von MetaModels
==========================

.. _introdution_was-ist-metamodels:

Was ist MetaModels?
-------------------

MetaModels ist eine Erweiterung für das CMS Contao, mit der sich beliebige strukturierte Inhalte ohne Programmierung
verwalten lassen. Ob Produktkatalog, Veranstaltungskalender, Mitarbeiterliste, Mietobjekte oder Speiseplan — wer in
Contao eine eigene Datenverwaltung mit individuellen Feldern, Filterung, Sortierung und mehrsprachiger Ausgabe
benötigt, findet in MetaModels eine fertige Lösung.

Der entscheidende Vorteil: Statt für jede neue Anforderung eine eigene Erweiterung entwickeln zu lassen, können
Administratoren neue Datenstrukturen vollständig im Contao-Backend einrichten — ohne Programmierung und ohne
externe Entwickler. Individuelle Anpassungen lassen sich damit schnell und selbständig umsetzen, auch
wenn sich Anforderungen im laufenden Betrieb ändern.

MetaModels unterstützt dabei viele Feldtypen — Texte, Auswahlfelder, Datum, Dateien, Ja/Nein-Felder u.v.m. — und gibt
diese im Frontend als Listen, Detailansichten oder gefilterte Ausgaben wieder. Redakteure pflegen ihre Inhalte
in übersichtlichen Eingabemasken, genau wie sie es aus anderen Bereichen von Contao kennen.

Weitere Einzelheiten zu den Funktionen sind in der :ref:`rst_features` zu finden.

Was mit MetaModels in der Praxis entstanden ist, zeigt der
`MetaModels Showcase <https://now.metamodel.me/de/showcase>`_ oder der
`Vortrag zur CK17 <https://www.e-spin.de/metamodels-vortrag-contao-konferenz-2017.html>`_.

Ein `aktives Team in MetaModels <https://now.metamodel.me/de/ueber-uns/team>`_ hilft bei der Umsetzung mit diesem
Handbuch oder auch dem `Contao-Forum <https://community.contao.org/de/forumdisplay.php?149-MetaModels>`_ und
`Slack-Channel <https://contao.slack.com/archives/CKGEBDV60>`_.


MetaModels im Vergleich zu anderen Tools
-----------------------------------------

MetaModels ist besonders dann die richtige Wahl, wenn eine Webseite individuelle Datenbereiche braucht, die über
einfache Inhaltselemente hinausgehen — und wenn diese Lösung wartbar, erweiterbar und für Redakteure gewohnt bedienbar
sein soll.

Die klare Stärke liegt in der Arbeitsteilung: Ein Administrator richtet das Datenmodell einmalig ein — Felder,
Eingabemasken, Filter und Ausgabe. Danach pflegen Redakteure die Inhalte selbstständig, ohne technisches
Hintergrundwissen zu benötigen.

Im Vergleich zu einer maßgeschneiderten Erweiterung bietet MetaModels einen entscheidenden Vorteil: Änderungen an
Struktur und Ausgabe sind jederzeit im Backend möglich, ohne Programmierkenntnisse und ohne Deployment. Für ein
vertreibbares, paketiertes Produkt (z. B. eine kommerzielle Erweiterung) ist hingegen eine eigene Erweiterung
sinnvoller.

Wer die Möglichkeiten von MetaModels voll ausschöpfen will — z. B. eigene Templates, komplexe SQL-Filter oder
Hooks — profitiert von Grundkenntnissen in HTML, SQL, Contao-Templating und PHP. Für Standard-Anwendungsfälle reicht
das Backend allein.


Wie fange ich an?
-----------------

Wer MetaModels noch nicht kennt, findet den einfachsten Einstieg über diese Schritte:

**1. Installation** |br|
MetaModels wird über den Contao Manager oder Composer eingerichtet. Eine Anleitung dazu
findet sich im Abschnitt :ref:`manual_install`.

**2. Erstes MetaModel anlegen** |br|
Der Abschnitt ":ref:`mm_first_index`" führt anhand eines konkreten Beispiels durch die
wichtigsten Konzepte:

- Datenmodell anlegen
- Attribute (Felder) definieren
- Eingabemaske einrichten
- Ausgabe im Frontend konfigurieren
- Filter anlegen und einbinden

**3. Checkliste für den Start** |br|
Die Seite mit dem :ref:`component_workflow` fasst die typischen Schritte beim Anlegen eines neuen MetaModels kompakt
zusammen — nützlich als Nachschlagewerk für die ersten Projekte.

**Tipp für den Einstieg:** |br|
Ein :ref:`einfaches Beispiel <mm_first_index>` — etwa eine Mitarbeiterliste mit Name,
Funktion und Foto — ist ideal zum Ausprobieren. Es enthält die wesentlichen Bausteine
(Attribute, Eingabemaske, Ausgabe, Filterung), bleibt aber überschaubar genug, um die Zusammenhänge
zu verstehen. Zur Orientierung, wo was ist, lege den
:download:`"MM-Lageplan" </_download/MM_Lageplan_e-spin-Berlin.pdf>` griffbereit zur Hand.

Bei Fragen helfen das `Contao-Forum <https://community.contao.org/de/forumdisplay.php?149-MetaModels>`_
und der `Slack-Channel #metamodels <https://contao.slack.com/archives/CKGEBDV60>`_ - bei komplexen Aufgaben kann
jemand aus dem MM-Team beratend oder als "MM-Coach" zur Seite stehen; Kontakt über
`mail@metamodels.me <mailto:mail@metamodels.me>`_.


Historie der MetaModels
-----------------------

MetaModels startete 2012 als die "next generation" der bekannten und vielfach geschätzten Erweiterung 'Catalog' - im
Mai 2013 wurde Version 1.0 veröffentlicht.

Der 'Catalog' ist im Laufe der Zeit zu einer sehr komplexen Erweiterung gewachsen und bot viele Möglichkeiten beim
Einsatz im Zusammenspiel mit Contao. Leider ist es mit der Zeit immer schwieriger geworden, den Code zu pflegen oder
neue Funktionen zu implementieren.

Aus den Erfahrungen, die bei der Entwicklung des Catalog 1 und Catalog 2 gemacht wurden, wurde klar, dass für ein
"Catalog 3" ein kompletter Neuanfang notwendig war.

Auf dieser Grundlage wurde unter dem Namen "MetaModels" eine komplett neue Erweiterung entwickelt, in die viele
moderne Programmierparadigmen eingeflossen sind. Ziel war es, eine Erweiterung auf einer flexiblen und gut
erweiterbaren Codebasis zu schaffen.

Mit der Version 2.0 von MetaModels für Contao 3.x lag das Ergebnis von vielen Stunden der Diskussion um die
"beste Lösung" und harter Programmierung vor.

Weiter ging es mit Version 2.1 als Migration von 2.0 für Contao 4.4. Bei diesen Umstellungen wurde vieles im
"Unterbau" angepasst und "alte Zöpfe" abgeschnitten, viele kleine Bugs gefixt sowie die DB-Abfragen Symfony-like
umgestellt. Eine Zusammenstellung für MM 2.2 ist :ref:`hier zu finden <new_in_mm220>`.

Der weitere Weg führte über :ref:`MM 2.3 für Contao 4.13 <new_in_mm230>` zu :ref:`MM 2.4 für Contao 5.3
<new_in_mm240>` mit mehr Standardkomponenten aus Symfony - ein MM 2.5 für Contao 5.7 ist in Arbeit.

Für MM 3.0 gibt es auch schon Planungen - :ref:`siehe <planning_mm30>`.


Ressourcen
----------

* `MetaModels Projektseite <https://now.metamodel.me>`_
* `MetaModels auf Github <https://github.com/MetaModels>`_
* `MetaModels Handbuch auf Github <https://github.com/MetaModels/docs-de>`_
* `MetaModels Contao Community Subforum <https://community.contao.org/de/forumdisplay.php?149-MetaModels>`_
* `MetaModels Contao-Slack #metamodels <https://contao.slack.com/archives/CKGEBDV60>`_
* :download:`"MM-Lageplan" </_download/MM_Lageplan_e-spin-Berlin.pdf>`


.. |br| raw:: html

   <br />

