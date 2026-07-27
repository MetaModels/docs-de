.. _new_in_mm250:

Änderungen und Features von MM 2.5
==================================

Folgend eine Übersicht der Änderungen und Features zu MetaModels 2.5, die durch das
"early adopter Programm" ermöglicht wurden - mehr dazu unter Fundraising auf der
`MM Webseite <https://now.metamodel.me/de/unterstuetzer/fundraising#metamodels_2-5>`_.

Für einen Check nach einem Upgrade zu MM 2.5 sind :ref:`unten weitere Hinweise <check_upgrade_mm250>`.


Allgemein und Core
------------------

MetaModels 2.5 setzt auf **Contao 5.7** und **PHP 8.4** auf.

Das wichtigste neue Feature ist die Unterstützung von **Twig-Templates** zusätzlich zu den bisherigen
``.html5``-Templates.

Twig-Templates (NEU)
^^^^^^^^^^^^^^^^^^^^^

Jedes MetaModels-Template kann nun zusätzlich als **Twig-Template** angeboten werden. Existiert für ein Template
eine Twig-Variante, hat sie **Vorrang** vor dem klassischen ``.html5``-Template - genau wie in Contao selbst.
Fehlt die Twig-Variante, wird unverändert das ``.html5`` gerendert (voller Rückwärtskompatibilitäts-Fallback).

Der Vorrang gilt sowohl im **Frontend als auch im Backend**. Nur die sichtbare Ausgabe (Format ``html5``) wird
über Twig gerendert; die Textausgabe für Suchindex und Sortierung bleibt auf der bisherigen Engine.

**Namensschema:** Die Twig-Templates liegen im gemanagten ``@Contao``-Namespace in einer eigenen Untergruppe
``metamodels/``. Aus dem bisherigen (flachen) Template-Namen wird der Twig-Identifier gebildet, indem das
konventionelle Präfix entfernt und die Gruppe (``attribute``, ``filter`` oder ``item``) vorangestellt wird:

============================  ===========  =========================================================
Bisher (``.html5``)           Gruppe       Twig
============================  ===========  =========================================================
``mm_attr_text``              attribute    ``@Contao/metamodels/attribute/text.html.twig``
``mm_filteritem_default``     filter       ``@Contao/metamodels/filter/default.html.twig``
``metamodel_prerendered``     item         ``@Contao/metamodels/item/prerendered.html.twig``
============================  ===========  =========================================================

Weil die Templates im ``@Contao``-Namespace liegen, sind sie ohne Zusatzaufwand im **Template Studio** von Contao
bearbeitbar und über **Theme-Ordner** sowie das globale Projekt-``templates/``-Verzeichnis überschreibbar.

**Eigene Twig-Templates bereitstellen:** Eigene Twig-Templates werden - wie in Contaos eigenen Bundles - unter
einem *Namespace-Root* abgelegt: ein Ordner ``twig/`` mit einer leeren Marker-Datei ``.twig-root``. Im Projekt ist
der Ordner ``templates/`` bereits ein Namespace-Root, sodass dort direkt die Unterordner-Struktur genutzt werden
kann:

.. code-block:: text

   templates/
   └── metamodels/
       ├── attribute/
       │   └── text.html.twig
       ├── filter/
       │   └── default.html.twig
       └── item/
           └── prerendered.html.twig

Innerhalb eines Templates stehen dieselben Variablen zur Verfügung wie im ``.html5`` (z. B. ``{{ raw }}`` beim
Attribut). Die aus den ``.html5`` bekannten Blöcke sind echte Twig-Blöcke - z. B. erweitert ein Filter-Widget das
Standard-Template mit ``{% extends "@Contao/metamodels/filter/default.html.twig" %}`` und überschreibt die Blöcke
``formlabel`` und ``formfield``.

**Bestehende Overrides:** Ein vorhandenes Override eines **flachen** Template-Namens im Projekt-``templates/``-Ordner
(oder in einem Theme-Ordner) - z. B. ``templates/metamodel_prerendered.html5`` - behält weiterhin **Vorrang** vor
einem mitgelieferten Twig-Template. Bestehende Anpassungen funktionieren also nach dem Upgrade unverändert weiter.

.. note:: Diese Rücksichtnahme auf Flach-Overrides ist eine **Übergangslösung** und entfällt in MetaModels 3.0
   gemeinsam mit den ``.html5``-Templates. Eigene Anpassungen sollten daher nach ``templates/metamodels/<gruppe>/…``
   umgezogen werden - entweder als ``.html.twig`` oder (übergangsweise) als ``.html5`` unter dem neuen Pfad.


