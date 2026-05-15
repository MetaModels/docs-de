.. _component_attribute_longtext:

Langtext
========

Das Attribut "Langtext" ist für längere Texteingaben vorgesehen. Es wird als
Textarea-Widget im Backend angezeigt und kann optional mit einem Rich-Text-Editor
(RTE wie TinyMCE) ausgestattet werden. Typische Einsatzbereiche:

* Beschreibungstexte, Produktbeschreibungen, Artikeltexte
* Freitextfelder für mehrzeilige Eingaben
* HTML-Inhalte (bei aktiviertem RTE)

Die maximale Länge beträgt 65.535 Zeichen (MySQL-Typ ``TEXT``).

.. seealso:: Für mehrsprachige MetaModels steht das Attribut
   :ref:`component_attribute_translatedlongtext` zur Verfügung.

.. seealso:: Dieses Attribut wird von der :ref:`File-Usage Integration <rst_extended_file-usage>`
   unterstützt. Damit lässt sich in der Contao-Dateiverwaltung anzeigen, ob und wo eine Datei
   eingebunden ist.


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_longtext


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Das Langtext-Attribut besitzt keine eigenen spezifischen Einstellungen beim Anlegen.
Es werden nur die allgemeinen Attribut-Einstellungen verwendet:

* Name, Spaltenname, Beschreibung
* Varianten überschreiben


Einstellungen bei den Render-Einstellungen
-------------------------------------------

Das Langtext-Attribut besitzt keine eigenen Render-Einstellungen. In der Attributliste
einer Render-Einstellung stehen die üblichen Optionen zur Verfügung:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Template
     - Auswahl eines eigenen Templates für die Ausgabe des Langtextes.
       Wird kein Template angegeben, erfolgt die Ausgabe als einfacher Text
       bzw. HTML.
   * - CSS-Klasse
     - Optionale CSS-Klasse, die dem Ausgabeelement hinzugefügt wird.


Einstellungen bei der Eingabemaske
------------------------------------

Wird das Langtext-Attribut einer Eingabemaske hinzugefügt, stehen folgende Optionen
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
       (nur verfügbar, wenn die Erweiterung "Frontend Editing" installiert ist).
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

Das Langtext-Attribut kann mit folgenden Filterregeln verwendet werden:

.. list-table::
   :header-rows: 1
   :widths: 30 70

   * - Filterregel
     - Hinweis
   * - Textsuche
     - Freie Texteingabe zur Volltextsuche im Langtext-Feld.
   * - Levenshtein-gestützte Suche
     - Ähnlichkeitssuche mit Tippfehlertoleranz; erfordert das Paket
       ``attribute_levenshtein``.
   * - Loupe
     - Volltext-Index-Suche; erfordert das Paket ``filter_loupe`` (ab MM 2.4).


Sonderfunktionen
-----------------

**Rich-Text-Editor (RTE)**

Über die Eingabemaske kann ein RTE wie TinyMCE aktiviert werden. Dabei ist
zu beachten, dass der RTE die eingegebenen HTML-Inhalte formatiert und
beim Speichern Entitäten kodiert. Die Option "HTML-Eingabe erlauben" sollte
dann in den Funktionen ebenfalls aktiviert sein.

**Datenbank-Speicherung**

Der Text wird als ``text NULL`` (bis zu 65.535 Zeichen) gespeichert. Ein leerer
Wert wird als ``NULL`` abgelegt (kompatibel mit MySQL Strict Mode). Für längere
Inhalte kann eine Migration auf ``mediumtext`` oder ``longtext`` direkt auf
Datenbankebene notwendig sein — dies ist im Kochbuch unter
:ref:`rst_cookbook_inputmask_manipulate-select-values` beschrieben.


.. |br| raw:: html

   <br />
