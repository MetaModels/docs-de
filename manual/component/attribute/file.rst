.. _component_attribute_file:

|svg_attr_file_22| | |img_file| Datei
=====================================

Das Attribut "Datei" stellt einen Dateipicker zur Auswahl von einer oder mehreren
Dateien aus dem Contao-Dateiverzeichnis bereit. Typische Einsatzbereiche:

* Bilder für Produkte, Personen oder Artikel (Einzelbild oder Galerie)
* Download-Dateien wie PDFs, Dokumente oder Archive
* Videos, Audio-Dateien oder andere Mediendateien

Das Attribut unterstützt verschiedene Widget-Modi für unterschiedliche Anwendungsfälle
im Backend und Frontend. Für die Anzeige von Bildern muss in den Render-Einstellungen
die Option "Als Bildfeld mit Vorschaubild benutzen" aktiviert werden.

.. seealso:: Für mehrsprachige MetaModels steht das Attribut
   :ref:`component_attribute_translatedfile` zur Verfügung.

.. seealso:: Dieses Attribut wird von der :ref:`File-Usage Integration <rst_extended_file-usage>`
   unterstützt. Damit lässt sich in der Contao-Dateiverwaltung anzeigen, ob und wo eine Datei
   eingebunden ist.

.. seealso:: Für den Datei-Upload im Frontend steht die Erweiterung
   :ref:`rst_extended_frontend_editing` zur Verfügung.


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_file


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Neben den allgemeinen Attribut-Einstellungen (Name, Spaltenname, Beschreibung,
Varianten überschreiben) bietet das Datei-Attribut folgende spezifische Optionen:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Mehrfachauswahl
     - Erlaubt die Auswahl mehrerer Dateien. Ist diese Option nicht gesetzt,
       kann nur eine einzelne Datei ausgewählt werden.
   * - Wurzelordner angeben
     - Schränkt den Dateipicker auf einen bestimmten Startordner im Dateiverzeichnis
       ein. Ist kein Ordner gewählt, startet der Picker am Wurzelverzeichnis.
   * - Gültige Dateitypen
     - Kommagetrennte Liste erlaubter Dateiendungen (z. B. ``jpg,jpeg,png,gif``),
       um die Contao-Standardeinstellung zu überschreiben.
   * - Erlaubte Dateitypen
     - Einschränkung der Auswahl auf Dateien, Ordner oder beides (Standard: keine
       Einschränkung).


Einstellungen bei den Render-Einstellungen
-------------------------------------------

Das Datei-Attribut besitzt eigene Render-Einstellungen für die Ausgabe:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Als Bildfeld mit Vorschaubild benutzen
     - Aktiviert die Bildausgabe mit Vorschaubild-Generierung. Ohne diese Option
       wird nur der Dateipfad ausgegeben. Für jede direkte Bildanzeige im Backend
       oder Frontend **muss** diese Option gesetzt sein.
   * - Bildbreite und -höhe
     - Größenangabe für das generierte Vorschaubild (Breite × Höhe). Wird nur
       eines der beiden Felder ausgefüllt, wird proportional skaliert. Beide Felder
       leer lassen gibt das Bild in Originalgröße aus.
   * - Link als Download oder Lightbox erstellen
     - Bettet die Datei in einen Link ein, der entweder als Download oder zur
       Großansicht in einer Lightbox dient.
   * - Geschützter Download
     - Die Download-URL ist nur vorübergehend gültig (zeitlich begrenzte
       signierte URL).
   * - Sortierung nach
     - Legt die Sortierreihenfolge bei Mehrfachdateien fest: Name aufsteigend/
       absteigend, Datum aufsteigend/absteigend oder zufällig.
   * - Bild als Platzhalter
     - Wählt ein Platzhalterbild aus, das angezeigt wird, wenn keine Datei
       ausgewählt ist.


Einstellungen bei der Eingabemaske
------------------------------------

Wird das Datei-Attribut einer Eingabemaske hinzugefügt, stehen folgende Optionen
zur Verfügung:

**Darstellung**

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Backend-Klasse
     - CSS-Klassen für die Darstellung des Feldes im Backend-Formular.
   * - Template für das Backend
     - Auswahl eines eigenen Widget-Templates für das Backend-Formular.
   * - Template für das Frontend
     - Auswahl eines eigenen Widget-Templates für das Frontend-Editing
       (nur verfügbar, wenn die Erweiterung "Frontend Editing" installiert ist).
   * - Widget-Modus
     - Bestimmt die Darstellungsart des Datei-Widgets. Verfügbare Modi:

       * **Normal** – Standardmäßiger Dateipicker
       * **Downloads** – Darstellung als Download-Liste
       * **Galerie** – Darstellung als Bildergalerie
       * **FE Einzelupload** – Frontend-Upload für eine einzelne Datei
       * **FE Einzelupload mit Vorschau** – Frontend-Upload mit Vorschaubild
       * **FE Mehrfachupload** – Frontend-Upload für mehrere Dateien
       * **FE Mehrfachupload mit Vorschau** – Frontend-Upload mit Vorschaubildern

