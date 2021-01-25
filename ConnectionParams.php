<?php

require __DIR__.'/vendor/autoload.php';

// LOCAL MYSQL DATABASE PARAMETERS
$connectionParams = array(
    'dbname' => 'mydb',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost:3306',
    'driver' => 'pdo_mysql',
);

function getparams() 
{
    $conn = \Doctrine\DBAL\DriverManager::getConnection($GLOBALS['connectionParams']);
    return $conn;
}
