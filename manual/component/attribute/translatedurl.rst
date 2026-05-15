.. _component_attribute_translatedurl:

Übersetzte URL
==============

Das Attribut "Übersetzte URL" ist die mehrsprachige Variante des
:ref:`URL-Attributs <component_attribute_url>`. Es speichert je Sprache einen
eigenen Link bestehend aus Titel und URL-Adresse. Die Werte werden nicht in der
MetaModel-Tabelle gespeichert, sondern in der Übersetzungstabelle
``tl_metamodel_translatedurl``.

Typische Einsatzbereiche:

* Sprachabhängige Links zu externen Websites (z. B. deutsche und englische
  Produktseite eines Herstellers)
* Übersetzte Download-Links (z. B. DE- und EN-Datenblatt als separate URLs)
* Sprachspezifische interne Verlinkungen auf unterschiedliche Contao-Seiten

.. seealso:: Die einsprachige Variante dieses Attributs ist unter
   :ref:`component_attribute_url` beschrieben.

.. seealso:: Hinweise zur Mehrsprachigkeit in MetaModels sind auf der Seite
   :ref:`component_multi-language` zu finden.


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_translatedurl


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Neben den allgemeinen Attribut-Einstellungen bietet das Attribut folgende
spezifische Option:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Titel entfernen
     - Ist diese Option aktiviert, wird nur das URL-Feld angezeigt und
       gespeichert — das Titelfeld entfällt. Sinnvoll, wenn nur die reine URL
       ohne beschreibenden Text benötigt wird.


Einstellungen bei den Render-Einstellungen
-------------------------------------------

Das Attribut besitzt eine eigene Render-Einstellung:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Nicht in neuem Tab öffnen
     - Ist diese Option aktiv, wird der Link **ohne** ``target="_blank"``
       ausgegeben — er öffnet sich im selben Browserfenster. Standard
       (nicht aktiviert): Links öffnen in einem neuen Tab.
   * - Template
     - Auswahl eines eigenen Templates für die Ausgabe des Links.
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


Filterregeln
------------

Das übersetzte URL-Attribut kann mit folgenden Filterregeln verwendet werden:

.. list-table::
   :header-rows: 1
   :widths: 30 70

   * - Filterregel
     - Hinweis
   * - Levenshtein-gestützte Suche
     - Ähnlichkeitssuche mit Tippfehlertoleranz; erfordert das Paket
       ``attribute_levenshtein``.
   * - Loupe
     - Volltext-Index-Suche; erfordert das Paket ``filter_loupe`` (ab MM 2.4).


Sonderfunktionen
-----------------

**Speicherung**

Die URL-Werte werden sprachspezifisch in ``tl_metamodel_translatedurl``
gespeichert. Je Eintrag werden zwei Spalten pro Sprache abgelegt: ``href``
(die URL-Adresse) und ``title`` (der Linktext). Die MetaModel-Tabelle erhält
keine eigene Spalte.

**Sprachabhängige Links**

Titel und URL können je Sprachversion völlig unterschiedlich sein. Im Backend
erscheint für jede Sprache ein eigenes Eingabeformular mit Titelfeld und
URL-Feld (inkl. Seitenpicker-Wizard).

**Fallback-Sprache**

Fehlt für eine Sprache ein Wert, greift MetaModels auf die Fallback-Sprache
zurück.

**Eingabe-Wizard**

Im Backend wird neben dem Textfeld automatisch ein Seitenpicker-Wizard
eingeblendet, über den interne Contao-Seiten ausgewählt werden können. Bei
aktiviertem "Titel entfernen" steht nur ein einfaches Textfeld zur Verfügung.


.. |br| raw:: html

   <br />
