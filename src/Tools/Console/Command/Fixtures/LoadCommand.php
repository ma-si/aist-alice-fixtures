<?php

/**
 * Aist Alice Fixtures (http://mateuszsitek.com/projects/fixtures)
 *
 * @copyright Copyright (c) 2017-2018 DIGITAL WOLVES LTD (http://digitalwolves.ltd) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace Aist\AliceFixtures\Tools\Console\Command\Fixtures;

use Aist\AliceFixtures\Tools\Console\Helper\FixtureLoaderHelper;
use Aist\AliceFixtures\Tools\Console\Helper\FixturePersisterHelper;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Utility\PersisterHelper;
use Nelmio\Alice\Fixtures;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command to load fixtures.
 */
class LoadCommand extends AbstractCommand
{

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
        ->setName('orm:fixtures:load')
        ->setDescription(
            'Processes the fixtures and load to database.'
        )
        ->setDefinition([
            new InputOption(
                'force',
                null,
                InputOption::VALUE_NONE,
                "Don't ask for the deletion of the database, but force the operation to run."
            )
        ])
        ->setHelp(<<<EOT
Processes the schema and either create it directly on EntityManager Storage Connection or generate the SQL output.

<comment>Hint:</comment> If you have a database with tables that should not be managed
by the ORM, you can use a DBAL functionality to filter the tables and sequences down
on a global level:

    \$config->setFilterSchemaAssetsExpression(\$regexp);
EOT
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function executeFixturesCommand(
        InputInterface $input,
        OutputInterface $output,
        FixturePersisterHelper $persisterHelper,
        FixtureLoaderHelper $loaderHelper
    ) {
//        if ($input->getOption('dump-sql')) {
////            $sqls = $schemaTool->getCreateSchemaSql($metadatas);
////            $output->writeln(implode(';' . PHP_EOL, $sqls) . ';');
//        } else {
            $output->writeln('Loading fixtures...');

        $objectManager = $loaderHelper->getObjectManager();
        $files = $loaderHelper->getFiles();
        $options = $loaderHelper->getOptions();

        $objects = Fixtures::load(
            $files,
            $objectManager,
            $options
            //            [
            ////                'locale' => 'en_US',
            //                'providers' => $providers,
            ////                'seed' => 1,
            ////                'logger' => null,
            ////                'persist_once' => false,
            //            ]
        );

//            $persisterHelper->getPersister()->persist($loaderHelper->getLoader());
        $output->writeln(
            sprintf("  - Inserted <fg=green>objects</fg=green> (<fg=yellow>%s</fg=yellow>)", count($objects))
        );
//        }

        return 0;
    }
}
