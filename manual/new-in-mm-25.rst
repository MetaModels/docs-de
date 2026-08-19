.. _new_in_mm250:

Änderungen und Features von MM 2.5
==================================

Folgend eine Übersicht der Änderungen und Features zu MetaModels 2.5, die durch das
"early adopter Programm" ermöglicht wurden - mehr dazu unter Fundraising auf der
`MM Webseite <https://now.metamodel.me/de/unterstuetzer/fundraising#metamodels_2-5>`_.

Für einen Check nach einem Upgrade zu MM 2.5 sind :ref:`unten weitere Hinweise <check_upgrade_mm250>`.


Allgemein und Core
------------------

MetaModels 2.5 setzt auf **Contao 5.7** und **PHP 8.4** auf.

Das wichtigste neue Feature ist die Unterstützung von **Twig-Templates** zusätzlich zu den bisherigen
``.html5``-Templates.


Twig-Templates (NEU)
....................

Jedes MetaModels-Template kann nun zusätzlich als **Twig-Template** angeboten werden. Existiert für ein Template
eine Twig-Variante, hat sie **Vorrang** vor dem klassischen ``.html5``-Template - genau wie in Contao selbst.
Fehlt die Twig-Variante, wird unverändert das ``.html5`` gerendert (voller Rückwärtskompatibilitäts-Fallback).

Der Vorrang gilt sowohl im **Frontend als auch im Backend** und für **beide Ausgabeformate**: die sichtbare
Ausgabe (Format ``html5``) und die Textausgabe (Format ``text``, genutzt für Suchindex und Sortierung).
Die Textausgabe wird über ein eigenes Template mit der Endung ``.text.html.twig`` gerendert - aus dem
bisherigen ``mm_attr_text.text`` wird also ``@Contao/metamodels/attribute/text.text.html.twig``. Die
Doppelung im Namen des Text-Attributs ist kein Tippfehler: der erste Teil ist der Attributtyp, der zweite
das Format. Fehlt eine Twig-Variante, wird auch hier unverändert das Legacy-Template genutzt.

.. note:: Twig-Textvarianten werden von MetaModels **nur für die Gruppe** ``attribute`` ausgeliefert - dort
   entsteht der Inhalt für den ``text``-Knoten in ``raw`` oder für den Suchindex. Für ``filter`` und ``item``
   gibt es keine.

**Namensschema:** Die Twig-Templates liegen im gemanagten ``@Contao``-Namespace in einer eigenen Untergruppe
``metamodels/``. Aus dem bisherigen (flachen) Template-Namen wird der Twig-Identifier gebildet, indem das
konventionelle Präfix entfernt und die Gruppe (``attribute``, ``filter`` oder ``item``) vorangestellt wird:

============================  ===========  =========================================================
Bisher (``.html5``)           Gruppe       Twig
============================  ===========  =========================================================
``mm_attr_text``              attribute    ``@Contao/metamodels/attribute/text.html.twig``
``mm_filteritem_default``     filter       ``@Contao/metamodels/filter/default.html.twig``
``metamodel_prerendered``     item         ``@Contao/metamodels/item/prerendered.html.twig``
============================  ===========  =========================================================

Weil die Templates im ``@Contao``-Namespace liegen, sind sie ohne Zusatzaufwand im **Template Studio** von Contao
bearbeitbar und über **Theme-Ordner** sowie das globale Projekt-``templates/``-Verzeichnis überschreibbar.

**Eigene Twig-Templates bereitstellen:** Eigene Twig-Templates werden - wie in Contaos eigenen Bundles - unter
einem *Namespace-Root* abgelegt: ein Ordner ``twig/`` mit einer leeren Marker-Datei ``.twig-root``. Im Projekt ist
der Ordner ``templates/`` bereits ein Namespace-Root, sodass dort direkt die Unterordner-Struktur genutzt werden
kann:

.. code-block:: text

   templates/
   └── metamodels/
       ├── attribute/
       │   └── text.html.twig
       ├── filter/
       │   └── default.html.twig
       └── item/
           └── prerendered.html.twig

Innerhalb eines Templates stehen dieselben Variablen zur Verfügung wie im ``.html5`` (z. B. ``{{ raw }}`` beim
Attribut). Die aus den ``.html5`` bekannten Blöcke sind echte Twig-Blöcke - z. B. erweitert ein Filter-Widget das
Standard-Template mit ``{% extends "@Contao/metamodels/filter/default.html.twig" %}`` und überschreibt die Blöcke
``formlabel`` und ``formfield``.

**Bestehende Overrides:** Ein vorhandenes Override eines **flachen** Template-Namens im Projekt-``templates/``-Ordner
(oder in einem Theme-Ordner) - z. B. ``templates/metamodel_prerendered.html5`` - behält weiterhin **Vorrang** vor
einem mitgelieferten Twig-Template. Bestehende Anpassungen funktionieren also nach dem Upgrade unverändert weiter.

.. note:: Diese Rücksichtnahme auf Flach-Overrides ist eine **Übergangslösung** und entfällt in MetaModels 3.0
   gemeinsam mit den ``.html5``-Templates. Eigene Anpassungen sollten daher nach ``templates/metamodels/<gruppe>/…``
   umgezogen werden - entweder als ``.html.twig`` oder (übergangsweise) als ``.html5`` unter dem neuen Pfad.

**Auch die Templates des Frontend-Editings sind nun Twig-fähig.** Betroffen sind die Eingabemaske selbst
(``dcfe_general_edit``) sowie die Widgets für Dateien (``form_upload-on-steroids``), den MultiColumnWizard
(``form_mcw``) und das Mehrfach-Textfeld (``form_text_multiple``).

