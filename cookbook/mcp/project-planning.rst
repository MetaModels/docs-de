.. _rst_cookbook_mcp_project-planning:

Projekt planen mit den Metadaten (MetaModels 2.4 bis 2.6)
=========================================================

**Stand: 19.11.2026**

Dieses Rezept zeigt, wie man ein MetaModels-Projekt von einem KI-Chat **planen** lässt, bevor man etwas anlegt. Der Chat
braucht dafür keinen :ref:`MCP-Server <rst_extended_mcp-admin>` und nichts, was im System installiert ist: Er liest
eine **Metadaten-Datei**, in der alle Attribut- und Filtertypen, ihre Pakete und ihre Eigenschaften stehen, und liefert
ein Datenmodell, die Zuordnung der Felder zu Typen, die benötigten Pakete und eine Liste dessen, was noch zu prüfen ist.
Es wird nichts geändert und nichts installiert.

Das Rezept ist für **MetaModels 2.4 und 2.5** gedacht, für die es den MCP-Server nicht gibt. Es gilt auch für 2.6, dort
kann der Agent die Metadaten über das Werkzeug ``metamodels_search_catalog`` nutzen, siehe
:ref:`MCP-Administration <rst_extended_mcp-admin>`.

.. note:: Das Ergebnis ist ein **Vorschlag**. Die Antworten hängen vom Chat und vom Sprachmodell ab, der Prompt ist eine
   Vorlage zum Anpassen und keine Garantie für ein bestimmtes Ergebnis. Was der Chat nicht aus der Datei belegen kann,
   kennzeichnet er als offene Prüfung - diese Punkte prüft man selbst.

.. contents::
   :local:
   :depth: 1


Die Metadaten
-------------

Die Datei wird aus dem Repository `MetaModels/mcp-metadata <https://github.com/MetaModels/mcp-metadata>`_ erzeugt und
unter dieser Adresse veröffentlicht:

* ``https://metamodels.github.io/mcp-metadata/metadata.min.json`` - ohne Leerzeichen, rund 90 KB, für den Chat,
* ``https://metamodels.github.io/mcp-metadata/metadata.json`` - derselbe Inhalt, lesbar formatiert, rund 200 KB.

Sie enthält:

* **Pakete** mit dem Stand ihrer Verfügbarkeit (frei oder im Early-Adopter-Programm, mit Zugang) und je Release-Linie
  (2.4, 2.5, 2.6), was das Paket verlangt: PHP, Contao und die Version von MetaModels,
* **Typen** mit einer Kurzbeschreibung, Stichworten und der Seite im Handbuch, bei Attributen mit Eigenschaften
  (mehrsprachig, mehrere Werte, Datenquellen, Frontend-Editing, Dateiverwendung) und bei Filtern mit den Attributtypen,
  auf die sie sich anwenden lassen,
* **Artikel**: Seiten und Rezepte des Handbuchs zu einem Thema.

Die Eigenschaften der Typen gelten für jede Linie von MetaModels 2.x, denn eine neuere Linie fügt nur hinzu. Was später
dazukam, steht als Funktion mit der Version, in der es kam. Abweichungen je Linie, zum Beispiel die Version der
Zusatzpakete für das Frontend-Editing, nennt die Datei beim Typ. Die **Verfügbarkeit** gilt je Linie: Für 2.4 und 2.5
ist alles außer ``metamodels/core`` im Early-Adopter-Programm.

Die Felder der Datei kommen hinzu, bestehende werden nicht umbenannt oder entfernt.


Voraussetzungen
---------------

* Ein Chat, der **öffentliche Webseiten abrufen** kann. Kann er das nicht, lädt man die Datei ``metadata.min.json``
  herunter und hängt sie an. Im Prompt steht dann "Datei im Anhang" statt der Adresse.
* Die **Version von MetaModels** (``2.4``, ``2.5`` oder ``2.6``) und von **Contao**. Die PHP-Version braucht der Chat
  nicht: Er nennt, welche das Hosting haben muss.
* Eine Beschreibung des Projekts: Objekte, Felder, Beziehungen, Filter im Frontend, Frontend-Eingabe, Sprachen.


Der Prompt
----------

In der ersten Zeile ersetzt man die beiden Werte, am Ende beschreibt man das Projekt:

