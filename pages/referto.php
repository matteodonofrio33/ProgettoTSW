<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Referto</title>
</head>
<body>

<div class="tables"> 
<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../backend/conn.php');


if (!isset($_SESSION['username'])) {
    die("Errore: utente non autenticato.");
}

$arbitro = $_SESSION['username'];

$sql = "SELECT 
            PARTITA.nome_squadra1 AS \"SQUADRA1\",
            PARTITA.nome_squadra2 AS \"SQUADRA2\"
        FROM REFERTO
        JOIN PARTITA ON REFERTO.id_partita = PARTITA.id_partita
        WHERE REFERTO.id_arbitro = $1
        AND REFERTO.stato_partita IS NULL; ";

$ret = pg_query_params($db, $sql, array($arbitro));

if (!$ret) {
    echo "ERRORE QUERY: " . pg_last_error($db);
    return false;
}



   
    while($row = pg_fetch_assoc($ret)){
        $squadra1 = $row['SQUADRA1'];
        $squadra2 = $row['SQUADRA2'];
    }

/*
    echo "$squadra1";
    echo "<br> $squadra2";
*/

//ottengo i nomi dei giocatori della squadra1:

$sql = "SELECT 
            GIOCATORE.nome_giocatore AS \"Nome Giocatore\"
            FROM GIOCATORE
            JOIN PARTECIPAZIONE ON GIOCATORE.id_giocatore = PARTECIPAZIONE.id_giocatore
            WHERE GIOCATORE.nome_squadra = $1 ";

$ret = pg_query_params($db, $sql, array($squadra1));

if (!$ret) {
    echo "ERRORE QUERY: " . pg_last_error($db);
    return false;
}

$giocatore1 = $giocatore2 = $giocatore3 = $giocatore4 = $giocatore5 = $giocatore6 = null;
$i = 1;

// Recupera i risultati riga per riga e assegna i nomi ai giocatori
while ($row = pg_fetch_assoc($ret)) {
    if ($i == 1) {
        $giocatore1 = $row['Nome Giocatore'];
    } elseif ($i == 2) {
        $giocatore2 = $row['Nome Giocatore'];
    } elseif ($i == 3) {
        $giocatore3 = $row['Nome Giocatore'];
    } elseif ($i == 4) {
        $giocatore4 = $row['Nome Giocatore'];
    } elseif ($i == 5) {
        $giocatore5 = $row['Nome Giocatore'];
    } elseif ($i == 6) {
        $giocatore6 = $row['Nome Giocatore'];
    }
    $i++;
}

//echo " Giocatori squadra 1: $giocatore1, $giocatore2, $giocatore3, $giocatore4, $giocatore5, $giocatore6 ";
/*
echo" <table id='table1'> ";





echo "</table>";

   */ 








?>
 </div>
    
</body>
</html>


