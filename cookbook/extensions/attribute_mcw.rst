.. _rst_cookbook_extensions_attribute_mcw:

Erweiterung: Attribut für Multi-Column-Wizard
=============================================

Mit dem Multi-Column-Wizard (MCW) ist es möglich, eine variable Eingabetabelle
mit unterschiedlichen Eingabetypen wie Text, Checkboxen, Select in den Spalten
zu definieren - mehr zu den Möglichkeiten des MCW auf
`Github <https://github.com/menatwork/MultiColumnWizard>`_ bzw. im
`Contao-Wiki <http://de.contaowiki.org/MultiColumnWizard>`_.

Mit der Erweiterung `metamodelsattribute_multi <https://github.com/byteworks-ch/contao-metamodelsattribute_multi>`_
kann der MCW als Attribut in MetaModels genutzt werden. Es ist jedoch zu beachten,
dass der MCW nicht vollständig über das Backend konfiguriert werden kann, sondern
über eine entsprechende Datei mit der DCA-Konfiguration. Zudem ist es nicht
möglich, über die gespeicherten Werte des MCW-Attributes zu suchen oder zu filtern.
Die MCW-Werte werden in der Datenbank als serialisiertes Array gespeichert.

Das MCW-Attribut kann z.B. verwendet werden, um in einer Eingabemaske eine variable
Anzahl von Eingaben zu machen, die unterschiedliche Eingabetypen beinhalten. Ein einfaches
Bespiel wäre die Angabe mehrerer Links mit einem Textfeld für die URL, Einem Textfeld
für den Linktext und einer Checkbox für das Link-Target.

Die Installation und Verwendung besteht aus den Punkten

* Installation des Attributes per Composer über Github
* Anpassung der DCA-Konfigurationsdatei


Installation des Attributes per Composer über Github
----------------------------------------------------

Für die Installation muss zunächst die Composer-JSON um den Link zum
Programmpaket erweitert werden. Dazu in der Paketverwaltung über die
Button "Einstellungen" und "Expertenmodus" die Composer-JSON aufrufen.

Der Knoten "repositories" muss mit Typ und URL zum Programmpaket erweitert
werden, so dass der Bereich nun i.E. wie folgt aussehen sollte

.. code-block:: php
   :linenos:
   
   ...
    "repositories": [
        {
            "type": "composer",
            "url": "https://legacy-packages-via.contao-community-alliance.org/"
        },
        {
            "type": "artifact",
            "url": "packages"
        },
        {
            "type": "vcs",
            "url": "https://github.com/byteworks-ch/contao-metamodelsattribute_multi.git"
        }
    ],
    ...
       
Nach dem Speichern kann wieder auf die Hauptseite der Paketverwaltung gewechselt werden.
Wird im Suchfeld "byteworks/metamodelsattribute_multi" eingegeben und die Suche gestartet,
sollte das entsprechende Programmpaket zur Installationsauswahl erscheinen. Aktuell ist
"dev-master" zu installieren.

Mit der erfolgreichen Installation steht in der Auswahl der Attributtypen ein neuer Eintrag
als "Multi (Multi Column Wizard)" zur Verfügung.

Das MCW-Attribut kann wie üblich als Attribut angelegt und in den Rendereinstellungen und
Eingabemasken hinzugefügt werden. Um damit auch arbeiten zu können, muss noch eine DCA-Datei
editiert bzw. angelegt werden.


Anpassung der DCA-Konfigurationsdatei
-------------------------------------

Mit der Installation wird automatisch eine DCA-Konfigurationsdatei unter
"/system/config/module-multicolumnwizard.php" angelegt. Diese ist Datei entsprechend den
eigenen MetaModel-Parametern und den gewünschten Feldern mit einem Editor anzupassen - siehe
`Contao-Wiki <http://de.contaowiki.org/MultiColumnWizard>`_.

Eine Konfiguration könnte für das MetaModel "mm_my_table" mit dem MCW-Attribut "my_mcw"
wie folgt aussehen:

.. code-block:: php
   :linenos:
   
   <?php if (!defined('TL_ROOT')) die('You can not access this file directly!');
   
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

Ansicht in der Eingabemaske:

|img_input_mask|


Die Erweiterung "metamodelsattribute_multi" wird von der `Byteworks GmbH <http://www.byteworks.ch>`_
unter GPL zur Verfügung gestellt.




.. |img_input_mask| image:: /_img/screenshots/cookbook/extensions/attribut_mcw/input_mask.jpg

