<?php

/**
 * Aist Alice Fixtures (http://mateuszsitek.com/projects/fixtures)
 *
 * @copyright Copyright (c) 2017-2018 DIGITAL WOLVES LTD (http://digitalwolves.ltd) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace Test\Aist\AliceFixtures\Faker\Provider;

use Aist\AliceFixtures\Faker\Provider\Internet;
use BaconStringUtils\Filter\Slugify;
use BaconStringUtils\UniDecoder;
use Faker\Generator;
use Faker\Provider\Internet as FakerInternet;

class InternetTest extends \PHPUnit\Framework\TestCase
{
    private $expectedSlug = 'zazolc-gesla-jazn';

    /**
     * [
     *     [testedString, uniDecoded, slugified],
     * ]
     *
     * @var array
     */
    private $testedStrings = [
        [
            '.Zażółć gęślą jaźń-!-',
            '.Zazolc gesla jazn-!-',
            'zazolc-gesla-jazn',
            [
                '.Zazolc gesla jazn-!-',
                'zazolc-gesla-jazn',
            ],
        ],
        [
            'Zażółć gęślą jaźń',
            'Zazolc gesla jazn',
            'zazolc-gesla-jazn',
            [
                'Zazolc gesla jazn',
                'zazolc-gesla-jazn',
            ],
        ],
        [
            '.Zażółć-gęślą-jaźń-!-',
            '.Zazolc-gesla-jazn-!-',
            'zazolc-gesla-jazn',
            [
                '.Zazolc-gesla-jazn-!-',
                'zazolc-gesla-jazn',
            ],
        ],
    ];

    public function testSlugifyWithEmptyString()
    {
//    Use createMock() or getMockBuilder()
        $emptyString = '';
        $generator = $this->createMock(Generator::class);
        $slugifier = $this->createMock(Slugify::class);
        $uniDecoder = $this->createMock(UniDecoder::class);
        $internet = new Internet($generator, $slugifier, $uniDecoder);
        $slug = $internet->slugify($emptyString);
        $this->assertSame($emptyString, $slug);
    }

    /**
     * @param string $text String to be sluggified
     *
     * @dataProvider providerTestSlugify
     */
    public function testSlugifyReturnsSlugifiedString($text, $uniDecoded, $slugified, array $filteredValues)
    {
        $generator = $this->createMock(Generator::class);
        $slugifier = $this->createMock(Slugify::class);
        $uniDecoder = $this->createMock(UniDecoder::class);
        $filters = [];

        $uniDecoder
            ->expects(self::once())
            ->method('decode')
            ->with($text)
            ->willReturn($uniDecoded)
        ;

        $slugifier
            ->expects(self::once())
            ->method('filter')
            ->with($uniDecoded)
            ->willReturn($slugified);

        foreach ($filters as $key => $filter) {
            $filter
                ->expects(self::once())
                ->method('filter')
                ->with($text)
                ->willReturn($filteredValues[$key]);
        }

        $internet = new Internet($generator, $slugifier, $uniDecoder);
        $slug = $internet->slugify($text);
        $this->assertSame($this->expectedSlug, $slug);
        self::assertInstanceOf(
            FakerInternet::class,
            $internet
        );
    }

//    public function testUniDecode()
//    {
//        $generator = $this->getMock(Generator::class);
//        $slugifier = null;
//        $uniDecoder = $this->getMock(UniDecoder::class);
//        $text = 'Zażółć gęślą jaźń';
//        $uniDecoded = 'Zazolc gesla jazn';
//
//        $uniDecoder
//            ->expects(self::once())
//            ->method('decode')
//            ->with($text)
//            ->willReturn($uniDecoded)
//        ;
//
//        $internet = new Internet($generator, $slugifier, $uniDecoder);
//        $slug = $internet->uniDecode($text);
//        $this->assertSame($uniDecoded, $slug);
//    }

    public function providerTestSlugify()
    {
        return $this->testedStrings;
    }
}
