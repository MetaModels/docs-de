.. _component_attribute_translatedtext:

Übersetzter Text
================

Das Attribut "Übersetzter Text" ist die mehrsprachige Variante des
:ref:`Text-Attributs <component_attribute_text>`. Es speichert je Sprache einen
eigenen kurzen Textwert (bis zu 255 Zeichen). Die Werte werden nicht in der
MetaModel-Tabelle gespeichert, sondern in der Übersetzungstabelle
``tl_metamodel_translatedtext``.

Typische Einsatzbereiche:

* Mehrsprachige Produktnamen, Titel oder Überschriften
* Sprachabhängige Kurzbeschreibungen oder Untertitel
* Übersetzte Artikelnummern oder Referenzen (wenn sprachabhängig)

.. note:: Für längere Texte (über 255 Zeichen) sollte das Attribut
   :ref:`component_attribute_translatedlongtext` verwendet werden.

.. seealso:: Die einsprachige Variante dieses Attributs ist unter
   :ref:`component_attribute_text` beschrieben.


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Das Attribut besitzt keine eigenen spezifischen Einstellungen beim Anlegen.
Es werden nur die allgemeinen Attribut-Einstellungen verwendet:

* Name, Spaltenname, Beschreibung
* Eindeutige Werte
* Varianten überschreiben


Einstellungen bei den Render-Einstellungen
-------------------------------------------

Das Attribut besitzt keine eigenen Render-Einstellungen. In der Attributliste
einer Render-Einstellung stehen die üblichen Optionen zur Verfügung:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Template
     - Auswahl eines eigenen Templates für die Ausgabe des Textwerts.
   * - CSS-Klasse
     - Optionale CSS-Klasse, die dem Ausgabeelement hinzugefügt wird.


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
     - CSS-Klassen für die Darstellung des Feldes im Backend-Formular (z. B.
       ``w50`` für halbe Breite, ``long`` für volle Breite).
   * - Template für das Backend
     - Auswahl eines eigenen Widget-Templates für das Backend-Formular.
   * - Template für das Frontend
     - Auswahl eines eigenen Widget-Templates für das Frontend-Editing
       (nur wenn "Frontend Editing" installiert ist).

**Funktionen**

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Pflichtfeld
     - Macht das Feld zu einem Pflichtfeld.
   * - Regular Expression
     - Validierung der Eingabe mit einem vordefinierten regulären Ausdruck.
       Verfügbare Muster:

       * **digit** – Nur Ziffern
       * **natural** – Positive Ganzzahlen
       * **alpha** – Nur Buchstaben
       * **alnum** – Buchstaben und Ziffern
       * **extnd** – Alles außer ``#`` und ``<>``
       * **date** – Datum im konfigurierten Format
       * **time** – Uhrzeit im konfigurierten Format
       * **datim** – Datum und Uhrzeit
       * **friendly** – Freundlicher Name (für E-Mail)
       * **email** – E-Mail-Adresse
       * **emails** – Kommagetrennte E-Mail-Adressen
       * **url** – URL-Adresse
       * **alias** – Alias-taugliche Zeichen
       * **phone** – Telefonnummer
       * **prcnt** – Prozentzahl (0–100)
       * **locale** – Sprachkürzel (z. B. ``de``, ``de_DE``)
       * **language** – Sprachcode
       * **fieldname** – Gültiger Feldname

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

.. list-table::
   :header-rows: 1
   :widths: 30 70

   * - Filterregel
     - Hinweis
   * - Textsuche
     - Freie Texteingabe zur Suche im Textfeld der aktiven Sprache.
   * - Einfache Abfrage
     - Filtert nach einem exakten oder partiellen Wert über einen URL-Parameter.
   * - Einzelauswahl
     - Auswahl eines Wertes aus einer Liste vorhandener Textwerte.
   * - Mehrfachauswahl
     - Mehrfachauswahl aus vorhandenen Textwerten.
   * - Register
     - Filtert nach Anfangsbuchstaben des Textwertes.
   * - Levenshtein-gestützte Suche
     - Ähnlichkeitssuche mit Tippfehlertoleranz; erfordert das Paket
       ``attribute_levenshtein``.
   * - Loupe
     - Volltext-Index-Suche; erfordert das Paket ``filter_loupe`` (ab MM 2.4).


Sonderfunktionen
-----------------

**Speicherung**

Die Textwerte werden sprachspezifisch in ``tl_metamodel_translatedtext``
gespeichert (Felder: ``att_id``, ``item_id``, ``langcode``, ``value`` als
``varchar(255)``). Die MetaModel-Tabelle erhält keine eigene Spalte.

**Fallback-Sprache**

Fehlt für eine Sprache ein Wert, greift MetaModels auf die Fallback-Sprache
zurück. IDs ohne Wert in der Fallback-Sprache werden als leerer String
behandelt.

**HTML-Entities**

Das Attribut behandelt Contao-HTML-Entities automatisch (``basicEntities``).
Sonderzeichen werden beim Speichern und Ausgeben korrekt kodiert und dekodiert.

**Eindeutigkeit je Sprache**

Ist "Eindeutige Werte" aktiv, prüft MetaModels die Eindeutigkeit je Sprache
separat.


.. |br| raw:: html

   <br />
