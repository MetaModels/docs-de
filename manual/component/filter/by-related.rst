.. _component_filter_by-related:

|img_filter_default| Filter-by-related
=======================================

Die Filterregel "Filter-by-related" (Paket ``filter_by_related``, ab MM 2.4) ermöglicht
es, Items anhand von Eigenschaften eines verknüpften (relationierten) MetaModels zu
filtern. Die Relation zwischen dem Haupt-MetaModel und dem verknüpften MetaModel kann
entweder über eine Kindtabelle (pid-Relation) oder über ein Einzelauswahl-Attribut
(select-Relation) aufgebaut sein.

Beispielsweise kann in einer Struktur "Hersteller → Produkte" nach Eigenschaften des
Herstellers gefiltert werden (z. B. "Zeige alle Produkte von Herstellern aus
Deutschland").

Optional kann ein Frontend-Widget ausgegeben werden, über das Besucher einen Wert
selbst auswählen können.

.. seealso:: Detaillierte Dokumentation zu Filter-by-related:
   :ref:`rst_extended_filter_by_related`


Installation
------------

Die Filterregel wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/filter_by_related


Einstellungen beim Anlegen der Filterregel
------------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - Typ
     - Auswahl des Filterregeltyps – hier: "Filter-by-related".
   * - Aktiviert
     - Aktiviert oder deaktiviert diese Filterregel.
   * - Kommentar
     - Freitextfeld zur Beschreibung des Zwecks dieser Filterregel.
   * - Verknüpftes MetaModel
     - Das MetaModel, über das die Relation aufgebaut ist (das "Eltern-MetaModel").
   * - Relationsspalte
     - Legt fest, wie die Relation zum Haupt-MetaModel aufgebaut ist:

       * **PID** – Über die Kindtabellenrelation (pid-Feld)
       * **Meta-Attribut** – Über ein Meta-Attribut
       * **Attribut** – Über ein Einzelauswahl-Attribut im Haupt-MetaModel
   * - Verknüpftes Attribut
     - Das Attribut im verknüpften MetaModel, nach dessen Wert gefiltert wird.
   * - Label-Attribut
     - Das Attribut im verknüpften MetaModel, dessen Wert als Anzeigetext im
       Frontend-Widget verwendet wird.


Einstellungen für das Frontend-Widget
--------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - URL-Parameter
     - Der Schlüssel (Key) des URL-Parameters.
   * - Statischer Parameter
     - Ist diese Option aktiv, wird der Filterwert aus einer Auswahlliste im
       Inhaltselement/Modul bezogen statt aus der URL.
   * - Frontend Widget bereitstellen
     - Gibt ein Filterwidget im Frontend aus.
   * - Widget-Typ
     - Darstellungsart des Frontend-Widgets:

       * **Select** – Auswahlliste (Standard)
       * **Text** – Texteingabefeld
       * **Radio** – Radio-Buttons
       * **Checkbox** – Checkboxen
   * - Leeren Wert erlauben
     - Ist die Option aktiv und der URL-Parameter leer, ist kein Filter aktiv.
   * - Label
     - Beschriftung des Filterwidgets.
   * - Label beim Filterwidget ausblenden
     - Unterdrückt die Ausgabe des Labels.
   * - Template
     - Template für die Widget-Ausgabe.
   * - Standard
     - Vorausgewählter Wert im Frontend-Widget.
   * - Leere Auswahl ermöglichen
     - Fügt eine leere Option ("Alle") hinzu.
   * - Nur zugeordnete Werte
     - Zeigt nur Werte an, die tatsächlich in einer Relation vorhanden sind.
   * - Nur verbleibende Werte
     - Zeigt nur Werte an, für die nach Anwendung anderer Filter noch Ergebnisse
       vorhanden sind.
   * - Diesen Filter für verbleibende Werte ignorieren
     - Dieser Filter liefert beim Berechnen verbleibender Werte seine eigenen Optionen
       nicht als Einschränkung zurück.


Passende Attribute
------------------

Die Filterregel "Filter-by-related" arbeitet nicht mit einem Attribut des
Haupt-MetaModels, sondern mit Attributen des verknüpften MetaModels. Dort
können beliebige Attributtypen gefiltert werden.

Die Relation zum Haupt-MetaModel kann über folgende Attributtypen aufgebaut sein:

* :ref:`Einzelauswahl [select] <component_attribute_select>`
* Kindtabellenrelation (pid/ptable)


.. |img_filter_default| image:: /_img/icons/filter_default.png

.. |br| raw:: html

   <br />
