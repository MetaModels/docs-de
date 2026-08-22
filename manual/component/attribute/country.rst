.. _component_attribute_country:

|svg_attr_country_22| |img_country| Land
========================================

Das Attribut "Land" stellt eine Auswahliste aller Länder der Welt zur Verfügung.
Die Ländernamen werden in der jeweils aktiven Sprache des Backends angezeigt und
alphabetisch sortiert. Gespeichert wird der zweistellige ISO-3166-1-Alpha-2-Code
(z. B. ``DE`` für Deutschland, ``AT`` für Österreich). Typische Einsatzbereiche:

* Länderfeld in Adressformularen
* Herkunfts- oder Zielland bei Produkten oder Versandoptionen
* Nationalitätsangabe bei Personendaten

Die verfügbaren Länder können eingeschränkt werden, wenn nur eine Auswahl
bestimmter Länder sinnvoll ist.


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_country


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Neben den allgemeinen Attribut-Einstellungen (Name, Spaltenname, Beschreibung,
Varianten überschreiben) bietet das Land-Attribut folgende spezifische Option:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Verfügbare Länder filtern
     - Einschränkung der Länderauswahl auf bestimmte Länder. Mehrfachauswahl
       über eine durchsuchbare Dropdown-Liste möglich. Ist keine Auswahl getroffen,
       stehen alle Länder zur Verfügung.


Einstellungen bei den Render-Einstellungen
-------------------------------------------

Das Land-Attribut besitzt keine eigenen Render-Einstellungen. In der Attributliste
einer Render-Einstellung stehen die üblichen Optionen zur Verfügung:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Template
     - Auswahl eines eigenen Templates für die Ausgabe. Wird kein Template angegeben,
       wird der lokalisierte Ländername in der aktiven Sprache ausgegeben.
   * - CSS-Klasse
     - Optionale CSS-Klasse, die dem Ausgabeelement hinzugefügt wird.


Einstellungen bei der Eingabemaske
------------------------------------

Wird das Land-Attribut einer Eingabemaske hinzugefügt, stehen folgende Optionen
zur Verfügung:

**Darstellung**

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Backend-Klasse
     - CSS-Klassen für die Darstellung des Feldes im Backend-Formular (z. B.
       ``w50`` für halbe Breite).
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
   * - Leere Option anzeigen
     - Zeigt eine leere Auswahloption am Anfang der Länderliste an, damit
       kein Land vorausgewählt ist.

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

Für das Land-Attribut steht aktuell keine eigene Filterregel zur Verfügung.
Für eine Filterung nach einem Land kann die Filterregel "Einfache Abfrage"
mit dem Ländercode (z. B. ``DE``) als Parameter verwendet werden.


Sonderfunktionen
-----------------

**Lokalisierte Ausgabe**

Der gespeicherte ISO-Code (z. B. ``DE``) wird bei der Ausgabe automatisch in den
lokalisierten Ländernamen der aktiven Sprache umgewandelt. Das Attribut löst den
Code intern über den Contao-Dienst ``contao.intl.countries`` auf und cacht das
Ergebnis je Sprache.

**Sortierung nach Ländernamen**

Die Sortierung der Datensätze nach dem Land-Attribut erfolgt anhand des
lokalisierten Ländernamens (nicht anhand des gespeicherten ISO-Codes), sodass
die alphabetische Sortierung sprachabhängig korrekt ist.

**Datenbank-Speicherung**

Der Länderwert wird als ``varchar(2) NULL`` (zweistelliger ISO-Code) gespeichert.
Ein leerer Wert wird als ``NULL`` abgelegt (kompatibel mit MySQL Strict Mode).


.. |svg_attr_country_22| image:: /_img/icons_svg/country.svg
   :width: 22px
.. |img_country| image:: /_img/icons/country.png

.. |br| raw:: html

   <br />
