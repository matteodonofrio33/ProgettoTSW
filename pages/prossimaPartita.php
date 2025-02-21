<?php
session_start();
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
            PARTITA.n_giornata AS \"N GIORNATA\",
            PARTITA.data_partita AS \"DATA\"
        FROM REFERTO
        JOIN PARTITA ON REFERTO.id_partita = PARTITA.id_partita
        WHERE REFERTO.id_arbitro = $1
        AND (REFERTO.stato_partita IS NULL OR REFERTO.stato_partita = '');";

$ret = pg_query_params($db, $sql, array($arbitro));
if (!$ret) {
    echo "ERRORE QUERY: " . pg_last_error($db);
    return false;
}

$stadio = null;

if (pg_num_rows($ret) > 0) {
    $row = pg_fetch_assoc($ret);
    $stadio = htmlspecialchars($row["STADIO"] ?? '', ENT_QUOTES, 'UTF-8');
}

$ret = pg_query_params($db, $sql, array($arbitro));
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/prossimaPartitaStyle.css">
    <link rel="icon" href="../assets/immagini/fischietto.ico" type="image/x-icon">
    <title>Prossima partita</title>
</head>
<body>
<?php include '../includes/header.php'; ?>
    <h1>La tua prossima partita sarà:</h1>
    <div id="tableContainer">
        <?php
        if (pg_num_rows($ret) > 0) {
              //creo una riga
              echo "<table><tr>";
     
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
        <img src="../assets/immagini/compenso.png" alt="Meteo Stadio" style="display:none" id="img3">
        <div><p id="payment"></p></div>
    </div>

    <script>
    var latStadio=0;
    var longStadio=0;
    var pay=0;
    var stadio="<?php echo $stadio; ?>"; //recupera il nome dello stadio
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

            div.style.display="flex";
            img1.style.display="flex";
            img2.style.display="flex";
            img3.style.display="flex";
            
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

               

                let distance=calculateDistance(latStadio, longStadio, lat, long);
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

    </script>
</body>
<?php include('../includes/footer.html'); ?>

</html>