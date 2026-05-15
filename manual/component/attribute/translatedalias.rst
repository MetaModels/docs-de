.. _component_attribute_translatedalias:

Übersetzter Alias
=================

Das Attribut "Übersetzter Alias" ist die mehrsprachige Variante des
:ref:`Alias-Attributs <component_attribute_alias>`. Es erzeugt je Sprache einen
eigenen URL-tauglichen Kurzbezeichner (Slug). Die Werte werden nicht in der
MetaModel-Tabelle gespeichert, sondern in der Übersetzungstabelle
``tl_metamodel_translatedtext``.

Typische Einsatzbereiche:

* Mehrsprachige URL-Parameter bei der Filterung (z. B. ``/produkte/mein-produkt``
  auf Deutsch, ``/products/my-product`` auf Englisch)
* Lesbare, stabile Bezeichner für Deeplinks oder :ref:`SEO-URLs <rst_cookbook_tips_seo_url>`
* Eindeutige Kürzel, die automatisch aus Namen oder Titeln generiert werden

.. seealso:: Die einsprachige Variante dieses Attributs ist unter
   :ref:`component_attribute_alias` beschrieben.

.. note:: Ein Alias ist nicht automatisch eindeutig (unique). Soll die Eindeutigkeit
   sichergestellt werden, muss die Option "Eindeutige Werte" in den allgemeinen
   Attribut-Einstellungen aktiviert werden.

.. warning:: Wird die Option "Neuerstellung des Alias erzwingen" aktiviert,
   werden bestehende Alias-Werte bei jeder Änderung der Quell-Attribute neu
   generiert. Damit werden ggf. bereits veröffentlichte URLs ungültig.

.. seealso:: Hinweise zur Mehrsprachigkeit in MetaModels sind auf der Seite
   :ref:`component_multi-language` zu finden.


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_translatedalias


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Neben den allgemeinen Attribut-Einstellungen bietet das Attribut folgende
spezifische Optionen:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Alias-Felder
     - Auswahl eines oder mehrerer Attribute, aus denen der Alias gebildet
       wird. Neben eigenen MetaModels-Attributen stehen auch System-Metafelder
       (ID, PID, Sortierung usw.) zur Verfügung.
   * - Neuerstellung des Alias erzwingen
     - Ist die Checkbox aktiv, wird der Alias bei jeder Änderung eines der
       Quell-Attribute automatisch neu generiert. Das Feld wird im Backend
       schreibgeschützt angezeigt.
   * - Gültige Alias-Zeichen
     - Zeichensatz für die automatische Generierung: *Unicode-Zahlen und
       -Kleinbuchstaben* (Standard), *Unicode-Zahlen und -Buchstaben*,
       *ASCII-Zahlen und -Kleinbuchstaben*, *ASCII-Zahlen und -Buchstaben*.
   * - Kein Integer-Präfix
     - Ist die Checkbox aktiv (Standard), wird kein ``id-``-Präfix vorangestellt,
       wenn der resultierende Alias rein numerisch ist.
   * - Alias-Präfix und -Postfix
     - Optionaler Präfix und Postfix, die dem Alias vorangestellt bzw.
       nachgestellt werden. Im Gegensatz zum einsprachigen Alias kann hier je
       Sprache ein eigener Präfix/Postfix eingestellt werden (Mehrspaltiger
       Assistent mit Sprachauswahl, Präfix-Feld und Postfix-Feld).

.. note:: Die Option "Konvertierungssprache" aus dem einsprachigen Alias
   entfällt hier — die aktive MetaModels-Sprache wird automatisch verwendet.


Einstellungen bei den Render-Einstellungen
-------------------------------------------

Das Attribut besitzt keine eigenen Render-Einstellungen. In der Attributliste
einer Render-Einstellung stehen die üblichen Optionen (Template, CSS-Klasse)
zur Verfügung.


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
     - CSS-Klassen für die Darstellung (z. B. ``w50``, ``long``).
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
   * - Immer speichern
     - Wird automatisch gesetzt, wenn "Neuerstellung des Alias erzwingen"
       aktiv ist.

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

Gleiche Filterregeln wie beim einsprachigen :ref:`Alias-Attribut
<component_attribute_alias>`: Einfache Abfrage, Textsuche, Levenshtein,
Loupe.


Sonderfunktionen
-----------------

**Speicherung**

Die Alias-Werte werden sprachspezifisch in ``tl_metamodel_translatedtext``
gespeichert (Felder: ``att_id``, ``item_id``, ``langcode``, ``value`` als
``varchar(255)``). Die MetaModel-Tabelle erhält keine eigene Spalte.

**Sprachabhängiger Präfix/Postfix**

Im Gegensatz zum einsprachigen Alias kann jeder Sprachversion ein eigener
Präfix oder Postfix zugewiesen werden (z. B. ``de-`` für die deutsche,
``en-`` für die englische URL-Variante).

**Eindeutigkeit mit Suffix**

Bei aktivierter Eindeutigkeit prüft MetaModels je Sprache separat und hängt
bei Duplikaten automatisch einen Zähler an (``mein-produkt-2`` usw.).


.. |br| raw:: html

   <br />