Diese folgen **nicht** dem oben beschriebenen ``metamodels/<gruppe>/<leaf>``-Schema, sondern Contaos eigener
Konvention mit flachem Namen: Ein ``@Contao/dcfe_general_edit.html.twig`` hat Vorrang vor dem gleichnamigen
``.html5``. Das ist kein MetaModels-Mechanismus, sondern Contaos eingebauter Twig-Vorrang für Legacy-Templates -
er gilt für jedes Template, das über Contaos Template-Klasse ausgegeben wird.

Für die Praxis heißt das: Wer eines dieser Templates überschreiben will, legt entweder wie bisher ein
``.html5`` an oder neuerdings ein ``.html.twig`` unter demselben Namen. Ein vorhandenes ``.html5``-Override in
höherer Priorität behält seinen Vorrang, bestehende Anpassungen laufen also unverändert weiter.

Für eigene Twig-Fassungen der Widget-Templates gibt es dabei eine Regel zu beachten - der ``label``-Block wird
bei Feldern mit Sprach-Badge ersetzt, siehe :ref:`rst_extended_frontend_editing`.


Icons im Backend (überarbeitet)
...............................

Sämtliche Icons des Backends wurden von **PNG auf SVG** umgestellt. Sie bleiben damit in jeder
Größe scharf - auch bei vergrößerter Browser-Darstellung oder auf hochauflösenden Bildschirmen.

**Die sechs Bereiche eines MetaModels sind an der Farbe zu unterscheiden:** Attribute (blau),
Render-Einstellungen (grün), Eingabemaske (orange), Sucheinstellungen (violett), Filter (rot) und
Zuordnungen (magenta). Die Icons der einzelnen Attribut- und Filtertypen bleiben bewusst
einfarbig grau - sie stehen in langen Listen untereinander, wo Farbigkeit nur unruhig wirkt.

|mm_list_with_icons|

**Der Dunkelmodus wird durchgängig bedient.** Für jedes Symbol, dessen Farbe im dunklen Design
nicht trägt, liegt eine eigene Fassung bereit; Contao blendet die passende ein. Deaktivierte
Schaltflächen erscheinen in einer blassen Fassung desselben Symbols, ebenfalls für beide Designs.

Drei Stellen haben darüber hinaus neue Icons bekommen:

* **Bedingungen in der Eingabemaske** trugen bisher alle dasselbe Symbol. Jetzt hat jeder Typ ein
  eigenes - UND, ODER, NICHT, „Eigenschaft ist sichtbar", „Eigenschaft hat den Wert" und
  „Eigenschaft enthält eines von". In einer verschachtelten Bedingung ist damit auf einen Blick
  erkennbar, wie sie aufgebaut ist.
* **Das Checkbox-Attribut** wird in der Item-Liste nicht mehr mit einem Auge umgeschaltet, sondern
  mit einer angehakten bzw. leeren Checkbox. Ein Auge behauptet Sichtbarkeit, ein Checkbox-Attribut
  kann aber alles Mögliche bedeuten - „bezahlt", „geprüft", „Mitglied". Die Farben entsprechen
  denen, die Contao für veröffentlicht und nicht veröffentlicht verwendet.
* **Die Notizliste** zeigt am MetaModel, ob überhaupt Notizlisten eingerichtet sind: Das Symbol ist
  gefüllt, sobald welche vorhanden sind, und bleibt sonst leer. Es gilt in der Liste der MetaModels
  ebenso wie in der Breadcrumb.

.. seealso:: Wem die Icons im Backend grundsätzlich zu klein sind, kann sie mit der Erweiterung
   `contao-backend-size-bundle <https://github.com/e-spin/contao-backend-size-bundle>`_ im eigenen
   Benutzerprofil vergrößern - die Einstellung gilt pro Benutzer, nicht für die ganze Installation.
   Die Erweiterung gehört **nicht** zu MetaModels und ist unabhängig davon einsetzbar; durch die
   Umstellung auf SVG bleiben die MetaModels-Icons dabei aber scharf.

Kurzwahl zu den Bereichen eines MetaModels (NEU)
................................................

Wer ein MetaModel konfiguriert, springt ständig zwischen seinen Bereichen hin und her: von den
Attributen in die Eingabemaske, von dort zu den Render-Einstellungen, dann zu den Filtern. Bisher
führte jeder dieser Wechsel über die Gesamtliste aller MetaModels zurück.

Rechts in der Breadcrumb stehen nun die Icons **aller Bereiche des MetaModels**, in dem man sich
gerade befindet - Attribute, Render-Einstellungen, Eingabemaske, Sucheinstellungen, Filter,
Zuordnungen und, sofern installiert, die Notizlisten. Ein Klick führt direkt hinüber.

|mm_breadcrumb_icons|

Die Kurzwahl erscheint überall dort, wo klar ist, um welches MetaModel es geht: in den Listen der
einzelnen Bereiche ebenso wie in den Bearbeitungsmasken darin. In der **Gesamtliste** aller
MetaModels erscheint sie nicht - dort ist kein einzelnes MetaModel gemeint. Ein neu angelegtes
MetaModel hat sie, sobald es gespeichert ist.

Welche Icons erscheinen, ergibt sich aus den vorhandenen Bereichen; kommt über eine Erweiterung
ein weiterer hinzu, steht er automatisch mit in der Reihe.

