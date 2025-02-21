<?php session_start();
session_set_cookie_params(0);
?>
<!DOCTYPE html>
<html lang="it">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Refert</title>
</head>

<body>


   <?php


   include('../includes/header.php');




   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);

   $giocatore11 = isset($_SESSION['giocatore11']) ? $_SESSION['giocatore11'] : '';
   $giocatore12 = isset($_SESSION['giocatore12']) ? $_SESSION['giocatore12'] : '';
   $giocatore13 = isset($_SESSION['giocatore13']) ? $_SESSION['giocatore13'] : '';
   $giocatore14 = isset($_SESSION['giocatore14']) ? $_SESSION['giocatore14'] : '';
   $giocatore15 = isset($_SESSION['giocatore15']) ? $_SESSION['giocatore15'] : '';
   $giocatore16 = isset($_SESSION['giocatore16']) ? $_SESSION['giocatore16'] : '';



   $team1 = array($giocatore11, $giocatore12, $giocatore13, $giocatore14, $giocatore15, $giocatore16);

   $giocatore21 = isset($_SESSION['giocatore21']) ? $_SESSION['giocatore21'] : '';
   $giocatore22 = isset($_SESSION['giocatore22']) ? $_SESSION['giocatore22'] : '';
   $giocatore23 = isset($_SESSION['giocatore23']) ? $_SESSION['giocatore23'] : '';
   $giocatore24 = isset($_SESSION['giocatore24']) ? $_SESSION['giocatore24'] : '';
   $giocatore25 = isset($_SESSION['giocatore25']) ? $_SESSION['giocatore25'] : '';
   $giocatore26 = isset($_SESSION['giocatore26']) ? $_SESSION['giocatore26'] : '';



   $team2 = array($giocatore21, $giocatore22, $giocatore23, $giocatore24, $giocatore25, $giocatore26);

   $id_arbitro = $_SESSION['id_arbitro'];





   $err = false;
   //prendo gli stati giocatore:
   if (isset($_POST['statoGiocatore11'])) {
      $statoGiocatore11 = $_POST['statoGiocatore11'];
      if (!isValidState($statoGiocatore11)) {

         $err = true;

      }

   } else {
      $statoGiocatore11 = "";
   }


   if (isset($_POST['statoGiocatore12'])) {

      $statoGiocatore12 = $_POST['statoGiocatore12'];

      if (!isValidState($statoGiocatore12))
         $err = true;
   } else {
      $statoGiocatore12 = "";
   }


   if (isset($_POST['statoGiocatore13'])) {
      $statoGiocatore13 = $_POST['statoGiocatore13'];
      if (!isValidState($statoGiocatore13))
         $err = true;
   } else {

      $statoGiocatore13 = "";
   }


   if (isset($_POST['statoGiocatore14'])) {
      $statoGiocatore14 = $_POST['statoGiocatore14'];
      if (!isValidState($statoGiocatore14))
         $err = true;
   } else {

      $statoGiocatore14 = "";
   }


   if (isset($_POST['statoGiocatore15'])) {
      $statoGiocatore15 = $_POST['statoGiocatore15'];
      if (!isValidState($statoGiocatore15))
         $err = true;
   } else {

      $statoGiocatore15 = "";
   }


   if (isset($_POST['statoGiocatore16'])) {
      $statoGiocatore16 = $_POST['statoGiocatore16'];
      if (!isValidState($statoGiocatore16))
         $err = true;
   } else {

      $statoGiocatore16 = "";
   }

   $stati1 = array($statoGiocatore11, $statoGiocatore12, $statoGiocatore13, $statoGiocatore14, $statoGiocatore15, $statoGiocatore16);



   //prendo i minuti giocatore:
   if (isset($_POST['minuto11'])) {
      $minuto11 = $_POST['minuto11'];

      if (!isValidateMin($minuto11)) {
         echo "No valid min";
         $err = true;
      }
   } else {

      $minuto11 = "";
   }


   if (isset($_POST['minuto12'])) {
      $minuto12 = $_POST['minuto12'];

      if (!isValidateMin($minuto12)) {
         echo "No valid min";
         $err = true;
      }
   } else {

      $minuto12 = "";
   }


   if (isset($_POST['minuto13'])) {
      $minuto13 = $_POST['minuto13'];
      if (!isValidateMin($minuto13)) {
         echo "No valid min";
         $err = true;
      }
   } else {

      $minuto13 = "";
   }


   if (isset($_POST['minuto14'])) {
      $minuto14 = $_POST['minuto14'];
      if (!isValidateMin($minuto14)) {
         echo "No valid min";
         $err = true;
      }
   } else {

      $minuto14 = "";
   }


   if (isset($_POST['minuto15'])) {
      $minuto15 = $_POST['minuto15'];
      if (!isValidateMin($minuto15)) {
         echo "No valid min";
         $err = true;
      }
   } else {

      $minuto15 = "";
   }


   if (isset($_POST['minuto16'])) {
      $minuto16 = $_POST['minuto16'];
      if (!isValidateMin($minuto16)) {
         echo "No valid min";
         $err = true;
      }
   } else {

      $minuto16 = "";
   }

   $minuti1 = array($minuto11, $minuto12, $minuto13, $minuto14, $minuto15, $minuto16);

   //prendo gli stati giocatore:
   if (isset($_POST['statoGiocatore21'])) {
      $statoGiocatore21 = $_POST['statoGiocatore21'];
      if (!isValidState($statoGiocatore21))
         $err = true;
   } else
      $statoGiocatore21 = "";

   if (isset($_POST['statoGiocatore22'])) {
      $statoGiocatore22 = $_POST['statoGiocatore22'];
      if (!isValidState($statoGiocatore22))
         $err = true;
   } else
      $statoGiocatore22 = "";

   if (isset($_POST['statoGiocatore23'])) {
      $statoGiocatore23 = $_POST['statoGiocatore23'];
      if (!isValidState($statoGiocatore23))
         $err = true;
   } else
      $statoGiocatore23 = "";

   if (isset($_POST['statoGiocatore24'])) {
      $statoGiocatore24 = $_POST['statoGiocatore24'];
      if (!isValidState($statoGiocatore24))
         $err = true;
   } else
      $statoGiocatore24 = "";

   if (isset($_POST['statoGiocatore25'])) {
      $statoGiocatore25 = $_POST['statoGiocatore25'];
      if (!isValidState($statoGiocatore25))
         $err = true;
   } else
      $statoGiocatore25 = "";

   if (isset($_POST['statoGiocatore26'])) {
      $statoGiocatore26 = $_POST['statoGiocatore26'];
      if (!isValidState($statoGiocatore26))
         $err = true;
   } else
      $statoGiocatore26 = "";


   $stati2 = array($statoGiocatore21, $statoGiocatore22, $statoGiocatore23, $statoGiocatore24, $statoGiocatore25, $statoGiocatore26);


   //prendo i minuti giocatore:
   if (isset($_POST['minuto21'])) {
      $minuto21 = $_POST['minuto21'];
      if (!isValidateMin($minuto21)) {
         echo "No valid min";
         $err = true;
      }
   } else
      $minuto21 = "";

   if (isset($_POST['minuto22'])) {
      $minuto22 = $_POST['minuto22'];
      if (!isValidateMin($minuto22)) {
         echo "No valid min";
         $err = true;
      }
   } else
      $minuto22 = "";

   if (isset($_POST['minuto23'])) {
      $minuto23 = $_POST['minuto23'];
      if (!isValidateMin($minuto23)) {
         echo "No valid min";
         $err = true;
      }
   } else
      $minuto23 = "";

   if (isset($_POST['minuto24'])) {
      $minuto24 = $_POST['minuto24'];
      if (!isValidateMin($minuto24)) {
         echo "No valid min";
         $err = true;
      }
   } else
      $minuto24 = "";

   if (isset($_POST['minuto25'])) {
      $minuto25 = $_POST['minuto25'];
      if (!isValidateMin($minuto25)) {
         echo "No valid min";
         $err = true;
      }
   } else
      $minuto25 = "";

   if (isset($_POST['minuto26'])) {
      $minuto26 = $_POST['minuto26'];
      if (!isValidateMin($minuto26)) {
         echo "No valid min";
         $err = true;
      }
   } else
      $minuto26 = "";


   $minuti2 = array($minuto21, $minuto22, $minuto23, $minuto24, $minuto25, $minuto26);


   $m0 = isset($_POST['m0']) ? (int) $_POST['m0'] : 0;
   $m1 = isset($_POST['m1']) ? (int) $_POST['m1'] : 0;

   if (isset($_POST['numFalli'])) {
      $numFalli = $_POST['numFalli'];
   } else {
      $numFalli = 0;
   }






   if ($err) {

      $message = "Oops si è verificato un errore";
      header("Location: ./error.php?message=" . $message . "&redirect=../pages/homepage.php");
      exit();

   } else {

      require('../backend/conn.php');

      //prelevo l'id_partita tra le partite che si devono refertare:
      $q = "SELECT id_partita
         FROM REFERTO
         WHERE id_arbitro = $1
         AND (stato_partita IS NULL OR stato_partita = ''); ";

      $qr = pg_query_params($db, $q, array($id_arbitro));

      if (!$qr) {

         $message = "Oops si è verificato un errore";
         header("Location: ./error.php?message=" . $message . "&redirect=../pages/homepage.php");
         exit();

      }

      $id_partita = pg_fetch_result($qr, 0, 'id_partita');


      if (!$id_partita) {
         echo "<h1> Non ci sono partite da refertare </h1>";
      } else {
         echo "<h1> ID PARTITA $id_partita </h1>";
      }

      //popolo la tabella  PARTECIPAZIONE sia per la squadra1 che per la squadra2
      inserisciPartecipazione($db, $id_partita, $team1, $stati1, $minuti1);
      inserisciPartecipazione($db, $id_partita, $team2, $stati2, $minuti2);

      //popolo la tabella REFERTO
      $esito = $m0 . "-" . $m1;

      $q = "UPDATE REFERTO
         SET stato_partita = $1, numero_falli = $2, id_arbitro = $3
         WHERE id_partita = $4;
";

      $qr = pg_query_params($db, $q, array($esito, $numFalli, $id_arbitro, $id_partita));

      if (!$qr) {
         // echo "ERRORE QUERY: " . pg_last_error($db);
         $message = "Oops si è verificato un errore";
         header("Location: ./error.php?message=" . $message . "&redirect=../pages/homepage.php");
         exit();
         //return false;
      }


   }


   ?>
   </div>

