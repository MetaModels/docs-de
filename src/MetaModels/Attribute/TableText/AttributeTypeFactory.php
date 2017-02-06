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
 * @author     Ingolf Steinhardt <info@e-spin.de>
 * @copyright  2012-2016 The MetaModels team.
 * @license    https://github.com/MetaModels/attribute_tabletext/blob/master/LICENSE LGPL-3.0
 * @filesource
 */

namespace MetaModels\Attribute\TableText;

use MetaModels\Attribute\AbstractAttributeTypeFactory;

/**
 * Attribute type factory for table text attributes.
 */
class AttributeTypeFactory extends AbstractAttributeTypeFactory
{
    /**
     * {@inheritDoc}
     */
    public function __construct()
    {
        parent::__construct();

        $this->typeName  = 'tabletext';
        $this->typeIcon  = 'system/modules/metamodelsattribute_tabletext/html/tabletext.png';
        $this->typeClass = 'MetaModels\Attribute\TableText\TableText';
    }
}
