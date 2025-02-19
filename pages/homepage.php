<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

    session_set_cookie_params(0);
    session_start();
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>

  <link rel="icon" href="../assets/immagini/homepage.ico" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="../assets/css/homepageStyle.css">
</head>
<body> 

  <?php include '../includes/header.php'; ?>

  <?php if(isset($_SESSION['username'])) { ?>
      <script src="../assets/js/homepageJS.js"></script>
      <h1 id="title1">Benvenuto <?php echo htmlspecialchars($_SESSION['username']); ?>, pronto per arbitrare?</h1>
      <?php 
        } else { ?>
          <h1 id="title2">Benvenuto!</h1>
  <?php } ?>

  <?php 
  if(isset($_SESSION['username'])) { ?>
      
  
    
    <?php  
     require ('../backend/conn.php');
     include('../backend/refertQuery.php');  
    
     
     ?>
     

    <div class="videoAuto">
    <video autoplay loop muted width="800">
      <source src="../assets/immagini/arbitriVideo.mp4" type="video/mp4">
      
      Il tuo browser non supporta il tag video.
    </video>
    </div>

    <?php 
    } else { ?>

    <div class="videoAuto">
    <video autoplay loop muted width="800">
      <source src="../assets/immagini/arbitriVideo.mp4" type="video/mp4">
      Il tuo browser non supporta il tag video.<
    </video>
    </div>

    <div id="mainContent"> 

      <p>
        Essere <b>arbitro</b> è molto più che un semplice ruolo, è una passione. L'arbitro è il custode del fair play,
        colui che in campo mantiene il rispetto delle regole e la correttezza tra le due squadre. Essere arbitro significa concentrazione,
        sudore, tanti sacrifici e saper prendere decisioni difficili assumendosi la responsabilità delle proprie scelte. Essere arbitro significa
        rendere unico ogni momento di gioco assicurando alle squadre coinvolte e al pubblico un'esperienza di gioco leale e corretta.
      </p>

      <h3>Perchè abbiamo creato questo sito?</h3>

      <p>
        Abbiamo deciso di creare questo sito per permettere agli arbitri di qualsiasi categoria di avere un'unico potente mezzo per poter
        svolgere le attività burocratiche legate a questo splendido lavoro. Se sei un arbitro ma non hai ancora un account sulla nostra 
        piattaforma ti invitiamo a <a href="./registration.php">registrarti!</a>. 
      </p>

      <h3>Cosa ti offriamo?</h3>

      <p>
        In questa piattaforma, dopo aver effettuato il <a href="./login.html">login</a>, potrai accedere a numerose ed utilissime 
        funzionalità tramite la barra di navigazione:

        <ul>
          <li><a href="#referto">Compilazione referto</a></li>
          <li><a href="#prossimaPartita">Visualizzare la prossima partita</a></li>
          <li><a href="#miePartite">Le mie partite</a></li>
        </ul>
      </p>

      <h3 id="referto">Compilazione referto</h3>

      <p>
        In questa pagina potrai compilare il referto per una partita da te precedentemente arbitrata inserendo in maniera semplice
        ed intuitiva i giocatori presenti, il numero di falli, eventuali marcatori, ammonizioni ed espulsioni ed il minuto nel quale sono
        avvenute.
      </p>

      <h3 id="prossimaPartita">Visualizzare la prossima partita</h3>

      <p>
        In questa pagina potrai visualizzare la prossima partita che ti è stata assegnata, la posizione dello stadio e 
        il calcolo del pagamento in base alla distanza e all'importanza della partita.
      </p>

      <h3 id="miePartite">Le mie partite</h3>

      <p>
        In questa pagina potrai visualizzare le partite che hai arbitrato e refertato ordinate partendo adlla più recente, inoltre
        cliccando su una delle partite potrai visualizzare il referto ad essa associato.
      </p>

      <div>
        <p>
          Se sei arrivato fin qui e ti stai chiedendo come si faccia a far parte della nostra grande famiglia puoi farlo
          cliccando su questo <a href="./request.html">link</a> utile ad inoltrare la tua richiesta per diventare uno di noi!
        </p>
      </div>
     
      </p>
    </div>

    <?php } ?>
    

    


</body>
<?php include '../includes/footer.html'; ?>
</html>
