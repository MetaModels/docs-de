.. _component_filter_condition-or:

|img_filter_or| ODER-Bedingung (OR)
=====================================

Die Filterregel "ODER-Bedingung" ist ein Container, der mehrere Unterfilterregeln
aufnehmen kann. Die enthaltenen Filterregeln werden mit einer ODER-Verknüpfung
kombiniert: Ein Item muss mindestens eine der Teilbedingungen erfüllen, um in der
Ergebnismenge zu erscheinen.

Diese Filterregel ermöglicht es, Filteralternativen abzubilden, z. B.
"Zeige alle Items der Kategorie A oder der Kategorie B". Durch Verschachtelung
mit UND-Bedingungen lassen sich komplexe Kombinationen wie
``(A UND B) ODER (C UND D)`` realisieren.

Die Option "Nach erstem Treffer beenden" erlaubt eine Performance-Optimierung:
Sobald eine Unterregel Items liefert, werden die nachfolgenden Unterregeln nicht
mehr ausgeführt.

Diese Filterregel hat keine Frontend-Widgetausgabe.


Einstellungen beim Anlegen der Filterregel
------------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - Typ
     - Auswahl des Filterregeltyps – hier: "ODER-Bedingung (OR)".
   * - Aktiviert
     - Aktiviert oder deaktiviert diese Filterregel.
   * - Kommentar
     - Freitextfeld zur Beschreibung des Zwecks dieser Filterregel.
   * - Nach erstem Treffer beenden
     - Ist diese Option aktiv, werden nachfolgende Unterregeln nicht mehr ausgeführt,
       sobald eine Unterregel mindestens ein Item gefunden hat. Dies kann die
       Datenbankabfragen reduzieren und die Performance verbessern.


Passende Attribute
------------------

Die ODER-Bedingung ist kein attributgebundener Filter, sondern ein struktureller
Container. Die enthaltenen Unterfilterregeln können beliebige Attribute verwenden.


Sonderfunktionen
----------------

**Verschachtelung mit UND-Bedingungen**

Durch die Kombination von ODER- und UND-Bedingungen können logische Ausdrücke
aufgebaut werden, die native SQL-WHERE-Klauseln mit UND/ODER nachbilden.

Beispiel einer dreigliedrigen ODER-Verknüpfung mit je zwei UND-Bedingungen:

.. code-block:: text

   ODER-Bedingung
   ├── UND-Bedingung
   │   ├── Filterregel A (z. B. Kategorie = "Sport")
   │   └── Filterregel B (z. B. Status = veröffentlicht)
   └── UND-Bedingung
       ├── Filterregel C (z. B. Kategorie = "Kultur")
       └── Filterregel D (z. B. Status = veröffentlicht)


.. |img_filter_or| image:: /_img/icons/filter_or.png

.. |br| raw:: html

   <br />
