.. _new_in_mm220:

Änderungen und Features von MM 2.2
==================================

.. seealso:: Die Liste wird kontinuierlich erweitert

Folgend eine Übersicht der Änderungen und Features zu MetaModels 2.2, die durch das
"early adopter Programm" ermöglicht wurden - mehr dazu unter Fundraising auf der
`MM Webseite <https://now.metamodel.me/de/unterstuetzer/fundraising#metamodels_2-2>`_.

An der Stelle nochmal der Hinweis, dass MM 2.2 PHP 7.4 voraussetzt. Änderungen an Bezeichnungen
und Beschreibungen sind erstmal nur zu sehen, wenn die Backendsprache auf Englisch gestellt ist.
Die Übersetzungen per Transifex können erst eingespielt werden, wenn die Pakete wieder bei Github
sind.

In dem Issue auf `Github <https://github.com/MetaModels/core/issues/1424>`_ gibt es
eine Auflistung der für MM 2.2 fertig gestellten Repositories, d. h. es gibt dort
keine Tickets mehr, die auf MM 2.2 verweisen.

Für einen Check nach einem Upgrade zu MM 2.2 sind :ref:`unten weitere Hinweise<Check für Upgrade auf MM 2.2>`.

Allgemein und Core
------------------

* kompatibel zum `strict mode` von MySQL und MariaDB; alle Queries auf queryBuilder umgeschrieben und bei den
  Abfragen einen Tabellenpräfix eingefügt - damit fällt die prüfung auf die von MySQL-Reservierten Wörter weg
* verschiedene Optimierungen für eine schnellere Anzeige von Daten
* Backend von MM "aufgeräumt" und typische Einstellungen als Default gesetzt (ca. 30% weniger Klicks beim Erstellen)
* im Backend sind im Panel (Bereich über der Listenansicht) die Standardicons aus Contao für Filterung und Filter
  zurücksetzen statt der "Gelben Pfeile" eingebaut
* Im Bereich der übersetzten MetaModels wurde etliches an Code refactored - so ist z.B. ein neues Interface
  ITranslatedMetaModel hinzu gekommen für eine einfachere und saubere Schnittstelle und Ansprache der Daten.
  Für den "MM-Enduser" ändert sich zwar erstmal nichts Sichtbares, aber es vereinfacht und sichert die
  Arbeit/Entwicklung der Mehrsprachigkeit bei MM.
* Überarbeitung aller Migrationen für Unterstützung `strict mode` nun `case sensitive` für Spaltennamen
* Entfernung der nicht mehr von Contao unterstützten xhtml-Templatedateien; in der Migration kommt ein Hinweis,
  wenn alte von Contao nicht mehr unterstützte xhtml-Templatedateien von MM gefunden werden - automatisch können
  diese leider nicht angepasst werden.
* In Liste der Attributen Suche und Filterung nach Name bzw. Typ
* In Einstellung Eingabemaske (fehlerhafte) DCA-Popups entfernt - dafür Helper-Popup ("Verkehrszeichen")
* Unterstützung des Cachings (ESI-Tags)
* Verbesserte Anzeige bei Auswahl von Attributen - nun im Schema 'Attribut-Name [Typ, "Spaltenname"]'
* neues FE-Ausgabetemplate für Debuganzeige: metamodel_prerendered_debug.html5
* Für die URL der Weiterleitungsseite (jumpTo) musste man bei den Rendersettings sowohl die Seite
  als auch einen Filter angeben - nun ist nur noch die Seitenauswahl notwendig und die URL wird im
  Listentemplate ausgegeben. Damit kann man z. B. aus dem BE einen Link auf der Detailseite zurück
  zur Listenseite anlegen ohne einen Filter angeben zu müssen. Zur Prüfung ob Filterparameter gesetzt
  wurden, gibt es nun den Knoten "deep" - der ist `true`, wenn Parameter vorhanden.
