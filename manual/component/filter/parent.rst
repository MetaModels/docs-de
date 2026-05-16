.. _component_filter_parent:

|img_filter_default| Parent-Filter
====================================

.. note:: Diese Filterregel wird nicht weiter entwickelt - Nachfolger ist Filterregel :ref:`component_filter_by-related`,
   welcher diese Funktionalität mit abdeckt.

Die Filterregel "Parent-Filter" (Paket ``filter_parent``) ermöglicht die Filterung
von Items anhand einer Eltern-Kind-Beziehung zu einem anderen MetaModel. Dabei wird
ein Item des Ziel-MetaModels über ein Attribut mit einem Item des "Parent"-MetaModels
verknüpft. Die Filterregel filtert dann auf Items, die mit einem bestimmten
Elternelement verbunden sind.

Optional kann ein Frontend-Widget ausgegeben werden, über das Besucher das
Elternelement selbst auswählen können.

Mit der Option "Statischer Parameter" kann in den CE/FE-Modul MetaModels-Liste und -Filter eine überschreibbare Auswahl
als Filtereinstellung getroffen werden - siehe :ref:`rst_cookbook_filter_filter-with-static-parameter`.

Installation
------------

Die Filterregel wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/filter_parent


Einstellungen beim Anlegen der Filterregel
------------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - Typ
     - Auswahl des Filterregeltyps – hier: "Parent-Filter".
   * - Aktiviert
     - Aktiviert oder deaktiviert diese Filterregel.
   * - Kommentar
     - Freitextfeld zur Beschreibung des Zwecks dieser Filterregel.
   * - Eltern-MetaModel
     - Das MetaModel, das als Elternebene dient (das "Parent"-MetaModel).
   * - Eltern-Attribut
     - Das Attribut im aktuellen MetaModel, das die Relation zum Elternelement
       herstellt (z. B. ein Einzelauswahl-Attribut, das auf das Eltern-MetaModel
       zeigt).


Einstellungen für das Frontend-Widget
--------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - URL-Parameter
     - Der Schlüssel (Key) des URL-Parameters für die Übergabe des Eltern-IDs.
   * - URL-Typ für den Parameter
     - Legt fest, ob der Parameter als Slug (sprechende URL), als GET-Parameter übergeben wird (ab MM 2.4) - :ref:`siehe
       SEO <rst_cookbook_tips_seo_filter-url>`
   * - Statischer Parameter
     - Ist diese Option aktiv, kann der Filterwert aus einer Auswahlliste im
       Inhaltselement/Modul überschreibbar vorbelegt werden.
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
   * - Template
     - Template für die Widget-Ausgabe.
   * - Standard
     - Vorausgewählter Eltern-Datensatz im Frontend-Widget.
   * - Leere Auswahl ermöglichen
     - Fügt eine leere Option ("Alle") hinzu.
   * - Nur zugeordnete Werte
     - Zeigt im Widget nur Elternelemente an, die tatsächlich mit mindestens einem
       Item verknüpft sind.
   * - Nur verbleibende Werte
     - Zeigt nur Elternelemente an, für die nach Anwendung anderer Filter noch
       Ergebnisse vorhanden sind.
   * - Diesen Filter für verbleibende Werte ignorieren
     - Dieser Filter liefert beim Berechnen verbleibender Werte seine eigenen Optionen
       nicht als Einschränkung zurück.


Passende Attribute
------------------

Die Filterregel "Parent-Filter" arbeitet mit einem Attribut des aktuellen
MetaModels, das die Relation zum Eltern-MetaModel herstellt:

* :ref:`Einzelauswahl [select] <component_attribute_select>`


.. |img_filter_default| image:: /_img/icons/filter_default.png

.. |br| raw:: html

   <br />
