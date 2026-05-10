.. _component_attribute_translatedfile:

Übersetzte Datei
================

Das Attribut "Übersetzte Datei" ist die mehrsprachige Variante des
:ref:`Datei-Attributs <component_attribute_file>`. Es stellt je Sprache einen
eigenen Dateipicker zur Auswahl von Dateien aus dem Contao-Dateiverzeichnis
bereit. Die Werte werden nicht in der MetaModel-Tabelle gespeichert, sondern
in der Übersetzungstabelle ``tl_metamodel_translatedlongblob``.

Typische Einsatzbereiche:

* Sprachspezifische Produktbilder (z. B. ein DE-Produktfoto mit deutschem
  Aufdruck, ein EN-Produktfoto mit englischem Aufdruck)
* Verschiedene PDFs je Sprache (z. B. deutsche und englische Datenblätter)
* Sprachabhängige Medieninhalte wie Videos oder Audio-Dateien

.. seealso:: Die einsprachige Variante dieses Attributs ist unter
   :ref:`component_attribute_file` beschrieben.


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Neben den allgemeinen Attribut-Einstellungen bietet das Datei-Attribut folgende
spezifische Optionen:

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
       ein.
   * - Gültige Dateitypen
     - Kommagetrennte Liste erlaubter Dateiendungen (z. B. ``jpg,jpeg,png,gif``).
   * - Erlaubte Dateitypen
     - Einschränkung der Auswahl auf Dateien, Ordner oder beides.


Einstellungen bei den Render-Einstellungen
-------------------------------------------

Das Attribut besitzt eigene Render-Einstellungen für die Ausgabe:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Als Bildfeld mit Vorschaubild benutzen
     - Aktiviert die Bildausgabe mit Vorschaubild-Generierung. Für jede direkte
       Bildanzeige im Backend oder Frontend **muss** diese Option gesetzt sein.
   * - Bildbreite und -höhe
     - Größenangabe für das generierte Vorschaubild (Breite × Höhe).
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

Wird das Attribut einer Eingabemaske hinzugefügt, stehen folgende Optionen
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
       (nur wenn "Frontend Editing" installiert ist).
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
     - Ermöglicht dem Nutzer, eine Datei aus dem Datensatz zu entfernen.
   * - Datei löschen
     - Ermöglicht dem Nutzer, eine Datei zu entfernen und aus dem Dateiverzeichnis
       zu löschen.
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
     - Das Attribut steht im Backend als Filterkriterium zur Verfügung.
   * - Suchbar
     - Das Attribut steht im Backend als Suchfeld zur Verfügung.


Filterregeln
------------

Für das übersetzte Datei-Attribut steht aktuell keine eigene Frontend-Filterregel
zur Verfügung. Im Backend ist eine Suche nach Dateiname oder UUID möglich.


Sonderfunktionen
-----------------

**Speicherung**

Die Dateireferenzen werden sprachspezifisch in ``tl_metamodel_translatedlongblob``
gespeichert (Felder: ``att_id``, ``item_id``, ``langcode``, ``value`` als
``blob``). Die MetaModel-Tabelle erhält keine eigene Spalte.

**Sprachabhängige Dateien**

Jede Sprachversion kann eine völlig andere Datei referenzieren. Im Backend
erscheint das Datei-Widget je Sprache mit dem sprachspezifischen Wert.

**Fallback-Sprache**

Fehlt für eine Sprache eine Datei, greift MetaModels auf die Fallback-Sprache
zurück.

**Sortierung bei Mehrfachdateien**

Die Reihenfolge von mehreren Dateien kann in den Render-Einstellungen (für die
Ausgabe) und in den Eingabemaske-Einstellungen (für den Frontend-Upload)
unabhängig voneinander konfiguriert werden.


.. |br| raw:: html

   <br />
