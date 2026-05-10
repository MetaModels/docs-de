.. _component_filter_customsql:

|img_filter_customsql| Eigenes SQL
===================================

Die Filterregel "Eigenes SQL" ermöglicht die Verwendung einer selbst geschriebenen
SQL-Abfrage zur Filterung von Items. Die Abfrage muss eine Liste von Item-IDs
zurückgeben. Diese Filterregel richtet sich an fortgeschrittene Anwender, die
komplexe Filterbedingungen benötigen, die sich nicht mit den vorhandenen Filterregel-
Typen abbilden lassen – z. B. Vergleiche über mehrere Spalten, Unterabfragen oder
datumsbezogene Berechnungen.

Diese Filterregel hat keine Frontend-Widgetausgabe.

.. seealso:: Praktische Beispiele und Hinweise zur Nutzung finden sich im Kochbuch:
   :ref:`rst_cookbook_filter_custom-sql`


Einstellungen beim Anlegen der Filterregel
------------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - Typ
     - Auswahl des Filterregeltyps – hier: "Eigenes SQL".
   * - Aktiviert
     - Aktiviert oder deaktiviert diese Filterregel.
   * - Kommentar
     - Freitextfeld zur Beschreibung des Zwecks dieser Filterregel.
   * - Eigene SQL-Abfrage
     - Eingabe der SQL-Abfrage. Die Abfrage muss die Spalte ``id`` mit den
       Item-IDs zurückgeben. Insert-Tags von Contao werden unterstützt.
       Ein Hilfe-Assistent (Popup) gibt weitere Informationen und Beispiele. |br|
       Standardvorlage: ``SELECT id FROM {{table}} WHERE 1 = 1``
   * - Nur in Umgebung verwenden
     - Optionale Einschränkung, in welcher Contao-Umgebung (z. B. Backend oder
       Frontend) die Filterregel ausgeführt werden soll.


Passende Attribute
------------------

Die Filterregel "Eigenes SQL" ist nicht attributgebunden. Die Filterlogik wird
vollständig in der SQL-Abfrage definiert. Über den Platzhalter ``{{table}}``
wird der Tabellenname des MetaModels eingesetzt.


Sonderfunktionen
----------------

**Insert-Tags**

In der SQL-Abfrage können Contao Insert-Tags verwendet werden, z. B.:

* ``{{user::id}}`` – ID des eingeloggten Frontend-Mitglieds
* ``{{page::id}}`` – ID der aktuellen Seite
* ``{{env::request}}`` – Aktueller Request-URI

**Platzhalter {{table}}**

Der Platzhalter ``{{table}}`` wird zur Laufzeit durch den tatsächlichen
Tabellennamen des MetaModels ersetzt, z. B. ``mm_meinmodel``.

**Abfrage-Rückgabe**

Die SQL-Abfrage muss genau eine Spalte mit dem Namen ``id`` zurückgeben.
Nur Items, deren ID in dieser Spalte enthalten ist, werden angezeigt.


.. |img_filter_customsql| image:: /_img/icons/filter_customsql.png

.. |br| raw:: html

   <br />
