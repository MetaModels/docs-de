.. _component_filter_simplelookup:

|img_filter_default| Einfache Abfrage
======================================

Die Filterregel "Einfache Abfrage" filtert Items anhand eines einzelnen Attributwerts.
Der Filterwert kann entweder über einen URL-Parameter (GET/Slug) dynamisch übergeben
werden oder mit "Statischer Parameter" fest im Inhaltselement bzw. Modul konfiguriert
werden. Diese Filterregel eignet sich für einfache Auswahlen wie "Zeige alle Items
der Kategorie X" oder "Filtere nach einem bestimmten Tag".

Typischer Weise wird diese Filterregel eingesetzt, um einen :ref:`Datensatz als Detailseite anzuzeigen
<mm_first_contentelements_detailpage>`.

Optional kann ein Frontend-Widget ausgegeben werden, über das Besucher selbst
einen Wert auswählen können - damit arbeitet diese Filterregel wie die :ref:`component_filter_select`.

Mit der Option "Statischer Parameter" kann in den CE/FE-Modul MetaModels-Liste und -Filter eine überschreibbare Auswahl
als Filtereinstellung getroffen werden - siehe :ref:`rst_cookbook_filter_filter-with-static-parameter`.


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
     - Auswahl des Filterregeltyps – hier: "Einfache Abfrage".
   * - Aktiviert
     - Aktiviert oder deaktiviert diese Filterregel.
   * - Kommentar
     - Freitextfeld zur Beschreibung des Zwecks dieser Filterregel.
   * - Attribut
     - Das Attribut, nach dessen Wert gefiltert werden soll.
   * - Label-Attribut
     - Optionales Attribut, dessen Wert als Anzeigetext im Frontend-Widget verwendet
       wird (z. B. ein Titelattribut statt des internen Alias).
   * - Alle Sprachen durchsuchen
     - Bei mehrsprachigen MetaModels kann hier eingestellt werden, ob alle Sprachen
       oder nur die aktive Sprache für den Vergleich herangezogen werden sollen.


Einstellungen für das Frontend-Widget
--------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - URL-Parameter
     - Der Schlüssel (Key) des URL-Parameters für die Übergabe des Filterwerts.
       Ohne Angabe wird der Spaltenname des Attributs verwendet. Mit ``auto_item``
       wird nur der Wert – ohne Schlüssel – in die URL eingebaut.
   * - URL-Typ für den Parameter
     - Legt fest, ob der Parameter als Slug (sprechende URL), als GET-Parameter übergeben wird (ab MM 2.4) - :ref:`siehe
       SEO <rst_cookbook_tips_seo_filter-url>`
   * - Statischer Parameter
     - Ist diese Option aktiv, kann der Filterwert aus einer Auswahlliste im
       Inhaltselement/Modul überschreibbar vorbelegt werden.
   * - Frontend Widget bereitstellen
     - Gibt ein Filterwidget im Frontend aus, über das Besucher einen Wert auswählen
       können.
   * - Leeren Wert erlauben
     - Ist die Option aktiv und der URL-Parameter ist leer, verhält sich die
       Filterregel so, als wäre sie nicht definiert (kein Filter aktiv).
   * - Label
     - Beschriftung des Filterwidgets im Frontend. Wird kein Label angegeben, wird
       der Attributname verwendet.
   * - Label beim Filterwidget ausblenden
     - Unterdrückt die Ausgabe des Labels im Frontend.
   * - Das Label als leere Option verwenden
     - Das Label wird als erste leere Option in der Auswahlliste angezeigt.
   * - Template
     - Template für die Ausgabe des Filterwidgets. Standard: ``mm_filteritem_default``.
   * - Standard
     - Vorausgewählter Wert im Frontend-Widget.
   * - Sortierung
     - Sortierung der Auswahlwerte im Widget (aufsteigend oder absteigend).
   * - Leere Auswahl ermöglichen
     - Fügt eine leere Option ("Alle") in die Auswahlliste ein.
   * - Nur zugeordnete Werte
     - Zeigt im Widget nur Werte an, die in mindestens einem Item des MetaModels
       tatsächlich vergeben sind.
   * - Nur verbleibende Werte
     - Zeigt nur Werte an, für die nach Anwendung der anderen aktiven Filter noch
       Ergebnisse vorhanden sind (dynamische Filteroptionen).
   * - Diesen Filter für verbleibende Werte ignorieren
     - Dieser Filter liefert beim Berechnen verbleibender Werte seine eigenen Optionen
       nicht als Einschränkung zurück.
   * - CSS-ID/Klasse
     - Setzt eine CSS-ID oder -Klasse am Filterwidget-Element.


Passende Attribute
------------------

Die Filterregel "Einfache Abfrage" unterstützt Attribute, die einen einzelnen
vergleichbaren Wert speichern:

* Text, Alias, Kombinierte Einträge, Token
* Numerisch, Dezimal
* Checkbox
* Einzelauswahl (select)
* Mehrfachauswahl (tags)


Sonderfunktionen
----------------

**Mehrsprachige Attribute**

Bei übersetzten Attributen (z. B. "Übersetzter Text") kann über die Option
"Alle Sprachen durchsuchen" konfiguriert werden, ob nur die aktive Sprache oder
alle Sprachvarianten für den Vergleich verwendet werden sollen.

**Statischer Parameter im Inhaltselement**

Ist "Statischer Parameter" aktiviert, erscheint im Inhaltselement/Modul eine
Auswahlliste, über die ein fester Filterwert festgelegt werden kann. Diese
Einstellung eignet sich für Seiten, die immer eine bestimmte Kategorie anzeigen
sollen, ohne dass ein URL-Parameter benötigt wird - siehe :ref:`rst_cookbook_filter_filter-with-static-parameter`.


.. |img_filter_default| image:: /_img/icons/filter_default.png

.. |br| raw:: html

   <br />