* neue Optionen bei der Paginierung der MM-Listenausgabe (Siehe Screenshots unten)

  * dynamischer Parameter verhindert das "Übersprechen" der Paginierung anderer Listen
  * die Bezeichnung des Paginierungsparameters kann frei gewählt werden
  * ein eigenes Template für die Paginierung ist möglich - Standard "mm_pagination.html5"
  * es kann ausgewählt werden, ob der Parameter per Slug (/page_mmce42/3) oder GET (?page_mmce42=3) übergeben wird
  * die Links der Paginierung können um ein URL-Fragment (Sprunganker) erweitert werden - ggf. eigene Templates anpassen
* neue Optionen beim Überschreiben der Sortierung bei der MM-Listenausgabe (Siehe Screenshots unten)

  * die Bezeichnung der Standardparameter "orderBy" und "orderDir" kann mit eigenen Werten überschrieben werden
  * die Parameter können wahlweise als Slug und/oder GET angegeben werden
* neue Option zur Übermittlung von eigenen Parametern von den Einstellungen der Listenausgabe (CE/FE-Modul) an das
  Listentemplate. Über einen MCW können eigene "Key-Value-Pärchen" erstellt werden, die im Template über
  "$this->params" als Array zur Verfügung stehen. Damit kann man ein Listentemplate weiter verallgemeinern
  und über das Backend z. B. mit Bezeichnungen, Übersetzungen oder Parameter für die Ausgabe oder JavaScript-Inhalte
  steuern. Siehe :ref:`rst_cookbook_templates_fe_list_parameters`.
* Das Zählen der Items in den Widgets des FE-Filters wurde abgeschaltet - siehe `Github <https://github.com/MetaModels/core/issues/312#issuecomment-686963070>`_
* Beim Contentelement MM-Liste ist in der Listenansicht des Artikels die Filterauswahlen des "Statischen Parameters"
  zusätzlich zu der Angabe des Filternamens zu sehen
* neuer Inserttag für Anzahl Items (total count): `{{mm::total::mm::[MM Name|ID](::[ID filter])}}` - damit ist kein
  extra MM-CE/Modul notwendig
* Attribute als Variante haben eine Kennzeichnung in der Liste der Attribute
* Alle SQL-Queries wurden mit Tabellenpräfixen versehen, so dass eine Prüfung auf `reservierte Wörter von MySQL <https://dev.mysql.com/doc/refman/5.7/en/keywords.html>`_ nicht mehr notwendig ist
* alle xhtml-Templates wurden entfernt
* Ansichtsbedingungen für die Widgets der Eingabemaske wurden angepasst: dort wird nun auch eine "Nicht Auswahl" z.B.
  eines Select- oder Tags-Parameters korrekt ausgewertet, d.h. wenn als Bedingung "Nichts" ausgewählt wurde, ist das
  Widget sichtbar - solange bis was ausgewählt wurde (das erspart einen NOT-Operator)
* in der Maske von "Alle hinzufügen" der Eingabemaske gibt es nun ein Eingabefeld, um den Attributen gleich ein oder
  mehrere CSS-Klassen mit auf den Weg zu geben - wenn man Attribute einzeln hinzufügt, ist die Standard-CSS-Klasse "w50"
  - mit dem Feature kann man sich das einzelne Editieren der Attribute sparen
* wenn man beim Erstellen eines Attributes auf "Speichern und neu" klickt, wird der Attributstyp mit übernommen und
  ist vorausgewählt
* wenn ein Attribut gelöscht wird, wird nun automatisch eine ggf. angelegte Ansichtsbedingung bzw. Sortierung/Gruppierung
  mit gelöscht
* bei der Mehrsprachigkeit werden nun auch die Territory-Angabe bei Locale unterstützt, d.h. z. B. ch_DE, ch_FR usw.
  bei den Einstellungen des Models kann mit einer Checkbox die Liste der "Sprachen" um die Angaben mit Territory-Angabe
  erweitert werden; in der Liste gibt es jeweils eine Angabe, wie der Eintrag in dem Startpunkt der Webseite aussehen
  muss
