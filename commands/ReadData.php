<?php 

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\DBAL\Exception;

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
            $conn = getParams();
            
            if ($conn->connect()) { 
                $output->writeln("Connection Successful \n"); 

                $sql = "SELECT * FROM entries";
                $stmt = $conn->query($sql);
                while (($result = $stmt->fetch()) !==false) {
                        print "accessed db at {$result['accessed']} \n";
                }

                return Command::SUCCESS;
            } else {
                $output->writeln("Connection Unsuccessful \n"); 
                return Command::FAILURE;
            } 
        } catch (Exception $e) 
        {
            $output->writeln("Connection Unsuccessful \n"); 
            return Command::FAILURE;
        }
    }
}



