<?php

/**
 * * This file is part of MetaModels/attribute_tabletext.
 *
 * (c) 2012-2018 The MetaModels team.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * @package    MetaModels
 * @subpackage AttributeTableText
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @author     Andreas Dziemba <adziemba@web.de>
 * @copyright  2012-2018 The MetaModels team.
 * @license    https://github.com/MetaModels/attribute_tablemulti/blob/master/LICENSE LGPL-3.0-or-later
 * @filesource
 */

namespace MetaModels\AttributeTableMultiBundle\Test\DependencyInjection;

use MetaModels\AttributeTableMultiBundle\DependencyInjection\MetaModelsAttributeTableMultiExtension;
use MetaModels\AttributeTableMultiBundle\Attribute\AttributeTypeFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

/**
 * This test case test the extension.
 */
class MetaModelsAttributeTableMultiExtensionTest extends TestCase
{
    /**
     * Test that extension can be instantiated.
     *
     * @return void
     */
    public function testInstantiation()
    {
        $extension = new MetaModelsAttributeTableMultiExtension();

        $this->assertInstanceOf(MetaModelsAttributeTableMultiExtension::class, $extension);
        $this->assertInstanceOf(ExtensionInterface::class, $extension);
    }

    /**
     * Test that the services are loaded.
     *
     * @return void
     */
    public function testFactoryIsRegistered()
    {
        $container = $this->getMockBuilder(ContainerBuilder::class)->getMock();

        $container
            ->expects($this->once())
            ->method('setDefinition')
            ->with(
                'metamodels.attribute_tablemulti.factory',
                $this->callback(
                    function ($value) {
                        /** @var Definition $value */
                        $this->assertInstanceOf(Definition::class, $value);
                        $this->assertEquals(AttributeTypeFactory::class, $value->getClass());
                        $this->assertCount(1, $value->getTag('metamodels.attribute_factory'));

                        return true;
                    }
                )
            );

        $extension = new MetaModelsAttributeTableMultiExtension();
        $extension->load([], $container);
    }
}
