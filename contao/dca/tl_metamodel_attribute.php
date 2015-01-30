<?php

/**
 * The MetaModels extension allows the creation of multiple collections of custom items,
 * each with its own unique set of selectable attributes, with attribute extendability.
 * The Front-End modules allow you to build powerful listing and filtering of the
 * data in each collection.
 *
 * PHP version 5
 * @package     MetaModels
 * @subpackage  AttributeTableText
 * @author      Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @author      Andreas Isaak <info@andreas-isaak.de>
 * @author      David Maack <david.maack@arcor.de>
 * @author      David Greminger <david.greminger@1up.io>
 * @copyright   The MetaModels team.
 * @license     LGPL.
 * @filesource
 */

/**
 * Table tl_metamodel_attribute
 */

$GLOBALS['TL_DCA']['tl_metamodel_attribute']['metapalettes']['tabletext extends _complexattribute_'] = array(
    '+advanced' => array('tabletext_cols'),
);

$GLOBALS['TL_DCA']['tl_metamodel_attribute']['fields']['tabletext_cols'] = array(
    'label'                 => &$GLOBALS['TL_LANG']['tl_metamodel_attribute']['tabletext_cols'],
    'exclude'               => true,
    'inputType'             => 'multiColumnWizard',
    'eval'                  => array(
        'rgxp'              => 'digit',
        'mandatory'         => true,
        'columnFields'      => array(
            'rowLabel'      => array(
                'label'     => &$GLOBALS['TL_LANG']['tl_metamodel_attribute']['tabletext_rowLabel'],
                'inputType' => 'text',
                'eval'      => array('allowHtml' => false, 'style' => 'width: 500px;'),
            ),
            'rowStyle'      => array(
                'label'     => &$GLOBALS['TL_LANG']['tl_metamodel_attribute']['tabletext_rowStyle'],
                'inputType' => 'text',
                'eval'      => array('allowHtml' => false, 'style' => 'width: 90px;'),
            ),
        ),
        'tl_class'          => 'clr',
    ),
);
