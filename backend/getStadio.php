<?php
/*session_start();
session_set_cookie_params(0);

require('../backend/conn.php');

if (!$db) {
    $message = "Ooops si è verificato un problema";
    header("Location: ./error.php?message=".$message."&redirect=../pages/homepage.php");
    die("Errore di connessione al database: " . pg_last_error());
}

if (!isset($_SESSION['username'])) {
    $message = "L'utente non è autenticato";
    header("Location: ./error.php?message=".$message."&redirect=../pages/homepage.php");
    die("Errore: utente non autenticato.");
}

$arbitro = $_SESSION['username'];

if (empty($arbitro)) {
    $message = "Il nome dell'arbitro non è valido.";
    header("Location: ./error.php?message=".$message."&redirect=../pages/homepage.php");
    die("Errore: il nome dell'arbitro non è valido.");

    
}

$sql = "SELECT 
            REFERTO.id_referto AS \"ID REFERTO\",
            PARTITA.nome_stadio AS \"STADIO\",
            PARTITA.nome_squadra1 AS \"SQUADRA1\",
            PARTITA.nome_squadra2 AS \"SQUADRA2\",
            PARTITA.n_giornata AS \"N GIORNATA\",
            PARTITA.data_partita AS \"DATA\"
        FROM REFERTO
        JOIN PARTITA ON REFERTO.id_partita = PARTITA.id_partita
        WHERE REFERTO.id_arbitro = $1;";

$ret = pg_query_params($db, $sql, array($arbitro));

if (!$ret) {
    $message = "Ooops si è verificato un problema";
    header("Location: ./error.php?message=".$message."&redirect=../pages/homepage.php");
    die("Errore nella query: " . pg_last_error($db));
}

$num_rows = pg_num_rows($ret);
if ($num_rows === false) {
    $message = "Ooops si è verificato un problema";
    header("Location: ./error.php?message=".$message."&redirect=../pages/homepage.php");
    die("Errore con pg_num_rows: " . pg_last_error($db));
}*/
?>
