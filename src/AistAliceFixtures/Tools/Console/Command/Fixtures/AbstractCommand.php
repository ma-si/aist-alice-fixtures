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
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Base class for CreateCommand, DropCommand and UpdateCommand.
 */
abstract class AbstractCommand extends Command
{

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$input->getOption('force')) {
            $output->writeln('<comment>ATTENTION</comment>: This operation should not be executed in a production environment.' . PHP_EOL);

            return;
        }
        $emHelper = $this->getHelper('em');
        $loaderHelper = $this->getHelper('loader');
        $persisterHelper = $this->getHelper('persister');

        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $emHelper->getEntityManager();

        $metadatas = $em->getMetadataFactory()->getAllMetadata();

        if (!empty($metadatas)) {
            return $this->executeFixturesCommand($input, $output, $persisterHelper, $loaderHelper);
        } else {
            $output->writeln('No Metadata Classes to process.');

            return 0;
        }
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param SchemaTool $schemaTool
     * @param array $metadatas
     * @return null|int Null or 0 if everything went fine, or an error code.
     */
    abstract protected function executeFixturesCommand(InputInterface $input, OutputInterface $output, FixturePersisterHelper $persisterHelper, FixtureLoaderHelper $loaderHelper);
}
