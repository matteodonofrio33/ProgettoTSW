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
            <td>   <input id='statoGiocatore11' type='text' name='statoGiocatore11'  required  />  </td>
            <td> <input id='minuto11' type='text' name='minuto11'  /> </td>
        </tr>

        <tr>
            <td>$giocatore12</td>
            <td>  <input id='statoGiocatore12' type='text' name='statoGiocatore12'  required  /> </td>
             <td> <input id='minuto12' type='text' name='minuto12'  /> </td>
        </tr>

        <tr>
            <td>$giocatore13</td>
            <td> <input id='statoGiocatore13' type='text' name='statoGiocatore13'  required  /> </td>
             <td> <input id='minuto13' type='text' name='minuto13'  /> </td>
        </tr>

        <tr>
            <td>$giocatore14</td>
            <td> <input id='statoGiocatore14' type='text' name='statoGiocatore14'  required  /> </td>
             <td> <input id='minuto14' type='text' name='minuto14'  /> </td>
        </tr>

        <tr>
            <td>$giocatore15</td>
            <td> <input id='statoGiocatore15' type='text' name='statoGiocatore15'  required  /> </td>
             <td> <input id='minuto15' type='text' name='minuto15'  /> </td>
        </tr>
        <tr>
            <td>$giocatore16</td>
            <td> <input id='statoGiocatore16' type='text' name='statoGiocatore16'  required  /> </td>
             <td> <input id='minuto16' type='text' name='minuto16'  /> </td>
        </tr>



    </table>

    ";


    ?>
    <input type="submit" name="send" value="Invia" />
    </form>

</body>
</html>