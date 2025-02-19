
<?php
session_start();

include('../includes/header.php');

require('../backend/conn.php'); // Connessione al database
if (!isset($_SESSION['username'])) {
    $message = "Errore: utente non autenticato";
	header("Location: ./error.php?message=".$message."&redirect=../pages/login.html");
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
        AND (REFERTO.stato_partita IS NULL OR REFERTO.stato_partita = '');";

$ret = pg_query_params($db, $sql, array($arbitro));
if (!$ret) {
    $message = "Errore: utente non autenticato";
	header("Location: ./error.php?message=".$message."&redirect=../pages/login.html");
    exit();
   
}
// Inizializza una variabile per salvare il nome dello stadio
$stadio = null;
// Se ci sono partite, prendi il nome dello stadio della prima
if (pg_num_rows($ret) > 0) {
    $row = pg_fetch_assoc($ret);
    $stadio = htmlspecialchars($row["STADIO"] ?? '', ENT_QUOTES, 'UTF-8');
}
// Riavvia la query per ottenere tutte le partite (la prima riga è già stata estratta)
$ret = pg_query_params($db, $sql, array($arbitro));
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prossima partita</title>
    <link rel="icon" href="../assets/immagini/fischietto.ico" type="image/x-icon">

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
        #tableContainer{
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

        #meteoStadio, #distanceStadium, #payment{
            background-color: rgba(255, 255, 255, 0.1);
            padding: 10px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0px 0px 5px rgba(255, 255, 255, 0.2);
        }

        #info_match {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin: 20px ;
            width: 100%;
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
    <div id= "info_match" style="display:none">
        <img src="../assets/immagini/meteo.png" alt="Meteo Stadio" style="display:none" id="img1">
        <div id="meteoStadio"></div>
        <img src="../assets/immagini/posizione.png" alt="Meteo Stadio" style="display:none" id="img2">
        <div><p id="distanceStadium"></p></div>
        <img src="../assets/immagini/compenso.png" alt="Meteo Stadio" style="display:none" id="img2">
        <div><p id="payment"></p></div>
    </div>

    <script>
    var latStadio=0;
    var longStadio=0;
    var pay=0;
    //document.addEventListener("DOMContentLoaded",function() {
    var stadio="<?php echo $stadio; ?>"; // Recupera il nome dello stadio
    var citta="";
    var abilita="false";

    if (stadio==="Stadio Olimpico")  {
        citta="Roma,IT";
        latStadio=41.9336612653;
        longStadio=12.4528698552;
        abilita="true";
    }
    else if (stadio==="Giuseppe Meazza") {
        citta="Milano,IT";
        latStadio=45.4734797727;
        longStadio=9.12118951524;
        abilita="true";
    }
    else if (stadio==="Gewiss Stadium") {
        citta="Bergamo,IT";
        latStadio=45.705330512;
        longStadio=9.675163966;
        abilita="true";
    }
    else if (stadio==="Allianz Stadium") {
        citta="Torino,IT";
        latStadio=45.105666244;
        longStadio=7.637997448;
        abilita="true";
    }
    else {
        console.log("Stadio non riconosciuto:", stadio);
    }
   

    document.addEventListener("DOMContentLoaded", function () {
        // meteo
        if (abilita==="true") {
            img1=document.getElementById("img1");
            img2=document.getElementById("img2");
            img3=document.getElementById("img3");
            div=document.getElementById("info_match");

            div.style.display="block";
            img1.style.display="block";
            img2.style.display="block";
            img3.style.display="block";
            
            var xhttp = new XMLHttpRequest();
            var apiKey = "09515bcce37bc93c4496846db36038b7";
            var url = "https://api.openweathermap.org/data/2.5/weather?q=" + citta + "&appid=" + apiKey + "&units=metric&lang=it";
            
            xhttp.open("GET", url, true);
            xhttp.responseType = "json";
            xhttp.send();

            xhttp.onload = function () {
                if (xhttp.status == 200) {
                    var response = xhttp.response;
                    document.getElementById("meteoStadio").innerHTML =
                        "<p><strong>Temperatura:</strong> " + response.main.temp + "°C</p>" +
                        "<p><strong>Condizione:</strong> " + response.weather[0].description + "</p>" +
                        "<p><strong>Umidità:</strong> " + response.main.humidity + "%</p>" +
                        "<p><strong>Vento:</strong> " + response.wind.speed + " m/s</p>";
                } else {
                    $("#meteoStadio").html("<p class='noPart'>Errore nel recupero delle informazioni meteo.</p>");
                    console.error("Errore API:", xhttp.status, xhttp.statusText);
                }
            };
        }
        
    });

    
    function calculateDistance(lat1, long1, lat2, long2) {
        const R=6371; //raggio della terra

        const dLat=(lat2-lat1) * Math.PI/180;
        const dLon=(long2-long1) * Math.PI/180;

        const a=Math.sin(dLat/2) * Math.sin(dLat/2) + 
                Math.cos(lat1*Math.PI/180) * Math.cos(lat2*Math.PI/180) * 
                Math.sin(dLon/2) * Math.sin(dLon/2);

        const c=2*Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
        return R*c; //per avere la distanza in km
    }

    function myPos() {
        if (!navigator.geolocation) {
            alert("Il tuo browser non supporta la geolocalizzazione");
            return;
        }

        navigator.geolocation.getCurrentPosition(
            function (position) {
                let lat=position.coords.latitude;
                let long=position.coords.longitude;

                //alert("Latitudine ottenuta: " + lat); //debug
                //alert("Longitudine ottenuta: " + long); //debug

                //calcola la distanza solo dopo aver ottenuto la posizione
                let distance=calculateDistance(latStadio, longStadio, lat, long);
                //alert("Distanza dallo stadio: " + distance.toFixed(2) + " km"); //debug
                document.getElementById("distanceStadium").innerHTML = `<strong>Distanza:</strong> ${distance.toFixed(2)} km`;

                calculatePay(distance);
            },
            function () {
                alert("Errore nella geolocalizzazione");
            },
            { timeout: 10000 }
        );
    }

    function calculatePay(distance) {
        if((distance>0 && distance<=200))    
            pay=1000;
        else if(distance>200 && distance<=600)
            pay=3000;
        else if(distance>600)
            pay=5000;

        document.getElementById("payment").innerHTML = `<strong>Compenso:</strong> ${pay} €`;
    }

    if(abilita==="true")
        myPos(); 

    //distance=calculateDistance(latStadio, longStadio, lat, long);
    //alert(distance); //prova stampa distanza


    </script>
</body>
<?php include('../includes/footer.html'); ?>

</html>