Deaktivierte Einträge sind durchgestrichen
..........................................

In den Listen des Backends war bisher schwer zu sehen, ob ein Eintrag abgeschaltet ist - das
Symbol am Zeilenende sagte es, der Name selbst nicht. Der Name eines deaktivierten Eintrags wird
nun **durchgestrichen** dargestellt. Das betrifft die Render-Einstellungen, die Eingabemaske, die
Filterregeln und die Auswahl von Dateien.

Bei den Dateilisten steht der Zusatz „[Standard]" hinter dem Namen. Er bleibt lesbar und wird
nicht mit durchgestrichen, damit die beiden Angaben nicht ineinanderlaufen.


Breadcrumb bei Kind-Tabellen (NEU)
..................................

Steht man in der Liste einer **Kind-Tabelle**, zeigte die Kopfzeile bisher nur den Namen des Moduls. Woher man kam und
zu welchem Datensatz die Liste gehört, stand nirgends - bei mehrfacher Schachtelung verlor man schnell die Orientierung.

Dort erscheint nun der ganze Weg, vom Basismodell bis zur aktuellen Ebene:

.. code-block:: text

   Mitarbeiter: Mayer, Herbert  ›  Dienstreisen

Jedes Glied ist verlinkt und führt auf die Listenansicht seiner Ebene, so dass ein Wechsel zwischen den Ebenen nicht
mehr über die Gesamtliste aller MetaModels führt. Bei tiefer Schachtelung bleiben Basismodell, letzte Elternebene und
aktuelle Ebene sichtbar; was dazwischen liegt, klappt zu ``…`` ein und lässt sich aufklappen:

.. code-block:: text

   Mitarbeiter  ›  …  ›  Kind 3: Drittes Kind  ›  Dienstreisen

In der **Bearbeitungsmaske** tritt der bearbeitete Datensatz als letztes Glied hinzu.

Womit ein Datensatz im Pfad benannt wird, legt die Eingabemaske seiner Ebene unter **"Ergänzungen zur
Maskenüberschrift"** fest - dasselbe Feld, das schon bisher die Überschrift der Bearbeitungsmaske ergänzte. Es nimmt
Simple Tokens über die Attribute auf, ``##model_id##`` gibt die ID aus:

.. code-block:: text

   ##model_name##, ##model_firstname##
   ##model_city## [##model_id##]

Ohne Angabe erscheint an der Stelle nur der Name des MetaModels. Ein neues Feld gibt es also nicht, und bereits
gepflegte Angaben wirken sofort mit.

.. note:: Listen **ohne** Elternschaft behalten ihre bisherige Überschrift. Contao zeigt an dieser Stelle entweder eine
   Breadcrumb oder eine Überschrift, und auf der obersten Ebene sagte die Breadcrumb dasselbe wie die Überschrift.

Aussehen und Bedienung stammen von Contao selbst - es ist dieselbe Breadcrumb wie in den Kernmodulen, samt Aufklappmenü
hinter der Auslassung. Siehe auch :ref:`component_relations` zu den Kind-Tabellen.


DC_General
----------

Der DC_General wurde als **Version 2.5** auf **Contao 5.7** umgestellt. Die wesentlichen Änderungen:

* **Referer-Handling neu:** Contao 5.7 ermittelt die Referenzseite nicht mehr über die Session, sondern über den
  ``DcaUrlAnalyzer``. Für die MetaModels-Tabellen greift das nicht, daher werden die Links für „Zurück" und
  „Speichern und schließen" nun **deterministisch** erzeugt (neu: ``ViewHelpers::getBackUrl()``). Der bisherige
  ``StoreRefererListener`` entfällt.
* **Button „Speichern und zurück" (saveNback) entfernt:** Der DC_General folgt hier Contao Core 5.7.0 - der Button
  ``saveNback`` wurde in Eingabemaske und „Alle bearbeiten" entfernt. „Speichern und schließen" (``saveNclose``)
  bleibt erhalten.
* **Contao-Altlasten entfernt:** Nicht mehr benötigte Klassen und Pfade aus Contao-Versionen kleiner 5.7 wurden
  entfernt (u. a. ``TreeSelect``, ``FileSelect`` sowie der tote File-Selector-Pfad im ``FileTree``-Widget).
* **Sortierbare Auswahllisten auf Contao-5-Technik umgestellt:** Das ``fileTree``-Widget und die Baum-Picker
  nutzen jetzt die Stimulus-Controller ``contao--sortable`` und ``contao--input-map`` von Contao anstelle des
  mit Contao 5.7 als veraltet markierten ``Backend.makeMultiSrcSortable()``. Der Button zum Entfernen einer
  Datei wird dabei serverseitig gerendert statt per JavaScript nachgerüstet. Zusätzlich wertet das
  ``fileTree``-Widget die Widget-Option ``isSortable`` aus, mit der Contao seit Version 5.0 die entfallene
  Option ``orderField`` ersetzt - letztere wird weiterhin unterstützt. An der Bedienung ändert sich nichts.
* **Baum-Wähler lassen sich einschränken (NEU):** Ein Baum-Wähler baut sich seine eigene Sicht auf die
  Zieltabelle und bot deshalb immer alle Datensätze an - auch dort, wo die Liste daneben nur eine
  gefilterte Auswahl zeigte. Über die neue Widget-Option ``sourceFilter`` kann der Aufrufer die
  erlaubten IDs mitgeben; der Wähler beschränkt sich dann darauf. Eine leere Liste bedeutet dabei
  „nichts passt" und nicht „kein Filter" - wer eine Einschränkung angibt, bekommt sie auch dann.
  Ohne die Option ändert sich nichts. Genutzt wird sie von den Attributen Auswahl und Tags, siehe dort.
