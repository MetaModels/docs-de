.. _component_attribute_url:

URL
===

Das Attribut "URL" speichert einen Link bestehend aus einem Titel und einer
URL-Adresse. Alternativ kann es auf reine URL-Ausgabe (ohne Titel) umgestellt
werden. Typische Einsatzbereiche:

* Externe Links zu Websites, Dokumenten oder Social-Media-Profilen
* Interne Links zu Contao-Seiten (über den Seitenpicker)
* Download-Links mit beschreibendem Titel

Externe Links inklusive Protokoll eingeben (z. B. ``https://www.example.com``).
Interne Contao-Links können über den integrierten Seitenpicker ausgewählt werden.

.. seealso:: Für mehrsprachige MetaModels steht das Attribut
   :ref:`component_attribute_translatedurl` zur Verfügung.


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_url


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Neben den allgemeinen Attribut-Einstellungen (Name, Spaltenname, Beschreibung,
Varianten überschreiben) bietet das URL-Attribut folgende spezifische Option:

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

Das URL-Attribut besitzt eine eigene Render-Einstellung:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Nicht in neuem Tab öffnen
     - Ist diese Option aktiv, wird der Link **ohne** ``target="_blank"``
       ausgegeben — er öffnet sich also im selben Browserfenster. Standard
       (nicht aktiviert): Links öffnen in einem neuen Tab.
   * - Template
     - Auswahl eines eigenen Templates für die Ausgabe des Links.
   * - CSS-Klasse
     - Optionale CSS-Klasse, die dem Ausgabeelement hinzugefügt wird.


Einstellungen bei der Eingabemaske
------------------------------------

Wird das URL-Attribut einer Eingabemaske hinzugefügt, stehen folgende Optionen
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
       (nur verfügbar, wenn die Erweiterung "Frontend Editing" installiert ist).

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

Das URL-Attribut kann mit folgenden Filterregeln verwendet werden:

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

**Datenbank-Speicherung**

Ist "Titel entfernen" deaktiviert, wird das Paar ``[Titel, URL]`` als
serialisiertes Array in einem ``blob NULL``-Feld gespeichert. Ist "Titel
entfernen" aktiviert, wird nur die URL als einfacher String gespeichert.

**Eingabe-Wizard**

Im Backend wird neben dem Textfeld automatisch ein Seitenpicker-Wizard
eingeblendet, über den interne Contao-Seiten ausgewählt werden können. Bei
aktiviertem "Titel entfernen" steht nur ein einfaches Textfeld zur Verfügung.


.. |br| raw:: html

   <br />
