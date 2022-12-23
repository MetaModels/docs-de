.. _rst_cookbook_templates_flatpickr-integration:

Einfache Datumsauswahl für den Filterregel from-to durch Integration von Flatpickr
==================================================================================

Wenn man im FE-Widget der Filterregel From-To ("Wert von/bis für ein Datumsfeld")
Picker für die Datumsauswahl haben möchte, kann man das mit den folgenden Anpassungen erreichen:

Im BE das Template mm_filteritem_default.html5 anlegen und in mm_filteritem_flatpickr.html5 umbenennen sowie
in den Filtereinstellungen als Template auswählen.

Folgende Zeilen sind im Template zu ergänzen:

An 1. Stelle die Dateien von Flatpickr einbinden - diese sind unter `Flatpickr <https://flatpickr.js.org>`_
zu finden:

.. code-block:: php
   :linenos:

   <?php
   $GLOBALS['TL_JAVASCRIPT'][] = 'files/resources/flatpickr/flatpickr.min.js';
   $GLOBALS['TL_JAVASCRIPT'][] = 'files/resources/flatpickr/l10n/de.js';
   $GLOBALS['TL_JAVASCRIPT'][] = 'files/resources/flatpickr/plugins/rangePlugin.js';
   $GLOBALS['TL_CSS'][]        = 'files/resources/flatpickr/flatpickr.min.css';
   ?>

An letzter Stelle den folgenden JavaScript-Code eingeben - hier ist der Spaltenname des Attributes ``startDate``
und es wird das RangePlugin verwendet - weitere Einstellungen in der `Doku vom Flatpickr <https://flatpickr.js.org>`_
zu finden:

.. code-block:: php
   :linenos:

   <script>
   flatpickr('#ctrl_startDate_0', {
      locale: "de",
      minDate: "today",
      enableTime: false,
      allowInput: true,
      disableMobile: true,
      dateFormat: "d.m.Y",
      defaultDate: ["today", new Date().fp_incr(14)],
      "plugins": [new rangePlugin({ input: "#ctrl_startDate_1"})]
   });
   </script>
