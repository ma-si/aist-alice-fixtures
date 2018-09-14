<?php

/**
 * Aist Alice Fixtures (http://mateuszsitek.com/projects/fixtures)
 *
 * @copyright Copyright (c) 2017-2018 DIGITAL WOLVES LTD (http://digitalwolves.ltd) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace Aist\AliceFixtures\Filter;

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
