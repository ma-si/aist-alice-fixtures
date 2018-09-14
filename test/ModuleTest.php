<?php

/**
 * Aist Alice Fixtures (http://mateuszsitek.com/projects/fixtures)
 *
 * @copyright Copyright (c) 2017-2018 DIGITAL WOLVES LTD (http://digitalwolves.ltd) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace Test\Aist\AliceFixtures;

use Aist\AliceFixtures\Module;
use Aist\AliceFixtures\Tools\Console\Command\Fixtures\LoadCommand;

class ModuleTest extends \PHPUnit\Framework\TestCase
{
    /** @var Module */
    private $module;

    public function setUp()
    {
        $this->module = new Module();
    }

    public function testGetConfig()
    {
        $config = $this->module->getConfig();

        $expectedConfig = [
            'service_manager' => [
                'invokables' => [
                    'aist.fixtures.load' => LoadCommand::class,
                ],
            ],
        ];

        $this->assertInternalType('array', $config);
        $this->assertSame($expectedConfig, $config);
        $this->assertSame($config, unserialize(serialize($config)));
    }

    public function testGetModuleDependencies()
    {
        $config = $this->module->getModuleDependencies();

        $expected = [
            'DoctrineModule',
            'DoctrineORMModule',
        ];

        $this->assertInternalType('array', $config);
        $this->assertSame($expected, $config);
        $this->assertSame($config, unserialize(serialize($config)));
    }
}
