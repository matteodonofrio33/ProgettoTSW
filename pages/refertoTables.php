<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/refertoTablesStyle.css">
    <title>Document</title>
</head>
<body>

    <?php include('../includes/header.php'); ?>
    <form id="formTeam1" method="post" action="../pages/refert.php" >


    <?php include '../includes/header.php'; ?>

    <form id="formTeam1" method="post" action="../backend/refert.php" >


<?php
//session_start();
require('../backend/players.php');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




   

$squadra1 = isset($_SESSION['squadra1']) ? $_SESSION['squadra1'] : '';
$squadra2 = isset($_SESSION['squadra2']) ? $_SESSION['squadra2'] : '';



/*
echo " Giocatori squadra 1: $giocatore11, $giocatore12, $giocatore13, $giocatore14, $giocatore15, $giocatore16 ";
echo " Giocatori squadra 2: $giocatore21, $giocatore22, $giocatore23, $giocatore24, $giocatore25, $giocatore26";
*/


   // require('../backend/players.php');
    
    //echo "$giocatore1";

    echo "<div class='tables'>";
    echo " 
    <div class='table1'>
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
    </div>
    ";

    //tabella squadra 2 DA MODIFICARE**********
    echo " 
    <div class='table1'>
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

    <input type = 'hidden' name = 'm0' id='m0' value='0' />
    <input type = 'hidden' name = 'm1' id='m1' value='0' />

    ";
    
    ?>
    </form>

    <div id="results">
    <h2>
        <span id="team1Name"><?php echo "$squadra1"; ?></span> 
        <span id="score0">0</span> 
        <span id="score1">0</span> 
        <span id="team2Name"><?php echo "$squadra2"; ?></span>
    </h2>
    <h2>
        <span class="num_ammoniti">Ammoniti: <span id="ammoniti"> 0</span></span>
        <span class="num_espulsi">Espulsi: <span id="espulsioni">0</span></span>
    </h2>


   <!-- Aggiungi il contenitore qui sotto -->
<div id="formControls">
    <label for='numFalli'> 
        Numero falli
        <input id='numFalli' type='number' min='0' step='1' name='numFalli' value='0' required/>
    </label>

    <div id="bottone"> 
        <input type="submit" name="send" value="Invia" /> 
    </div>
</div>

</div>



<script type="text/javascript">
    var marcatore0 = 0, marcatore1 = 0, ammonito = 0, espulso = 0;
    var goals = 0, gialli = 0, rossi = 0;

    function calcolaStatistiche1(stato, boolean){ //boolean se 0 riguarda squadra1 altrimenti squadra2
        
        str = stato.value.toLowerCase();
        goals = 0, gialli = 0, rossi = 0;

        
        let arrayElements = str.split(", ");

        arrayElements.forEach(element => {
            if(element != "marcatore" && element != "ammonito" && element != "espulso" && element != "assente"  && element != "presente"){
                
                alert("Assicurati di insericlearre le stringhe corrette nel campo stato giocatore");
                
            } else if(element.includes("marcatore")){
                goals++;
                stato.readOnly = true;
                
            } 

            if(element.includes("ammonito")){
                gialli++;
                stato.readOnly = true;
              
            } 

            if(element.includes("espulso")){
                rossi++;
                stato.readOnly = true;
            } 
            if(element.includes("assente") || element.includes("presente")){
                
                stato.readOnly = true;
            } 

           
                
        });

        if(!boolean){
            marcatore0  =  marcatore0 + goals;
            let score = document.getElementById("score0");
            score.innerText = marcatore0;

            //aggiornamento del campo nascosto marcatore0 per poter passare il risultato al php
            document.getElementById("m0").value = marcatore0;
            

            
        } else {
            marcatore1  =  marcatore1 + goals;
            let score = document.getElementById("score1");
            score.innerText = marcatore1;

            //aggiornamento del campo nascosto marcatore1 per poter passare il risultato al php
            document.getElementById("m1").value = marcatore1;
        }
        
        ammonito    = ammonito + gialli;
        let giallo = document.getElementById("ammoniti");
        giallo.innerText=ammonito

        espulso     = espulso + rossi;
        let rosso = document.getElementById("espulsioni");
        rosso.innerText=espulso;

        
        

        
    }


    function bloccaMinuto(stato){
        str = stato.value;
        minutes = str.split(", ");

        notNum = false; 
        notInterval = false;

        minutes.forEach(min => {
            if(isNaN(min)){
                notNum = true;
            }else if(min < 1 || min > 90){
                notInterval = true;
            }

        });

        if(notNum){
            alert("Minuto può contenere solo numeri separati da virgola e spazio");
        } else if(notInterval){
            alert("Minuto dev'essere compreso tra 1 e 90");
        } else {
            stato.readOnly = true;
        }
    }


    
</script>

    

</body>

    <?php include('../includes/footer.html'); ?>


</html>
