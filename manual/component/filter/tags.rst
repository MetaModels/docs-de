.. _component_filter_tags:

|img_filter_tags| Mehrfachauswahl
==================================

Die Filterregel "Mehrfachauswahl" (Paket ``filter_tags``) gibt ein Frontend-Widget
aus, über das Besucher mehrere Werte gleichzeitig aus einer Liste auswählen können.
Die Items werden nach den gewählten Werten eines Attributs gefiltert. Typischerweise
wird die Filterregel mit dem Attributtyp :ref:`Mehrfachauswahl (tags) <component_attribute_tags>`
kombiniert, um Relationen (m:n) im Frontend filterbar zu machen.

Alternativ steht das Template ``mm_filteritem_linklist.html5`` (Link-Liste) zur Verfügung.
Über die Option "ODER-Verknüpfung" kann konfiguriert werden, ob Items alle oder nur
einen der gewählten Werte erfüllen müssen.


Installation
------------

Die Filterregel wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/filter_tags


Einstellungen beim Anlegen der Filterregel
------------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - Typ
     - Auswahl des Filterregeltyps – hier: "Mehrfachauswahl".
   * - Aktiviert
     - Aktiviert oder deaktiviert diese Filterregel.
   * - Kommentar
     - Freitextfeld zur Beschreibung des Zwecks dieser Filterregel.
   * - Attribut
     - Das Tags-Attribut, nach dessen Werten gefiltert werden soll.
   * - Label-Attribut
     - Optionales Attribut, dessen Wert als Anzeigetext der Optionen im Widget
       verwendet wird.


Einstellungen für das Frontend-Widget
--------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - URL-Parameter
     - Der Schlüssel (Key) des URL-Parameters.
   * - Label
     - Beschriftung des Filterwidgets.
   * - Label beim Filterwidget ausblenden
     - Unterdrückt die Ausgabe des Labels.
   * - Template
     - Template für die Widget-Ausgabe. Standard: ``mm_filteritem_default``;
       alternativ: ``mm_filteritem_linklist``.
   * - Sortierung
     - Sortierung der Auswahloptionen im Widget (aufsteigend oder absteigend).
   * - Leere Auswahl ermöglichen
     - Fügt eine leere Option ("Alle") hinzu.
   * - "Alle auswählen"-Button anzeigen
     - Fügt einen Button ein, mit dem alle Optionen auf einmal ausgewählt werden können.
   * - ODER-Verknüpfung
     - Ist diese Option aktiv, wird ein Item angezeigt, wenn es mindestens einen der
       gewählten Werte enthält (ODER). Ist die Option inaktiv, müssen alle gewählten
       Werte zutreffen (UND).
   * - Nur zugeordnete Werte
     - Zeigt im Widget nur Werte an, die in mindestens einem Item tatsächlich
       vergeben sind.
   * - Nur verbleibende Werte
     - Zeigt nur Werte an, für die nach Anwendung der anderen aktiven Filter noch
       Ergebnisse vorhanden sind.
   * - Diesen Filter für verbleibende Werte ignorieren
     - Dieser Filter liefert beim Berechnen verbleibender Werte seine eigenen Optionen
       nicht als Einschränkung zurück.
   * - CSS-ID/Klasse
     - Setzt eine CSS-ID oder -Klasse am Widget-Element.


Passende Attribute
------------------

Die Filterregel "Mehrfachauswahl" eignet sich insbesondere für:

* :ref:`Mehrfachauswahl [tags] <component_attribute_tags>`
* :ref:`Übersetzte Mehrfachauswahl [tags] <component_attribute_translatedtags>`


Sonderfunktionen
----------------

**Link-Listen**

Das Template ``mm_filteritem_linklist`` gibt die Filteroptionen als Links aus.
Jeder Klick auf einen Link übergibt den Wert als URL-Parameter, ohne ein Formular
zu benötigen. Dies eignet sich besonders für SEO-freundliche Filternavigationen.

**UND- vs. ODER-Verknüpfung**

Bei deaktivierter ODER-Option (Standard) müssen alle gewählten Tags in einem Item
vorhanden sein (UND-Filterung). Bei aktivierter ODER-Option reicht ein übereinstimmender
Tag (ODER-Filterung). Dies beeinflusst die Ergebnismenge bei mehrfacher Auswahl
erheblich.


.. |img_filter_tags| image:: /_img/icons/filter_tags.png

.. |br| raw:: html

   <br />
