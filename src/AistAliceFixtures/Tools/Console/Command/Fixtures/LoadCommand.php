<?php

/**
 * AistAliceFixtures (http://mateuszsitek.com/projects/aist-alice-fixtures)
 *
 * @link      http://github.com/ma-si/aist-alice-fixtures for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Aist Internet Technologies (http://aist.pl) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace AistAliceFixtures\Tools\Console\Command\Fixtures;

use AistAliceFixtures\Tools\Console\Helper\FixtureLoaderHelper;
use AistAliceFixtures\Tools\Console\Helper\FixturePersisterHelper;
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
                'force', null, InputOption::VALUE_NONE,
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
    protected function executeFixturesCommand(InputInterface $input, OutputInterface $output, FixturePersisterHelper $persisterHelper, FixtureLoaderHelper $loaderHelper)
    {
//        var_dump('test');
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
//        var_dump($objects);
//            $persisterHelper->getPersister()->persist($loaderHelper->getLoader());
        $output->writeln(sprintf("  - Inserted <fg=green>objects</fg=green> (<fg=yellow>%s</fg=yellow>)", count($objects)));
//        $output->writeln('Fixtures loaded successfully!');
//        }

        return 0;
    }

}
