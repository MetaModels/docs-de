.. _component_filter_customsql:

|svg_filt_customsql_22| | |img_filter_customsql| Eigenes SQL
============================================================

Die Filterregel "Eigenes SQL" ermöglicht die Verwendung einer selbst geschriebenen SQL-Abfrage zur Filterung von Items.
Die Abfrage muss eine Liste von Item-IDs zurückgeben. Diese Filterregel richtet sich an fortgeschrittene Anwender, die
komplexe Filterbedingungen benötigen, die sich nicht mit den vorhandenen Filterregel-Typen abbilden lassen – z. B.
Vergleiche über mehrere Spalten, Unterabfragen oder datumsbezogene Berechnungen.

Diese Filterregel hat keine Frontend-Widgetausgabe.

Spaltennamen sollten immer in Backticks ` wie z.B. \`name\` gesetzt oder mit dem Tabellennamen bzw. dessen Alias
versehen werden (siehe `MySQL Identifier <https://dev.mysql.com/doc/refman/8.0/en/identifiers.html>`_).
Damit ist die Verwendung auch von in (My)SQL `reservierten Wörter <https://dev.mysql.com/doc/refman/8.0/en/keywords.html>`_
möglich.

Bei komplexeren Queries ist es ratsam, diese vor dem Einbau mit entsprechenden SQL-Tools wie phpMyAdmin, PHPStorm o. ä.
zu testen bzw. bei Verschachtelungen Stück für Stück aufzubauen und vorab mit festen Werten zu arbeiten. Die
entsprechenden Daten sollten dann natürlich auch als Items in der DB vorhanden sein. Als letzten Schritt fügt man
ggf. notwendige dynamische Parameter mit den zur Verfügung stehenden Inserttags hinzu. Die MM-SQL-Inserttags werden nur
innerhalb der Verarbeitung des Query aufgelöst und stehen daher auch nicht allgemein im FE zur Verfügung.

Auch mit der Filterregel "Eigenes SQL" werden nur IDs zur nächsten Filterregel bzw. zum Filterset
weiter gereicht. Es können keine "Attributwerte" hinzugefügt oder berechnet werden, auch wenn das per SQL z.B. durch
JOINs oder mathematische Anweisungen möglich wäre.

.. seealso:: Praktische Beispiele und Hinweise zur Nutzung finden sich im Kochbuch:
   :ref:`rst_cookbook_filter_custom-sql` |br|
   Allgemeine SQL-Tipps: :ref:`rst_cookbook_sql-tips`


Installation
------------

Diese Filterregel ist Bestandteil von ``metamodels/core`` und nach der
MetaModels-Grundinstallation ohne weitere Pakete verfügbar.


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
     - Eingabe der SQL-Abfrage. Die Abfrage muss mindestens eine Spalte ``id``
       zurückgeben. Die Spaltennamen sollten mit dem Tabellenalias als Präfix
       angegeben werden (z. B. ``t.id``). Insert-Tags und Parameterquellen werden
       unterstützt. |br|
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

Platzhalter ``{{table}}``
~~~~~~~~~~~~~~~~~~~~~~~~~~

Der Platzhalter ``{{table}}`` wird zur Laufzeit durch den tatsächlichen
Tabellennamen des MetaModels ersetzt, z. B. ``mm_meinmodel``.

.. code-block:: sql

   SELECT t.id FROM {{table}} AS t WHERE t.page_id = 1

ist gleichbedeutend mit:

.. code-block:: sql

   SELECT t.id FROM mm_mymetamodel AS t WHERE t.page_id = 1


Insert-Tags
~~~~~~~~~~~

In der SQL-Abfrage können Contao Insert-Tags verwendet werden. Zu beachten ist,
dass nicht alle Tags in allen Ausgaben verfügbar sind. Ein Tag wie
``{{page::id}}`` funktioniert z. B. nur bei Frontend-Seitenaufrufen, nicht bei
RSS-Feeds.

Beispiele:

* ``{{user::id}}`` – ID des eingeloggten Frontend-Mitglieds
* ``{{page::id}}`` – ID der aktuellen Seite
* ``{{env::request}}`` – Aktueller Request-URI


Sichere Insert-Tags
~~~~~~~~~~~~~~~~~~~

Sichere Insert-Tags funktionieren wie normale Insert-Tags, die Werte werden in
der Abfrage jedoch automatisch escaped. Eine unbedachte Nutzung kann daher zu
unerwarteten Ergebnissen führen.

Notation:

.. code-block:: text

   {{secure::page::id}}


Parameterquellen ``{{param::...}}``
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Parameterquellen erlauben den Zugriff auf verschiedene externe Werte direkt in
der SQL-Abfrage. Das Muster lautet:

.. code-block:: text

   {{param::[quelle]?[querystring]}}

**Verfügbare Quellen:**

.. list-table::
   :header-rows: 1
   :widths: 20 80

   * - Quelle
     - Beschreibung
   * - ``get``
     - HTTP-GET-Query-String
   * - ``post``
     - HTTP-POST-Felder
   * - ``session``
     - Beliebiges Feld aus der Contao-Session
   * - ``filter``
     - Ausgeführter Filterparameter (zum Teilen von Filterwerten zwischen Filterregeln)

**Optionale Schlüsselwörter im Querystring:**

.. list-table::
   :header-rows: 1
   :widths: 20 80

   * - Schlüsselwort
     - Beschreibung
   * - ``name``
     - Name des Parameters (Pflichtfeld)
   * - ``default``
     - Standardwert, falls kein anderer Wert verfügbar ist
   * - ``aggregate``
     - ``list`` oder ``set`` – für Array-Werte
   * - ``key``
     - Auf ``1`` setzen, um den Schlüssel eines Arrays auszulesen
       (erfordert ``aggregate``)
   * - ``recursive``
     - Auf ``1`` setzen, um Arrays rekursiv auszulesen
       (erfordert ``aggregate``)


Beispiele
---------

**Beispiel 1 – Einfache Abfrage**

.. code-block:: sql

   SELECT t.id FROM mm_mymetamodel AS t WHERE t.page_id = 1

Wählt alle IDs aus der Tabelle ``mm_mymetamodel``, bei denen ``page_id = 1``.

**Beispiel 2 – Tabellenname einsetzen**

.. code-block:: sql

   SELECT t.id FROM {{table}} AS t WHERE t.page_id = 1

Wie Beispiel 1, aber der Tabellenname des aktuellen MetaModels wird automatisch
eingesetzt.

**Beispiel 3 – GET-Parameter und Standardwert**

.. code-block:: sql

   SELECT t.id
   FROM {{table}} AS t
   WHERE t.catname = {{param::get?name=category&default=defaultcat}}

Bei der URL ``https://example.org/list/category/demo.html`` ergibt sich: |br|
``SELECT t.id FROM mm_demo AS t WHERE t.catname = 'demo'``

Bei der URL ``https://example.org/list.html`` (kein Parameter): |br|
``SELECT t.id FROM mm_demo AS t WHERE t.catname = 'defaultcat'``


.. |svg_filt_customsql_22| image:: /_img/icons_svg/filter_customsql.svg
   :width: 22px
.. |img_filter_customsql| image:: /_img/icons/filter_customsql.png

.. |br| raw:: html

   <br />