* **Tooltips der Operations-Buttons korrigiert:** In den Listenansichten wurde die Anzeige der Tooltips (inkl. der
  Icons zum Öffnen von Kindtabellen) korrigiert.
* **Sprachen außerhalb der Contao-Sprachliste:** Unterstützt ein MetaModel eine Sprache, die in den
  Contao-Einstellungen nicht als Sprache aktiviert ist (z. B. ``en_DE``), erzeugte die Sprachauswahl der
  Eingabemaske eine PHP-Warnung und einen leeren Eintrag. Es wird nun der ICU-Anzeigename herangezogen und
  zuletzt das Sprachkürzel selbst, sodass die Sprache in jedem Fall auswählbar bleibt.
* **Dienste werden über den Konstruktor übergeben:** Mehrere Klassen des DC_General holten benötigte Dienste
  bisher zur Laufzeit aus dem Symfony-Container; sie bekommen sie nun als Konstruktor-Argument. Für den Betrieb
  ändert sich nichts, und **kein MetaModels-Paket ist betroffen**. Relevant ist es nur für **eigene
  Erweiterungen**, die auf dem DC_General aufsetzen: Der Ereignis-Empfänger ``WidgetBuilder`` ist von einer
  statischen auf eine gewöhnliche Methode umgestellt und sein Konstruktor nimmt jetzt vier Pflichtargumente.
  Wer ``WidgetBuilder::handleEvent()`` statisch aufruft oder die Klasse mit zwei Argumenten erzeugt, muss
  anpassen - Einzelheiten in ``docs/upgrade-2.5.md`` des DC_General.
* **MooTools vollständig entfernt:** Das gesamte Backend-JavaScript des DC_General ist auf Vanilla-JS und die
  Stimulus-Controller von Contao 5.7 umgestellt. Das betrifft auch das **Markup**: die veralteten Marker-Klassen
  ``click2edit``, ``picker_selector`` und die ID ``sbtog`` sind aus den Templates verschwunden, ebenso sämtliche
  ``onclick``-Attribute mit ``Backend.*``-Aufrufen. Die mitgelieferten JS-Dateien wurden dabei umbenannt
  (``dcGeneralAjax.js`` → ``generalAjax.js``, ``vanillaGeneral.js`` → ``generalBase.js``,
  ``generalDriver_src.js`` → ``generalDriver.js``); einen Build-Schritt gibt es nicht mehr, die ausgelieferte
  Datei **ist** die Quelle. Wer eigene DC_General-Templates überschreibt oder diese Dateien direkt einbindet,
  muss nachziehen - Details in ``docs/upgrade-2.5.md`` des DC_General.
* **Varianten folgen jetzt der Sortierung ihrer Basis:** In Baumansichten wurden die Kindeinträge
  bisher immer nach der internen Spalte ``sorting`` ausgegeben, während die oberste Ebene der in
  der Eingabemaske eingestellten Sortierung folgte. Bei einer nach einem Attribut sortierten Liste
  standen die Basisdatensätze daher in der gewünschten Reihenfolge und ihre Varianten darunter
  scheinbar willkürlich. Beide Ebenen nutzen nun dieselbe Sortierung.

  Betroffen sind ausschließlich Listen mit einer **Attributsortierung**. Bei manueller Sortierung
  ändert sich nichts, ebenso wenig, wenn gar keine Sortierung hinterlegt ist – dann bleibt es wie
  bisher bei der Reihenfolge aus ``sorting``. Die Änderung wirkt auf alle Baumansichten des
  DC_General, nicht nur auf Varianten.

* **Sichtbarkeits-Schalter folgt jetzt Contaos Modell:** Bisher tauschte der Schalter nach dem Klick per
  JavaScript nur das Symbol des angeklickten Eintrags aus. Das konnte nur für genau diesen einen Eintrag
  stimmen: In einer **Variantenhierarchie** erben die Varianten den Wert vom nicht-varianten Datensatz - schaltete
  man den Elternsatz um, änderte sich der Zustand der Varianten fachlich mit, ihre Icons blieben aber stehen,
  bis die Seite neu geladen wurde. Der Schalter ist nun ein gewöhnlicher Link: Der Server speichert den neuen
  Zustand und liefert die Liste neu aus, sodass **alle** betroffenen Zeilen sofort richtig angezeigt werden. An
  der Bedienung ändert sich nichts.
* **Seitenleiste unter Listenansichten (NEU):** Umfasst eine Liste mehr Datensätze, als der
  Seitenblock zeigt, erscheint unter der Tabelle eine Leiste mit „Seite x von y" und den
  Seitenzahlen - wie man es aus dem Contao-Backend kennt. Zusätzlich führen „Anfang", „Zurück",
  „Vorwärts" und „Ende" zu den Randseiten. Der Seitenblock-Wähler im Panel bleibt unverändert;
  die Leiste kommt hinzu, ohne etwas zu ersetzen. Passt alles auf eine Seite, wird sie nicht
  angezeigt. Die gewählte Seite bleibt wie die übrigen Panel-Einstellungen erhalten, wird aber
  bewusst zurückgesetzt, sobald ein Filter oder die Blockgröße geändert wird - andernfalls
  landete man auf einer Seite, die es nach der neuen Auswahl gar nicht mehr gibt.

  **Auch die Baumansicht** hat nun eine Seitenleiste, und dort ist zusätzlich der
  Seitenblock-Wähler neu - bisher war er ausgeblendet und der Baum wurde stets vollständig
  geladen. Gezählt werden dabei ausschließlich die **Datensätze der obersten Ebene**, bei
  Varianten also die Basen. Jede Basis erscheint mit allen ihren Varianten; „Seite 1 von 3"
  bedeutet demnach „Basis 1-3 von 7" und nicht „Zeile 1-3 von 20". Über alle Knoten zu
  blättern würde Basen von ihren Varianten trennen. Was aufgeklappt ist, bleibt beim Blättern
  aufgeklappt.