</body>
<?php include('../includes/footer.html'); ?>

</html>


<?php

function inserisciPartecipazione($db, $id_partita, $team, $stati, $minuti)
{



   //prelevo id_giocatore dato il suo nome
   $id_giocatori = []; //array che conterrà gli id trovati

   foreach ($team as $nome_giocatore) {



      $q = "SELECT id_giocatore
            FROM GIOCATORE
            WHERE nome_giocatore = $1;";

      $qr = pg_query_params($db, $q, array($nome_giocatore));

      if (!$qr) {

         $message = "Oops si è verificato un errore";
         header("Location: ./error.php?message=" . $message . "&redirect=../pages/homepage.php");
         exit();

      }

      $id_giocatore = pg_fetch_result($qr, 0, 'id_giocatore');

      if (!$id_giocatore) {
         $message = "Oops si è verificato un errore";
         header("Location: ./error.php?message=" . $message . "&redirect=../pages/homepage.php");
         exit();
      } else {
         $id_giocatori[] = $id_giocatore;
      }

   }


   foreach ($id_giocatori as $index => $id) {
      $stato = $stati[$index];
      $minuto = $minuti[$index];
      $q = "INSERT INTO PARTECIPAZIONE (id_giocatore, id_partita, stato_giocatore, minuto) 
      VALUES ($1, $2, $3, $4);";
      $qr = pg_query_params($db, $q, array($id, $id_partita, $stato, $minuto));

      if (!$qr) {

         $message = "Oops si è verificato un errore";
         header("Location: ./error.php?message=" . $message . "&redirect=../pages/homepage.php");
         exit();

      } else {
         header("Location: ../pages/homepage.php");
      }
   }


}



?>






<?php
//funzioni utilizzate

function isValidState($str)
{
   $str2 = explode(", ", $str);
   $flag = true;

   foreach ($str2 as $s) {
      if ($s !== "marcatore" && $s !== "ammonito" && $s !== "espulso" && $s !== "assente" && $s !== "presente")
         $flag = false;
   }

   return $flag;
}


function isValidateMin($str)
{//prende la stringa di minuti

   $minutes = explode(", ", $str); //divide la stringa ove presenti ", "
   $notNum = false;
   $notInterval = false;

   foreach ($minutes as $min) { 
      if (is_numeric($min)) {
         $min = (int) $min;
         if (!is_int($min)) {
            $notNum = true;   //setta notNum a true se non è un intero
         } else if ($min < 1 || $min > 90) {
            $notInterval = true; //setta notInterval a true se non è compreso nell'intervallo

         }

      }

   }

   if ($notNum || $notInterval) {
      return false;  //ritorna false se non è un numero o non è nell'intervallo
   }

   return true;   //ritorna true se ha superato i controlli

}

?>

