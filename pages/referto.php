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

//$squadra1 = null;
//$squadra2 = null;

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


    //echo "$squadra1";
    //echo "<br> $squadra2";


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

$giocatore11 = $giocatore12 = $giocatore13 = $giocatore14 = $giocatore15 = $giocatore16 = null;
$i = 1;

// Recupera i risultati riga per riga e assegna i nomi ai giocatori
while ($row = pg_fetch_assoc($ret)) {
    if ($i == 1) {
        $giocatore11 = $row['Nome Giocatore'];
    } elseif ($i == 2) {
        $giocatore12 = $row['Nome Giocatore'];
    } elseif ($i == 3) {
        $giocatore13 = $row['Nome Giocatore'];
    } elseif ($i == 4) {
        $giocatore14 = $row['Nome Giocatore'];
    } elseif ($i == 5) {
        $giocatore15 = $row['Nome Giocatore'];
    } elseif ($i == 6) {
        $giocatore16 = $row['Nome Giocatore'];
    }
    $i++;
}

//echo " Giocatori squadra 1: $giocatore1, $giocatore2, $giocatore3, $giocatore4, $giocatore5, $giocatore6 ";
/*
echo" <table id='table1'> ";





echo "</table>";

   */ 
//prendo gli stati giocatore:
if(isset($_POST['statoGiocatore11']))
   $statoGiocatore11 = $_POST['statoGiocatore11'];
else
   $statoGiocatore11 = "";

if(isset($_POST['statoGiocatore12']))
   $statoGiocatore12 = $_POST['statoGiocatore12'];
else
   $statoGiocatore12 = "";

if(isset($_POST['statoGiocatore13']))
   $statoGiocatore13 = $_POST['statoGiocatore13'];
else
   $statoGiocatore13 = "";

if(isset($_POST['statoGiocatore14']))
   $statoGiocatore14 = $_POST['statoGiocatore14'];
else
   $statoGiocatore14 = "";
   
if(isset($_POST['statoGiocatore15']))
   $statoGiocatore15 = $_POST['statoGiocatore15'];
else
   $statoGiocatore15 = "";

   if(isset($_POST['statoGiocatore16']))
   $statoGiocatore16 = $_POST['statoGiocatore16'];
else
   $statoGiocatore16 = "";


   //prendo i minuti giocatore:
if(isset($_POST['minuto11']))
   $minuto11 = $_POST['minuto11'];
else
   $minuto11 = "";
   
if(isset($_POST['minuto12']))
   $minuto12 = $_POST['minuto12'];
else
   $minuto12 = "";

   if(isset($_POST['minuto13']))
   $minuto13 = $_POST['minuto13'];
else
   $minuto13 = "";

   if(isset($_POST['minuto14']))
   $minuto14 = $_POST['minuto14'];
else
   $minuto14 = "";
   
if(isset($_POST['minuto15']))
   $minuto15 = $_POST['minuto15'];
else
   $minuto15 = "";

   if(isset($_POST['minuto16']))
   $minuto16 = $_POST['minuto16'];
else
   $minuto16 = "";




/*
   echo "$statoGiocatore11, $statoGiocatore12, $statoGiocatore13, $statoGiocatore14, $statoGiocatore15, $statoGiocatore16 ";
   echo "$minuto11, $minuto12, $minuto13, $minuto14, $minuto15, $minuto16 ";

*/

//per tabella della squadra 2
$sql2 = "SELECT 
            GIOCATORE.nome_giocatore AS \"Nome Giocatore\"
            FROM GIOCATORE
            JOIN PARTECIPAZIONE ON GIOCATORE.id_giocatore = PARTECIPAZIONE.id_giocatore
            WHERE GIOCATORE.nome_squadra = $1 ";

$ret2 = pg_query_params($db, $sql2, array($squadra2));

if (!$ret2) {
    echo "ERRORE QUERY: " . pg_last_error($db);
    return false;
}


$giocatore21 = $giocatore22 = $giocatore23 = $giocatore24 = $giocatore25 = $giocatore26 = null;
$i = 1;

// Recupera i risultati riga per riga e assegna i nomi ai giocatori
while ($row2 = pg_fetch_assoc($ret2)) {
    if ($i == 1) {
        $giocatore21 = $row2['Nome Giocatore'];
    } elseif ($i == 2) {
        $giocatore22 = $row2['Nome Giocatore'];
    } elseif ($i == 3) {
        $giocatore23 = $row2['Nome Giocatore'];
    } elseif ($i == 4) {
        $giocatore24 = $row2['Nome Giocatore'];
    } elseif ($i == 5) {
        $giocatore25 = $row2['Nome Giocatore'];
    } elseif ($i == 6) {
        $giocatore26 = $row2['Nome Giocatore'];
    }
    $i++;
}

//echo " Giocatori squadra 1: $giocatore1, $giocatore2, $giocatore3, $giocatore4, $giocatore5, $giocatore6 ";
/*
echo" <table id='table1'> ";





echo "</table>";

   */ 
//prendo gli stati giocatore:
if(isset($_POST['statoGiocatore21']))
   $statoGiocatore21 = $_POST['statoGiocatore21'];
else
   $statoGiocatore21 = "";

if(isset($_POST['statoGiocatore22']))
   $statoGiocatore22 = $_POST['statoGiocatore22'];
else
   $statoGiocatore22 = "";

if(isset($_POST['statoGiocatore23']))
   $statoGiocatore23 = $_POST['statoGiocatore23'];
else
   $statoGiocatore23 = "";

if(isset($_POST['statoGiocatore24']))
   $statoGiocatore24 = $_POST['statoGiocatore24'];
else
   $statoGiocatore24 = "";
   
if(isset($_POST['statoGiocatore25']))
   $statoGiocatore25 = $_POST['statoGiocatore25'];
else
   $statoGiocatore25 = "";

   if(isset($_POST['statoGiocatore26']))
   $statoGiocatore26 = $_POST['statoGiocatore26'];
else
   $statoGiocatore26 = "";


   //prendo i minuti giocatore:
if(isset($_POST['minuto21']))
   $minuto21 = $_POST['minuto21'];
else
   $minuto21 = "";
   
if(isset($_POST['minuto22']))
   $minuto22 = $_POST['minuto22'];
else
   $minuto22 = "";

   if(isset($_POST['minuto23']))
   $minuto23 = $_POST['minuto23'];
else
   $minuto23 = "";

   if(isset($_POST['minuto24']))
   $minuto24 = $_POST['minuto24'];
else
   $minuto24 = "";
   
if(isset($_POST['minuto25']))
   $minuto25 = $_POST['minuto25'];
else
   $minuto25 = "";

   if(isset($_POST['minuto26']))
   $minuto26 = $_POST['minuto26'];
else
   $minuto26 = "";

/*
   echo "$statoGiocatore21, $statoGiocatore22, $statoGiocatore23, $statoGiocatore24, $statoGiocatore25, $statoGiocatore26 ";
   echo "$minuto21, $minuto22, $minuto23, $minuto24, $minuto25, $minuto26 ";
*/






?>
 </div>
    
</body>
</html>


