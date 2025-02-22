<!DOCTYPE html>
<html lang="it">

<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta name="description" content="Sito pensato per gli arbitri e per la crezione di referti."> 
  <meta name="keywords" content="arbitro, referto, partita, goals, ammonito, espulso, fallo.">
  
    <link rel="stylesheet" type="text/css" href="../assets/css/refertoTablesStyle.css">
    <title>refertoTables</title>
    <link rel="icon" href="../assets/immagini/fischietto.ico" type="image/x-icon">

</head>

<body>

    <?php include '../includes/header.php'; ?>



    <form id="formTeam1" method="post" action="../backend/refert.php">
        <div class="all">
            <?php
            require('../backend/players.php');


            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);


//tabella squadra1
            echo " 
    
    <div id='tables'>
        <table id='tableTeam1'>

        <tr>
            <th>Nome Giocatore</th>
            <th>Stato Giocatore</th>
            <th>Minuto</th>
        </tr>

        <tr>
            <td>$giocatore11</td>
            <td>   <input id='statoGiocatore11' type='text' name='statoGiocatore11'  required onchange='calcolaStatistiche1(this, 0)' />  </td>
            <td> <input id='minuto11' type='text' name='minuto11' onchange='bloccaMinuto(this)' /> </td>
        </tr>

        <tr>
            <td>$giocatore12</td>
            <td>  <input id='statoGiocatore12' type='text' name='statoGiocatore12'  required onchange='calcolaStatistiche1(this, 0)' /> </td>
             <td> <input id='minuto12' type='text' name='minuto12' onchange='bloccaMinuto(this)' /> </td>
        </tr>

        <tr>
            <td>$giocatore13</td>
            <td> <input id='statoGiocatore13' type='text' name='statoGiocatore13'  required onchange='calcolaStatistiche1(this, 0)' /> </td>
             <td> <input id='minuto13' type='text' name='minuto13' onchange='bloccaMinuto(this)' /> </td>
        </tr>

        <tr>
            <td>$giocatore14</td>
            <td> <input id='statoGiocatore14' type='text' name='statoGiocatore14'  required onchange='calcolaStatistiche1(this, 0)' /> </td>
             <td> <input id='minuto14' type='text' name='minuto14' onchange='bloccaMinuto(this)' /> </td>
        </tr>

        <tr>
            <td>$giocatore15</td>
            <td> <input id='statoGiocatore15' type='text' name='statoGiocatore15'  required  onchange='calcolaStatistiche1(this, 0)'/> </td>
             <td> <input id='minuto15' type='text' name='minuto15' onchange='bloccaMinuto(this)' /> </td>
        </tr>
        <tr>
            <td>$giocatore16</td>
            <td> <input id='statoGiocatore16' type='text' name='statoGiocatore16'  required onchange='calcolaStatistiche1(this, 0)' /> </td>
             <td> <input id='minuto16' type='text' name='minuto16' onchange='bloccaMinuto(this)' /> </td>
        </tr>



        </table>
    
    ";

            //tabella squadra2
            echo " 
    
        <table id='tableTeam2'>

        <tr>
            <th>Nome Giocatore</th>
            <th>Stato Giocatore</th>
            <th>Minuto</th>
        </tr>

        <tr>
            <td>$giocatore21</td>
            <td>   <input id='statoGiocatore21' type='text' name='statoGiocatore21'  required  onchange='calcolaStatistiche1(this, 1)' />  </td>
            <td> <input id='minuto21' type='text' name='minuto21' onchange='bloccaMinuto(this)' /> </td>
        </tr>

        <tr>
            <td>$giocatore22</td>
            <td>  <input id='statoGiocatore22' type='text' name='statoGiocatore22'  required  onchange='calcolaStatistiche1(this, 1)' /> </td>
             <td> <input id='minuto22' type='text' name='minuto22' onchange='bloccaMinuto(this)' /> </td>
        </tr>

        <tr>
            <td>$giocatore23</td>
            <td> <input id='statoGiocatore23' type='text' name='statoGiocatore23'  required  onchange='calcolaStatistiche1(this, 1)' /> </td>
             <td> <input id='minuto23' type='text' name='minuto23' onchange='bloccaMinuto(this)' /> </td>
        </tr>

        <tr>
            <td>$giocatore24</td>
            <td> <input id='statoGiocatore24' type='text' name='statoGiocatore24'  required onchange='calcolaStatistiche1(this, 1)' /> </td>
             <td> <input id='minuto24' type='text' name='minuto24' onchange='bloccaMinuto(this)' /> </td>
        </tr>

        <tr>
            <td>$giocatore25</td>
            <td> <input id='statoGiocatore25' type='text' name='statoGiocatore25'  required onchange='calcolaStatistiche1(this, 1)' /> </td>
             <td> <input id='minuto25' type='text' name='minuto25' onchange='bloccaMinuto(this)' /> </td>
        </tr>
        <tr>
            <td>$giocatore26</td>
            <td> <input id='statoGiocatore26' type='text' name='statoGiocatore26'  required onchange='calcolaStatistiche1(this, 1)' /> </td>
             <td> <input id='minuto26' type='text' name='minuto26' onchange='bloccaMinuto(this)' /> </td>
        </tr>




    </table>
    </div>

    <input type = 'hidden' name = 'm0' id='m0' value='0' />
    <input type = 'hidden' name = 'm1' id='m1' value='0' />
    
    
    
    ";

            ?>

            <div id="results">

                <div class="res12">
                    <div class="res1">
                        <span id="team1Name">
                            <h2><?php echo "$squadra1"; ?> </h2>
                        </span>
                        <span id="score0">0</span>
                    </div>

                    <div class="res2">
                        <span id="team2Name">
                            <h2><?php echo "$squadra2"; ?> </h2>
                        </span>
                        <span id="score1">0</span>

                    </div>
                </div>


                <div class="count">
                    <span class="num_ammoniti">
                        <h3> Ammoniti </h3><span id="ammoniti"> 0</span>
                    </span>

                    <span class="num_espulsi">
                        <h3>Espulsi </h3><span id="espulsioni">0</span>
                    </span>
                </div>


                <div id="formControls">
                    <label for='numFalli'>
                        Numero falli
                        <input id='numFalli' type='number' min='0' step='1' name='numFalli' value='0' required />
                    </label>

                    <div id="bottone">
                        <input type="submit" name="send" value="Invia" />
                    </div>
                </div>

            </div>
    </form>

    </div>


    <script type="text/javascript">
        var marcatore0 = 0, marcatore1 = 0, ammonito = 0, espulso = 0;
        var goals = 0, gialli = 0, rossi = 0;

        function calcolaStatistiche1(stato, boolean) { //boolean se 0 riguarda squadra1 altrimenti squadra2

            str = stato.value.toLowerCase();
            goals = 0, gialli = 0, rossi = 0;


            let arrayElements = str.split(", ");

            arrayElements.forEach(element => {
                if (element != "marcatore" && element != "ammonito" && element != "espulso" && element != "assente" && element != "presente") {

                    alert("Assicurati di inserire le stringhe corrette nel campo stato giocatore");

                } else if (element.includes("marcatore")) {
                    goals++;
                    stato.readOnly = true;

                }

                if (element.includes("ammonito")) {
                    gialli++;
                    stato.readOnly = true;

                }

                if (element.includes("espulso")) {
                    rossi++;
                    stato.readOnly = true;
                }
                if (element.includes("assente") || element.includes("presente")) {

                    stato.readOnly = true;
                }



            });

            if (!boolean) {
                marcatore0 = marcatore0 + goals;
                let score = document.getElementById("score0");
                score.innerText = marcatore0;

                //aggiornamento del campo nascosto marcatore0 per poter passare il risultato al php
                document.getElementById("m0").value = marcatore0;



            } else {
                marcatore1 = marcatore1 + goals;
                let score = document.getElementById("score1");
                score.innerText = marcatore1;

                //aggiornamento del campo nascosto marcatore1 per poter passare il risultato al php
                document.getElementById("m1").value = marcatore1;
            }

            ammonito = ammonito + gialli;
            let giallo = document.getElementById("ammoniti");
            giallo.innerText = ammonito

            espulso = espulso + rossi;
            let rosso = document.getElementById("espulsioni");
            rosso.innerText = espulso;





        }


        function bloccaMinuto(stato) {
            str = stato.value;
            minutes = str.split(", ");

            notNum = false;
            notInterval = false;

            minutes.forEach(min => {
                if (isNaN(min)) {
                    notNum = true;
                } else if (min < 1 || min > 90) {
                    notInterval = true;
                }

            });

            if (notNum) {
                alert("Minuto può contenere solo numeri separati da virgola e spazio");
            } else if (notInterval) {
                alert("Minuto dev'essere compreso tra 1 e 90");
            } else {
                stato.readOnly = true;
            }
        }



    </script>



</body>

<?php include('../includes/footer.html'); ?>


</html>