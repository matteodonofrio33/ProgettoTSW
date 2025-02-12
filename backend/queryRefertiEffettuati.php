
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
    require('./conn.php');
    $arbitro = 'arbitro1';
    //$sql = "SELECT $campo FROM arbitro WHERE $campo=$1";

    $sql= "SELECT 
                  REFERTO.id_referto,
                    REFERTO.stato_partita,
                    REFERTO.numero_falli,
                    REFERTO.id_arbitro,
                    PARTITA.id_partita,     
                    PARTITA.n_giornata,     
                    PARTITA.data_partita,
                    PARTITA.nome_squadra1,
                    PARTITA.nome_squadra2,
                    PARTITA.nome_stadio
            FROM REFERTO
            JOIN PARTITA ON REFERTO.id_partita = PARTITA.id_partita
            WHERE REFERTO.id_arbitro = $1;  
            ";
	
	$ret = pg_query_params($db, $sql, array($arbitro));
	

	if(!$ret) {
		echo "ERRORE QUERY: " . pg_last_error($db);
		return false;
	}
	else{

        if(pg_num_rows($ret) > 0) {
            //creo una riga
            echo "<table border='1' 
            <tr>
            ";
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
            echo "Non sono stati trovati referti";
        }

        
		
		
	}
	pg_close($db);


?>



</body>
</html>