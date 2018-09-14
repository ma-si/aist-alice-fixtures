<?php

/**
 * Aist Alice Fixtures (http://mateuszsitek.com/projects/fixtures)
 *
 * @copyright Copyright (c) 2017-2018 DIGITAL WOLVES LTD (http://digitalwolves.ltd) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace Aist\AliceFixtures\Tools\Console\Helper;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Helper\Helper;

/**
 * Fixtures Persister Helper.
 */
class FixturePersisterHelper extends Helper
{

    /**
     * Doctrine ORM EntityManagerInterface.
     *
     * @var EntityManagerInterface
     */
    protected $persister;

    /**
     * Constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct($persister)
    {
        $this->persister = $persister;
    }

    /**
     * Retrieves Doctrine ORM EntityManager.
     *
     * @return EntityManagerInterface
     */
    public function getPersister()
    {
        return $this->persister;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'fixturePersister';
    }
}
