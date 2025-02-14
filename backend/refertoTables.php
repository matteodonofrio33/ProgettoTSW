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
            <td>   <input id='statoGiocatore21' type='text' name='statoGiocatore21'  required  />  </td>
            <td> <input id='minuto21' type='text' name='minuto21'  /> </td>
        </tr>

        <tr>
            <td>$giocatore22</td>
            <td>  <input id='statoGiocatore22' type='text' name='statoGiocatore22'  required  /> </td>
             <td> <input id='minuto22' type='text' name='minuto22'  /> </td>
        </tr>

        <tr>
            <td>$giocatore23</td>
            <td> <input id='statoGiocatore23' type='text' name='statoGiocatore23'  required  /> </td>
             <td> <input id='minuto23' type='text' name='minuto23'  /> </td>
        </tr>

        <tr>
            <td>$giocatore24</td>
            <td> <input id='statoGiocatore24' type='text' name='statoGiocatore24'  required  /> </td>
             <td> <input id='minuto24' type='text' name='minuto24'  /> </td>
        </tr>

        <tr>
            <td>$giocatore25</td>
            <td> <input id='statoGiocatore25' type='text' name='statoGiocatore25'  required  /> </td>
             <td> <input id='minuto25' type='text' name='minuto25'  /> </td>
        </tr>
        <tr>
            <td>$giocatore26</td>
            <td> <input id='statoGiocatore26' type='text' name='statoGiocatore26'  required  /> </td>
             <td> <input id='minuto26' type='text' name='minuto26'  /> </td>
        </tr>



    </table>

    ";


    ?>
    <input type="submit" name="send" value="Invia" />
    </form>

</body>
</html>