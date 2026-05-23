.. _component_attribute_translatedcheckbox:

Übersetzte Checkbox
===================

Das Attribut "Übersetzte Checkbox" ist die mehrsprachige Variante des
:ref:`Checkbox-Attributs <component_attribute_checkbox>`. Es speichert je Sprache
einen eigenen booleschen Wert (0 oder 1). Die Werte werden in der eigenen
Übersetzungstabelle ``tl_metamodel_translatedcheckbox`` abgelegt.

Typische Einsatzbereiche:

* Sprachabhängige Veröffentlichung (z. B. auf Deutsch veröffentlicht, auf
  Englisch noch nicht)
* Ja/Nein-Felder, die pro Sprache unterschiedlich gesetzt werden können

.. seealso:: Die einsprachige Variante dieses Attributs ist unter
   :ref:`component_attribute_checkbox` beschrieben.

.. seealso:: Hinweise zur Mehrsprachigkeit in MetaModels sind auf der Seite
   :ref:`component_multi-language` zu finden.


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_translatedcheckbox


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Neben den allgemeinen Attribut-Einstellungen bietet das Attribut folgende
spezifische Optionen:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Wechsel-Icon
     - Fügt ein zusätzliches Icon ("Auge") in der Backend-Listenansicht ein,
       um den Status direkt umzuschalten (sprachabhängig). Als Spaltenname
       wird üblicherweise ``published`` verwendet.
   * - Invertierte Anzeigeoption
     - Kehrt den Umschaltstatus des Icons um: Ein aktiviertes Kontrollkästchen
       (Wert ``1``) zeigt dann das inaktive Symbol, ein deaktiviertes zeigt das
       aktive Symbol; Sinnvoll z. B. für ein "Verbergen"-Feld analog beim Contao Contentelement.
   * - Benutzerdefiniertes Icon
     - Aktiviert die Auswahl eigener Icons. Im Gegensatz zur einsprachigen
       Variante können die Icons **je Sprache** separat festgelegt werden
       (Mehrspaltiger Assistent mit Sprachauswahl, Icon Aktiv und Icon Inaktiv).


Einstellungen bei den Render-Einstellungen
-------------------------------------------

In der Attributliste
einer Render-Einstellung stehen die üblichen Optionen zur Verfügung:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Template
     - Auswahl eines eigenen Templates für die Ausgabe des Checkbox-Wertes. Wird
       kein Template angegeben, erfolgt die Ausgabe als einfacher Text (``1`` bei Aktiv
       oder ```` bei Inaktiv).

       Primär für die Listenanzeige im BE ist das Template ``mm_attr_checkbox_icon``, welches den
       Status mit UTF8-Icons als ☐ bzw. ☑ angezeigt (ab MM 2.4)
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
     - CSS-Klassen für die Darstellung (z. B. ``w50 cbx m12``).
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
   * - Beim Ändern speichern
     - Die Eingabemaske wird per Ajax neu geladen, wenn die Checkbox umgeschaltet
       wird (``submitOnChange``). Die Daten werden dabei noch nicht gespeichert.

**Übersicht (Backend-Filter)**

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Filterbar
     - Das Attribut steht im Backend als Filterkriterium zur Verfügung.


Filterregeln
------------

.. list-table::
   :header-rows: 1
   :widths: 30 70

   * - Filterregel
     - Hinweis
   * - Übersetzter Checkbox-Status
     - Prüft, ob der Checkbox-Wert in der aktiven Sprache gleich ``1`` ist.
       Wird typischerweise für sprachabhängige Veröffentlichungssteuerung
       eingesetzt.


Sonderfunktionen
-----------------

**Speicherung**

Die Werte werden sprachspezifisch in ``tl_metamodel_translatedcheckbox``
gespeichert (Felder: ``att_id``, ``item_id``, ``langcode``, ``value`` als
``char(1)``). Die MetaModel-Tabelle erhält keine eigene Spalte.

**Sprachabhängige Icons**

Die benutzerdefinierten Icons für aktiv/inaktiv können je Sprachversion
unterschiedlich gewählt werden — z. B. eine DE-Flagge für die deutsche
und eine GB-Flagge für die englische Veröffentlichung.

**Fallback-Sprache**

Fehlt für eine Sprache ein Wert, greift MetaModels auf die Fallback-Sprache
zurück. IDs ohne Wert in der Fallback-Sprache werden als inaktiv (``''``)
behandelt.


.. |br| raw:: html

   <br />
