<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form id="formTeam1" method="post" action="../pages/referto.php" onsubmit="">

    <?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    require('../pages/referto.php');
    
    //echo "$giocatore1";
    echo " 
        <table id='tableTeams'>

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

    //tabella squadra 2 DA MODIFICARE**********
    echo " 
        <table id='tableTeams'>

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

    ";


    ?>
    <input type="submit" name="send" value="Invia" />
    </form>











<script type="text/javascript">
    var marcatore0 = 0, marcatore1 = 0, ammonito = 0, espulso = 0;
    var goals = 0, gialli = 0, rossi = 0;

    function calcolaStatistiche1(stato, boolean){ //boolean se 0 riguarda squadra1 altrimenti squadra2
        
        str = stato.value.toLowerCase();
        goals = 0, gialli = 0, rossi = 0;

        
        let arrayElements = str.split(", ");

        arrayElements.forEach(element => {
            if(element != "marcatore" && element != "ammonito" && element != "espulso" && element != "assente"){
                
                alert("Assicurati di inserire le stringhe corrette nel campo stato giocatore");
                
            } else if(element.includes("marcatore")){
                goals++;
                stato.disabled = true;
            } 

            if(element.includes("ammonito")){
                gialli++;
                stato.disabled = true;
              
            } 

            if(element.includes("espulso")){
                rossi++;
                stato.disabled = true;
            } 

           
                
        });
        if(!boolean){
            marcatore0  =  marcatore0 + goals;
        } else {
            marcatore1  =  marcatore1 + goals;
        }
        
        ammonito    = ammonito + gialli;
        espulso     = espulso + rossi;
        


    console.log("marcatore0: " + marcatore0);
    console.log("marcatore: " + marcatore1);
    console.log("ammonito: " + ammonito);
    console.log("espulso: " + espulso); 
         
        
    }


    function bloccaMinuto(stato){
        minute = stato.value;

        if(isNaN(minute)){
            alert("Devi inserire un numero");
        } else {
            stato.disabled = true;
        }

        
        
    }


    


    


    
        
        
        

       

        
    




</script>

</body>
</html>
