<?php

/**
 * This file is part of MetaModels/attribute_tablemulti.
 *
 * (c) 2012-2019 The MetaModels team.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * @package    MetaModels
 * @subpackage AttributeTableMulti
 * @author     Andreas Dziemba <adziemba@web.de>
 * @author     Stefan Heimes <stefan_heimes@hotmail.com>
 * @copyright  2012-2019 The MetaModels team.
 * @license    https://github.com/MetaModels/attribute_tablemulti/blob/master/LICENSE LGPL-3.0-or-later
 * @filesource
 */

$GLOBALS['TL_DCA']['tl_metamodel_tablemulti'] = [
    'config'                            => [
        'sql'                           => [
            'keys'                      => [
                'id'                    => 'primary',
                'att_id,item_id,row,col'    => 'unique',
                'att_id,item_id'        => 'index',
            ],
        ],
    ],
    'fields'                      => [
        'id'                      => [
            'sql'                 => 'int(10) unsigned NOT NULL auto_increment',
        ],
        'tstamp'                  => [
            'sql'                 => 'int(10) unsigned NOT NULL default \'0\'',
        ],
        'att_id'                  => [
            'sql'                 => 'int(10) unsigned NOT NULL default \'0\'',
        ],
        'item_id'                 => [
            'sql'                 => 'int(10) unsigned NOT NULL default \'0\'',
        ],
        'row'                 => [
            'sql'                 => 'int(5) unsigned NOT NULL default \'0\'',
        ],
        'col'                 => [
            'sql'                 => 'varchar(255) NOT NULL default \'\'',
        ],
        'value'                   => [
            'sql'                 => 'text NULL',
        ],
    ],
];