* **Turbo Drive ist im Backend aktiv:** Die Navigation zwischen den MetaModels-Backend-Seiten läuft über Contaos
  Turbo Drive, das heißt ohne vollständigen Seitenaufbau; die Scrollposition bleibt dabei erhalten. Die
  **Formulare** des DC_General sind bewusst ausgenommen (``data-turbo="false"``), weil das automatische Absenden
  bei Anzeigebedingungen die Maske ohne Weiterleitung neu rendert - eine Antwort, die Turbo verwerfen würde.
* **Eingabemaske und Speichern beschleunigt:** Beim Aufbau der Eingabemaske wurde das Datenmodell bisher für
  **jedes einzelne Feld** komplett neu zusammengesetzt - bei einer Maske mit 27 Feldern also 27-mal. Das geschieht
  nun einmal je Durchlauf. Die Zahl der Attribut-Umwandlungen sinkt dadurch erheblich, im Testfall von 1.785 auf
  221 Aufrufe je Speichervorgang. Ebenfalls entschärft: Die Ermittlung, ob eine Anfrage aus dem Backend stammt,
  wurde je Speichervorgang rund 6.000-mal neu durchgeführt und wird jetzt einmal je Anfrage gemerkt. An der
  Bedienung und am Ergebnis ändert sich nichts, es geht ausschließlich um Laufzeit.

.. note:: **Wer das Backend als langsam empfindet, sollte zuerst die Umgebung prüfen** - nicht MetaModels. In
   einer Messung an derselben Eingabemaske dauerte ein Speichervorgang im Symfony-**dev**-Modus mit aktivem
   Xdebug rund 10,9 Sekunden, im dev-Modus ohne Xdebug 4,2 Sekunden und im **prod**-Modus 0,75 Sekunden. Ein
   dauerhaft eingeschaltetes ``xdebug.mode=debug`` mit ``start_with_request=yes`` allein kostet den Faktor 2,6,
   weil bei **jeder** Anfrage ein Verbindungsversuch zum Debugger unternommen wird. Auf Produktivsystemen gehört
   Xdebug abgeschaltet und ``APP_ENV=prod`` gesetzt.


Attribute
---------

