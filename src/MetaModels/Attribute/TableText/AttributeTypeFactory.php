<?php
/**
 * The MetaModels extension allows the creation of multiple collections of custom items,
 * each with its own unique set of selectable attributes, with attribute extendability.
 * The Front-End modules allow you to build powerful listing and filtering of the
 * data in each collection.
 *
 * PHP version 5
 *
 * @package    MetaModels
 * @subpackage AttributeTableText
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @copyright  The MetaModels team.
 * @license    LGPL-3+
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
