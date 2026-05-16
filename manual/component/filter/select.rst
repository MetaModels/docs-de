.. _component_filter_select:

|img_filter_select| Einzelauswahl
==================================

Die Filterregel "Einzelauswahl" (Paket ``filter_select``) gibt ein Frontend-Widget
aus, über das Besucher einen einzelnen Wert aus einer Auswahlliste auswählen können.
Die Items werden nach dem gewählten Wert eines Attributs gefiltert. Typischerweise
wird die Filterregel mit dem Attributtyp :ref:`Einzelauswahl (select) <component_attribute_select>`
kombiniert, um eine Relation (1:n) im Frontend filterbar zu machen.

Alternativ stehen die Templates ``mm_filteritem_radiobutton.html5`` (Radio-Buttons)
und ``mm_filteritem_linklist.html5`` (Link-Liste) zur Verfügung.


Installation
------------

Die Filterregel wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/filter_select


Einstellungen beim Anlegen der Filterregel
------------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - Typ
     - Auswahl des Filterregeltyps – hier: "Einzelauswahl".
   * - Aktiviert
     - Aktiviert oder deaktiviert diese Filterregel.
   * - Kommentar
     - Freitextfeld zur Beschreibung des Zwecks dieser Filterregel.
   * - Attribut
     - Das Attribut, nach dessen Wert gefiltert werden soll.
   * - Label-Attribut
     - Optionales Attribut, dessen Wert als Anzeigetext der Optionen im Widget
       verwendet wird (z. B. ein Name- oder Titelattribut).


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
   * - Label
     - Beschriftung des Filterwidgets.
   * - Label beim Filterwidget ausblenden
     - Unterdrückt die Ausgabe des Labels.
   * - Das Label als leere Option verwenden
     - Das Label wird als erste leere Option (statt einer leeren Zeile) verwendet.
   * - Template
     - Template für die Widget-Ausgabe. Standard: ``mm_filteritem_default``;
       alternativ: ``mm_filteritem_radiobutton`` oder ``mm_filteritem_linklist``.
   * - Sortierung
     - Sortierung der Auswahloptionen im Widget (aufsteigend oder absteigend).
   * - Standard
     - Vorausgewählter Wert im Frontend-Widget.
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
     - Setzt eine CSS-ID oder -Klasse am Widget-Element.


Passende Attribute
------------------

Die Filterregel "Einzelauswahl" eignet sich insbesondere für:

* :ref:`Einzelauswahl [select] <component_attribute_select>`
* :ref:`Übersetzte Einzelauswahl [select] <component_attribute_translatedselect>`
* :ref:`Text <component_attribute_text>`
* :ref:`Alias <component_attribute_alias>`
* :ref:`Kombinierte Einträge <component_attribute_combinedvalues>`
* :ref:`Token <component_attribute_token>`


Sonderfunktionen
----------------

**Radio-Buttons und Link-Listen**

Über die Template-Auswahl kann das Widget als Radio-Button-Liste
(``mm_filteritem_radiobutton``) oder als Link-Liste (``mm_filteritem_linklist``)
ausgegeben werden. Link-Listen eignen sich besonders für SEO-optimierte
Navigation ohne Formularübermittlung.


.. |img_filter_select| image:: /_img/icons/filter_select.png

.. |br| raw:: html

   <br />
