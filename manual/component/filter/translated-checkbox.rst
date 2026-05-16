.. _component_filter_translated-checkbox:

|img_filter_checkbox| Übersetzter Checkbox-Status
==================================================

Die Filterregel "Übersetzter Checkbox-Status" (Paket ``filter_checkbox``) prüft, ob
der Wert eines übersetzten Checkbox-Attributs gleich ``1`` (aktiv) ist. Sie entspricht
in ihrer Funktion der Filterregel :ref:`component_filter_checkbox`, ist jedoch
für den Einsatz mit dem Attributtyp
:ref:`Übersetzte Checkbox <component_attribute_translatedcheckbox>` in mehrsprachigen
MetaModels vorgesehen.

Der übersetzte Checkbox-Status wird sprachabhängig ausgewertet: In der aktiven
Sprache wird der Wert der übersetzten Checkbox geprüft. Damit können
Veröffentlichungszustände pro Sprache gesteuert werden.

.. seealso:: Für einsprachige MetaModels steht die Filterregel
   :ref:`component_filter_checkbox` zur Verfügung.


Installation
------------

Die Filterregel wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/filter_checkbox


Einstellungen beim Anlegen der Filterregel
------------------------------------------

Die Einstellungen entsprechen vollständig denen der Filterregel
:ref:`component_filter_checkbox`. Lediglich der Attributtyp muss ein
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
   * - URL-Parameter
     - Der Schlüssel (Key) des URL-Parameters für die Übergabe des Filterwerts.
       Ohne Angabe wird der Spaltenname des Attributs verwendet. Mit ``auto_item``
       wird nur der Wert – ohne Schlüssel – in die URL eingebaut.
   * - URL-Typ für den Parameter
     - Legt fest, ob der Parameter als Slug (sprechende URL), als GET-Parameter übergeben wird (ab MM 2.4) - :ref:`siehe
       SEO <rst_cookbook_tips_seo_filter-url>`

Einstellungen für das Frontend-Widget
--------------------------------------

Identisch mit den Einstellungen der Filterregel
:ref:`component_filter_checkbox` – es stehen dieselben Optionen
(URL-Parameter, Modus, Template usw.) zur Verfügung.


Passende Attribute
------------------

Die Filterregel "Übersetzter Checkbox-Status" ist ausschließlich für folgende
Attribute geeignet:

* :ref:`Übersetzte Checkbox <component_attribute_translatedcheckbox>`


.. |img_filter_checkbox| image:: /_img/icons/filter_checkbox.png

.. |br| raw:: html

   <br />
