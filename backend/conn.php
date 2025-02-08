<?php
$host = 'localhost';
$port = '5432';
$database = 'esercizio2';
$username = 'www';
$password = 'tw2024';

$connection_string = "host=$host port=$port dbname=$database user=$username password=$password";


//CONNESSIONE AL DB
$db = pg_connect($connection_string) or die('Impossibile connetersi al database: ' . pg_last_error());


?>
