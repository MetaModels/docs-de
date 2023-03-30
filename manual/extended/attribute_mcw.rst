.. _rst_extended_attribute_mcw:

Attribut für Multi-Column-Wizard
================================

Mit dem Multi-Column-Wizard (MCW) ist es möglich, eine variable Eingabetabelle
mit unterschiedlichen Eingabetypen wie Text, Checkboxen, Select in den Spalten
zu definieren - mehr zu den Möglichkeiten des MCW auf
`Github <https://github.com/MetaModels/attribute_tablemulti>`_ bzw. im
`Contao-Wiki <http://de.contaowiki.org/MultiColumnWizard>`_.

Mit der Erweiterung `attribute_tablemulti <https://github.com/MetaModels/attribute_tablemulti>`_
kann der MCW als Attribut in MetaModels genutzt werden. Es ist jedoch zu beachten,
dass der MCW nicht vollständig über das Backend konfiguriert werden kann, sondern
über eine entsprechende Datei mit der DCA-Konfiguration. Zudem ist es nicht
möglich, über die gespeicherten Werte des MCW-Attributes zu suchen oder zu filtern.
Die MCW-Werte werden in der Datenbank als serialisiertes Array gespeichert.

Neben der genannten Version gibt es auch noch das Gegenstück für eine mehrsprachige Nutzung
als Erweiterung `attribute_translatedtablemulti <https://github.com/MetaModels/attribute_translatedtablemulti>`_

Das MCW-Attribut kann z.B. verwendet werden, um in einer Eingabemaske eine variable
Anzahl von Eingaben zu machen, die unterschiedliche Eingabetypen beinhalten. Ein einfaches
Beispiel wäre die Angabe mehrerer Links mit einem Textfeld für die URL, einem Textfeld
für den Linktext und einer Checkbox für das Link-Target.

Die Installation und Verwendung besteht aus den Punkten

* Installation des Attributes per Composer über Github oder über den Contao Manager
* Anpassung der DCA-Konfigurationsdatei


Anpassung der DCA-Konfigurationsdatei
-------------------------------------

Die DCA-Konfigurationsdatei `config.php` muss an einer geeigneten
Stelle in der Contao-Installation abgelegt oder eine bestehende Datei
mit den Angaben ergänzt werden. Das kann z.B. erfolgen in

* app/Resources/contao/config/ (ab Contao 4.4)
* contao/config/ (ab Contao 4.9)
* src/AppBundle/Resources/contao/config/ (eigenes Bundle)

Diese ist Datei entsprechend den eigenen MetaModel-Parametern und den gewünschten
Feldern mit einem Editor anzupassen - siehe
`Contao-Wiki <http://de.contaowiki.org/MultiColumnWizard>`_.

Eine Konfiguration könnte für das MetaModel "mm_my_table" mit dem MCW-Attribut "my_mcw"
wie folgt aussehen:

.. code-block:: php
   :linenos:
   
   <?php
   // /contao/config/config.php

   $GLOBALS['TL_CONFIG']['metamodelsattribute_multi']['mm_my_table']['my_mcw'] = array(
      'minCount'     => 2,
      'maxCount'     => 4,
      'columnFields' => array(
         'ts_client_os'     => array(
            'label'     => 'Meine Optionen',
            'exclude'   => true,
            'inputType' => 'select',
            'options'   => array(
               'option1' => 'Option 1',
               'option2' => 'Option 2',
            ),
            'eval'      => array('style' => 'width:250px', 'includeBlankOption' => true, 'chosen' => true)
         ),
         'ts_client_mobile' => array(
            'label'     => 'Meine Checkbox',
            'exclude'   => true,
            'inputType' => 'checkbox',
            'eval'      => array('style' => 'width:40px')
   
         ),
         'ts_extension'     => array(
            'label'     => 'Das Textfeld',
            'inputType' => 'text',
            'eval'      => array('mandatory' => true, 'style' => 'width:115px')
         ),
      ),
   
   );

Hinweis: Die Bezeichnungen in "label" können auch als Sprach-Array eingebunden werden.

Nach Anpassungen der Konfiguration den Cache leeren!

Ansicht in der Eingabemaske:

|img_input_mask|


.. |img_input_mask| image:: /_img/screenshots/extended/attribute_mcw/input_mask.jpg

