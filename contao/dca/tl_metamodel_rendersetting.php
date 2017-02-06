<?php

/**
 * This file is part of MetaModels/attribute_tabletext.
 *
 * (c) 2012-2016 The MetaModels team.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * @package    MetaModels
 * @subpackage AttributeTableText
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @author     Andreas Isaak <info@andreas-isaak.de>
 * @author     David Maack <david.maack@arcor.de>
 * @author     David Greminger <david.greminger@1up.io>
 * @author     Ingolf Steinhardt <info@e-spin.de>
 * @copyright  2012-2016 The MetaModels team.
 * @license    https://github.com/MetaModels/attribute_tabletext/blob/master/LICENSE LGPL-3.0
 * @filesource
 */

$GLOBALS['TL_DCA']['tl_metamodel_rendersetting']['metapalettes']['tabletext extends default'] = array
(
    '+advanced' => array('tabletext_hide_tablehead'),
);


$GLOBALS['TL_DCA']['tl_metamodel_rendersetting']['fields']['tabletext_hide_tablehead'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_metamodel_rendersetting']['tabletext_hide_tablehead'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'eval'      => array
    (
        'tl_class' => 'clr w50'
    )
);
