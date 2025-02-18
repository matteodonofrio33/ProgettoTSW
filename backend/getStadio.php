<?php
session_start();
session_set_cookie_params(0);

require('../backend/conn.php'); // Connessione al database

if (!$db) {
    die("Errore di connessione al database: " . pg_last_error());
}

if (!isset($_SESSION['username'])) {
    die("Errore: utente non autenticato.");
}

$arbitro = $_SESSION['username'];

if (empty($arbitro)) {
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
    die("Errore nella query: " . pg_last_error($db));
}

$num_rows = pg_num_rows($ret);
if ($num_rows === false) {
    die("Errore con pg_num_rows: " . pg_last_error($db));
}
?>
