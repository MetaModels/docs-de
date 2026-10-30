.. _rst_cookbook_frontend_list-with-detail-page:

Liste mit Detailseite
=====================

Eine typische Ausgabe besteht aus einer Listenseite und einer Detailseite: In der Liste steht pro Eintrag ein Link,
die Detailseite zeigt den einen Eintrag mit allen Angaben. Die folgenden Schritte gelten für ein einsprachiges und für
ein mehrsprachiges MetaModel gleichermaßen - bei einem mehrsprachigen MetaModel sind es nur die Varianten der Attribute
und je Sprache eine Seite.

Als Beispiel dient eine Eventverwaltung mit den Attributen Titel, Startdatum und "veröffentlicht".

.. contents::
   :local:
   :depth: 1


1. Alias als eindeutiger Schlüssel
----------------------------------

Der Eintrag auf der Detailseite wird über einen Alias gefunden, der in der URL steht, z. B.
``/veranstaltung/forum-fuer-sport-2026-11-07``. Dafür legt man ein Attribut :ref:`Alias <component_attribute_alias>` an
- bei einem mehrsprachigen MetaModel :ref:`Übersetzter Alias <component_attribute_translatedalias>`.

Wichtig sind vier Einstellungen:

* **Felder für den Alias**: Titel und Startdatum. Das Datum macht den Alias auch dann unterscheidbar, wenn zwei Events
  den gleichen Titel haben.
* **Pflichtfelder**: Die Attribute, aus denen der Alias entsteht, setzt man in der Eingabemaske auf "Pflichtfeld". Bleibt eines
  leer, ist der Alias unvollständig und ändert sich, sobald es später gefüllt wird - und mit ihm der Link zur Detailseite.
* **Eindeutige Werte**: Die Option in den allgemeinen Attribut-Einstellungen stellt sicher, dass der Alias nur einmal
  vorkommt.
* **Immer aktualisieren**: Der Alias wird bei jedem Speichern neu erzeugt. Ohne diese Option bleibt ein einmal
  vergebener Alias auch dann stehen, wenn sich der Titel ändert.

.. note:: Der Alias entsteht beim Speichern im Backend. Wer Einträge anders anlegt (z. B. über die
   :ref:`Contao-API <rst_extended_contao-api>`), muss den Wert des Alias mitgeben.


2. Zwei Filter
--------------

Für die Liste und für die Detailseite braucht es je einen eigenen Filter. Die Regeln einer Ebene sind
immer mit UND verknüpft. Man muss also **keine** Regel "UND" anlegen und die anderen Regeln darunter einordnen - das ist
nur für eine Gruppe innerhalb einer Regel "ODER" nötig. Das gilt ebenso für die Ansichtsbedingungen der Eingabemaske.

**Filter "Liste"**

* Regel :ref:`Checkbox-Status <component_attribute_checkbox>` auf das Attribut "veröffentlicht": Nur Einträge mit gesetzter
  Checkbox erscheinen.
* Daneben die Regeln, die die Besucher bedienen, z. B. Kategorie, Schlagworte und ein Datumsbereich (jeweils mit einem
  URL-Parameter).

**Filter "Detail"**

* Regel :ref:`Checkbox-Status <component_attribute_checkbox>` auf das Attribut "veröffentlicht": Damit ist ein Eintrag,
  der auf "nicht veröffentlicht" gesetzt wird, auch über einen Lesezeichenlink nicht mehr aufrufbar.
* Regel :ref:`Einfache Abfrage <component_filter_simplelookup>` auf das Attribut "Alias" mit dem URL-Parameter
  ``auto_item``. Dadurch steht in der URL nur der Wert des Alias, ohne Schlüssel.

.. warning:: Für "nur veröffentlichte Einträge" nimmt man die Regel "Checkbox-Status" des Pakets ``attribute_checkbox``
   und nicht die Regel "Ja / Nein" (Paket ``filter_checkbox``). Die Regel "Ja / Nein" ist ein Widget für die Besucher: Sie
   filtert erst, wenn jemand etwas auswählt, und sie setzt ``published/1`` in jede URL, die der Filter erzeugt - damit
   enden auch die Links zur Detailseite auf ``/published/1``.


3. Render-Einstellungen
-----------------------

Mindestens drei :ref:`Render-Einstellungen <component_rendersettings>` haben sich bewährt:

* **Backend-Liste**: die Standardwerte der Liste und der Attribute reichen. Soll die Liste als Tabelle erscheinen, setzt
  man bei der :ref:`Eingabemaske <component_dca>` die Option "Anzeige in Tabellenform".
* **Frontend-Liste**: die Attribute, die in der Liste stehen sollen (z. B. Titel, Vorschaubild, Datum, Uhrzeit, Ort).
* **Detail**: alle Angaben des Eintrags.

Für die Ausgabe im Frontend braucht man meist angepasste Templates, siehe :ref:`Templates <rst_cookbook_templates_index>`:
das Template der Render-Einstellung (z. B. ``metamodel_prerendered``), das Template des Listenelements
(``ce_metamodel_list``) und ggf. die Attribut-Templates ``mm_attr_*``. Auch die Größe eines Vorschaubildes wird nicht
in MetaModels festgelegt, sondern in Contao unter *Themes > Bildgrößen*. In der Render-Einstellung wählt man sie nur aus.


4. Weiterleitungsseite in der Liste
-----------------------------------

Bei der Render-Einstellung der Liste legt man die **Weiterleitungsseite** fest: die Detailseite und den **Filter der
Detailseite** (bei einem mehrsprachigen MetaModel je Sprache eine Zeile). Aus dem Filter erzeugt MetaModels die Links der
Liste: Der Wert des Alias wird in die URL der Detailseite eingesetzt.


5. Seiten und Inhaltselemente
-----------------------------

* **Listenseite**: Ein Artikel mit dem Inhaltselement "MetaModel Filter" (wenn Besucher filtern sollen) und darunter
  dem Inhaltselement "MetaModel Liste". Bei der Liste wählt man das MetaModel, die Render-Einstellung der Liste, den
  Filter der Liste und die Sortierung (z. B. nach Startdatum absteigend).
* **Detailseite**: Eine Seite, die meistens nicht in der Navigation erscheint, mit dem Inhaltselement "MetaModel Liste"
  mit der Render-Einstellung und dem Filter der Detailseite.

Die Liste und die Detailseite haben die gleiche Technik, nur der Filter und die Render-Einstellung unterscheiden sich.


6. Prüfen
---------

* In der Liste zeigen die Links auf ``/<Detailseite>/<Alias>`` und nicht auf ``/<Detailseite>/<Alias>/published/1``.
* Die Detailseite eines Eintrags zeigt alle Angaben.
* Ein unbekannter Alias und ein nicht veröffentlichter Eintrag liefern eine leere Seite ("Es gibt keine Einträge …").
* In einem mehrsprachigen MetaModel gilt das für jede Sprache und jede Seite getrennt.
