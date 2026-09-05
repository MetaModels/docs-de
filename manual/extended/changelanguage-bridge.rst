.. _rst_extended_changelanguage-bridge:

ChangeLanguage-Bridge für MetaModels
=====================================

Macht die Erweiterung `"ChangeLanguage" <https://github.com/terminal42/contao-changelanguage>`_ auf
Detailseiten eines MetaModels item-bezogen: Statt beim Sprachwechsel auf die Sprachstartseite
zurückzufallen, verlinkt der Sprachenwechsler direkt auf denselben Datensatz in der Zielsprache -
inklusive der dort passenden Filterparameter (z. B. Alias).

Mehr zum Thema :ref:`Mehrsprachigkeit in MetaModels <component_multi-language>`, insbesondere der
Abschnitt ":ref:`component_multi-language_fe-output`" - dort sind auch die beiden bisherigen
Behelfslösungen (Filterregel "Alle Sprachen durchsuchen" bzw. ein eigener
``changelanguageNavigation``-Hook) beschrieben, die sich mit dieser Erweiterung erübrigen.


Voraussetzungen
----------------

* ab MetaModels 2.5
* `terminal42/contao-changelanguage <https://github.com/terminal42/contao-changelanguage>`_
* je Sprache eine eigene "Springe zu Seite"-Zeile samt Filtereinstellung in der Rendereinstellung -
  die übliche Konfiguration für mehrsprachige Sprung-Links


Installation per Contao-Manager oder Composer
----------------------------------------------

.. code-block:: bash

   composer require metamodels/changelanguage-bridge


Aktivierung
-----------

Keine globale Konfiguration nötig. Pro Rendereinstellung, deren Sprungziel den Sprachenwechsler
unterstützen soll, wird im Bereich "Springe zu Seite" die Option **"Sprachumschalter
unterstützen"** angehakt - standardmäßig aus, damit ein bereits vorhandener eigener
``changelanguageNavigation``-Hook für dieselbe Rendereinstellung nicht kollidiert.


Wie es funktioniert
--------------------

Beim Aufbau des Sprachenwechslers prüft die Erweiterung selbstständig, ob die aktuelle Seite das
Sprungziel einer Rendereinstellung mit aktivierter Option ist. Ist das der Fall, wird der gerade
angezeigte Datensatz ermittelt, die MetaModel-Sprache auf die jeweilige Zielsprache umgeschaltet und
über dieselbe interne Funktion, mit der MetaModels auch sonst seine Sprung-Links erzeugt, Zielseite
und Slug für diese Sprache bestimmt. Die Rendereinstellung mit ihrer Filterkonfiguration bleibt damit
die einzige Stelle, an der das Sprungziel gepflegt wird.
