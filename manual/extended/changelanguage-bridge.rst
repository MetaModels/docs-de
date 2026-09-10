.. _rst_extended_changelanguage-bridge:

ChangeLanguage-Bridge für MetaModels
=====================================

Macht die Erweiterung `"ChangeLanguage" <https://github.com/terminal42/contao-changelanguage>`_ auf
Detailseiten eines MetaModels item-bezogen: Statt beim Sprachwechsel auf die Sprachstartseite
zurückzufallen, verlinkt der Sprachenwechsler direkt auf denselben Datensatz in der Zielsprache -
inklusive der dort passenden Filterparameter (z. B. Alias).

Die Erweiterung deckt zwei getrennte Fälle ab, siehe ":ref:`rst_extended_changelanguage-bridge_slug-get`"
weiter unten für die Abgrenzung:

* **Übersetztes Attribut** (der Filterwert unterscheidet sich je Sprache, z. B.
  ``adam-de-adonis-de`` vs. ``adam-en-adonis-en``): Häkchen "Sprachumschalter unterstützen" je
  Rendereinstellung nötig, siehe ":ref:`rst_extended_changelanguage-bridge_aktivierung`".
* **GET-Filterparameter, auch bei einsprachigen Modellen** (z. B. ``?alias=...``): läuft ganz ohne
  Konfiguration automatisch mit, siehe ":ref:`rst_extended_changelanguage-bridge_get-auto`".

Mehr zum Thema :ref:`Mehrsprachigkeit in MetaModels <component_multi-language>`, insbesondere der
Abschnitt ":ref:`component_multi-language_fe-output`" - dort sind auch die beiden bisherigen
Behelfslösungen (Filterregel "Alle Sprachen durchsuchen" bzw. ein eigener
``changelanguageNavigation``-Hook) beschrieben, die sich mit dieser Erweiterung erübrigen.


Voraussetzungen
----------------

* ab MetaModels 2.5
* `terminal42/contao-changelanguage <https://github.com/terminal42/contao-changelanguage>`_
* nur für den Fall "übersetztes Attribut": je Sprache eine eigene "Springe zu Seite"-Zeile samt
  Filtereinstellung in der Rendereinstellung - die übliche Konfiguration für mehrsprachige
  Sprung-Links. Für den GET-Fall ist keine besondere Konfiguration der Rendereinstellung nötig.


Installation per Contao-Manager oder Composer
----------------------------------------------

.. code-block:: bash

   composer require metamodels/changelanguage-bridge


.. _rst_extended_changelanguage-bridge_slug-get:

Wie ChangeLanguage Slug- und GET-Parameter behandelt
------------------------------------------------------

Ob `"ChangeLanguage" <https://github.com/terminal42/contao-changelanguage>`_ einen Filterparameter
beim Sprachwechsel von sich aus mitnimmt, hängt davon ab, wie er in der URL steht - das ist reines
ChangeLanguage-Verhalten, unabhängig von dieser Erweiterung oder MetaModels allgemein:

* **Als Pfadsegment** (Contaos "Folder"-URLs, z. B. ``/alias/hihi-huhusss-2``) liest
  ``ChangeLanguageModule::createUrlParameterBag()`` jedes ``/schlüssel/wert/``-Paar aus der
  aktuellen Anfrage aus und übernimmt es ungefragt in die Ziel-URL. Dafür ist **keine**
  Konfiguration nötig - solange der Wert auch in der Zielsprache gültig ist (siehe unten).
* **Als GET-Parameter** (z. B. ``?alias=hihi-huhusss-2``) übernimmt dieselbe Methode nur, was im
  Seitenfeld "Query-Parameter beibehalten" (``tl_page.languageQuery``) explizit als Name
  eingetragen ist. Ohne Eintrag geht der Parameter beim Sprachwechsel verloren, der Sprachenwechsler
  landet dann auf der bloßen Zielseite ohne Datensatzbezug.

Contaos ``auto_item`` (der parameterlose Fall, z. B. ``/hihi-huhusss-2`` ganz ohne vorangestellten
Schlüssel) ist von der Pfadsegment-Übernahme ausdrücklich ausgenommen -
``createUrlParameterBag()`` entfernt ihn wieder. Ein Filterparameter, der beim Sprachwechsel
mitgenommen werden soll, darf also nicht als ``auto_item`` eingetragen sein, sondern braucht einen
echten URL-Parameternamen (z. B. "alias").

Das erklärt auch, warum ein **einsprachiges** MetaModel, dessen Detailseite in jeder Sprachwurzel
denselben Alias verwendet, beim Pfadsegment-Fall ganz ohne diese Erweiterung funktioniert: Es gibt
keinen sprachspezifischen Wert zu übersetzen, und ChangeLanguage übernimmt den identischen Wert
schon von sich aus. Erst wenn sich der Wert je Sprache unterscheidet (übersetztes Attribut) oder
der Parameter als GET übergeben wird, wird eine der beiden folgenden Abschnitte relevant.


.. _rst_extended_changelanguage-bridge_get-auto:

Automatische GET-Parameter (unabhängig von der Checkbox)
------------------------------------------------------------

Den GET-Fall von oben löst diese Erweiterung automatisch, ganz ohne Häkchen bei
"Sprachumschalter unterstützen" und ohne manuellen Eintrag bei "Query-Parameter beibehalten": Für
die aktuelle Seite wird ermittelt, welches MetaModels-Inhaltselement (bzw. eingebundene Modul) dort
Datensätze filtert, und welche seiner Filterparameter als "GET" (oder das nachsichtige
"Slug-oder-GET") deklariert sind. Deren aktueller Wert wird unverändert an den Sprachenwechsler
weitergereicht.

Bewusst getrennt von der Item-Übersetzung im nächsten Abschnitt: Dieser Teil übersetzt nichts,
sondern reicht nur den rohen Wert durch - für ein einsprachiges Modell (identischer Wert in jeder
Sprache) ist das immer richtig. Ist für dieselbe Rendereinstellung zusätzlich "Sprachumschalter
unterstützen" aktiv und liefert bereits einen sprachspezifisch übersetzten Wert, hat dieser Vorrang
und wird von der automatischen Weiterleitung nicht überschrieben.


.. _rst_extended_changelanguage-bridge_aktivierung:

Aktivierung für übersetzte Attribute
---------------------------------------

Pro Rendereinstellung, deren Sprungziel den Sprachenwechsler mit dem übersetzten Datensatz
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