* Die Anzeige der Eingabemaske bei Varianten wurde angepasst. Bisher wurden Attribute ohne Variation in der Variant-Maske
  ausgeblendet - nun werden diese Attribute als Readonly dargestellt.


Attribute
---------
* Alias
    * Slug-Generator für Sonderzeichen
    * Option zum Verhindern des "id-"-Präfix für Zahlen
* Checkbox
    * Die optionalen eigenen Icons werden als 16x16px Thumbnails gerendert
    * Sind die Checkboxen `readonly`, werden diese in der Listen-Ansicht dargestellt, haben aber keine Toggle-Funktion
    * Widget als `readonly` arbeitet nun korrekt in der Eingabemaske
* ContentArticle
    *  es gibt sowohl in der Eingabemaske als auch in der Listenansicht eine Vorschau auf die angelegten Elemente
       inkl. Typ und ob sichtbar oder nicht
* Datei
    * Unterstützung manuelle Dateisortierung
    * arbeitet nun mit der "picture factory" - damit wird das Lazy-load der Bildereinstellungen unterstützt
    * Option "Nur lesen" (readonly) ist nun möglich
    * Die Einschränkung der Auswahl auf "nur Dateien" wurde erweitert auf "nur Ordner" - Standard bleibt Dateien und Ordner
    * Unterstützung der Bildgröße bei einer Lightbox mit Werten aus den Layouteinstellungen
    * ein Platzhalterbild kann ausgewählt werden
    * Option, ob ein Downloadlink über die Session geschützt ist oder nicht; aus Gründen der Abwärtskompatibilität ist über
      eine Migration der Wert gesetzt, sofern die Checkbox "Downloadlink" an ist; wird der Schutz deaktiviert, wird kein
      Cookie von der Funktion gesetzt und die Seite kann gecached werden 
* Datum
    * In den Einstellungen der Eingabemaske kann festgelegt werden, welcher Teil des Timestamps "auf Null" gesetzt
      werden soll, damit z. B. die Zeit ohne eine Tagesangabe bzw. ein Datum ohne Zeitergänzung gespeichert werden
      soll - das kann für eine korrekte Filterung nach Zeit oder Datum wichtig sein
* Einzelauswahl [select]
    * Mit dem neuen neuen Interface ITranslatedMetaModel kann bei den Einstellungen des Attributs bei Alias nun
      ein translated Alias verwendet werden - bisher musste das ein Attribut mit "unique" Werten sein
    * mit Umstellung auf Interface ITranslatedMetaModel erwartet die API bei Methode `widgetToValue` den Datenwert
      der beim Attribut bei Alias ausgewählt wurde - bisher fix auf `id`
    * Widget als `readonly` arbeitet nun korrekt in der Eingabemaske; auch beim Popup-Picker
    * ein bei den Attributseinstellungen aktivierter Filter wirkt sich nun auch auf die Ausgabe im FE aus - z. B.
      werden referenzierte Items nicht mehr ausgegeben, wenn ein Filter das begrenzt analog der Darstellung im BE
* Levenshtein-gestützte Suche (Ähnlichkeitssuche)
    * Umbenennung in korrekte Schreibweise ("sht" statt "sth") - bitte in composer.json prüfen
    * Das automatische Abschalten des Autosubmit bei CE/Modul-MM-Filter wurde entfernt - durch die neuen
      Einstellungsmöglichkeiten ist das nicht mehr notwendig
    * Einstellmöglichkeit der Wortlänge (min + max), die im Index gesucht wird
    * Erklärung zu den Einstellmöglichkeiten beim Attribut
    * Autovervollständigung beim FE-Widget der Suche Umstellung von Mootools auf "Vanilla Script" somit
      unabhängig von Mootools - *Auswahl des (neuen) Templates beachten*
    * Autovervollständigung kann abgeschaltet werden und minimale Buchstabenlänge kann angegeben werden
    * Bei den Filtereinstellungen muss für das Autocomplete das entsprechende Template gewählt werden; das Autocomplete
      kann aber auch per Checkbox abgeschaltet werden - zusätzlich kann aktiviert werden, dass bei Klick auf ein
      Autosubmit-Eintrag das Formular abgesendet wird
