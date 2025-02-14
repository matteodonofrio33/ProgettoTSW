<?php
session_start();
require('../backend/conn.php'); // Connessione al database

if (!isset($_SESSION['username'])) {
    die("Errore: utente non autenticato.");
}

$arbitro = $_SESSION['username'];

$sql = "SELECT 
            REFERTO.id_referto AS \"ID REFERTO\",
            PARTITA.nome_stadio AS \"STADIO\",
            PARTITA.nome_squadra1 AS \"SQUADRA1\",
            PARTITA.nome_squadra2 AS \"SQUADRA2\",
            PARTITA.n_giornata AS \"N GIORNATA\",
            PARTITA.data_partita AS \"DATA\"
        FROM REFERTO
        JOIN PARTITA ON REFERTO.id_partita = PARTITA.id_partita
        WHERE REFERTO.id_arbitro = $1
        AND REFERTO.stato_partita IS NULL";

$ret = pg_query_params($db, $sql, array($arbitro));

if (!$ret) {
    echo "ERRORE QUERY: " . pg_last_error($db);
    return false;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prossima partita</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1e1e2f;
            color: white;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        h1 {
            margin-top: 20px;
            font-size: 28px;
            color: #f1c40f;
        }

        #tableContainer {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        table {
            width: 80%;
            max-width: 1000px;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            /*overflow: hidden;*/
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.2);
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            text-align: left;
        }

        th {
            background-color: rgba(241, 196, 15, 0.8);
            color: black;
            font-weight: bold;
        }

        tr:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        td {
            font-size: 16px;
        }

        .noPart {
            margin-top: 20px;
            font-size: 18px;
            color: #e74c3c;
        }
    </style>
</head>
<body>
    <h1>La tua prossima partita sarà:</h1>
    <div id="tableContainer">
        <?php
        if (pg_num_rows($ret) > 0) {
            echo "<table>
                    <tr>
                        <th>ID REFERTO</th>
                        <th>STADIO</th>
                        <th>SQUADRA1</th>
                        <th>SQUADRA2</th>
                        <th>N GIORNATA</th>
                        <th>DATA</th>
                    </tr>";

            while ($row = pg_fetch_assoc($ret)) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>" . htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='noPart'>Non hai partite da arbitrare.</p>";
        }

        pg_close($db);
        ?>
    </div>
</body>
</html>
