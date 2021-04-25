.. _new_in_mm220:

Änderungen und Features von MM 2.2
==================================

.. seealso:: Die Liste wird kontinuierlich erweitert

Folgend eine Übersicht der Änderungen und Features zu MetaModels 2.2, die durch das
"early adopter Programm" ermöglicht wurden - mehr dazu unter Fundrasing auf der
`MM Webseite <https://now.metamodel.me/de/unterstuetzer/fundraising#metamodels_2-2>`_.

Allgemein und Core
------------------

* kompatibel zum `strict mode` von MySQL und MariaDB
* verschiedene Optimierungen für eine schnellere Anzeige von Daten
* Backend von MM "aufgeräumt" und typische Einstellungen als default gesetzt
* im Backend sind im Panel (Bereich über der Listenansicht) die Standardicons aus Contao für Filterung und Filter
  zurücksetzen statt der "Gelben Pfeile" eingebaut
* Im Bereich der übersetzten MetaModels wurde etliches an Code refactured - so ist z.B. ein neues Interface
  ITranslatedMetaModel hinzu gekommen für eine einfachere und saubere Schnittstelle und Ansprache der Daten.
Für den "MM-Enduser" ändert sich zwar erstmal nichts Sichtbares, aber es vereinfacht und sichert die Arbeit/Entwicklung der Mehrsprachigkeit bei MM.
* Überarbeitung aller Migrationen für Unterstützung `strict mode` nun `case sensitive` für Spaltennamen
* Entfernung der nicht mehr von Contao unterstützten xhtml-Templatedateien; in der Migration kommt ein Hinweis,
  wenn alte von Contao nicht mehr unterstützte xhtml-Templatedateien von MM gefunden werden - automatisch können
  diese leider nicht angepasst werden.


Attribute
---------
* Alias und Übersetzter Alias
  * Slug-Generator
  * Option zum Verhindern des "id-"-Präfix
* Checkbox
  * Die optionalen eigenen Icons werden als 16x16px Thumbnails gerendert
  * Sind die Checkboxen `readonly`, werden diese in der Listen-Ansicht dargestellt, haben aber keine Togglefunktion
* Datei
  * Unterstützung manuelle Dateisortierung
  * arbeitet nun mit der "picture factory" - damit wird das Lazyload der Bildereinstellungen unterstützt
* Rating ("Sternchenbewertung")
  * Umstellung von Mootools auf Vanilla Script
  * Sortierung im BE unter  Berücksichtigung der Anzahl der Bewertungen
* Text-Tabelle
  * Einstellungen zum Angeben der min. und max. Anzahl der Zeilen
  * Checkbox zum Deaktivieren der manuellen Sortierung
* Übersetzter Alias
  * Slug-Generator
  * Option zum Verhindern des "id-"-Präfix
* Übersetzte Checkbox
  * Die optionalen eigenen Icons werden als 16x16px Thumbnails gerendert
  * Je Sprache ein eigenes Icon-Set ausgewählt werden
  * Sind die Checkboxen `readonly`, werden diese in der Listen-Ansicht dargestellt, haben aber keine Togglefunktion
  * Unterstützung der Option "Inverse", die das Anzeigeverhalten umdreht; Damit kann man die Methodik vom ContaoCore
    bei Inhaltselementen nachstellen, die per se immer sichtbar sind und per Checkbox auf nicht sichtbar geschaltet werden.
    Achtung! die Icons in der Listenansicht im Backend wechseln auch mit.
* Übersetzte Datei
  * Unterstützung manuelle Dateisortierung
  * arbeitet nun mit der "picture factory" - damit wird das Lazyload der Bildereinstellungen unterstützt
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
  * Option, wenn die Filterregel ein FE-Widget ausgeben soll (bis MM 2.0 über Option "Statischer Parameter" und
    Option "GET-Parameter" einzustellen - Umstellung der Einstellung bitte manuell durchführen)
* Einzelauswahl [select]
  * Option, dass das Label des Filterwidgets nicht ausgegeben wird
* Ja / Nein
  * Option, dass das Label des Filterwidgets nicht ausgegeben wird
* Mehrfachauswahl [Tags]
  * Attributstypen Alias und Übersetzter Alias möglich
  * Option, dass das Label des Filterwidgets nicht ausgegeben wird
  * Angabe CSS-ID und CSS-Klassen für FE-Widget möglich
* Register (Filter für Anfangsbuchstaben)
  * Korrekte Ausgabe der active-CSS-Klassen
  * Optional kann nach mehreren Buchstaben gefiltert werden
  * Option, dass das Label des Filterwidgets nicht ausgegeben wird
* Umkreissuche (Perimeterseach)
  * Neuer Lookup-Services Service "Koordinaten" hinzu gekommen. Damit kann direkt mit den Koordinaten gearbeitet und ein Button "Eigener Standort" eingebaut
    werden
* Wert von/bis für ein Feld
  * Option, dass das Label des Filterwidgets nicht ausgegeben wird
* Wert von/bis für zwei Felder
  * Option, dass das Label des Filterwidgets nicht ausgegeben wird


Frontend-Editing (FEE)
______________________
* Frontend-Editing mit Dateiupload inkl. Drag&Drop, deaktivieren/löschen von Dateien, Thumbnails bei Bildern
* Konfiguration der Buttons der Eingabemaske im FEE inkl. Option Weiterleitungsseite und nicht speichern
* Anbindung des Notification Center zur Versendung von E-Mails bei Erstellung/Kopie/Bearbeiten/Löschen von
  Datensätzen im FEE
* Unterstützung des MCW im FEE z.B. für Attribut Text-Tabelle (Vanilla Script)
* Bei der FEE-Eingabemaske haben die Widgets eine CSS-Klasse bestehend aus `prop-<Spaltenname-Attribut`, so dass diese
  besser per CSS arrangiert/gestyled werden können


.. seealso:: Für eine Re-Finanzierung der umfangreichen Arbeiten, bittet das MM-Team um finanzielle
   Zuwendung. Als Richtgröße sollte der Umfang des zu realisierenden Projektes genommen werden
   und etwa 10% einkalkuliert werden - aufgrund der Erfahrung der letzten Zuwendungen, sind
   das Beträge zwischen 100€ und 500€ (Netto) - eine Rechnung inkl. MwSt wird natürlich immer
   ausgestellt. `Mehr... <https://now.metamodel.me/de/unterstuetzer/spenden>`_

.. |br| raw:: html

   <br />
