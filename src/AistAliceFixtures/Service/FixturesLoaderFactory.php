<?php

/**
 * AistAliceFixtures (http://mateuszsitek.com/projects/aist-alice-fixtures)
 *
 * @link      http://github.com/ma-si/aist-alice-fixtures for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Aist Internet Technologies (http://aist.pl) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace AistAliceFixtures\Service;

use AistAliceFixtures\Faker\Provider\Internet;
use AistAliceFixtures\Tools\Console\Helper\FixtureLoaderHelper;
use BaconStringUtils\UniDecoder;
use Faker\Factory as FakerFactory;
use Nelmio\Alice\Fixtures;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\ArrayUtils;

class FixturesLoaderFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return Application
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        // load objects from a yml file
        $fixtureFiles = $serviceLocator->get('config')['fixture_manager']['files'];

        $fakerGenerator = FakerFactory::create();
        $slugifier = $serviceLocator->get('FilterManager')->get('slugify');
        $uniDecoder = new UniDecoder();
        $em = $serviceLocator->get('doctrine.entitymanager.orm_default');

        /** get included faker providers & add user defined */
        $includedProviders = [
            new Internet($fakerGenerator, $slugifier, $uniDecoder),
        ];
        $providers = ArrayUtils::merge(
            $includedProviders,
            $serviceLocator->get('config')['fixture_manager']['providers']
        );

        $objects = new Fixtures(
            $em,
            [
//                'locale' => 'en_US',
                'providers' => $providers,
//                'seed' => 1,
//                'logger' => null,
//                'persist_once' => false,
            ]
        );
        $loaderHelper = new FixtureLoaderHelper(
            $objects,
            $fixtureFiles,
            $em,
            [
//                'locale' => 'en_US',
                'providers' => $providers,
//                'seed' => 1,
//                'logger' => null,
//                'persist_once' => false,
            ]
        );

        return $loaderHelper;
    }
}
