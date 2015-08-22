<?php

/**
 * AistAliceFixtures (http://mateuszsitek.com/projects/aist-alice-fixtures)
 *
 * @link      http://github.com/ma-si/aist-alice-fixtures for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Aist Internet Technologies (http://aist.pl) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace AistAliceFixtures\Faker\Provider;

use BaconStringUtils\Slugifier;
use BaconStringUtils\UniDecoder;
use Faker\Generator;
use Faker\Provider\Internet as FakerInternet;
use Zend\Filter\FilterInterface;

/**
 * Internet provider for Faker.
 */
class Internet extends FakerInternet
{
    /**
     * @var UniDecoder
     */
    private $uniDecoder;

    /**
     * @var FilterInterface[]
     */
    private $filters;

    /**
     * @var Slugifier
     */
    private $slugifier;

    /**
     * @param Generator $generator
     * @param Slugifier $slugifier
     * @param UniDecoder $uniDecoder
     */
    public function __construct(Generator $generator, FilterInterface $slugifier, UniDecoder $uniDecoder, $filters = [])
    {
        parent::__construct($generator);
        $this->slugifier = $slugifier;
        $this->uniDecoder = $uniDecoder;
        $this->filters = $filters;
    }

    /**
     * Slugify text
     *
     * Runs all defined filters in ASC order
     *
     * @example '.Zażółć gęślą jaźń-!-' -> 'zazolc-gesla-jazn'
     * @param $text
     * @return string
     */
    public function slugify($text)
    {
        if (!is_string($text) || $text === '') {
            return '';
        }
        $text = $this->uniDecode($text);
        $text = $this->slugifier->filter($text);

        foreach($this->filters as $filter) {
            $text = $filter->filter($text);
        }

        return $text;
    }

    /**
     * UniDecode text
     *
     * @example 'Zażółć gęślą jaźń' -> 'Zazolc gesla jazn'
     * @param $text
     * @return string
     */
    public function uniDecode($text)
    {
        if (!is_string($text) || $text === '') {
            return '';
        }

        return $this->uniDecoder->decode($text);
    }
}
