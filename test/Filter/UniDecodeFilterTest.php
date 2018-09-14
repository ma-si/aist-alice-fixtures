<?php

/**
 * Aist Alice Fixtures (http://mateuszsitek.com/projects/fixtures)
 *
 * @copyright Copyright (c) 2017-2018 DIGITAL WOLVES LTD (http://digitalwolves.ltd) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace Test\Aist\AliceFixtures\Filter;

use Aist\AliceFixtures\Filter\UniDecodeFilter;

class UniDecodeFilterTest extends \PHPUnit\Framework\TestCase
{

    /**
     * [testedString, filtered]
     * @var array
     */
    private $testedStrings = [
        ['.Zażółć gęślą jaźń-!-', '.Zazolc gesla jazn-!-'],
        ['Żółwik', 'Zolwik'],
        ['Świat', 'Swiat'],
    ];

    /**
     * @dataProvider providerTestFilter
     */
    public function testFilter($text, $filtered)
    {
        $internet = new UniDecodeFilter();
        $slug = $internet->filter($text);
        $this->assertSame($filtered, $slug);
    }

    public function providerTestFilter()
    {
        return $this->testedStrings;
    }
}
