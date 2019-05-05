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

namespace MetaModels\AttributeTableMultiBundle\Runonce;

use Contao\Controller;

/**
 * Class TableMultiRunOnce
 *
 * @package MetaModels\AttributeTableMultiBundle
 */
class TableMultiRunOnce extends Controller
{
    /**
     * Initialize the object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('Database');
    }

    /**
     * Run the controller
     * Update from attribute_multi to attribute_tablemulti
     *
     * @return void|null
     */
    public function run()
    {
        if ($this->Database->tableExists('tl_metamodel_tablemulti')) {
            return;
        }

        if ($this->Database->tableExists('tl_metamodel_multi')) {
            $this->Database
                ->prepare('RENAME TABLE tl_metamodel_multi TO tl_metamodel_tablemulti')
                ->execute();
        }

        $this->Database
            ->prepare("UPDATE tl_metamodel_attribute SET type='tablemulti' WHERE type='multi'")
            ->execute();

        $sql = 'UPDATE tl_metamodel_rendersetting SET template=\'mm_attr_tablemulti\' WHERE template=\'mm_attr_multi\'';
        $this->Database
            ->prepare($sql)
            ->execute();
    }
}
