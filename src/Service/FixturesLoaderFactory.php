<?php

/**
 * Aist Alice Fixtures (http://mateuszsitek.com/projects/fixtures)
 *
 * @copyright Copyright (c) 2017-2018 DIGITAL WOLVES LTD (http://digitalwolves.ltd) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace Aist\AliceFixtures\Service;

use Aist\AliceFixtures\Faker\Provider\Internet;
use Aist\AliceFixtures\Tools\Console\Helper\FixtureLoaderHelper;
use BaconStringUtils\UniDecoder;
use Faker\Factory as FakerFactory;
use Interop\Container\ContainerInterface;
use Nelmio\Alice\Fixtures;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Stdlib\ArrayUtils;

class FixturesLoaderFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');

        // load objects from a yml file
        $fixtureFiles = $config['fixture_manager']['files'];

        $fakerGenerator = FakerFactory::create();
        $slugifier = $container->get('FilterManager')->get('slugify');
        $uniDecoder = new UniDecoder();
        $em = $container->get('doctrine.entitymanager.orm_default');

        /** get included faker providers & add user defined */
        $includedProviders = [
            new Internet($fakerGenerator, $slugifier, $uniDecoder),
        ];
        $providers = ArrayUtils::merge(
            $includedProviders,
            $config['fixture_manager']['providers']
        );

        $objects = new Fixtures(
            $em,
            [
                //'locale' => 'en_US',
                'providers' => $providers,
                //'seed' => 1,
                //'logger' => null,
                //'persist_once' => false,
            ]
        );
        $loaderHelper = new FixtureLoaderHelper(
            $objects,
            $fixtureFiles,
            $em,
            [
                //'locale' => 'en_US',
                'providers' => $providers,
                //'seed' => 1,
                //'logger' => null,
                //'persist_once' => false,
            ]
        );

        return $loaderHelper;
    }
}
