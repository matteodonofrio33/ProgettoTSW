<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partite Arbitrate</title>
    <style>
        #tableContainer {
            display: flex;
            flex-direction: row;
            justify-content: center;
            width: 100%;
        }

        #tableRefert {
            background-color: rgba(0, 0, 0, 0.46);
            color: white;
            width: 70%;
            margin: 0 auto;
            border: 2px solid black;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 1);
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid white;
        }

        th {
            background-color: rgba(231, 204, 1, 0.48);
        }
    </style>
</head>
<body>
<div id="tableContainer">
    <?php
    require('../backend/conn.php');

    if (!isset($_SESSION['username'])) {
        die("Errore: utente non autenticato.");
    }

    $arbitro = $_SESSION['username'];

    $sql = "SELECT 
                REFERTO.id_referto AS \"ID REFERTO\",
                PARTITA.nome_stadio AS \"STADIO\",
                PARTITA.nome_squadra1 AS \"SQUADRA1\",
                PARTITA.nome_squadra2 AS \"SQUADRA2\",
                REFERTO.stato_partita AS \"ESITO\",
                PARTITA.n_giornata AS \"N GIORNATA\",
                PARTITA.data_partita AS \"DATA\"
            FROM REFERTO
            JOIN PARTITA ON REFERTO.id_partita = PARTITA.id_partita
            WHERE REFERTO.id_arbitro = $1
            AND (REFERTO.stato_partita IS NOT NULL AND REFERTO.stato_partita <> '');"; //filtra le partite senza esito

    $ret = pg_query_params($db, $sql, array($arbitro));

    if (!$ret) {
        $message = "Password errata";
		header("Location: ./error.php?message=".$message."&redirect=../pages/login.html");
        echo "ERRORE QUERY: " . pg_last_error($db);
    } else {
        if (pg_num_rows($ret) > 0) {
             //creo una riga
             echo "<table id='tableRefert' style='border-collapse: collapse;'><tr>";
     
                 //nella prima riga stampo i nomi dei campi
                 $fields = pg_num_fields($ret);
                 for($i = 0; $i < $fields; $i++){
                     echo "<th>".pg_field_name($ret, $i)."</th>";
     
                 }
                 echo "</tr>";
     
                 //stampa dei valori dei campi
                 while($row = pg_fetch_assoc($ret)){
                     echo "<tr>";
                     foreach($row as $value) {
                         echo "<td>" .htmlspecialchars($value)."</td>";
                     }
                     echo "</tr>";
                 }
                 echo"</table>";
        } else {
            echo "<p style='color: white; font-size: 18px;'>Non sono stati trovati referti con esito compilato.</p>";
        }
    }

    pg_close($db);
    ?>
</div>
</body>
</html>