* Mehrfachauswahl [tags]
    * Mit dem neuen neuen Interface ITranslatedMetaModel kann bei den Einstellungen des Attributs bei Alias nun
      ein translated Alias verwendet werden - bisher musste das ein Attribut mit "unique" Werten sein
    * mit Umstellung auf Interface ITranslatedMetaModel erwartet die API bei Methode `widgetToValue` den Datenwert
      der beim Attribut bei Alias ausgewählt wurde - bisher fix auf `id`
    * Widget als `readonly` arbeitet nun korrekt in der Eingabemaske; auch beim Popup-Picker
    * ein bei den Attributseinstellungen aktivierter Filter wirkt sich nun auch auf die Ausgabe im FE aus - z. B.
      werden referenzierte Items nicht mehr ausgegeben, wenn ein Filter das begrenzt analog der Darstellung im BE
* Rating ("Sternchenbewertung")
    * Umstellung von Mootools auf "Vanilla Script" somit unabhängig von Mootools
    * Sortierung im BE unter  Berücksichtigung der Anzahl der Bewertungen
* Text-Tabelle
    * Einstellungen zum Angeben der min. und max. Anzahl der Zeilen
    * Checkbox zum Deaktivieren der manuellen Sortierung
* Übersetzter Alias
    * Slug-Generator für Sonderzeichen
    * Option zum Verhindern des "id-"-Präfix für Zahlen
* Übersetzte Checkbox
    * Die optionalen eigenen Icons werden als 16x16px Thumbnails gerendert
    * Je Sprache kann ein eigenes Icon-Set ausgewählt werden
    * in der Listenansicht sind die Icons nun in der Reihenfolge wie die Sprachen des Model definiert sind - bisher
      war das Icon der Fallbacksprache immer an erster Position
    * Sind die Checkboxen `readonly`, werden diese in der Listen-Ansicht dargestellt, haben aber keine Toggle-Funktion
    * Unterstützung der Option "Inverse", die das Anzeigeverhalten umdreht; Damit kann man die Methodik vom ContaoCore
      bei Inhaltselementen nachstellen, die per se immer sichtbar sind und per Checkbox auf nicht sichtbar geschaltet
      werden. Achtung! die Icons in der Listenansicht im Backend wechseln auch mit.
* Übersetzte ContentArticle
    *  es gibt sowohl in der Eingabemaske als auch in der Listenansicht eine Vorschau auf die angelegten Elemente
       inkl. Typ und ob sichtbar oder nicht
* Übersetzte Datei
    * Unterstützung manuelle Dateisortierung
    * arbeitet nun mit der "picture factory" - damit wird das Lazy-load der Bildereinstellungen unterstützt
    * Option "Pflichtfeld" steht nun zur Verfügung
    * Option "Nur lesen" (readonly) ist nun möglich
    * Die Einschränkung der Auswahl auf "nur Dateien" wurde erweitert auf "nur Ordner" - Standard bleibt Dateien und Ordner
    * Unterstützung der Bildgröße bei einer Lightbox mit Werten aus den Layouteinstellungen
    * ein Platzhalterbild kann ausgewählt werden
    * Option, ob ein Downloadlink über die Session geschützt ist oder nicht; aus Gründen der Abwärtskompatibilität ist über
      eine Migration der Wert gesetzt, sofern die Checkbox "Downloadlink" an ist; wird der Schutz deaktiviert, wird kein
      Cookie von der Funktion gesetzt und die Seite kann gecached werden 
* Übersetzte Text-Tabelle
    * Einstellungen zum Angeben der min. und max. Anzahl der Zeilen
    * Checkbox zum Deaktivieren der manuellen Sortierung


