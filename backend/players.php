<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Referto</title>
</head>

<body>




    <?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require('../backend/conn.php');


    if (!isset($_SESSION['username'])) {
        $message = "Utente non autenticato";
        header("Location: ../backend/error.php?message=" . $message . "&redirect=../../ProgettoTSW/pages/homepage.php");
        die("Errore: utente non autenticato.");
    }

    $arbitro = $_SESSION['username'];

    $sql = "SELECT 
    PARTITA.nome_squadra1 AS \"SQUADRA1\",
    PARTITA.nome_squadra2 AS \"SQUADRA2\"
FROM REFERTO
JOIN PARTITA ON REFERTO.id_partita = PARTITA.id_partita
WHERE REFERTO.id_arbitro = $1
AND (REFERTO.stato_partita IS NULL OR REFERTO.stato_partita = ''); ";

    $ret = pg_query_params($db, $sql, array($arbitro));

    if (!$ret) {
        $message = "Oops si è verificato un errore";
        header("Location: ../backend/error.php?message=" . $message . "&redirect=../../ProgettoTSW/pages/homepage.php");
        exit();
    }



    $squadra1 = "";
    $squadra2 = "";
    while ($row = pg_fetch_assoc($ret)) {
        $squadra1 = $row['SQUADRA1'];
        $squadra2 = $row['SQUADRA2'];
    }

    if ($squadra1 === "" || $squadra2 === "") {

        $message = "Non ci sono partite da refertare";
        header("Location: ../backend/error.php?message=" . $message . "&redirect=../../ProgettoTSW/pages/homepage.php");
        exit();
    }

    //SQUADRA 1:
    
    $sql = "SELECT 
            GIOCATORE.nome_giocatore AS \"Nome Giocatore\"
            FROM GIOCATORE
            WHERE GIOCATORE.nome_squadra = $1 ";

    $ret = pg_query_params($db, $sql, array($squadra1));

    if (!$ret) {
        $message = "Oops si è verificato un errore";
        header("Location: ../backend/error.php?message=" . $message . "&redirect=../../ProgettoTSW/pages/homepage.php");
        exit();
    }

    $giocatore11 = $giocatore12 = $giocatore13 = $giocatore14 = $giocatore15 = $giocatore16 = null;
    $i = 1;

    //recupera i risultati riga per riga e assegna i nomi ai giocatori
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

    //SQUADRA 2
    $sql2 = "SELECT 
            GIOCATORE.nome_giocatore AS \"Nome Giocatore\"
            FROM GIOCATORE
            WHERE GIOCATORE.nome_squadra = $1 ";

    $ret2 = pg_query_params($db, $sql2, array($squadra2));

    if (!$ret2) {
        $message = "Oops si è verificato un errore";
        header("Location: ../backend/error.php?message=" . $message . "&redirect=../../ProgettoTSW/pages/homepage.php");
        exit();
    }


    $giocatore21 = $giocatore22 = $giocatore23 = $giocatore24 = $giocatore25 = $giocatore26 = null;
    $i = 1;

    //recupera i risultati riga per riga e assegna i nomi ai giocatori
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

    //uso le variabili session per passare queste info a refert.php
    $_SESSION['giocatore11'] = $giocatore11;
    $_SESSION['giocatore12'] = $giocatore12;
    $_SESSION['giocatore13'] = $giocatore13;
    $_SESSION['giocatore14'] = $giocatore14;
    $_SESSION['giocatore15'] = $giocatore15;
    $_SESSION['giocatore16'] = $giocatore16;

    $_SESSION['giocatore21'] = $giocatore21;
    $_SESSION['giocatore22'] = $giocatore22;
    $_SESSION['giocatore23'] = $giocatore23;
    $_SESSION['giocatore24'] = $giocatore24;
    $_SESSION['giocatore25'] = $giocatore25;
    $_SESSION['giocatore26'] = $giocatore26;

    $_SESSION['id_arbitro'] = $arbitro;

    $_SESSION['squadra1'] = $squadra1;
    $_SESSION['squadra2'] = $squadra2;

    ?>

</body>


</html>