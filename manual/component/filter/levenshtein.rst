.. _component_filter_levenshtein:

|img_filter_default| Levenshtein-gestützte Suche
=================================================

Die Filterregel "Levenshtein-gestützte Suche" (Paket ``attribute_levenshtein``)
erzeugt einen Volltext-Index über ausgewählte Attribute und ermöglicht eine
ähnlichkeitsbasierte Volltextsuche mit Autovervollständigung. Die Suche basiert
auf dem Levenshtein-Abstandsalgorithmus, der auch Tippfehler und ähnlich klingende
Begriffe findet.

Voraussetzung ist die Installation des Attributs
:ref:`Levenshtein <component_attribute_levenshtein>`, das den Suchindex
in einer eigenen Tabelle aufbaut. Das mitgelieferte Template
``mm_filteritem_levenshtein.html5`` enthält die notwendige JavaScript-Logik
für die Autovervollständigung.

.. seealso:: Detaillierte Dokumentation zum Levenshtein-Attribut:
   :ref:`component_attribute_levenshtein`


Installation
------------

Die Filterregel wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_levenshtein


Einstellungen beim Anlegen der Filterregel
------------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - Typ
     - Auswahl des Filterregeltyps – hier: "Levenshtein-gestützte Suche".
   * - Aktiviert
     - Aktiviert oder deaktiviert diese Filterregel.
   * - Kommentar
     - Freitextfeld zur Beschreibung des Zwecks dieser Filterregel.
   * - Attribut
     - Das Levenshtein-Attribut, das den Suchindex bereitstellt.


Einstellungen für das Frontend-Widget
--------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - URL-Parameter
     - Der Schlüssel (Key) des URL-Parameters für die Sucheingabe.
   * - URL-Typ für den Parameter
     - Legt fest, ob der Parameter als Slug, GET-Parameter oder beides übergeben wird.
       (ab MM 2.4)
   * - Label
     - Beschriftung des Sucheingabefelds.
   * - Label beim Filterwidget ausblenden
     - Unterdrückt die Ausgabe des Labels.
   * - Template
     - Template für die Widget-Ausgabe. Standard: ``mm_filteritem_levenshtein``
       (enthält JavaScript für Autovervollständigung).
   * - Platzhalter
     - Platzhaltertext im Sucheingabefeld.
   * - CSS-ID/Klasse
     - Setzt eine CSS-ID oder -Klasse am Widget-Element.
   * - Autovervollständigung aktivieren
     - Aktiviert die JavaScript-basierte Autovervollständigung während der Eingabe.
       Standard: aktiv.
   * - Mindestzeichen für Autovervollständigung
     - Anzahl der Zeichen, ab der die Autovervollständigung ausgelöst wird. Standard: 3.
   * - Automatisch übermitteln
     - Das Suchformular wird automatisch übermittelt, wenn ein Autovervollständigungs-
       vorschlag ausgewählt wird.


Passende Attribute
------------------

Die Filterregel "Levenshtein-gestützte Suche" arbeitet ausschließlich mit dem
speziellen Levenshtein-Attribut:

* :ref:`Levenshtein <component_attribute_levenshtein>`

Das Levenshtein-Attribut kann dabei seinerseits mehrere andere Attribute (Text,
Langtext, Alias usw.) indizieren.


.. |img_filter_default| image:: /_img/icons/filter_default.png

.. |br| raw:: html

   <br />