.. code-block:: text

   {LINIE} = 2.5
   {CONTAO} = 5.7

   Plane ein MetaModels-Projekt für MetaModels {LINIE} und {CONTAO}.

   Quelle für Attribute, Filter und Pakete ist die Datei https://metamodels.github.io/mcp-metadata/metadata.min.json
   (oder die angehängte Datei metadata.min.json). Lies sie vollständig. Kannst du sie nicht lesen, sage das und höre auf: ersetze
   sie nicht durch dein Gedächtnis.

   So ist die Datei aufgebaut:
   - `handbook`: Adresse des Handbuchs je Sprache. Link zu einer Seite = Adresse + `docs` bzw. `path`.
   - `types`: Attribut- und Filtertypen (`kind` = attribute oder filter, `type`, `package`, `summary`, `keywords` je
     Sprache, `docs`). Attribute haben `capabilities` (multilingual, multiple, datasources, file_usage,
     frontend_editing mit support und requires), Filter haben `works_with` (attribute_types, attribute_count). Beides
     gilt für jede Linie des Pakets; `lines` am Typ nennt nur, was für eine ältere Linie abweicht.
   - `packages`: die Composer-Pakete. Jedes hat `availability` und `lines`: ein Eintrag je Release-Linie von
     MetaModels (2.4, 2.5, 2.6) mit `requires` (php, contao/core-bundle, metamodels/core ...) und, wenn bekannt, einer
     eigenen `availability`.
   - `articles`: Seiten des Handbuchs zu Themen und Aufgaben, mit Schlüsselwörtern.
   Eine Suche gibt es nicht: Filtere `types` und `articles` selbst nach `summary` und `keywords` (Deutsch und Englisch).

   So liest du die Datei für die Zielversion:
   - Nimm im Paket den Eintrag in `lines` mit `metamodels` = {LINIE}. Hat das Paket diese Linie nicht, gibt es das
     Paket für das Ziel nicht: verwende es nicht, nenne eine Alternative oder Eigenentwicklung.
   - Die `availability` einer Linie gilt für diese Linie. Die `availability` des Pakets selbst ist der Stand der neuesten
     Linie (2.6): Ist {LINIE} die neueste Linie und hat sie keine eigene `availability`, gilt die des Pakets. Für eine
     ältere Linie ohne eigene `availability` ist sie unbekannt: schreibe dann "unbekannt" und nenne den Stand der
     neuesten Linie höchstens in Klammern, übertrage ihn nicht darauf.
   - `capabilities` (Attribute) und `works_with` (Filter) am Typ gelten für jede Linie des Pakets: die Linien von 2.x
     fügen nur hinzu. Hat der Typ in `lines` einen Eintrag mit `metamodels` = {LINIE}, ersetzt er sie für {LINIE}
     (so steht dort die Version der Zusatzpakete für das Frontend-Editing). Eine Fähigkeit, die später kam, ist ein
     `feature` mit `since`; ist `since` neuer als die Linie, gibt es sie in {LINIE} nicht.

   Arbeite in diesen Schritten:
   1. Anforderungen: Fasse sie zusammen, nenne Annahmen und offene Fragen. Frage nur nach, wenn die Antwort die
      Modellstruktur wesentlich ändert, sonst arbeite mit markierten Annahmen weiter.
   2. Datenmodell: MetaModels, Felder, Beziehungen. Pro Feld Zweck, Pflichtstatus, Mehrsprachigkeit,
      Einzel- oder Mehrfachwert.
   3. Zuordnung: Ordne jedem Feld und jeder Funktion einen Typ aus `types` zu, auch einfachen Feldern wie Namen oder
      Adressen (zum Beispiel `text`). Prüfe an `capabilities` bzw. `works_with`, ob der Typ passt.
      Ein fehlendes Feld heißt "unbekannt", nicht "nein".
   4. Pakete und Verfügbarkeit: Du kannst nicht prüfen, was im Projekt installiert ist. Nimm an, dass es unbekannt ist,
      außer ich gebe die Ausgabe von `composer show 'metamodels/*'` oder die composer.json an. Nenne je Paket, wie man es
      für {LINIE} bekommt (availability der Linie, bei Early Access `access`) und die Zusatzpakete
      (frontend_editing.requires). Schlage kein composer require für Pakete in Early Access vor.
   5. Kompatibilität: Vergleiche `requires` der Linie {LINIE} (php, contao/core-bundle, metamodels/core) mit dem Ziel. Das
      ist eine deklarierte Abhängigkeit, kein Nachweis. Markiere je Paket: deklariert kompatibel, deklariert nicht
      kompatibel, Linie fehlt, unklar. Nenne die Zahlen, auf denen die Einschätzung beruht. Die PHP-Version ist keine
      Eigenschaft des Projekts, sondern eine Einstellung des Hostings: Gib sie nicht als "unklar" aus, sondern als
      Voraussetzung mit der Version aus `requires` ("Stelle das Hosting auf PHP ab 8.4 ein"). Nur Contao und MetaModels
      werden gegen das Ziel verglichen.
   6. Umsetzung: Backend-Eingabe, Frontend-Ausgabe, Suche und Filter. Verweise für Details auf die Handbuchseite des
      Typs, statt sie nachzuerzählen. Sortier- und Suchbarkeit sowie das Backend-Widget stehen nicht in der Datei: als
      offene Prüfung markieren. Weise auf Funktionen hin, die Eigenentwicklung brauchen.
   7. Ausgabe: Kurzfassung, Datenmodell, dann Tabelle mit Funktion, Typ, Begründung, Verfügbarkeit ({LINIE}),
      Zusatzpakete, Kompatibilität ({LINIE}), offene Prüfung.

   Trenne in der Ausgabe: aus der Datei belegt, aus dem Handbuch belegt, abgeleitet, offen.
   Erfinde keine Paketfunktionen oder Versionsfreigaben.

   Projekt:
   <Beschreibung des Projekts: Objekte, Felder, Beziehungen, Filter im Frontend, Frontend-Eingabe, Sprachen>

