<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;

// START AN INSTANCE OF SYMFONY CONSOLE
$application = new Application();

include 'ConnectionParams.php';
include 'commands/ReadData.php';
include 'commands/LogAccess.php';

$application->add(new ReadData());
$application->add(new LogAccess());
$application->run();