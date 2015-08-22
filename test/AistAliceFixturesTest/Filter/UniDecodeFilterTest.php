<?php

/**
 * AistAliceFixtures (http://mateuszsitek.com/projects/aist-alice-fixtures)
 *
 * @link      http://github.com/ma-si/aist-alice-fixtures for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Aist Internet Technologies (http://aist.pl) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace test\AistAliceFixturesTest\Filter;

use AistAliceFixtures\Filter\UniDecodeFilter;

class UniDecodeFilterTest extends \PHPUnit_Framework_TestCase
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
