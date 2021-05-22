.. _new_in_mm220:

Änderungen und Features von MM 2.2
==================================

.. seealso:: Die Liste wird kontinuierlich erweitert

Folgend eine Übersicht der Änderungen und Features zu MetaModels 2.2, die durch das
"early adopter Programm" ermöglicht wurden - mehr dazu unter Fundrasing auf der
`MM Webseite <https://now.metamodel.me/de/unterstuetzer/fundraising#metamodels_2-2>`_.

In dem Issue auf `Github <https://github.com/MetaModels/core/issues/1424>`_ gibt es
eine Auflistung der für MM 2.2 fertig gestellten Repositories, d. h. es gibt dort
keine Tickets mehr, die auf MM 2.2 verweisen.

Allgemein und Core
------------------

* kompatibel zum `strict mode` von MySQL und MariaDB
* verschiedene Optimierungen für eine schnellere Anzeige von Daten
* Backend von MM "aufgeräumt" und typische Einstellungen als Default gesetzt
* im Backend sind im Panel (Bereich über der Listenansicht) die Standardicons aus Contao für Filterung und Filter
  zurücksetzen statt der "Gelben Pfeile" eingebaut
* Im Bereich der übersetzten MetaModels wurde etliches an Code refactured - so ist z.B. ein neues Interface
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


Attribute
---------
* Alias
    * Slug-Generator für Sonderzeichen
    * Option zum Verhindern des "id-"-Präfix für Zahlen
* Checkbox
    * Die optionalen eigenen Icons werden als 16x16px Thumbnails gerendert
    * Sind die Checkboxen `readonly`, werden diese in der Listen-Ansicht dargestellt, haben aber keine Togglefunktion
* Datei
    * Unterstützung manuelle Dateisortierung
    * arbeitet nun mit der "picture factory" - damit wird das Lazyload der Bildereinstellungen unterstützt
    * Option "Nur lesen" (readonly) ist nun möglich
    * Die Einschänkung der Auswahl auf "nur Dateien" würde erweitert auf "nur Ordner" - Standard bleibt Dateien und Ordner
* Datum
    * In den Einstellungen der Eingabemaske kann festgelegt werden, welcher Teil des Timestamps "auf Null" gesetzt
      werden soll, damit z. B. die Zeit ohne eine Tagesangabe bzw. ein Datum ohne Zeitergänzung gespeichert werden
      soll - das kann für eine korrekte Filterung nach Zeit oder Datum wichtig sein
* Einzelauswahl [select]
    * Mit dem neuen neuen Interface ITranslatedMetaModel kann bei den Einstellungen des Attributs bei Alias nun
      ein translated Alias verwendet werden - bisher musste das ein Attribut mit "unique" Werten sein
* Mehrfachauswahl [tags]
    * Mit dem neuen neuen Interface ITranslatedMetaModel kann bei den Einstellungen des Attributs bei Alias nun
      ein translated Alias verwendet werden - bisher musste das ein Attribut mit "unique" Werten sein
* Rating ("Sternchenbewertung")
    * Umstellung von Mootools auf Vanilla Script somit unabhängig von Mootools
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
    * Sind die Checkboxen `readonly`, werden diese in der Listen-Ansicht dargestellt, haben aber keine Togglefunktion
    * Unterstützung der Option "Inverse", die das Anzeigeverhalten umdreht; Damit kann man die Methodik vom ContaoCore
      bei Inhaltselementen nachstellen, die per se immer sichtbar sind und per Checkbox auf nicht sichtbar geschaltet werden.
      Achtung! die Icons in der Listenansicht im Backend wechseln auch mit.
* Übersetzte Datei
    * Unterstützung manuelle Dateisortierung
    * arbeitet nun mit der "picture factory" - damit wird das Lazyload der Bildereinstellungen unterstützt
    * Option "Pflichtfeld" steht nun zur Verfügung
    * Option "Nur lesen" (readonly) ist nun möglich
    * Die Einschänkung der Auswahl auf "nur Dateien" würde erweitert auf "nur Ordner" - Standard bleibt Dateien und Ordner
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
      diese leider nicht angepasst werden.
* Einfache Abfrage
    * Option, dass das Label des Filterwidgets nicht ausgegeben wird
    * Angabe CSS-ID und CSS-Klassen für FE-Widget möglich
    * Option, wenn die Filterregel ein FE-Widget ausgeben soll (bis MM 2.0 über Option "Statischer Parameter" und
      Option "GET-Parameter" einzustellen - Umstellung der Einstellung bitte manuell durchführen)
    * Option zum Sortieren der Filteritems nach "natürlicher Sortierung" - Auf- oder Absteigend
* Einzelauswahl [select]
    * Attributstypen Alias und Übersetzter Alias möglich
    * Option, dass das Label des FE-Widget nicht ausgegeben wird
    * Angabe CSS-ID und CSS-Klassen für FE-Widget möglich
    * Option zum Sortieren der Filteritems nach "natürlicher Sortierung" - Auf- oder Absteigend
* Ja / Nein
    * Alternativ zu den GET-Werten "1" und "-1" können die Werte "ja" und "nein" übermittelt werden (bzw. die
      jeweilige Übersetzung)
    * Attributstype Übersetzte Checkbox möglich
    * Option, dass das Label des FE-Widget nicht ausgegeben wird
    * Angabe CSS-ID und CSS-Klassen für FE-Widget möglich
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
* Unterstützung Attribute "Farbwähler" und "URL", die mit jeweils zwei Eingabefelder ausgegeben werden.
* UnterstützungDateiupload inkl. Drag&Drop, deaktivieren/löschen von Dateien, Thumbnails bei Bildern
* Konfiguration der Buttons der Eingabemaske im FEE inkl. Option Weiterleitungsseite und "Nicht speichern"
* Anbindung des Notification Center zur Versendung von E-Mails bei Erstellung/Kopie/Bearbeiten/Löschen von
  Datensätzen im FEE
* Unterstützung des MCW im FEE mit (Vanilla Script) z.B. für Attribut Text-Tabelle zum Vervielfältigen und Sortieren
  der Zeilen
* Unterstützung Min/Max bei Attribut Text-Tabelle im FE
* Bei der FEE-Eingabemaske haben die Widgets eine CSS-Klasse bestehend aus `prop-<Spaltenname-Attribut`, so dass diese
  besser per CSS arrangiert/gestyled werden können


.. seealso:: Für eine Re-Finanzierung der umfangreichen Arbeiten, bittet das MM-Team um finanzielle
   Zuwendung. Als Richtgröße sollte der Umfang des zu realisierenden Projektes genommen werden
   und etwa 10% einkalkuliert werden - aufgrund der Erfahrung der letzten Zuwendungen, sind
   das Beträge zwischen 100€ und 500€ (Netto) - eine Rechnung inkl. MwSt wird natürlich immer
   ausgestellt. `Mehr... <https://now.metamodel.me/de/unterstuetzer/spenden>`_

.. |img_about| image:: /_img/icons/about.png

.. |br| raw:: html

   <br />
