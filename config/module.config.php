<?php

/**
 * AistAliceFixtures (http://mateuszsitek.com/projects/aist-alice-fixtures)
 *
 * @link      http://github.com/ma-si/aist-alice-fixtures for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Aist Internet Technologies (http://aist.pl) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace AistAliceFixtures;

return [
    'service_manager' => [
        'invokables' => [
            // Aist Fixtures Commands
            'aist.fixtures.load' => __NAMESPACE__ . '\Tools\Console\Command\Fixtures\LoadCommand',
        ],
    ],
];
