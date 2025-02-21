<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="../immagini/fischietto.ico" type="image/x-icon">

</head>

<body>

    <?php
    require('../backend/conn.php');

    if (!isset($_POST['idRef'])) {
        die("Errore: ID referto non ricevuto.");
    }

    $id_referto = $_POST['idRef'];

    $sql = "SELECT 
                PARTITA.id_partita AS \"ID PARTITA\",
                PARTITA.data_partita AS \"DATA\",
                PARTITA.n_giornata AS \"N GIORNATA\",
                PARTITA.nome_squadra1 AS \"SQUADRA1\",
                PARTITA.nome_squadra2 AS \"SQUADRA2\",
                REFERTO.stato_partita AS \"ESITO\",
                REFERTO.numero_falli AS \"NUMERO FALLI\",
                GIOCATORE.id_giocatore AS \"ID GIOCATORE\",
                GIOCATORE.nome_giocatore AS \"NOME\",
                GIOCATORE.nome_squadra AS \"SQUADRA GIOCATORE\",
                PARTECIPAZIONE.stato_giocatore AS \"STATO GIOCATORE\",
                PARTECIPAZIONE.minuto AS \"MINUTO\"
            FROM REFERTO
            JOIN PARTITA ON REFERTO.id_partita = PARTITA.id_partita
            JOIN PARTECIPAZIONE ON PARTITA.id_partita = PARTECIPAZIONE.id_partita
            JOIN GIOCATORE ON PARTECIPAZIONE.id_giocatore = GIOCATORE.id_giocatore
            WHERE REFERTO.id_referto = $1";

    $ret = pg_query_params($db, $sql, array($id_referto));

    if (!$ret) {
        $message = "Ooops si è verificato un problema";
        header("Location: ./error.php?message=" . $message . "&redirect=../pages/homepage.php");
        echo "Errore query: " . pg_last_error($db);
    } else {
        if (pg_num_rows($ret) > 0) {
            $first_row = pg_fetch_assoc($ret); //prendo la prima riga per i dati della partita
            $squadra1 = $first_row['SQUADRA1'];
            $squadra2 = $first_row['SQUADRA2'];

            //tabella con le informazioni della partita
            echo "<h2>Dettagli Partita</h2>";
            echo "<table border='1' style='border-collapse: collapse;'>
                    <tr>
                        <th>DATA</th>
                        <th>N GIORNATA</th>
                        <th>SQUADRA 1</th>
                        <th>SQUADRA 2</th>
                        <th>ESITO</th>
                        <th>NUMERO FALLI</th>
                    </tr>
                    <tr>
                        <td>{$first_row['DATA']}</td>
                        <td>{$first_row['N GIORNATA']}</td>
                        <td>{$first_row['SQUADRA1']}</td>
                        <td>{$first_row['SQUADRA2']}</td>
                        <td>{$first_row['ESITO']}</td>
                        <td>{$first_row['NUMERO FALLI']}</td>
                    </tr>
                </table>";

            echo "<h2>Partecipanti</h2>";

            $giocatori_squadra1 = [];
            $giocatori_squadra2 = [];

            if ($first_row['SQUADRA GIOCATORE'] == $squadra1) {
                $giocatori_squadra1[] = $first_row;
            } else {
                $giocatori_squadra2[] = $first_row;
            }

            while ($row = pg_fetch_assoc($ret)) {
                if ($row['SQUADRA GIOCATORE'] == $squadra1) {
                    $giocatori_squadra1[] = $row;
                } else {
                    $giocatori_squadra2[] = $row;
                }
            }

            //squadra1
            if (pg_num_rows($ret) > 0) {
                echo "<table id='table1' style='border-collapse: collapse';
                <tr>";

                $fields = pg_num_fields($ret);

            }
            echo "<h3>$squadra1</h3>";
            echo "<table border='1' style='border-collapse: collapse;'>
                    <tr>
                        <th>NOME</th>
                        <th>STATO GIOCATORE</th>
                        <th>MINUTO</th>
                    </tr>";

            foreach ($giocatori_squadra1 as $giocatore) {
                echo "<tr>
                        <td>{$giocatore['NOME']}</td>
                        <td>{$giocatore['STATO GIOCATORE']}</td>
                        <td>{$giocatore['MINUTO']}</td>
                    </tr>";
            }
            echo "</table>";

            //squadra2
            echo "<h3>$squadra2</h3>";
            echo "<table border='1' style='border-collapse: collapse;'>
                    <tr>
                        <th>NOME</th>
                        <th>STATO GIOCATORE</th>
                        <th>MINUTO</th>
                    </tr>";

            foreach ($giocatori_squadra2 as $giocatore) {
                echo "<tr>
                        <td>{$giocatore['NOME']}</td>
                        <td>{$giocatore['STATO GIOCATORE']}</td>
                        <td>{$giocatore['MINUTO']}</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "Nessun risultato trovato.";
        }
    }
    ?>

</body>

</html>