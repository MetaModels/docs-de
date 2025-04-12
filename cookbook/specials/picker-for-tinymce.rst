.. _rst_cookbook_specials_picker-for-tinymce:

jumpTo-Picker (Detailseite) für den TinyMCE und als dcaPicker
=============================================================

.. note:: Vorausgesetzt wird mind. MM 2.4 |br|
   Wer das Feature einsetzen möchte, erhält weitere Informationen zur Konfiguration auf Anfrage an mail@metamodel.me


TinyMCE
-------

MM hat einen Insert-Tag, mit dem für ein definiertes Rendersetting der Link zur Detailseite (jumpTo) ausgegeben werden
kann - mehr dazu bei :ref:`Insert-Tags <component_inserttags_jumpto>`.

Für Redakteure die im "normalen Content" der Webseite eine Verlinkung zu einer bestimmten Detailseite einbauen wollen,
ist die Suche nach dem richtigen Insert-Tag sowie die passenden IDs von Rendersetting und Datensatz möglicher Weise zu
herausfordernd.

Dafür kann im TinyMCE-Link-Picker ein neuer Reiter definiert werden, mit dem sich diese Aufgabe leicht lösen lässt. Über
eine Konfiguration von MM wird eine solche Auswahl im TinyMCE erzeugt - siehe Beispiel im Screenshot.

|img_picker_01.png|

In der Konfiguration muss neben dem MetaModel die ID des Rendersettings angegeben werden, welches die URL zur
Detailseite erzeugt - üblicher Weise das Rendersetting der Listenansicht. Optional kann noch ein Icon für den Reiter
sowie eine Priorität angegeben werden. Über die Priorität wird die Einordnung des Reiters im Bezug auf die übrigen
Reiter definiert - je höher die Nummer, desto weiter links ist der Reiter, Standard ist 0.

Typische Prioritäten von Contao sind:

- Seiten: 192
- Dateien: 160
- News: 128
- Events: 96
- FAQ: 64
- Artikel: 0

Im Beispiel des Screenshots hat der MM-Picker eine Priorität von 144.

Das Erscheinungsbild des MetaModel im Picker wird durch das für die jeweilige Benutzergruppe eingestellte Rendersetting
definiert. Dabei ist zu beachten, dass bei einer Darstellung als Tabelle im Picker nur das erste Attribut angezeigt
wird (siehe Screenshot).

Wird eine Auswahl im Picker getroffen, wird die ID des Datensatzes (27) in den Insert-Tag automatisch eingefügt und in
der Ausgabe im Frontend eine URL ausgegeben.

|img_picker_02.png|


dcaPicker
---------

Man kann den Picker auch in einem eigen DCA einbauen. Das kann z. B. im :ref:`rst_extended_attribute_mcw`,
RS-CustomElement oder einer eigenen DCA-Anpassung sein. Hierfür wird ein eigener Picker-Provider zur Verfügung gestellt,
dessen Name sich aus dem Tabellenname des Model und der ID des Rendersettings in der Form
``metamodelPicker_<mm_tablename>_<rendersetting-id>``. Eine Konfiguration im Attribute MCW könnte z. B wie folgt aussehen:

.. code-block:: php
   :linenos:

   <?php
   // /contao/config/config.php
   //...
        'col_ma_detail'  => [
            'label'     => ['MA Detailseite'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => [
                'fieldType'  => 'radio',
                'dcaPicker'  => ['providers' => ['metamodelPicker_mm_employees_4']],
                'tl_class'   => 'wizard',
            ],
        ],
   //...

|img_picker_03.png|

Beim Klick auf das Picker-Icon:

|img_picker_04.png|


Spenden
-------

Ein Dank für die Spenden für das Feature an:

* `BAR PACIFICO <https://www.bar-pacifico.de/>`_



.. |img_picker_01.png| image:: /_img/screenshots/extended/picker/picker_01.png
.. |img_picker_02.png| image:: /_img/screenshots/extended/picker/picker_02.png
.. |img_picker_03.png| image:: /_img/screenshots/extended/picker/picker_03.png
.. |img_picker_04.png| image:: /_img/screenshots/extended/picker/picker_04.png

.. |br| raw:: html

   <br />
