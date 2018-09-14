<?php

/**
 * Aist Alice Fixtures (http://mateuszsitek.com/projects/fixtures)
 *
 * @copyright Copyright (c) 2017-2018 DIGITAL WOLVES LTD (http://digitalwolves.ltd) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace Aist\AliceFixtures\Service;

use Aist\AliceFixtures\Tools\Console\Helper\FixturePersisterHelper;
use Interop\Container\ContainerInterface;
use Nelmio\Alice\Persister\Doctrine;
use Zend\ServiceManager\Factory\FactoryInterface;

class FixturesPersisterFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $objectManager = $container->get('doctrine.entitymanager.orm_default');
        $persister = new Doctrine($objectManager);
        $persisterHelper = new FixturePersisterHelper($persister);

        return $persisterHelper;
    }
}
