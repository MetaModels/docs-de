.. _component_filter_translated-checkbox:

|svg_filt_translated_checkbox_22| |img_filter_checkbox| Übersetzter Checkbox-Status
===================================================================================

Die Filterregel "Übersetzter Checkbox-Status" (Paket ``attribute_translatedcheckbox``, im Backend als "Übersetzter
Veröffentlichungsstatus" bezeichnet) prüft, ob
der Wert eines übersetzten Checkbox-Attributs gleich ``1`` (aktiv) ist. Sie entspricht
in ihrer Funktion der Filterregel :ref:`component_filter_checkbox`, ist jedoch
für den Einsatz mit dem Attributtyp
:ref:`Übersetzte Checkbox <component_attribute_translatedcheckbox>` in mehrsprachigen
MetaModels vorgesehen.

Der übersetzte Checkbox-Status wird sprachabhängig ausgewertet: In der aktiven
Sprache wird der Wert der übersetzten Checkbox geprüft. Damit können
Veröffentlichungszustände pro Sprache gesteuert werden. Wie beim :ref:`Checkbox-Status <component_filter_checkbox>`
gibt die Regel kein Widget im Frontend aus und fügt der URL keinen Parameter hinzu.

.. warning:: Die Regel "Ja / Nein" (Paket ``filter_checkbox``) ist dagegen ein Widget für die Besucher und für die
   Veröffentlichungssteuerung nicht geeignet, siehe :ref:`component_filter_yes-no`.

.. seealso:: Für einsprachige MetaModels steht die Filterregel
   :ref:`component_filter_checkbox` zur Verfügung.


Installation
------------

Die Filterregel wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_translatedcheckbox


Einstellungen beim Anlegen der Filterregel
------------------------------------------

Die Einstellungen entsprechen denen der Filterregel :ref:`component_filter_checkbox`. Lediglich der Attributtyp muss ein
:ref:`component_attribute_translatedcheckbox` sein.

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - Typ
     - Auswahl des Filterregeltyps – hier: "Übersetzter Checkbox-Status".
   * - Aktiviert
     - Aktiviert oder deaktiviert diese Filterregel.
   * - Kommentar
     - Freitextfeld zur Beschreibung des Zwecks dieser Filterregel.
   * - Attribut
     - Das übersetzte Checkbox-Attribut, dessen Wert geprüft werden soll.
   * - Überschreiben erlauben
     - Ein URL-Parameter kann die Filterregel außer Kraft setzen (z. B. für Vorschaulinks).
   * - Filter nicht in Frontendvorschau nutzen
     - Die Filterregel wird übersprungen, wenn ein Backend-Benutzer die Contao-Frontend-Vorschau nutzt.


Passende Attribute
------------------

Die Filterregel "Übersetzter Checkbox-Status" ist ausschließlich für folgende
Attribute geeignet:

* :ref:`Übersetzte Checkbox <component_attribute_translatedcheckbox>`


.. |svg_filt_translated_checkbox_22| image:: /_img/icons_svg/filter_checkbox.svg
   :width: 22px
.. |img_filter_checkbox| image:: /_img/icons/filter_checkbox.png

.. |br| raw:: html

   <br />
