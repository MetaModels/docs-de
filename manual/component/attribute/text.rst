.. _component_attribute_text:

|svg_attr_text_22| |img_text| Text
==================================

Das Attribut "Text" ist das einfachste Textfeld in MetaModels und speichert kurze
Texte bis zu 255 Zeichen. Typische Einsatzbereiche:

* Namen, Titel, Überschriften
* Kurzbeschreibungen, Untertitel
* Codes, Artikelnummern, Referenzen
* Telefonnummern, Postleitzahlen (als Text, nicht Zahl)

.. note:: Für längere Texte (über 255 Zeichen) sollte das Attribut
   :ref:`component_attribute_longtext` verwendet werden.

.. seealso:: Für mehrsprachige MetaModels steht das Attribut
   :ref:`component_attribute_translatedtext` zur Verfügung.


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_text


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Das Text-Attribut besitzt keine eigenen spezifischen Einstellungen beim Anlegen.
Es werden nur die allgemeinen Attribut-Einstellungen verwendet:

* Name, Spaltenname, Beschreibung
* Eindeutige Werte
* Varianten überschreiben


Einstellungen bei den Render-Einstellungen
-------------------------------------------

Das Text-Attribut besitzt keine eigenen Render-Einstellungen. In der Attributliste
einer Render-Einstellung stehen die üblichen Optionen zur Verfügung:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Template
     - Auswahl eines eigenen Templates für die Ausgabe des Textwerts.
       Wird kein Template angegeben, erfolgt die Ausgabe als einfacher Text.
   * - CSS-Klasse
     - Optionale CSS-Klasse, die dem Ausgabeelement hinzugefügt wird.


Einstellungen bei der Eingabemaske
------------------------------------

Wird das Text-Attribut einer Eingabemaske hinzugefügt, stehen folgende Optionen
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
       (nur verfügbar, wenn die Erweiterung "Frontend Editing" installiert ist).

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

Das Text-Attribut kann mit folgenden Filterregeln verwendet werden:

.. list-table::
   :header-rows: 1
   :widths: 30 70

   * - Filterregel
     - Hinweis
   * - Textsuche
     - Freie Texteingabe zur Suche im Textfeld.
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

**Icon-Picker**
Das Attribut Text eignet sich auch, um einen :ref:`Icon-Picker für die Eingabemaske
<rst_cookbook_specials_picker-for-icons>` einzubauen.


**Datenbank-Speicherung**

Der Text wird als ``varchar(255) NULL`` gespeichert. Ein leerer Wert wird als
``NULL`` abgelegt (kompatibel mit MySQL Strict Mode). Die Begrenzung auf
255 Zeichen ist durch den Datenbanktyp fest vorgegeben.

**HTML-Entities**

Das Attribut behandelt Contao-HTML-Entities automatisch (``basicEntities``).
Sonderzeichen werden beim Speichern und Ausgeben korrekt kodiert und dekodiert.


.. |svg_attr_text_22| image:: /_img/icons_svg/text.svg
   :width: 22px
.. |img_text| image:: /_img/icons/text.png
.. |br| raw:: html

   <br />
