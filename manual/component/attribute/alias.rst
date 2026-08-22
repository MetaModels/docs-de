.. _component_attribute_alias:

|svg_attr_alias_22| |img_alias| Alias
=====================================

Das Attribut "Alias" erzeugt einen eindeutigen, URL-tauglichen Kurzbezeichner, der aus einem oder mehreren vorhandenen
Attributen erzeugt wird. Typische Einsatzbereiche sind:

* URL-Parameter bei der Filterung im Frontend (z. B. ``/produkte/mein-produkt``)
* Lesbare, stabile Bezeichner für Deeplinks oder :ref:`SEO-URLs <rst_cookbook_tips_seo_url>`
* Eindeutige Kürzel, die automatisch aus Namen oder Titeln generiert werden

Der Alias wird beim Speichern eines Datensatzes automatisch aus den konfigurierten
Quell-Attributen zusammengestellt. Dabei kann ein Zeichensatz und eine Konvertierungssprache
vorgegeben werden, damit Sonderzeichen (z. B. Umlaute) korrekt umgewandelt werden.

.. note:: Ein Alias ist nicht automatisch eindeutig (unique). Soll die Eindeutigkeit sichergestellt
   werden, muss die Option "Eindeutige Werte" in den allgemeinen Attribut-Einstellungen
   aktiviert werden.

.. warning:: Wird die Option "Neuerstellung des Alias erzwingen" aktiviert, werden
   bestehende Alias-Werte bei jeder Änderung der Quell-Attribute neu generiert.
   Damit werden ggf. bereits veröffentlichte URLs ungültig.


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_alias


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Neben den allgemeinen Attribut-Einstellungen (Name, Spaltenname, Beschreibung, Eindeutige
Werte, Varianten überschreiben) bietet das Alias-Attribut folgende spezifische Optionen:

**Alias-Felder**

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Alias-Felder
     - Auswahl eines oder mehrerer Attribute, aus denen der Alias gebildet wird.
       Neben eigenen MetaModels-Attributen stehen auch System-Metafelder wie ID,
       PID, Sortierung oder Zeitstempel zur Verfügung. Werden mehrere Felder
       ausgewählt, werden deren Werte mit einem Bindestrich verbunden.

**Erstellung und Zeichensatz**

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Neuerstellung des Alias erzwingen
     - Ist die Checkbox aktiviert, wird der Alias bei jeder Änderung eines der
       Quell-Attribute automatisch neu generiert. Das Alias-Feld wird im Backend
       dann als schreibgeschützt angezeigt. Ohne diese Option bleibt ein einmal
       generierter Alias unverändert.
   * - Gültige Alias-Zeichen
     - Legt fest, welcher Zeichensatz für die automatische Generierung verwendet
       wird. Mögliche Werte: *Unicode-Zahlen und -Kleinbuchstaben* (Standard),
       *Unicode-Zahlen und -Buchstaben*, *ASCII-Zahlen und -Kleinbuchstaben*,
       *ASCII-Zahlen und -Buchstaben*.
   * - Konvertierungssprache
     - ISO-639-1-Sprachcode (z. B. ``de`` oder ``de-DE``), nach dem Sonderzeichen
       beim Generieren umgewandelt werden. Wird das Feld leer gelassen, greift die
       Standardkonvertierung.
   * - Alias-Präfix
     - Optionaler Text, der dem generierten Alias vorangestellt wird
       (nur alphanumerische Zeichen erlaubt).
   * - Alias-Postfix
     - Optionaler Text, der dem generierten Alias nachgestellt wird.
   * - Kein Integer-Präfix
     - Ist die Checkbox aktiv (Standard), wird kein ``id-``-Präfix vorangestellt,
       wenn der resultierende Alias rein numerisch ist.


Einstellungen bei den Render-Einstellungen
-------------------------------------------

Das Alias-Attribut besitzt keine eigenen Render-Einstellungen. In der Attributliste
einer Render-Einstellung stehen die üblichen Optionen zur Verfügung:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Template
     - Auswahl eines eigenen Templates für die Ausgabe des Alias-Wertes. Wird kein
       Template angegeben, erfolgt die Ausgabe als einfacher Text.
   * - CSS-Klasse
     - Optionale CSS-Klasse, die dem Ausgabeelement hinzugefügt wird.


