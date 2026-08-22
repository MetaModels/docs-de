.. _component_filter_register:

|svg_filt_register_22| |img_filter_default| Register
====================================================

Die Filterregel "Register" (Paket ``filter_register``) filtert Items nach dem
Anfangsbuchstaben eines Attributwerts. Sie generiert eine Liste aller vorhandenen
oder möglichen Anfangsbuchstaben als klickbare Navigation (A–Z), über die Besucher
die Ausgabe auf Items mit einem bestimmten Anfangsbuchstaben einschränken können.

Typische Einsatzbereiche: alphabetische Navigation in Branchenverzeichnissen,
Personenlisten, Glossaren oder anderen alphabetisch sortierten Ausgaben.

Das mitgelieferte Template ``mm_filteritem_register.html5`` ist für die
Register-spezifische Ausgabe vorgesehen.


Installation
------------

Die Filterregel wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/filter_register


Einstellungen beim Anlegen der Filterregel
------------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - Typ
     - Auswahl des Filterregeltyps – hier: "Register".
   * - Aktiviert
     - Aktiviert oder deaktiviert diese Filterregel.
   * - Kommentar
     - Freitextfeld zur Beschreibung des Zwecks dieser Filterregel.
   * - Attribut
     - Das Textattribut, nach dessen Anfangsbuchstaben gefiltert werden soll
       (z. B. Nachname, Firmenname).

Einstellungen für das Frontend-Widget
--------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - URL-Parameter
     - Der Schlüssel (Key) des URL-Parameters für den ausgewählten Buchstaben.
   * - URL-Typ für den Parameter
     - Legt fest, ob der Parameter als Slug (sprechende URL), als GET-Parameter übergeben wird (ab MM 2.4) - :ref:`siehe
       SEO <rst_cookbook_tips_seo_filter-url>`
   * - Label
     - Beschriftung des Filterwidgets.
   * - Label beim Filterwidget ausblenden
     - Unterdrückt die Ausgabe des Labels.
   * - Template
     - Template für die Widget-Ausgabe. Standard: ``mm_filteritem_register``.
   * - Anzahl anzeigen
     - Zeigt hinter jedem Buchstaben die Anzahl der zugehörigen Items an.
   * - Leere Buchstaben ausblenden
     - Blendet Buchstaben aus, für die keine Items vorhanden sind.
   * - Mehrfachfilterung erlauben
     - Ermöglicht die gleichzeitige Filterung nach mehreren Anfangsbuchstaben.
   * - Nur verbleibende Werte
     - Zeigt nur Buchstaben an, für die nach Anwendung der anderen aktiven Filter
       noch Ergebnisse vorhanden sind.
   * - Diesen Filter für verbleibende Werte ignorieren
     - Dieser Filter liefert beim Berechnen verbleibender Werte seine eigenen Optionen
       nicht als Einschränkung zurück.
   * - CSS-ID/Klasse
     - Setzt eine CSS-ID oder -Klasse am Widget-Element.


Passende Attribute
------------------

Die Filterregel "Register" eignet sich für Attribute mit Textwerten:

* :ref:`Text <component_attribute_text>`
* :ref:`Alias <component_attribute_alias>`
* :ref:`Kombinierte Einträge <component_attribute_combinedvalues>`
* :ref:`Token <component_attribute_token>`
* :ref:`Übersetzter Text <component_attribute_translatedtext>`


Sonderfunktionen
----------------

**Template mm_filteritem_register**

Das mitgelieferte Template gibt die Buchstabenliste mit Links aus. Das Template
kann auf dem üblichen Contao-Weg (Template-Vererbung) angepasst werden, um z. B.
eine andere Darstellung oder Sonderzeichen zu integrieren.


.. |svg_filt_register_22| image:: /_img/icons_svg/filter_register.svg
   :width: 22px
.. |img_filter_default| image:: /_img/icons/filter_default.png

.. |br| raw:: html

   <br />