Filter
------
* CE/Modul FE-Filter und Filterreset (clear all)
    * Das Autosubmit bei CE/Modul FE-Filter ist nun in Vanilla Script geschrieben somit unabhängig von Mootools oder jQuery
    * das CE bzw. Modul Filterreset hat nun ein eigenes Template (mm_clearall_default.html5) welches dann beim Erstellen
      auch gleich ausgewählt ist. Bisher musste man beim Erstellen das Template von "mm_filter_default" auf
      "mm_filter_clearall" wechseln. Bei der Migration erfolgt eine eine Ausgabe, sofern noch ein eigenes Template
      "mm_filter_clearall*.*" gefunden werden mit der Aufforderung das umzustellen - automatisch können
      diese leider nicht angepasst werden. Sollte an der Stelle im FE eine Fehlermeldung kommen, dass das alte Template
      nicht gefunden werden kann, bitte das CE/FE-Modul einmal neu abspeichern.
    * die Widgets für die FE-Filter haben die Property "used" mit den Werten "true|false" bekommen -
      "true" wenn das Widget benutzt wird
    * die Zählerausgabe bei den Widgets im FE-Filter nicht mehr unterstützt - die Templates wurden entsprechend angepasst.
      `Erklärung siehe Github <https://github.com/MetaModels/core/issues/312#issuecomment-686963070>`_
    * Beim CE/Modul MM-Filter kann nun ein URL-Fragment angegeben werden - damit springt nach dem Relaod die Seite an
      den Ankerpunkt (bei eigenen Templates als Linkliste diese ggf. anpassen)
    * Beim CE/Modul MM-Filterreset kann nun ein URL-Fragment angegeben werden - damit springt nach dem Relaod die Seite
      an den Ankerpunkt
    * Die Templates für die Ausgabe der Filterwidgets wurden für eine sauberes Markup umgebaut - `siehe Github-Issue <https://github.com/MetaModels/core/issues/374>`_
      - ggf. eigene Templates anpassen
* Eigenes SQL
    * hier können nun in dem Parameter-Inserttags weitere (Contao-)Inserttags eingebaut werden - z.B. ist nun |br|
      :code:`SELECT * FROM  WHERE year = {{param::get?name=year&default={{date::Y}}}}` |br|
      möglich. Zudem liefert der Inserttag nun :code:`null`, wenn der Parameterkey nicht existiert.
* Einfache Abfrage
    * Option, dass das Label des Filterwidgets nicht ausgegeben wird
    * Angabe CSS-ID und CSS-Klassen für FE-Widget möglich
    * Option, wenn die Filterregel ein FE-Widget ausgeben soll (bis MM 2.0 über Option "Statischer Parameter" und
      Option "GET-Parameter" einzustellen - Umstellung der Einstellung bitte manuell durchführen)
    * Option zum Sortieren der Filteritems nach "natürlicher Sortierung" - Auf- oder Absteigend
    * per Checkbox kann das Label als Blankoptionlabel (statt "Nicht filtern") im Select ausgegeben werden
* Einzelauswahl [select]
    * Attributstypen Alias und Übersetzter Alias möglich
    * Option, dass das Label des FE-Widget nicht ausgegeben wird
    * Angabe CSS-ID und CSS-Klassen für FE-Widget möglich
    * Option zum Sortieren der Filteritems nach "natürlicher Sortierung" - Auf- oder Absteigend
    * per Checkbox kann das Label als Blankoptionlabel (statt "Nicht filtern") im Select ausgegeben werden
* Ja / Nein
    * Alternativ zu den GET-Werten "1" und "-1" können die Werte "ja" und "nein" übermittelt werden (bzw. die
      jeweilige Übersetzung)
    * Attributstyp "Übersetzte Checkbox" möglich
    * Option, dass das Label des FE-Widget nicht ausgegeben wird
    * Angabe CSS-ID und CSS-Klassen für FE-Widget möglich
