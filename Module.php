<?php

/**
 * AistAliceFixtures (http://mateuszsitek.com/projects/aist-alice-fixtures)
 *
 * @link      http://github.com/ma-si/aist-alice-fixtures for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Aist Internet Technologies (http://aist.pl) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace AistAliceFixtures;

use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\ModuleManagerInterface;

/**
 * AistAliceFixtures Module
 */
class Module implements ConfigProviderInterface, InitProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\ClassMapAutoloader' => [
                __DIR__ . '/autoload_classmap.php',
            ],
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ],
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getModuleDependencies()
    {
        return [
            'DoctrineModule',
            'DoctrineORMModule',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function init(ModuleManagerInterface $manager)
    {
        $events = $manager->getEventManager();
        $events->getSharedManager()->attach('doctrine', 'loadCli.post', [$this, 'initializeConsole']);
    }

    /**
     * Initializes the console with additional commands from the ORM, DBAL and (optionally) DBAL\Migrations
     *
     * @param \Zend\EventManager\EventInterface $event
     *
     * @return void
     */
    public function initializeConsole(EventInterface $event)
    {
        /** @var \Symfony\Component\Console\Application $cli */
        $cli = $event->getTarget();

        /** @var \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator */
        $serviceLocator = $event->getParam('ServiceManager');

        /** @var \AistAliceFixtures\Tools\Console\Helper\FixtureLoaderHelper $loader */
        $loader = $serviceLocator->get('fixtures.loader');

        /** @var \AistAliceFixtures\Tools\Console\Helper\FixturePersisterHelper $persister */
        $persister = $serviceLocator->get('fixture.persister');

        $commands = [
            'aist.fixtures.load',
        ];
        $cli->addCommands(array_map([$serviceLocator, 'get'], $commands));
        $helperSet = $cli->getHelperSet();
        $helperSet->set($loader, 'loader');
        $helperSet->set($persister, 'persister');
    }
}
