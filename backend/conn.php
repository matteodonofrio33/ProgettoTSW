<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



$host = 'localhost';
$port = '5432';
$database = 'gruppo34';
$user = 'www';
$pass = 'tw2024';

$connection_string = "host=$host port=$port dbname=$database user=$user password=$pass";


//connessione al database
$db = pg_connect($connection_string) or die('Impossibile connetersi al database: ' . pg_last_error());


?>