DC_General
----------

Der DC_General wurde auf **Contao 5.7** umgestellt. Die wesentlichen Änderungen:

* **Referer-Handling neu:** Contao 5.7 ermittelt die Referenzseite nicht mehr über die Session, sondern über den
  ``DcaUrlAnalyzer``. Für die MetaModels-Tabellen greift das nicht, daher werden die Links für „Zurück" und
  „Speichern und schließen" nun **deterministisch** erzeugt (neu: ``ViewHelpers::getBackUrl()``). Der bisherige
  ``StoreRefererListener`` entfällt.
* **Button „Speichern und zurück" (saveNback) entfernt:** Der DC_General folgt hier Contao Core 5.7.0 - der Button
  ``saveNback`` wurde in Eingabemaske und „Alle bearbeiten" entfernt. „Speichern und schließen" (``saveNclose``)
  bleibt erhalten.
* **Contao-Altlasten entfernt:** Nicht mehr benötigte Klassen und Pfade aus Contao-Versionen kleiner 5.7 wurden
  entfernt (u. a. ``TreeSelect``, ``FileSelect`` sowie der tote File-Selector-Pfad im ``FileTree``-Widget).
* **Sortierbare Auswahllisten auf Contao-5-Technik umgestellt:** Das ``fileTree``-Widget und die Baum-Picker
  nutzen jetzt die Stimulus-Controller ``contao--sortable`` und ``contao--input-map`` von Contao anstelle des
  mit Contao 5.7 als veraltet markierten ``Backend.makeMultiSrcSortable()``. Der Button zum Entfernen einer
  Datei wird dabei serverseitig gerendert statt per JavaScript nachgerüstet. Zusätzlich wertet das
  ``fileTree``-Widget die Widget-Option ``isSortable`` aus, mit der Contao seit Version 5.0 die entfallene
  Option ``orderField`` ersetzt - letztere wird weiterhin unterstützt. An der Bedienung ändert sich nichts.
* **Tooltips der Operations-Buttons korrigiert:** In den Listenansichten wurde die Anzeige der Tooltips (inkl. der
  Icons zum Öffnen von Kindtabellen) korrigiert.


Mehrsprachigkeit
----------------



Attribute
---------

