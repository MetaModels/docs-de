.. _component_inserttags:

Insert-Tags
==========

.. note:: Ausgabe von Werten eines Model, Item, Attributes per Insert-Tag |br|
  Die Insert-Tags wurden in MM 2.3 komplett überarbeitet und stehen teilweise erst ab
  der Version (lauffähig) zur Verfügung.



Einleitung
----------

Um verschiedene Ausgaben aus MetaModels im üblichen Contao-Content zu ermöglichen,
stehen verschiedene Insert-Tags zur Verfügung wie z. B. die Gesamtanzahl von (veröffentlichten)
Datensätzen oder auch einzelne Werte eines oder mehrere Items.

Eigene Insert-Tags können über den Contao-Hook
`replaceInsertTags <https://docs.contao.org/dev/reference/hooks/replaceInsertTags/>`_ im Zusammenspiel
mit der :ref:`MM-API <ref_api>` leicht selbst erstellt werden.


Gesamtanzahl von Items
----------------------

Wenn keine Items gefunden werden z. B. durch die Filterung, wird die Ziffer ``0``
ausgegeben.

* FE-Model MM-Liste: ``{{mm::total::mod::[ID]}}`` - z. B. ``{{mm::total::mod::22}}``
* CE MM-Liste: ``{{mm::total::ce::[ID]}}`` - z. B. ``{{mm::total::ce::33}}``
* MetaModel: ``{{mm::total::mm::[MM Col-Name|ID](::[ID filter])}}`` - z. B.
  ``{{mm::total::mm::mm_employees}}``, ``{{mm::total::1}}``, ``{{mm::total::1::44}}``


Ausgabe eines/mehrerer Items
----------------------------

Ausgabe eines oder mehrerer Items mit optionaler Angabe des Ausgabetyps.

* ``{{mm::item::[MM Col-Name|ID]::[Item ID|ID,ID,ID]::[ID render setting](::[Output (Default:text)|html5])`` - z. B.
  ``{{mm::item::mm_employees::1,3,42::5}}``


Ausgabe eines Attributes
------------------------

Ausgabe eines Attributes mit optionaler Angabe des Ausgabetyps.

* ``{{mm::attribute::[MM Col-Name|ID]::[Item ID]::[ID render setting]::[Attribute Col-Name|ID](::[Output (Default:text)|html5|raw])`` - z. B.
  ``{{mm::attribute::mm_employees::42::5::combined_name}}``, ``{{mm::attribute::mm_employees::42::5::date_start::raw}}``


Ausgabe von Parametern der Weiterleitung zur Detailseite
--------------------------------------------------------

Ausgabe der URL, Bezeichnung, Seiten-ID oder Werte des Knotens "param" wie z. B. dem Alias einer Weiterleitung
(jumpTo) eines Items - die Weiterleitung muss in den Rendereinstellungen entsprechend konfiguriert sein.

* ``{{mm::jumpTo::[MM Col-Name|ID]::[Item ID]::[ID render setting](::[Parameter (Default:url)|label|page|params.attname])}}`` - z. B.
  ``{{mm::jumpTo::mm_employees::42::5}}``, ``{{mm::jumpTo::mm_employees::42::5::page}}``, ``{{mm::jumpTo::mm_employees::42::5::params.alias}}``



.. |br| raw:: html

   <br />