**Upload-Einstellungen** (nur bei Frontend-Editing-Modi)

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Zielordner
     - Ordner im Dateiverzeichnis, in den hochgeladene Dateien gespeichert werden.
   * - Home-Verzeichnis verwenden
     - Speichert die Datei im Home-Verzeichnis des angemeldeten Mitglieds.
   * - Ordner erweitern
     - Erweitert den Zielordnerpfad dynamisch per Insert-Tags oder
       ``##post_*##``-Token.
   * - Erweiterten Ordner normalisieren
     - Normalisiert den erweiterten Ordnerpfad mit dem Alias-Generator.
   * - Dateinamen normalisieren
     - Normalisiert den Dateinamen beim Upload mit dem Alias-Generator.
   * - Dateinamen Präfix / Postfix
     - Stellt dem Dateinamen einen festen oder dynamischen Text voran bzw. nach.
   * - Vorhandene Dateien beibehalten
     - Fügt bei doppelten Dateinamen ein numerisches Suffix hinzu anstatt die
       Datei zu überschreiben.
   * - Datei abwählen
     - Ermöglicht dem Nutzer, eine Datei aus dem Datensatz zu entfernen
       (ohne sie zu löschen).
   * - Datei löschen
     - Ermöglicht dem Nutzer, eine Datei zu entfernen und gleichzeitig aus
       dem Dateiverzeichnis zu löschen.
   * - Sortieren nach
     - Legt die Sortierreihenfolge hochgeladener Mehrfachdateien fest.
   * - Breite und Höhe der Vorschaubilder
     - Größe der im Upload-Widget angezeigten Vorschaubilder.

**Funktionen**

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Pflichtfeld
     - Macht das Feld zu einem Pflichtfeld.

**Übersicht (Backend-Filter und -Suche)**

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Filterbar
     - Das Attribut steht im Backend als Filterkriterium zur Verfügung
       (Suche nach Dateiname oder UUID).
   * - Suchbar
     - Das Attribut steht im Backend als Suchfeld zur Verfügung.


Filterregeln
------------

Für das Datei-Attribut steht aktuell keine eigene Frontend-Filterregel zur
Verfügung. Im Backend ist eine Suche nach Dateiname oder UUID möglich.


Sonderfunktionen
-----------------

**Datenbank-Speicherung**

Einzelne Dateien werden als binäre UUID gespeichert. Mehrere Dateien werden als
serialisiertes Array von UUIDs in einem ``blob NULL``-Feld abgelegt. Die manuell
festgelegte Reihenfolge steckt dabei im Wert selbst.

.. note:: Bis MetaModels 2.4 wurde bei gesetzter Option *Mehrfachauswahl* zusätzlich
   die Spalte ``<spaltenname>__sort`` für die Sortierreihenfolge angelegt. Contao hat
   die zugehörige Widget-Option ``orderField`` mit Version 5.0 entfernt, daher entfällt
   die Spalte mit MetaModels 2.5 - eine Migration überführt die vorhandene Reihenfolge
   in den Wert und löscht die Spalte anschließend. Siehe :ref:`new_in_mm250`.

**Sortierung bei Mehrfachdateien**

Die Reihenfolge von mehreren Dateien kann sowohl in den Render-Einstellungen
(für die Ausgabe) als auch in den Eingabemaske-Einstellungen (für den Frontend-
Upload) unabhängig voneinander konfiguriert werden.

Unabhängig davon lässt sich die Reihenfolge in der Eingabemaske **manuell per
Drag & Drop** festlegen: In den Widget-Modi *Galerie* und *Downloads* sind die
ausgewählten Dateien bei aktiver *Mehrfachauswahl* sortierbar. An den
Vorschaubildern befindet sich außerdem ein roter Button, mit dem sich eine
einzelne Datei aus der Auswahl entfernen lässt, ohne den Dateipicker zu öffnen.


.. |svg_attr_file_22| image:: /_img/icons_svg/file.svg
   :width: 22px
.. |img_file| image:: /_img/icons/file.png

.. |br| raw:: html

   <br />
