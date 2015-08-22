<?php

/**
 * AistAliceFixtures (http://mateuszsitek.com/projects/aist-alice-fixtures)
 *
 * @link      http://github.com/ma-si/aist-alice-fixtures for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Aist Internet Technologies (http://aist.pl) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace AistAliceFixtures\Tools\Console\Helper;

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