Ein Beispiel für die Projektbeschreibung, eine Veranstaltungsverwaltung wie im Rezept
:ref:`Eventverwaltung mit einem KI-Agenten erstellen <rst_cookbook_mcp_event-management>`:

.. code-block:: text

   Projekt:
   Eventverwaltung, Deutsch, Englisch und Französisch (Deutsch ist Standard).
   - Events haben Titel, Beschreibung, Bild, Datum, mehrtägig (dann mit Enddatum), Uhrzeit, Ort, Preis,
     maximale Teilnehmerzahl und Kontaktinformationen.
   - Jedes Event gehört zu einer Kategorie (Konferenz, Workshop, Seminar) und hat mehrere Schlagworte.
   - Status: veröffentlicht und abgesagt.
   - Die Liste zeigt veröffentlichte Events mit Titel, Bild, Datum, Uhrzeit und Ort, absteigend nach Datum.
   - Besucher filtern nach Kategorie, Schlagwort und Datumsbereich.
   - Jedes Event hat eine eigene Detailseite.


So liest man das Ergebnis
-------------------------

Der Chat gibt eine Kurzfassung, das Datenmodell und eine **Tabelle** aus: je Funktion der Typ mit Begründung, die
Verfügbarkeit für die Linie, Zusatzpakete, die Kompatibilität und was noch zu prüfen ist.

**Verfügbarkeit.** Pakete im Early-Adopter-Programm schlägt der Chat nicht zur Installation per ``composer require``
vor, er nennt den Zugang. Bei Paketen, die es für die gewählte Linie nicht gibt (z. B. ``attribute_latlong`` in 2.4),
nennt er eine Alternative oder weist auf Eigenentwicklung hin.

**Kompatibilität.** Verglichen werden die Angaben aus der ``composer.json`` des Pakets für die Linie mit der Version von
Contao und MetaModels. Das ist eine **deklarierte** Abhängigkeit und kein Nachweis, dass es läuft. Die PHP-Version
steht als Voraussetzung für das Hosting, z. B. "PHP ab 8.4".

**Installierte Pakete.** Der Chat kann nicht sehen, was im Projekt installiert ist. Will man das berücksichtigen, gibt man
die Ausgabe von ``composer show 'metamodels/*'`` oder die ``composer.json`` des Projekts mit.

**Offene Prüfung.** Nicht in der Datei stehen die Sortier- und Suchbarkeit eines Typs, das Backend-Widget und das
Verhalten im Einzelfall, zum Beispiel ob ein Filter für Zeiträume Überschneidungen erfasst. Der Chat kennzeichnet diese
Punkte. Für Details verweist er auf die Handbuchseite des Typs.


Grenzen
-------

* Der Chat **plant**, er richtet nichts ein. Wie man MetaModels, Eingabemaske, Filter und Seiten anlegt, steht im
  Handbuch, bei MetaModels 2.6 kann das ein Agent über :ref:`MCP <rst_extended_mcp-admin>` übernehmen, siehe das Rezept
  :ref:`Eventverwaltung mit einem KI-Agenten erstellen <rst_cookbook_mcp_event-management>`.
* Die Datei beschreibt die Typen von MetaModels und seiner Pakete, **keine Erweiterungen von Dritten**.
* Für 2.4 und 2.5 ist die Verfügbarkeit eine Regel: Alles außer ``metamodels/core`` gilt als Early Access. Gibt es für ein
  Paket eine Ausnahme, kann das Ergebnis abweichen. Maßgeblich ist die Seite des Early-Adopter-Programms.
* Chats können Angaben erfinden. Der Prompt verlangt, nichts zu ergänzen, was nicht in der Datei steht, und Gelesenes
  und Abgeleitetes zu trennen. Wichtige Aussagen, besonders zu Paketen und Versionen, prüft man trotzdem.