* Levenshtein-gestützte Suche (Ähnlichkeitssuche)
    * siehe bei Attribute
* Mehrfachauswahl [Tags]
    * Attributstypen Alias und Übersetzter Alias möglich
    * Option, dass das Label des FE-Widget nicht ausgegeben wird
    * Angabe CSS-ID und CSS-Klassen für FE-Widget möglich
    * Option zum Sortieren der Filteritems nach "natürlicher Sortierung" - Auf- oder Absteigend
* Register (Filter für Anfangsbuchstaben)
    * Korrekte Ausgabe der active-CSS-Klassen
    * Optional kann nach mehreren Buchstaben gefiltert werden
    * Option, dass das Label des FE-Widget nicht ausgegeben wird
    * Angabe CSS-ID und CSS-Klassen für FE-Widget möglich
* Umkreissuche (Perimeterseach)
    * Neuer Lookup-Services Service "Koordinaten" hinzu gekommen. Damit kann direkt mit den Koordinaten gearbeitet
      und ein Button "Eigener Standort" eingebaut werden
    * für die Bereichsauswahl (Range) die Möglichkeit hinzu gekommen einen Vorgabe als Standard zu setzen; also wenn
      die Bereichsvorgaben z.B. 5, 10, 20 50 km sind, kann der Standard des Selects im FE auf 10 km gesetzt werden.
* Wert von/bis für ein Feld (fromto)
    * Option, dass das Label des Filterwidgets nicht ausgegeben wird
    * Angabe CSS-ID und CSS-Klassen für FE-Widget möglich
    * Platzhalter für FE-Widget
* Wert von/bis für zwei Felder (range)
    * Option, dass das Label des FE-Widget nicht ausgegeben wird
    * Angabe CSS-ID und CSS-Klassen für FE-Widget möglich
    * Platzhalter für FE-Widget
    * es gibt nun fünf verschiedene Varianten wie der Filter bei dem Vergleich zwischen vorhandene Werten in der DB
      und den eingegebenen Filterwerten reagieren soll; eine Beschreibung der Varianten kann über den 
      |img_about| Hilfe-Assistenten (Popup) aufgerufen werden.


Frontend-Editing (FEE)
______________________
* Übersicht der unterstützten Attribute - `siehe Github <https://github.com/MetaModels/contao-frontend-editing/issues/15>`_
* Möglichkeit von Dateiupload inkl. verschiedener Parameter wie Zielordner, dynamische Pfadangaben, Bereinigung
  von Dateinamen sowie Vorschaubilder, u.a.m. - Optional mit Dropzone.js-Unterstützung für ein oder mehrere Dateien
* Unterstützung Attribute "Farbwähler" und "URL", die mit jeweils zwei Eingabefelder ausgegeben werden.
* Konfiguration der Buttons der Eingabemaske im FEE inkl. Option für Weiterleitungsseite und "Nicht speichern";
  Option für Weiterleitungsseite können mit "Simple Tokens" dynamisch gestaltet werden
* Anbindung des Notification Center zur Versendung von E-Mails bei Erstellung/Kopie/Bearbeiten/Löschen von
  Datensätzen im FEE
* Unterstützung des "`MCW <https://github.com/contao-community-alliance/contao-multicolumnwizard-bundle>`_"
  im FEE mit (Vanilla Script) z.B. für Attribut Text-Tabelle und Multiwidget-Tabelle zum Vervielfältigen und
  Sortieren der Zeilen
* Unterstützung Min/Max bei Attribut Text-Tabelle und Multiwidget-Tabelle im FE
* Bei der FEE-Eingabemaske haben die Widgets eine CSS-Klasse bestehend aus `prop-<Spaltenname-Attribut`, so dass diese
  besser per CSS arrangiert/gestyled werden
