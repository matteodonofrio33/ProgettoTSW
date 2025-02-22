<?php
    session_start();
    require('../backend/conn.php')
?>

<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta name="description" content="Sito pensato per gli arbitri e per la crezione di referti."> 
  <meta name="keywords" content="arbitro, referto, partita, goals, ammonito, espulso, fallo.">
  
    <link rel="stylesheet" type="text/css" href="../assets/css/miePartiteStyle.css">
    <title>Le mie partite</title>
    <link rel="icon" href="../assets/immagini/fischietto.ico" type="image/x-icon">

</head>
<body>

    <div class="contentMiePartite">
    <?php include '../includes/header.php'; ?>
    <form method="POST" action="">
        <label for="idReferto">Inserisci l'id del referto che vuoi visualizzare</label><br>
        <input type="number" name="idRef" id="idField">
        <input type="submit" value="Invia" id="button">
    </form>

    <?php
    $arbitro = $_SESSION['username'];
    
    if (isset($_POST['idRef']) && !empty($_POST['idRef'])) {  


        
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
                WHERE REFERTO.id_referto = $1 AND REFERTO.id_arbitro = $2";

        $ret = pg_query_params($db, $sql, array($id_referto, $arbitro));

        if (!$ret) {
            $message = "Non ci sono partite con l'id referto inserito";
			header("Location: ../backend/error.php?message=".$message."&redirect=../pages/miePartite.php");
            echo "Errore query: " . pg_last_error($db);
        } elseif (pg_num_rows($ret) > 0) {
            $first_row = pg_fetch_assoc($ret);
            $squadra1 = $first_row['SQUADRA1'];
            $squadra2 = $first_row['SQUADRA2'];

            //tabella informazioni partita
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

            //tabella squadra1
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

            //tabella squadra2
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
    </div>
    
</body>
<?php include('../includes/footer.html'); ?>

</html>
