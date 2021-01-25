<?php 

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\DBAL\Exception;

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
            $conn = getParams();

            if ($conn->connect()) { 
                $output->writeln("Connection Successful \n"); 

                $conn->insert('entries', array('accessed' => date("D M d, Y G:i")));

                $output->writeln("Data Logged \n"); 

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


