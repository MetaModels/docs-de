.. _component_attribute_levenshtein:

|svg_attr_levenshtein_22| Levenshtein
=====================================

Das Attribut "Levenshtein" erstellt einen Volltext-Suchindex für ausgewählte
MetaModels-Attribute und ermöglicht eine Ähnlichkeitssuche mit konfigurierbarer
Fehlertoleranz (Tippfehler, ähnliche Schreibweisen). Typische Einsatzbereiche:

* Produktsuche mit Toleranz für Tippfehler
* Namensuche (z. B. "Meier" findet auch "Mayer", "Maier")
* Volltextsuche über mehrere Attribute gleichzeitig

Das Attribut selbst speichert keine eigenen Datenwerte, sondern erstellt und
pflegt einen separaten Suchindex. Die eigentliche Suche erfolgt über eine
eigene Filterregel im Frontend.


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_levenshtein


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Das Levenshtein-Attribut bietet folgende spezifische Einstellungen:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Attribute zum Indexieren
     - Auswahl aller MetaModels-Attribute, deren Werte in den Suchindex
       aufgenommen werden sollen. Es können mehrere Attribute gleichzeitig
       gewählt werden (Checkbox-Liste).
   * - Maximaler Levenshtein-Abstand
     - Mehrspaltiger Assistent zur Konfiguration der erlaubten Abweichung
       je Mindest-Wortlänge. Für jede Mindestlänge wird der maximale
       Levenshtein-Abstand festgelegt:

       * **Minimale Wortlänge** – Ab welcher Wortlänge der Abstand gilt
       * **Erlaubter Abstand** – Anzahl der erlaubten Zeichenabweichungen (0–10)

       Standardvorgabe: Wörter ab 3 Zeichen → Abstand 1, ab 5 Zeichen → 2,
       ab 9 Zeichen → 5.
   * - Mindestlänge der Wörter
     - Wörter mit weniger Zeichen als dieser Wert werden nicht in den
       Suchindex aufgenommen (Standard: ``3``).
   * - Maximale Länge der Wörter
     - Wörter mit mehr Zeichen als dieser Wert werden nicht in den
       Suchindex aufgenommen (Standard: ``20``).


Einstellungen bei den Render-Einstellungen
-------------------------------------------

Das Attribut besitzt keine eigenen Render-Einstellungen, da es keine
anzuzeigenden Datenwerte enthält. Es ist typischerweise nicht in
Render-Einstellungen aufgeführt.


Einstellungen bei der Eingabemaske
------------------------------------

Das Levenshtein-Attribut erscheint nicht als Eingabefeld in der Eingabemaske —
der Suchindex wird automatisch beim Speichern von Datensätzen aktualisiert.


Filterregeln
------------

Das Levenshtein-Attribut stellt eine eigene Filterregel zur Verfügung:

.. list-table::
   :header-rows: 1
   :widths: 30 70

   * - Filterregel
     - Hinweis
   * - Levenshtein-gestützte Suche
     - Ähnlichkeitssuche im Suchindex mit Tippfehlertoleranz. Unterstützt
       Wildcards (``*`` und ``?``). In den Filtereinstellungen kann ein
       URL-Parameter, ein Template und Autocomplete-Optionen (Mindestzeichenanzahl,
       automatische Übermittlung) konfiguriert werden.


Sonderfunktionen
-----------------

**Speicherung**

Das Attribut speichert keine eigenen Werte in der MetaModel-Tabelle. Der
Suchindex wird in zwei eigenen Tabellen abgelegt: ``tl_metamodel_levenshtein``
enthält je indiziertem Datensatz einen Eintrag, ``tl_metamodel_levenshtein_index``
die daraus gewonnenen Wörter (Spalten: ``word``, ``transliterated``). Die
MetaModel-Tabelle erhält keine eigene Spalte.

.. note:: Bis MetaModels 2.4 waren der Attributtyp, die beiden Tabellen und zwei Spalten
   in ``tl_metamodel_attribute`` als ``levensthein`` fehlgeschrieben (``h`` und ``t``
   vertauscht). Ab MetaModels 2.5 heißt alles einheitlich ``levenshtein``; eine Migration
   benennt Bestandsinstallationen automatisch um und erhält dabei den Suchindex, siehe
   :ref:`new_in_mm250`.

**Index-Aktualisierung**

Der Suchindex wird automatisch über einen ``modelSaved``-Hook aktualisiert,
sobald ein MetaModels-Datensatz gespeichert wird. Über die Backend-Listen-
operation "Index neu aufbauen" (Icon in der Attributliste) kann der Index
manuell komplett neu generiert werden.

**Autocomplete**

Die Filterregel unterstützt Autocomplete im Frontend. Über die Filtereinstellungen
kann eine Mindestzeichenanzahl konfiguriert werden, ab der Vorschläge erscheinen,
sowie ob das Formular automatisch übermittelt wird.

**Stoppwörter**

Sehr kurze oder häufige Wörter (Stoppwörter) werden nicht indiziert. Zusätzlich
zu der konfigurierten Mindestlänge enthält die Erweiterung eine Stoppwort-Liste
(z. B. englische Artikel wie "a", "an", "are").

**Sprachunterstützung**

Der Index wird sprachbewusst erstellt — bei mehrsprachigen MetaModels wird
die aktive Sprache beim Aufbau des Index berücksichtigt.


.. |svg_attr_levenshtein_22| image:: /_img/icons_svg/levenshtein.svg
   :width: 22px
.. |br| raw:: html

   <br />
