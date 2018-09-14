<?php

/**
 * Aist Alice Fixtures (http://mateuszsitek.com/projects/fixtures)
 *
 * @copyright Copyright (c) 2017-2018 DIGITAL WOLVES LTD (http://digitalwolves.ltd) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace Aist\AliceFixtures\Tools\Console\Helper;

use DoctrineModule\Persistence\ProvidesObjectManager;
use Nelmio\Alice\Fixtures;
use Symfony\Component\Console\Helper\Helper;

/**
 * Aist Fixture Loader Helper.
 */
class FixtureLoaderHelper extends Helper
{
    use ProvidesObjectManager;

    /**
     * Fixture Loader.
     *
     * @var Fixtures
     */
    protected $loader;

    private $files = [];
    private $options = [];

    /**
     * Constructor.
     *
     * @param Fixtures $loader
     */
//    public function __construct(Fixtures $loader)
    public function __construct($loader, $files, $objectManager, $options)
    {
        $this->loader = $loader;

        $this->objectManager = $objectManager;
        $this->options = $options;
        $this->files = $files;
    }

    /**
     * Retrieves files.
     *
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * Retrieves options.
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Retrieves Fixture Loader.
     *
     * @return Fixtures
     */
    public function getLoader()
    {
        return $this->loader;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'fixtureLoader';
    }
}
