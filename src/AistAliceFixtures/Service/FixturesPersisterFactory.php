<?php

/**
 * AistAliceFixtures (http://mateuszsitek.com/projects/aist-alice-fixtures)
 *
 * @link      http://github.com/ma-si/aist-alice-fixtures for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Aist Internet Technologies (http://aist.pl) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace AistAliceFixtures\Service;

use AistAliceFixtures\Tools\Console\Helper\FixturePersisterHelper;
use Nelmio\Alice\Persister\Doctrine as DoctrinePersister;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class FixturesPersisterFactory implements FactoryInterface
{

    /**
     * {@inheritDoc}
     * @return Application
     */
    public function createService(ServiceLocatorInterface $sl)
    {
        $objectManager = $sl->get('doctrine.entitymanager.orm_default');
        $persister = new DoctrinePersister($objectManager);
        $persisterHelper = new FixturePersisterHelper($persister);

        return $persisterHelper;
    }

}