Einstellungen bei der Eingabemaske
------------------------------------

Wird das Alias-Attribut einer Eingabemaske (DCA-Einstellung) hinzugefügt, stehen
folgende Optionen zur Verfügung:

**Darstellung**

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Backend-Klasse
     - CSS-Klassen für die Darstellung des Feldes im Backend-Formular (z. B.
       ``w50`` für halbe Breite, ``clr`` für Zeilenumbruch, ``long`` für volle
       Breite).
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
     - Macht das Feld zu einem Pflichtfeld. Ist in den Attribut-Einstellungen
       "Eindeutige Werte" aktiv, wird diese Option automatisch gesetzt.
   * - Immer speichern
     - Das Feld wird auch dann gespeichert, wenn sich sein Wert nicht geändert
       hat. Ist "Neuerstellung des Alias erzwingen" aktiv, wird diese Option
       ebenfalls automatisch gesetzt.

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

Das Alias-Attribut kann mit folgenden Filterregeln verwendet werden:

.. list-table::
   :header-rows: 1
   :widths: 30 70

   * - Filterregel
     - Hinweis
   * - Einfache Abfrage
     - Filtert Datensätze nach einem exakten oder partiellen Alias-Wert; der Alias-Spaltenname
       wird standardmäßig als URL-Parameter verwendet (z. B. ``?alias=mein-produkt`` oder
       mit ``auto_item`` als ``/mein-produkt``) - siehe z. B. :ref:`Detailseite <mm_first_contentelements_detailpage>`.
   * - Textsuche
     - Freie Texteingabe im Frontend zur Suche innerhalb des Alias-Feldes.
   * - Levenshtein-gestützte Suche
     - Ähnlichkeitssuche inkl. Tippfehlertoleranz; erfordert das Paket
       ``attribute_levenshtein``.
   * - Loupe
     - Volltext-Index-Suche auf Basis einer SQLite-Datenbank; erfordert das Paket
       ``filter_loupe`` (ab MM 2.4).


Sonderfunktionen
-----------------

**Insert-Tags in Quell-Attributen**

Enthält ein Quell-Attribut Insert-Tags (z. B. ``{{env::page}}``), werden diese vor der
Slug-Generierung aufgelöst. Damit lassen sich dynamische Alias-Bestandteile einbauen.

**Verhalten beim Kopieren eines Datensatzes**

Ist "Neuerstellung des Alias erzwingen" aktiv, wird beim Duplizieren eines Datensatzes
im Backend kein bestehender Alias-Wert übernommen. Stattdessen wird nach dem Speichern
automatisch ein neuer Alias generiert (``doNotCopy``-Verhalten).

**Eindeutigkeit mit automatischer Suffix-Vergabe**

Ist "Eindeutige Werte" aktiv, prüft der Slug-Generator nach der Generierung, ob der
Alias bereits existiert. Wird ein Duplikat gefunden, hängt Contao automatisch einen
numerischen Suffix an (z. B. ``mein-produkt-2``, ``mein-produkt-3`` usw.), bis ein
eindeutiger Wert gefunden ist.

**Datenbank-Speicherung**

Der Alias wird als ``varchar(255) NULL`` in der MetaModel-Tabelle gespeichert. Ein
leerer Wert wird als ``NULL`` abgelegt (kompatibel mit MySQL Strict Mode).

**Beautifier-Sonderzeichen**

Die Zeichenfolgen ``[-]``, ``[zwsp]``, ``&shy;`` und ``&ZeroWidthSpace;`` (bedingte
Trennzeichen, die in Contao zur Textformatierung genutzt werden) werden vor der
Slug-Generierung automatisch entfernt, damit sie nicht im Alias erscheinen.


.. |svg_attr_alias_22| image:: /_img/icons_svg/alias.svg
   :width: 22px
.. |img_alias| image:: /_img/icons/alias.png

.. |br| raw:: html

   <br />
