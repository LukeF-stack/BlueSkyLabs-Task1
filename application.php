<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\DBAL\Exception;

// START AN INSTANCE OF SYMFONY CONSOLE
$application = new Application();

// LOCAL MYSQL DATABASE PARAMETERS
$connectionParams = array(
    'dbname' => 'mydb',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost:3306',
    'driver' => 'pdo_mysql',
);

// COMMAND TO LOG ACCESS DATE/TIME TO DB
class LogAccess extends Command 
{
    protected static $defaultName = 'app:log-access';

    protected function configure()
    {
        $this
            ->setDescription('Logs current date and time to the database.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    
    {   
        try {
            $conn = \Doctrine\DBAL\DriverManager::getConnection($GLOBALS['connectionParams']);

            if ($conn->connect()) { 
                echo "Connection Successful \n";

                $conn->insert('entries', array('accessed' => date("D M d, Y G:i")));

                echo "Data Logged";

                return Command::SUCCESS;
            } else {
                echo "Connection Unsuccessful";
                return Command::FAILURE;
            } 
        } catch (Exception $e) 
        {
            echo "Connection unsuccessful";
            return Command::FAILURE;
        }
    } 
}

// COMMAND TO PRINT ALL DATA FROM THE ENTRIES TABLE IN MYSQL DATABASE
class ReadData extends Command 
{
    protected static $defaultName = 'app:read-data';

    protected function configure()
    {
        $this
            ->setDescription('Prints all data from the database table "entries" (all the access dates from the log-access command)');
    }

    protected function execute(InputInterface $input, OutputInterface $output) 
    {
        try {
            $conn = \Doctrine\DBAL\DriverManager::getConnection($GLOBALS['connectionParams']);

            if ($conn->connect()) { 
                echo "Connection Successful \n";

                $sql = "SELECT * FROM entries";
                $stmt = $conn->query($sql);
                while (($result = $stmt->fetch()) !==false) {
                        print "accessed db at {$result['accessed']} \n";
                }

                return Command::SUCCESS;
            } else {
                echo "Connection Unsuccessful";
                return Command::FAILURE;
            } 
        } catch (Exception $e) 
        {
            echo "Connection unsuccessful";
            return Command::FAILURE;
        }
    }
}

// REGISTER COMMANDS AND RUN THE APPLICATION
$application->add(new LogAccess());
$application->add(new ReadData());
$application->run();





