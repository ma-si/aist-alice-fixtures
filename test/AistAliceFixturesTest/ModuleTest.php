<?php

/**
 * AistAliceFixtures (http://mateuszsitek.com/projects/aist-alice-fixtures)
 *
 * @link      http://github.com/ma-si/aist-alice-fixtures for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Aist Internet Technologies (http://aist.pl) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace AistAliceFixturesTest;

use AistAliceFixtures\Module;
use PHPUnit_Framework_TestCase;

class ModuleTest extends PHPUnit_Framework_TestCase
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
                    'aist.fixtures.load' => 'AistAliceFixtures\Tools\Console\Command\Fixtures\LoadCommand',
                ],
            ],
        ];

        $this->assertInternalType('array', $config);
        $this->assertSame($expectedConfig, $config);
        $this->assertSame($config, unserialize(serialize($config)));
    }

//    public function testGetAutoloaderConfig()
//    {
//        $config = $this->module->getAutoloaderConfig();
//
//        $expectedConfig = [
//            'Zend\Loader\ClassMapAutoloader' => [
//                __DIR__ . '/../..' . '/autoload_classmap.php',
//            ],
//            'Zend\Loader\StandardAutoloader' => [
//                'namespaces' => [
//                    'AistAliceFixtures' => __DIR__ . '/../..' . '/src/' . 'AistAliceFixtures',
//                ],
//            ],
//        ];
//        $this->assertInternalType('array', $config);
//        $this->assertSame($expectedConfig, $config);
//        $this->assertSame($config, unserialize(serialize($config)));
//    }

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