* es wird eine saubere Exception geworfen, wenn ein Datensatz nicht löschbar ist
* im CE/Modul "MetaModels Frontend-Bearbeitung" kann nun ein eigenes Template für den Wrapper gewählt werden - im
  Standardtemplate ist ein JavaScript und CSS für die Aktualisierung der Maske bei Ansichtsbedingungen eingebunden;
  zusätzlich gibt es ein Template zur Auswahl, welches die beiden eingebundenen Dateien nicht enthält

Screenshots
-----------

Einstellungen für Paginierung und Sortierung bei der MM-Liste:

|img_settings-pagination-sort|


Check für Upgrade auf MM 2.2
----------------------------

Grundsätzlich ist ein Upgrade innerhalb des MM 2.x-Zweiges problemlos möglich und ggf. notwendige Anpassungen an
Bezeichnungen und DB-Änderungen werden über Migrationen abgefangen. Es gibt aber ein paar Sachen, die damit nicht
oder nur sehr schwer abzufangen sind. Aus dem Grund sollten bei der Umstellungen auf MM 2.2 die folgenden Punkte
im Blick behalten werden:

* eigene Programmierungen sollten dahingehend geprüft werden ob die Methode "widgetToValue" bei Attribut Select und
  Tags den Wert für "Alias" bekommt, wie es bei der Attributseinstelltung ausgewählt wurde - z.B. bei der Verarbeitung
  Formulardaten; bisher wurde immer eine ID erwartet
* bei der Paginierung ist der GET-Parameter nicht mehr nur "page" sondern es wird ein für jede Paginierung eindeutigen
  Key ausgegeben - wer möchte, kann das über die neuen Einstellungen der Paginierung überschreiben
* sollte die Paginierung im FE nach der Umstellung nicht angezeigt werden, dann das CE/FE-Modul Liste im BE aufrufen und
  neu speichern - dann klemmt die Zuweisung für das neue Paginierungstemplate
* die Links der Paginierung können um ein URL-Fragment (Sprunganker) erweitert werden - ggf. eigene Templates anpassen
* beim CE/FE-Modul "Clear all" gibt es nun ein eigenes Template - ggf. das checken
* eigene Templates für die Filterwidgets ggf. an neues Template anpassen
* die JavaScript-Unterstützung ist nun im Core, den Attributen und Filtern auf "Vanilla-Script" umgestellt - Abhängikeiten
  zu jQuery oder Mootools sind damit entfallen. Bitte eigene Scripte ggf. anpassen.
* bei den Attributen Select und Tags kann - wenn die Relation auf eine nicht-MM-Tabelle geht - eine WHERE-Einschränkung
  angegeben werden. Dort ist bei Tags der Tabellenalias "t" und bei Select "sourceTable" zu verwenden. Im englischen
  Hinweistext wird das mit angegeben - für weitere Sprachen muss das in Transifex nach Release gepflegt werden
* Bei Levenshtein-gestütze Suche die neue Schreibweise beachten (sht statt sth) sowie die Templateauswahl für die
  Autovervollständigung in den Einstellungen der Filterregel

Verschiedene Features kommen nun "out-of-the-box" wie z. B. das Platzhalterbild, so dass ggf. eigene Anpassungen
zurückgebaut werden können.


Re-Finanzierung
---------------
.. seealso:: Für eine Re-Finanzierung der umfangreichen Arbeiten, bittet das MM-Team um finanzielle
   Zuwendung. Als Richtgröße sollte der Umfang des zu realisierenden Projektes genommen werden
   und etwa 10% einkalkuliert werden - aufgrund der Erfahrung der letzten Zuwendungen, sind
   das Beträge zwischen 100€ und 500€ (Netto) - eine Rechnung inkl. MwSt wird natürlich immer
   ausgestellt. `Mehr... <https://now.metamodel.me/de/unterstuetzer/spenden>`_

.. |img_about| image:: /_img/icons/about.png
.. |img_settings-pagination-sort| image:: /_img/screenshots/metamodel_new_features/settings-pagination-sort.jpg

.. |br| raw:: html

   <br />
