.. _component_attribute_translatedlongtext:

Übersetzter Langtext
====================

Das Attribut "Übersetzter Langtext" ist die mehrsprachige Variante des
:ref:`Langtext-Attributs <component_attribute_longtext>`. Es speichert je Sprache
einen eigenen langen Textwert (bis zu 65.535 Zeichen). Die Werte werden nicht in
der MetaModel-Tabelle gespeichert, sondern in der Übersetzungstabelle
``tl_metamodel_translatedlongtext``.

Typische Einsatzbereiche:

* Mehrsprachige Produktbeschreibungen
* Sprachabhängige Artikeltexte oder Nachrichtenbeiträge
* Übersetzte HTML-Inhalte (bei aktiviertem Rich-Text-Editor)

.. seealso:: Die einsprachige Variante dieses Attributs ist unter
   :ref:`component_attribute_longtext` beschrieben.


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Das Attribut besitzt keine eigenen spezifischen Einstellungen beim Anlegen.
Es werden nur die allgemeinen Attribut-Einstellungen verwendet:

* Name, Spaltenname, Beschreibung
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
     - Auswahl eines eigenen Templates für die Ausgabe des Langtextes.
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
       ``long clr`` für volle Breite mit Zeilenumbruch).
   * - Template für das Backend
     - Auswahl eines eigenen Widget-Templates für das Backend-Formular.
   * - Template für das Frontend
     - Auswahl eines eigenen Widget-Templates für das Frontend-Editing
       (nur wenn "Frontend Editing" installiert ist).
   * - Rich-Text-Editor (RTE)
     - Aktivierung und Auswahl eines Rich-Text-Editors (z. B. ``tinyMCE``).
       Ist kein RTE ausgewählt, erscheint ein einfaches Textarea-Feld.
   * - Zeilen
     - Anzahl der sichtbaren Zeilen des Textarea-Feldes (Höhe).
   * - Spalten
     - Anzahl der sichtbaren Zeichen je Zeile des Textarea-Feldes (Breite).

**Funktionen**

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Pflichtfeld
     - Macht das Feld zu einem Pflichtfeld.
   * - HTML-Eingabe erlauben
     - Erlaubt die Eingabe von HTML-Tags im Textfeld (ohne RTE).
   * - Tags beibehalten
     - HTML-Tags werden beim Speichern nicht gefiltert oder kodiert.
   * - Entities dekodieren
     - HTML-Entities werden beim Speichern dekodiert.

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
     - Freie Texteingabe zur Volltextsuche im Langtext-Feld der aktiven Sprache.
   * - Levenshtein-gestützte Suche
     - Ähnlichkeitssuche mit Tippfehlertoleranz; erfordert das Paket
       ``attribute_levenshtein``.
   * - Loupe
     - Volltext-Index-Suche; erfordert das Paket ``filter_loupe`` (ab MM 2.4).


Sonderfunktionen
-----------------

**Speicherung**

Die Textwerte werden sprachspezifisch in ``tl_metamodel_translatedlongtext``
gespeichert (Felder: ``att_id``, ``item_id``, ``langcode``, ``value`` als
``text``). Die MetaModel-Tabelle erhält keine eigene Spalte.

**Rich-Text-Editor (RTE)**

Über die Eingabemaske kann ein RTE wie TinyMCE aktiviert werden. Der RTE
formatiert HTML-Inhalte und kodiert beim Speichern Entitäten. Die Option
"HTML-Eingabe erlauben" sollte dann ebenfalls aktiviert sein.

**Fallback-Sprache**

Fehlt für eine Sprache ein Wert, greift MetaModels auf die Fallback-Sprache
zurück.


.. |br| raw:: html

   <br />
