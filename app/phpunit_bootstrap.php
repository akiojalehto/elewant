<?php

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/AppKernel.php';

use Doctrine\Bundle\DoctrineBundle\Command\CreateDatabaseDoctrineCommand;
use Doctrine\Bundle\DoctrineBundle\Command\DropDatabaseDoctrineCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\ConsoleOutput;

$kernel = new AppKernel('test', true); // create a "test" kernel
$kernel->boot();

$application = new Application($kernel);

$command = new DropDatabaseDoctrineCommand();
$application->add($command);
$input = new ArrayInput(
    [
        'command' => 'doctrine:database:drop',
        '--force' => true,
    ]
);
$command->run($input, new ConsoleOutput(ConsoleOutput::VERBOSITY_QUIET));

// add the database:create command to the application and run it
$command = new CreateDatabaseDoctrineCommand();
$application->add($command);
$input = new ArrayInput(
    [
        'command' => 'doctrine:database:create',
    ]
);
$command->run($input, new ConsoleOutput(ConsoleOutput::VERBOSITY_QUIET));

// add doctrine:migrations:migrate
$command = new \Doctrine\Bundle\MigrationsBundle\Command\MigrationsMigrateDoctrineCommand();
$application->add($command);
$input = new ArrayInput(
    [
        'command' => 'doctrine:migrations:migrate',
        '--quiet' => true,
    ]
);
$input->setInteractive(false);
$command->run($input, new ConsoleOutput(ConsoleOutput::VERBOSITY_QUIET));
