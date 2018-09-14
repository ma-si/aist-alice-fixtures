<?php

/**
 * Aist Alice Fixtures (http://mateuszsitek.com/projects/fixtures)
 *
 * @copyright Copyright (c) 2017-2018 DIGITAL WOLVES LTD (http://digitalwolves.ltd) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

return [
    'service_manager' => [
        'invokables' => [
            // Aist Fixtures Commands
            'aist.fixtures.load' => \Aist\AliceFixtures\Tools\Console\Command\Fixtures\LoadCommand::class,
        ],
    ],
];