Für die Attribut-Templates werden schrittweise **Twig-Varianten** unter
``metamodels/attribute/<typ>`` ergänzt (siehe Abschnitt „Twig-Templates"). Die bisherigen
``.html5``-Templates bleiben als Fallback erhalten.

* Bewertung (rating)
    * die **MooTools-Variante wurde entfernt** (Template ``mm_attr_rating_moo.html5`` sowie die
      MooTools-JS-Dateien ``moostarrating.js``/``moostarrating_src.js``) - es bleibt die
      Vanilla-Star-Rating-Variante
    * neue Twig-Templates ``metamodels/attribute/rating`` (bindet das JS via ``{% add … to body %}``
      ein) und ``metamodels/attribute/rating_raw``

* Datei (file) und Übersetzte Datei (translatedfile)
    * die **separate Spalte für die Sortierung entfällt** - die Reihenfolge mehrerer Dateien steckt nun im Wert
      selbst, genau wie Contao es seit Version 5.0 handhabt
    * bisher legte MetaModels bei gesetzter Option *Mehrere Dateien* (``file_multiple``) eine zusätzliche Spalte
      ``<spaltenname>__sort`` in der Item-Tabelle an; bei *Übersetzte Datei* übernahm die Spalte ``value_sorting``
      in ``tl_metamodel_translatedlongblob`` diese Aufgabe
    * Hintergrund: Contao hat die Widget-Option ``orderField`` mit Version 5.0 entfernt - das ``fileTree``-Widget
      kennt nur noch ``isSortable`` und legt die Reihenfolge direkt im Feldwert ab. Die manuelle Sortierung war
      damit unter Contao 5 faktisch wirkungslos geworden
    * eine **Migration** überführt die vorhandene Reihenfolge in den Wert und löscht die Spalte anschließend:
      Einträge aus der Sortier-Spalte zuerst, danach die restlichen Dateien in ihrer bisherigen Reihenfolge
    * die virtuellen Hilfsattribute ``<spaltenname>__sort`` entfallen; die Klassen ``FileOrder`` bzw.
      ``TranslatedFileOrder`` sind als *deprecated* markiert und werden in MM 3.0 entfernt
    * an der Bedienung ändert sich nichts: mehrere Dateien werden in der Eingabemaske weiterhin per
      Drag & Drop sortiert und über den Button am Vorschaubild einzeln aus der Auswahl entfernt


Filter
------

* Die Filter-Widgets im Frontend werden nun über die MetaModels-Template-Engine gerendert und folgen damit demselben
  ``@Contao/metamodels/filter/<name>``-Schema wie Attribute und Items (siehe Abschnitt „Twig-Templates").


Frontend-Editing (FEE)
----------------------




Known-Issues
------------

* bei Umschaltung zu/vom Debugmodus im BE per Button stimmt die Referenzseite nicht mehr und man muss die Seite
  erneut ansteuern - z. B. mit „zurück" im Browser und Reload der Seite |br|
  Ursache ist der von Contao erzeugte Umschalt-Link ``?do=debug&key=enable&referer=…``: auf den route-basierten
  MetaModels-Backend-Seiten (z. B. ``/contao/metamodel/mm_employees``) bleibt der ``referer``-Parameter **leer**,
  sodass Contao nach dem Umschalten auf das Backend-Dashboard statt zur Ausgangsseite zurückführt. Das betrifft
  Contaos eigenen Debug-Umschalter und wird vom neuen Referer-Handling des DC_General (eigene „Zurück"-Buttons)
  nicht erfasst - Contao bietet an dieser Stelle keine Möglichkeit, den Referer zu beeinflussen.


.. _check_upgrade_mm250:
Check für Upgrade auf MM 2.5
----------------------------

Grundsätzlich ist ein Upgrade innerhalb des MM 2.x-Zweiges problemlos möglich und ggf. notwendige Anpassungen an
Bezeichnungen und DB-Änderungen werden über Migrationen abgefangen. Es gibt aber ein paar Sachen, die damit nicht
oder nur sehr schwer abzufangen sind. Aus dem Grund sollten bei der Umstellungen auf MM 2.5 die folgenden Punkte
im Blick behalten werden:

* bitte alle Hinweise aus :ref:`MM 2.4 <check_upgrade_mm240>` beachten
* Voraussetzungen prüfen: **Contao 5.7** und **PHP 8.4**
* **eigene Template-Overrides** am flachen Namen (z. B. ``templates/metamodel_prerendered.html5``) funktionieren
  weiter, sollten aber nach ``templates/metamodels/<gruppe>/…`` umgezogen werden - der Flach-Override-Vorrang
  entfällt in MM 3.0
* wer eigene Twig-Templates ausliefert: Ordner ``twig/`` mit ``.twig-root``-Marker und Struktur
  ``metamodels/<gruppe>/<leaf>.html.twig`` verwenden
* **DC_General:** Anpassungen zum Referer-Handling und der Wegfall des Buttons „Speichern und zurück" (saveNback)
  beachten; eigene Templates/Programmierungen, die auf ``saveNback`` bauen, anpassen
* **Datei-Attribute:** die Sortier-Spalten ``<spaltenname>__sort`` bzw. ``value_sorting`` werden per Migration in
  den Wert überführt und danach **gelöscht** - vorher unbedingt eine Datensicherung anlegen, das Löschen der
  Spalten ist nicht umkehrbar. Eigene Programmierungen oder Auswertungen, die direkt auf diese Spalten zugreifen,
  müssen angepasst werden; die Reihenfolge steht jetzt im Wert selbst. Im geparsten Wert bleiben die bisherigen
  Schlüssel ``bin_sorted``/``value_sorted``/``path_sorted``/``meta_sorted`` (Datei) und ``value_sorting``
  (Übersetzte Datei) erhalten, sie entsprechen nun dem unsortierten Pendant. Der bereits seit 2.1 als veraltet
  markierte Schlüssel ``sort`` entfällt


Re-Finanzierung
---------------
.. seealso:: Für eine Re-Finanzierung der umfangreichen Arbeiten, bittet das MM-Team um finanzielle
   Zuwendung. Als Richtgröße sollte der Umfang des zu realisierenden Projektes genommen werden
   und etwa 10% einkalkuliert werden - aufgrund der Erfahrung der letzten Zuwendungen, sind
   das Beträge zwischen 100€ und 500€ (Netto) - eine Rechnung inkl. MwSt wird natürlich immer
   ausgestellt. `Mehr... <https://now.metamodel.me/de/unterstuetzer/spenden>`_


.. |img_fallback| image:: /_img/icons/fallback.png
.. |img_translated| image:: /_img/icons/translated.png

.. |br| raw:: html

   <br />
