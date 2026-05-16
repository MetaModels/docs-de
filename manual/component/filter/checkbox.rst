.. _component_filter_checkbox:

|img_filter_checkbox| Checkbox-Status
======================================

Die Filterregel "Checkbox-Status" (Paket ``filter_checkbox``) prüft, ob der Wert
eines Checkbox-Attributs gleich ``1`` (aktiv) ist. Sie wird typischerweise für
die Veröffentlichungssteuerung eingesetzt: Nur Items mit aktivierter Checkbox
(z. B. ``published = 1``) werden im Frontend angezeigt.

Diese Filterregel agiert in der Regel ohne Frontend-Widgetausgabe, kann aber
auch so konfiguriert werden, dass Besucher den Checkbox-Status über ein
Frontend-Widget selbst wählen können.

.. seealso:: Für mehrsprachige MetaModels steht die Filterregel
   :ref:`component_filter_translated-checkbox` zur Verfügung.


Installation
------------

Die Filterregel wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/filter_checkbox


Einstellungen beim Anlegen der Filterregel
------------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - Typ
     - Auswahl des Filterregeltyps – hier: "Checkbox-Status" (bzw. "Ja / Nein"
       im Backend-Auswahlmenü).
   * - Aktiviert
     - Aktiviert oder deaktiviert diese Filterregel.
   * - Kommentar
     - Freitextfeld zur Beschreibung des Zwecks dieser Filterregel.
   * - Attribut
     - Das Checkbox-Attribut, dessen Wert geprüft werden soll.


Einstellungen für das Frontend-Widget
--------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - URL-Parameter
     - Der Schlüssel (Key) des URL-Parameters für die Übergabe des Filterwerts.
   * - URL-Typ für den Parameter
     - Legt fest, ob der Parameter als Slug (sprechende URL), als GET-Parameter übergeben wird (ab MM 2.4) - :ref:`siehe
       SEO <rst_cookbook_tips_seo_filter-url>`
   * - Label
     - Beschriftung des Filterwidgets im Frontend.
   * - Label beim Filterwidget ausblenden
     - Unterdrückt die Ausgabe des Labels im Frontend.
   * - Template
     - Template für die Ausgabe des Filterwidgets. Standard: ``mm_filteritem_default``;
       für Checkbox-spezifische Ausgaben: ``mm_filteritem_checkbox``.
   * - Modus
     - Legt fest, ob die Filterregel als Ja-Checkbox, Nein-Checkbox oder als
       Radio-Buttons (Ja/Nein-Auswahl) konfiguriert ist:

       * **Ja-Checkbox** – Filtert auf ``1`` (aktiv)
       * **Nein-Checkbox** – Filtert auf ``0`` bzw. leer (inaktiv)
       * **Radio-Buttons** – Gibt Ja/Nein-Radio-Buttons aus; zusätzliche Option
         "Leere Auswahl ermöglichen" (``blankoption``) erscheint
   * - "Ja/Nein" anstatt Attribut-Name
     - Zeigt "Ja/Nein" anstelle des Attributnamens im Widget an.
   * - Optionsbezeichnung als Parameter
     - Der URL-Parameterwert ist die Bezeichnung der Option (Text) statt einer Zahl.
   * - CSS-ID/Klasse
     - Setzt eine CSS-ID oder -Klasse am Filterwidget-Element.


Passende Attribute
------------------

Die Filterregel "Checkbox-Status" ist ausschließlich für folgende Attribute geeignet:

* :ref:`Kontrollkästchen (Checkbox) <component_attribute_checkbox>`


Sonderfunktionen
----------------

**Veröffentlichungssteuerung**

Der häufigste Einsatzfall ist die Filterregel als "Veröffentlichungsfilter":
Ein Checkbox-Attribut (typischer Spaltenname: ``published``) mit aktivierter
"Wechselicon"-Option im Backend erlaubt das schnelle Aktivieren/Deaktivieren von
Items. Im Frontend filtert die Filterregel "Checkbox-Status" die inaktiven Items
heraus.

**Template mm_filteritem_checkbox**

Das mitgelieferte Template ``mm_filteritem_checkbox.html5`` bietet eine
checkboxspezifische Ausgabe für das Filterwidget.


.. |img_filter_checkbox| image:: /_img/icons/filter_checkbox.png

.. |br| raw:: html

   <br />
