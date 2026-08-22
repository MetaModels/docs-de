.. _component_filter_text:

|svg_filt_text_22| |img_filter_text| Textfilter
===============================================

Die Filterregel "Textfilter" (Paket ``filter_text``) filtert Items anhand einer
Texteingabe im Frontend. Besucher geben einen Suchbegriff in ein Texteingabefeld
ein, und die Items werden nach Übereinstimmungen mit dem Wert des gewählten
Attributs gefiltert. Verschiedene Suchmodi ermöglichen genaue oder flexible
Suchen, einschließlich regulärer Ausdrücke.

Typische Einsatzbereiche: Freitextsuche in Titelfeldern, Stichwortsuche
in Beschreibungen, oder kombinierte Suchen mit mehreren Filterregeln.


Installation
------------

Die Filterregel wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/filter_text


Einstellungen beim Anlegen der Filterregel
------------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - Typ
     - Auswahl des Filterregeltyps – hier: "Textfilter".
   * - Aktiviert
     - Aktiviert oder deaktiviert diese Filterregel.
   * - Kommentar
     - Freitextfeld zur Beschreibung des Zwecks dieser Filterregel.
   * - Attribut
     - Das Textattribut, in dem gesucht werden soll.


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
     - Beschriftung des Sucheingabefelds.
   * - Label beim Filterwidget ausblenden
     - Unterdrückt die Ausgabe des Labels.
   * - Template
     - Template für die Widget-Ausgabe. Standard: ``mm_filteritem_default``.
   * - Suchmodus
     - Legt fest, wie der Suchbegriff mit dem Attributwert verglichen wird:

       * **Exakt** – Der Suchbegriff muss exakt mit dem Attributwert übereinstimmen.
       * **Beginnt mit** – Der Attributwert muss mit dem Suchbegriff beginnen.
       * **Endet mit** – Der Attributwert muss mit dem Suchbegriff enden.
       * **Beliebige Wörter** – Mindestens eines der durch Trennzeichen
         getrennten Wörter muss im Attributwert enthalten sein. |br|
         Zusätzliche Option: **Trennzeichen** (z. B. Leerzeichen oder Komma).
       * **Alle Wörter** – Alle durch Trennzeichen getrennten Wörter müssen
         im Attributwert enthalten sein. |br|
         Zusätzliche Option: **Trennzeichen**.
       * **Regulärer Ausdruck** – Der Attributwert wird gegen einen regulären
         Ausdruck geprüft. |br|
         Zusätzliche Option: **Muster** (z. B. ``%s`` für den Suchbegriff).
   * - Platzhalter
     - Platzhaltertext, der im Eingabefeld angezeigt wird, wenn es leer ist.
   * - CSS-ID/Klasse
     - Setzt eine CSS-ID oder -Klasse am Widget-Element.


Passende Attribute
------------------

Die Filterregel "Textfilter" eignet sich für Attribute, die Textwerte speichern:

* :ref:`Text <component_attribute_text>`
* :ref:`Langtext <component_attribute_longtext>`
* :ref:`Alias <component_attribute_alias>`
* :ref:`Kombinierte Einträge <component_attribute_combinedvalues>`
* :ref:`Token <component_attribute_token>`
* :ref:`Übersetzter Text <component_attribute_translatedtext>`
* :ref:`Übersetzter Langtext <component_attribute_translatedlongtext>`


Sonderfunktionen
----------------

**Reguläre Ausdrücke**

Im Suchmodus "Regulärer Ausdruck" kann ein PHP-Regex-Muster angegeben werden.
Der Platzhalter ``%s`` wird durch den eingegebenen Suchbegriff ersetzt.
Beispiel: ``^%s`` sucht nach Werten, die mit dem Suchbegriff beginnen.

**Mehrwortsuche mit Trennzeichen**

Bei den Modi "Beliebige Wörter" und "Alle Wörter" wird der Suchbegriff anhand
des konfigurierten Trennzeichens in einzelne Wörter zerlegt, bevor jedes Wort
separat gesucht wird.


.. |svg_filt_text_22| image:: /_img/icons_svg/filter_text.svg
   :width: 22px
.. |img_filter_text| image:: /_img/icons/filter_text.png

.. |br| raw:: html

   <br />
