.. _component_filter_checkbox:

|svg_filt_checkbox_22| |img_filter_checkbox| Checkbox-Status
============================================================

Die Filterregel "Checkbox-Status" (Paket ``attribute_checkbox``) prüft, ob der Wert eines Checkbox-Attributs gleich
``1`` (aktiv) ist. Sie wird für die Veröffentlichungssteuerung eingesetzt: Nur Items mit aktivierter Checkbox (z. B.
``published = 1``) werden im Frontend angezeigt. Die Regel gibt **kein** Widget im Frontend aus und fügt der URL keinen
Parameter hinzu.

.. warning:: Nicht verwechseln mit der Filterregel :ref:`"Ja / Nein" <component_filter_yes-no>` (Paket
   ``filter_checkbox``): Das ist ein Widget für die Besucher. Es filtert erst, wenn jemand etwas auswählt, und es setzt
   einen Parameter wie ``published/1`` in jede URL, die der Filter erzeugt, auch in die Links einer Liste zur
   Detailseite. Für "nur veröffentlichte Items" ist immer der "Checkbox-Status" richtig.

.. seealso:: Für mehrsprachige MetaModels steht die Filterregel
   :ref:`component_filter_translated-checkbox` zur Verfügung.


Installation
------------

Die Filterregel wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_checkbox


Einstellungen beim Anlegen der Filterregel
------------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - Typ
     - Auswahl des Filterregeltyps – hier: "Checkbox-Status".
   * - Aktiviert
     - Aktiviert oder deaktiviert diese Filterregel.
   * - Kommentar
     - Freitextfeld zur Beschreibung des Zwecks dieser Filterregel.
   * - Attribut
     - Das Checkbox-Attribut, dessen Wert geprüft werden soll.
   * - Überschreiben erlauben
     - Ein URL-Parameter kann die Filterregel außer Kraft setzen (z. B. für Vorschaulinks).
   * - Filter nicht in Frontendvorschau nutzen
     - Die Filterregel wird übersprungen, wenn ein Backend-Benutzer die Contao-Frontend-Vorschau nutzt. Die Option
       "Unveröffentlichte Elemente anzeigen" wird dann ignoriert.


Passende Attribute
------------------

Die Filterregel "Checkbox-Status" ist ausschließlich für folgende Attribute geeignet:

* :ref:`Kontrollkästchen (Checkbox) <component_attribute_checkbox>`


Sonderfunktionen
----------------

**Veröffentlichungssteuerung**

Der häufigste Einsatzfall ist die Filterregel als "Veröffentlichungsfilter": Ein Checkbox-Attribut (typischer
Spaltenname: ``published``) mit aktivierter "Wechselicon"-Option im Backend erlaubt das schnelle
Aktivieren/Deaktivieren von Items. Im Frontend filtert die Filterregel "Checkbox-Status" die inaktiven Items heraus -
auch dann, wenn ein Besucher den Link zu einem Item als Lesezeichen gespeichert hat und der Filter zur Detailseite
gehört.

Die Filterregeln einer Ebene sind immer mit UND verknüpft: Der "Checkbox-Status" steht also einfach neben den anderen
Regeln des Filters, es braucht dafür keine Regel "UND".


.. |svg_filt_checkbox_22| image:: /_img/icons_svg/filter_checkbox.svg
   :width: 22px
.. |img_filter_checkbox| image:: /_img/icons/filter_checkbox.png

.. |br| raw:: html

   <br />
