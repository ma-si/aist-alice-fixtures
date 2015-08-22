<?php

/**
 * AistAliceFixtures (http://mateuszsitek.com/projects/aist-alice-fixtures)
 *
 * @link      http://github.com/ma-si/aist-alice-fixtures for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Aist Internet Technologies (http://aist.pl) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace AistAliceFixtures\Filter;

use BaconStringUtils\UniDecoder;
use Zend\Filter\FilterInterface;

class UniDecodeFilter extends UniDecoder implements FilterInterface
{
    /**
     * {@inheritdoc}
     */
    public function filter($string)
    {
        return $this->decode($string);
    }
}