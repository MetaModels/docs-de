.. _component_attribute_translatedcombinedvalues:

Übersetzte kombinierte Einträge
================================

Das Attribut "Übersetzte kombinierte Einträge" ist die mehrsprachige Variante des
:ref:`Attributs "Kombinierte Einträge" <component_attribute_combinedvalues>`. Es
kombiniert Werte aus mehreren Attributen zu einem gespeicherten Textwert — je Sprache
separat. Werden übersetzte Quellattribute verwendet, wird der kombinierte Wert in der
jeweiligen Sprachvariante der Quellfelder berechnet. Die Werte werden in der
Übersetzungstabelle ``tl_metamodel_translatedtext`` abgelegt.

Typische Einsatzbereiche:

* Zusammensetzen von Vor- und Nachname in sprachabhängiger Reihenfolge
  (z. B. "Hans Müller" auf Deutsch, "Müller Hans" in anderen Sprachen)
* Kombinierte Bezeichner, die auf übersetzten Quellattributen basieren
* Sprachspezifische Such- oder Anzeigewerte

.. seealso:: Die einsprachige Variante dieses Attributs ist unter
   :ref:`component_attribute_combinedvalues` beschrieben.


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_translatedcombinedvalues


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Neben den allgemeinen Attribut-Einstellungen bietet das Attribut folgende
spezifische Optionen:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Format
     - ``sprintf``-Formatzeichenkette, die festlegt, wie die Quellwerte kombiniert
       werden. Für jeden ausgewählten Feldwert muss ein Platzhalter ``%s`` vorhanden
       sein. Beispiele:

       * ``%s, %s`` → "Müller, Hans"
       * ``%s (%s)`` → "Produkt A (Kategorie B)"
       * ``%s-%s-%s`` → "2024-01-15"

       Alle Platzhalter-Varianten von ``sprintf`` sind möglich (siehe
       https://www.php.net/sprintf).
   * - Felder
     - Auswahl der Quell-Attribute in der Reihenfolge, in der sie in das Format
       eingesetzt werden. Neben eigenen MetaModels-Attributen stehen auch
       System-Metafelder zur Auswahl: ID, PID, Sortierung, Zeitstempel,
       Variantengruppe, Variantenbasis.
   * - Aktualisierung erzwingen
     - Ist diese Checkbox aktiv, wird der kombinierte Wert bei jeder Änderung
       eines der Quell-Attribute automatisch neu generiert. Das Feld wird im
       Backend dann als schreibgeschützt angezeigt.


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
     - Auswahl eines eigenen Templates für die Ausgabe des kombinierten Wertes.
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
       ``long`` für volle Breite).
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
     - Das Feld wird auch dann gespeichert, wenn sich sein Wert nicht geändert
       hat. Wird automatisch gesetzt, wenn "Aktualisierung erzwingen" aktiv ist.

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
     - Freie Texteingabe zur Suche im kombinierten Wert der aktiven Sprache.
   * - Einfache Abfrage
     - Filtert nach einem exakten oder partiellen Wert über einen URL-Parameter.
   * - Einzelauswahl
     - Auswahl eines Wertes aus einer Liste der vorhandenen kombinierten Einträge.
   * - Mehrfachauswahl
     - Mehrfachauswahl aus einer Liste der vorhandenen kombinierten Einträge.
   * - Register
     - Filtert nach Anfangsbuchstaben des kombinierten Wertes.
   * - Levenshtein-gestützte Suche
     - Ähnlichkeitssuche mit Tippfehlertoleranz; erfordert das Paket
       ``attribute_levenshtein``.
   * - Loupe
     - Volltext-Index-Suche; erfordert das Paket ``filter_loupe`` (ab MM 2.4).


Sonderfunktionen
-----------------

**Speicherung**

Die kombinierten Werte werden sprachspezifisch in ``tl_metamodel_translatedtext``
gespeichert (Felder: ``att_id``, ``item_id``, ``langcode``, ``value`` als
``varchar(255)``). Die MetaModel-Tabelle erhält keine eigene Spalte.

**Sprachabhängige Kombination**

Die Kombination wird je Sprache separat berechnet. Werden übersetzte Attribute
als Quellfelder verwendet (z. B. "Übersetzter Text"), werden automatisch die
sprachspezifischen Werte des jeweiligen Quellattributs herangezogen.

**Fallback-Sprache**

Fehlt für eine Sprache ein kombinierter Wert, greift MetaModels auf die
Fallback-Sprache zurück.

**Eindeutigkeit mit automatischer Nummerierung**

Ist "Eindeutige Werte" aktiv, prüft MetaModels je Sprache separat, ob der
kombinierte Wert bereits existiert. Bei Duplikaten wird automatisch ein Zähler
angehängt: ``Müller, Hans (2)``, ``Müller, Hans (3)`` usw.


.. |br| raw:: html

   <br />