Für die Attribut-Templates gibt es durchgängig **Twig-Varianten** unter
``metamodels/attribute/<typ>`` (siehe Abschnitt „Twig-Templates"). Die bisherigen
``.html5``-Templates bleiben als Fallback erhalten und werden nur noch dann verwendet,
wenn sie im Projekt-``templates/``-Verzeichnis überschrieben wurden; in MetaModels 3.0
entfallen sie.

* **Der umschließende Block kommt jetzt aus dem Attributstemplate:** Bis 2.4 gab das Listentemplate
  um jeden Wert den Block ``<div class="field …"><div class="label">…</div><div class="value">…</div></div>``
  aus, das Attributstemplate lieferte nur den innersten Schnipsel. Wer die Ausgabe gestalten wollte,
  kam damit an den umschließenden Container nicht heran (`core#660
  <https://github.com/MetaModels/core/issues/660>`_). Ab 2.5 gibt das Attributstemplate den Block
  selbst aus.

  **Für bestehende Ausgaben ändert sich nichts.** In den Rendersettings gibt es dafür die Option
  „Wrapper im Listen-Template (Altverhalten, Deprecated)", und eine Migration setzt sie beim Upgrade
  für alle vorhandenen Rendersettings. Nur neu angelegte Rendersettings starten ohne die Option.
  Sie ist von Anfang an als deprecated gekennzeichnet und entfällt in 3.0.

  Zu beachten: Eigene Attributstemplates geben den Block nicht aus, solange sie nicht angepasst
  wurden - in einer neu angelegten Rendersetting fehlt er dort also. Im Spaltenmodus der
  Backend-Liste wird bewusst kein Block ausgegeben, weil die Spaltenüberschrift die Beschriftung
  bereits trägt. Und wer den Knoten ``html5`` außerhalb des Listentemplates verwendet, etwa über
  ``parseAll()`` in eigenem Code, bekommt für neue Rendersettings andere Werte; ``text``, ``raw``
  und ``attributes`` bleiben unverändert.

  Für eigene Attributstemplates gibt es dafür vier neue Werte: ``label``, ``colName``,
  ``hideLabels`` und ``legacyAttributeWrapper``. Das Muster samt Beispiel steht unter
  :ref:`component_templates_attribute-wrapper`.

* Auswahl (select), Übersetzte Auswahl (translatedselect), Tags und Übersetzte Tags
    * **Sprung in die Relationstabelle (NEU):** Neben der Feldbeschriftung steht im Backend ein
      Symbol, das die Tabelle öffnet, auf die das Attribut verweist - in einem neuen Tab, damit
      die ungespeicherte Eingabemaske erhalten bleibt.
    * Verweist das Attribut auf ein **MetaModel**, führt der Sprung in dessen Backend-Modul;
      verweist es auf eine **Contao-Tabelle**, in das zuständige Contao-Modul. Für Letztere ist
      eine Zuordnung hinterlegt (u. a. ``tl_page``, ``tl_article``, ``tl_news``,
      ``tl_calendar_events``, ``tl_faq``, ``tl_member``, ``tl_user``).
    * **Die Berechtigungen werden beachtet.** Das Symbol erscheint immer, ist aber ausgegraut und
      nicht anklickbar, wenn die Zieltabelle für die eigene Benutzergruppe nicht freigegeben ist,
      wenn das Feld schreibgeschützt ist oder wenn für eine Contao-Tabelle kein Modul hinterlegt
      ist. Der Grund steht jeweils im Tooltip. Administratoren sehen alles.
    * Kein Symbol gibt es, wenn das Ziel-MetaModel ausschließlich als **Kindtabelle** gepflegt
      wird - dorthin führt kein eigener Aufruf, sondern die Operation in der Elternliste.
    * Im **Frontend-Editing** erscheint das Symbol nicht.
    * **Der eingestellte Filter gilt jetzt auch im Baum-Wähler (NEU):** Ist das Attribut als
      Baum-Wähler eingestellt, öffnete das Popup bisher die vollständige Zieltabelle - die
      Einschränkung wirkte nur auf die Auswahlliste daneben. Auswählbar war damit auch, was gar
      nicht zur Auswahl stehen sollte. Das Popup hält sich nun an dieselbe Einschränkung.
    * Das gilt für **beide Wege**, ein Ziel einzugrenzen: die *Filtereinstellung*, wenn das Attribut
      auf ein MetaModel verweist, und die *Bedingung* (SQL) bei einer Contao-Tabelle. Beide werden
      aus derselben Abfrage bedient, aus der auch die Auswahlliste ihre Einträge zieht - die beiden
      Ansichten können daher nicht auseinanderlaufen.
    * Bei der Bedingung ist der **Tabellen-Alias** zu beachten; er unterscheidet sich zwischen den
      Attributtypen. Bei Tags ist es ``t.``, bei Auswahl ``sourceTable.`` - also etwa
      ``sourceTable.username='tester'``. Der jeweils gültige Alias steht in der Beschreibung des
      Eingabefeldes.
    * Ist **kein** Filter eingestellt, ändert sich nichts. Die Einschränkung wird dann gar nicht
      erst ermittelt - ein Baum-Wähler wird ja gerade dort verwendet, wo die Zieltabelle zu groß
      für eine Auswahlliste ist.
    * **Zu beachten:** Wird eine Einschränkung nachträglich verschärft, verschwinden bereits
      gespeicherte Werte, die ihr nicht mehr entsprechen, aus der Maske - im Wähler ebenso wie in
      der Auswahlliste, wo es schon bisher so war. Beim nächsten Speichern des Datensatzes sind sie
      dann auch im Datenbestand fort. Vor einer Verschärfung lohnt daher ein Blick darauf, ob
      Datensätze betroffen sind.

* Levenshtein (levenshtein)
    * **Schreibweise durchgängig korrigiert:** Der Attributtyp hieß seit seiner ersten Fassung
      ``levensthein`` - mit vertauschtem ``h`` und ``t``. Klassennamen, Composer-Paket und Template
      waren schon früher richtiggestellt worden, der Typname selbst, die beiden Index-Tabellen und
      zwei Spalten in ``tl_metamodel_attribute`` aber nicht. Das ist nun nachgeholt: überall steht
      ``levenshtein``.
    * Betroffen sind die Tabellen ``tl_metamodel_levensthein`` und ``tl_metamodel_levensthein_index``,
      die Spalten ``levensthein_distance`` und ``levensthein_attributes`` sowie der in
      ``tl_metamodel_attribute`` und ``tl_metamodel_filtersetting`` gespeicherte Typname. Auch die
      Filterregel des Attributs trug den falschen Namen.
    * Eine **Migration** benennt beides um und zieht die gespeicherten Typnamen nach - der vorhandene
      Suchindex bleibt dabei erhalten und muss **nicht** neu aufgebaut werden. Es ist nichts von Hand
      zu tun.

* Bewertung (rating)
    * die **MooTools-Variante wurde entfernt** (Template ``mm_attr_rating_moo.html5`` sowie die
      MooTools-JS-Dateien ``moostarrating.js``/``moostarrating_src.js``) - es bleibt die
      Vanilla-Star-Rating-Variante
    * neue Twig-Templates ``metamodels/attribute/rating`` (bindet das JS via ``{% add … to body %}``
      ein) und ``metamodels/attribute/rating_raw``

* Datei (file) und Übersetzte Datei (translatedfile)
    * die **separate Spalte für die Sortierung entfällt** - die Reihenfolge mehrerer Dateien steckt nun im Wert
      selbst, genau wie Contao es seit Version 5.0 handhabt
    * bisher legte MetaModels bei gesetzter Option *Mehrere Dateien* (``file_multiple``) eine zusätzliche Spalte
      ``<spaltenname>__sort`` in der Item-Tabelle an; bei *Übersetzte Datei* übernahm die Spalte ``value_sorting``
      in ``tl_metamodel_translatedlongblob`` diese Aufgabe
    * Hintergrund: Contao hat die Widget-Option ``orderField`` mit Version 5.0 entfernt - das ``fileTree``-Widget
      kennt nur noch ``isSortable`` und legt die Reihenfolge direkt im Feldwert ab. Die manuelle Sortierung war
      damit unter Contao 5 faktisch wirkungslos geworden
    * eine **Migration** überführt die vorhandene Reihenfolge in den Wert und löscht die Spalte anschließend:
      Einträge aus der Sortier-Spalte zuerst, danach die restlichen Dateien in ihrer bisherigen Reihenfolge
    * die virtuellen Hilfsattribute ``<spaltenname>__sort`` entfallen; die Klassen ``FileOrder`` bzw.
      ``TranslatedFileOrder`` sind als *deprecated* markiert und werden in MM 3.0 entfernt
    * an der Bedienung ändert sich nichts: mehrere Dateien werden in der Eingabemaske weiterhin per
      Drag & Drop sortiert und über den Button am Vorschaubild einzeln aus der Auswahl entfernt


Filter
------

* Die Filter-Widgets im Frontend werden nun über die MetaModels-Template-Engine gerendert und folgen damit demselben
  ``@Contao/metamodels/filter/<name>``-Schema wie Attribute und Items (siehe Abschnitt „Twig-Templates").
* **Statischer Parameter bei mehrsprachigen Attributen:** Die Filterregel „einfache Abfrage" mit gesetztem
  „Statischer Parameter" erlaubt eine Vorauswahl im Content-Element bzw. FE-Modul. Steckt hinter der Regel ein
  Attribut, dessen Werte übersetzt sind, war diese Vorauswahl bisher an die Sprache gebunden, in der sie gesetzt
  wurde: Wer sie auf Deutsch einstellte und das Element später mit englischer Profilsprache öffnete, sah statt der
  Auswahl einen unlesbaren Eintrag „Unknown option: …" — und verlor die Einstellung, sobald er das Feld anfasste.

  Die Auswahl wird jetzt über den referenzierten Datensatz aufgelöst, nicht über den Wert selbst. Damit zeigt das
  Feld unabhängig von der Profilsprache den passenden Eintrag. Das gilt auch, wenn das MetaModel eine Sprache führt,
  für die es gar keine Backend-Profilsprache gibt — dann greift die Rückfallsprache.

  **Die Filterung war nie betroffen.** Der gespeicherte Wert wird vor der Abfrage in die ID des referenzierten
  Datensatzes umgewandelt, unabhängig von der Sprache. Bestehende Vorauswahlen bleiben gültig, eine Migration ist
  nicht nötig. Zu beachten ist lediglich: Wer ein Element speichert, dessen Wert er in fremder Sprache vorfand,
  schreibt ihn dabei auf seine eigene Sprache um — gleichwertig, aber der gespeicherte Wert wandert mit.

  Dasselbe gilt für die Vorauswahl in den **Sucheinstellungen** eines MetaModels, die dieselben Filterparameter
  verwendet.


Frontend-Editing (FEE)
----------------------

Am Frontend-Editing selbst hat sich in MM 2.5 nichts geändert - der Funktionsumfang entspricht dem aus MM 2.4.
Zwei Punkte betreffen es aber mittelbar:

* Die **Templates der Eingabemaske und ihrer Widgets** lassen sich nun auch als Twig-Templates überschreiben -
  siehe Abschnitt „Twig-Templates".
* Die **Kennzeichnung übersetzter Felder** durch ein farbiges Abzeichen hinter der Beschriftung funktioniert
  unverändert - grün für eine eigene Übersetzung, orange für einen aus der Fallbacksprache geerbten Wert, der
  erklärende Satz als Tooltip. Für Redakteure ändert sich nichts.

  Unter der Haube war dafür Arbeit nötig: Contao 5.7 rendert die Formularfelder im Frontend über
  Twig-Templates, welche die Beschriftung escapen - HTML im Label erschiene dort als Quelltext. Bis Contao 5.3
  gaben die alten ``.html5``-Templates sie unverändert aus, weshalb das Abzeichen einfach im Label stehen
  konnte. Es wird nun über ein eigenes Template ausgegeben, das MetaModels nur den betroffenen Feldern zuweist;
  Formulare außerhalb des Frontend-Editings bleiben unberührt. Felder, die noch über ein
  ``.html5``-Template ausgegeben werden, bekommen das Abzeichen weiterhin direkt im Label.

Zur Bedienung des Frontend-Editings insgesamt: :ref:`rst_extended_frontend_editing`.


Known-Issues
------------

* bei Umschaltung zu/vom Debugmodus im BE per Button stimmt die Referenzseite nicht mehr und man muss die Seite
  erneut ansteuern - z. B. mit „zurück" im Browser und Reload der Seite |br|
  Ursache ist der von Contao erzeugte Umschalt-Link ``?do=debug&key=enable&referer=…``: auf den route-basierten
  MetaModels-Backend-Seiten (z. B. ``/contao/metamodel/mm_employees``) bleibt der ``referer``-Parameter **leer**,
  sodass Contao nach dem Umschalten auf das Backend-Dashboard statt zur Ausgangsseite zurückführt. Das betrifft
  Contaos eigenen Debug-Umschalter und wird vom neuen Referer-Handling des DC_General (eigene „Zurück"-Buttons)
  nicht erfasst - Contao bietet an dieser Stelle keine Möglichkeit, den Referer zu beeinflussen.


.. _check_upgrade_mm250:
Check für Upgrade auf MM 2.5
----------------------------

Grundsätzlich ist ein Upgrade innerhalb des MM 2.x-Zweiges problemlos möglich und ggf. notwendige Anpassungen an
Bezeichnungen und DB-Änderungen werden über Migrationen abgefangen. Es gibt aber ein paar Sachen, die damit nicht
oder nur sehr schwer abzufangen sind. Aus dem Grund sollten bei der Umstellungen auf MM 2.5 die folgenden Punkte
im Blick behalten werden:

* bitte alle Hinweise aus :ref:`MM 2.4 <check_upgrade_mm240>` beachten
* Voraussetzungen prüfen: **Contao 5.7** und **PHP 8.4**
* **eigene Template-Overrides** am flachen Namen (z. B. ``templates/metamodel_prerendered.html5``) funktionieren
  weiter, sollten aber nach ``templates/metamodels/<gruppe>/…`` umgezogen werden - der Flach-Override-Vorrang
  entfällt in MM 3.0
* wer eigene Twig-Templates ausliefert: Ordner ``twig/`` mit ``.twig-root``-Marker und Struktur
  ``metamodels/<gruppe>/<leaf>.html.twig`` verwenden
* **DC_General:** Anpassungen zum Referer-Handling und der Wegfall des Buttons „Speichern und zurück" (saveNback)
  beachten; eigene Templates/Programmierungen, die auf ``saveNback`` bauen, anpassen
* **Sortier-Links:** wer die Contao-Schlüssel ``MSC.orderMetaModelListByAscending``/``…Descending`` für die
  Beschriftung der Sortier-Links überschrieben hatte, stellt auf ``sorting_direction_label`` (mit
  ``%attribute_name%`` und ``%direction%``), ``sorting_direction_asc`` und ``sorting_direction_desc`` in der
  Domain ``metamodels_default`` um
* **Eigene DC_General-Erweiterungen:** der Ereignis-Empfänger ``WidgetBuilder`` hat eine geänderte Signatur
  (``handleEvent()`` nicht mehr statisch, vier Pflichtargumente im Konstruktor). Nur betroffen, wer ihn selbst
  aufruft oder erzeugt - die mitgelieferten MetaModels-Pakete tun das nicht
* **DC_General-Backend-JavaScript:** wer eigene DC_General-Templates überschreibt, eigenes JavaScript gegen deren
  Markup laufen lässt oder die mitgelieferten JS-Dateien direkt einbindet, muss nachziehen - MooTools ist raus,
  die Marker-Klassen (``click2edit``, ``picker_selector``, ``sbtog``) und die ``onclick``-Attribute sind ersetzt,
  die JS-Dateien umbenannt
* **Levenshtein-Attribut:** die durchgängige Korrektur von ``levensthein`` auf ``levenshtein`` wird per Migration
  erledigt, der Suchindex bleibt erhalten. Anpassen muss nur, wer die alten Namen **selbst** verwendet: eigene
  SQL-Auswertungen oder Exporte auf ``tl_metamodel_levensthein``/``tl_metamodel_levensthein_index`` bzw. auf die
  Spalten ``levensthein_distance``/``levensthein_attributes``, sowie eigener PHP-Code, der den Typnamen
  ``levensthein`` hart prüft. Die Klasse ``LevenstheinSearchRule`` bleibt übergangsweise als *deprecated* Alias
  erhalten und entfällt in MM 3.0
* **Icons:** die Icons liegen nun als SVG vor, die abgelösten PNG-Dateien wurden **entfernt**. Für die Bedienung
  ändert sich nichts. Anpassen muss nur, wer die alten Dateien selbst verwendet: eigenes CSS, das ein
  MetaModels-Symbol als Hintergrundbild einbindet, oder eigene DCA-Angaben, die auf einen ``.png``-Pfad unterhalb von
  ``bundles/metamodels…/images/`` zeigen. Dort ist die Endung auf ``.svg`` zu ändern
* **Datei-Attribute:** die Sortier-Spalten ``<spaltenname>__sort`` bzw. ``value_sorting`` werden per Migration in
  den Wert überführt und danach **gelöscht** - vorher unbedingt eine Datensicherung anlegen, das Löschen der
  Spalten ist nicht umkehrbar. Eigene Programmierungen oder Auswertungen, die direkt auf diese Spalten zugreifen,
  müssen angepasst werden; die Reihenfolge steht jetzt im Wert selbst. Im geparsten Wert bleiben die bisherigen
  Schlüssel ``bin_sorted``/``value_sorted``/``path_sorted``/``meta_sorted`` (Datei) und ``value_sorting``
  (Übersetzte Datei) erhalten, sie entsprechen nun dem unsortierten Pendant. Der bereits seit 2.1 als veraltet
  markierte Schlüssel ``sort`` entfällt


Re-Finanzierung
---------------
.. seealso:: Für eine Re-Finanzierung der umfangreichen Arbeiten, bittet das MM-Team um finanzielle
   Zuwendung. Als Richtgröße sollte der Umfang des zu realisierenden Projektes genommen werden
   und etwa 10% einkalkuliert werden - aufgrund der Erfahrung der letzten Zuwendungen, sind
   das Beträge zwischen 100€ und 500€ (Netto) - eine Rechnung inkl. MwSt wird natürlich immer
   ausgestellt. `Mehr... <https://now.metamodel.me/de/unterstuetzer/spenden>`_


.. |mm_list_with_icons| image:: /_img/screenshots/new_in_2-5/mm_list_with_icons.png
.. |mm_breadcrumb_icons| image:: /_img/screenshots/new_in_2-5/mm_breadcrumb_icons.png


.. |br| raw:: html

   <br />
