<?php
    session_set_cookie_params(0);
    session_start();
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>
  <link rel="stylesheet" type="text/css" href="../assets/css/homepageStyle.css">
</head>
<body>

  <?php include '../includes/header.php'; ?>

  <?php 
  if(isset($_SESSION['username'])) { ?>
    <!-- Contenuti per utente autenticato
    <h1>Benvenuto, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <a href="../backend/logout.php">Logout</a>
    <p>Sei autenticato con successo. Ora puoi accedere ai contenuti riservati.</p> -->

    <div id="mainContent"> 
      <p>
        Essere <b>arbitro</b> è molto più che un semplice ruolo, è una passione. L'arbitro è il custode del fair play,
        colui che in campo mantiene il rispetto delle regole e la correttezza tra le due squadre. Essere arbitro significa concentrazione,
        sudore, tanti sacrifici e saper prendere decisioni difficili assumendosi la responsabilità delle proprie scelte. Essere arbitro significa
        rendere unico ogni momento di gioco assicurando alle squadre coinvolte e al pubblico un'esperienza di gioco leale e corretta.
      </p>
    </div>
    <?php 
    } else { ?>
    <!-- <h1>Benvenuto!</h1> -->
    <div id="mainContent"> 
      <!-- <p>
        Questa è la homepage pubblica. Accedi per scoprire contenuti riservati e personalizzati.
      </p> -->
      <p>
        Essere <b>arbitro</b> è molto più che un semplice ruolo, è una passione. L'arbitro è il custode del fair play,
        colui che in campo mantiene il rispetto delle regole e la correttezza tra le due squadre. Essere arbitro significa concentrazione,
        sudore, tanti sacrifici e saper prendere decisioni difficili assumendosi la responsabilità delle proprie scelte. Essere arbitro significa
        rendere unico ogni momento di gioco assicurando alle squadre coinvolte e al pubblico un'esperienza di gioco leale e corretta.
      </p>
      <!-- <p>
        <a href="./login.html">Esegui il login</a> -->
      </p>
    </div>
    <?php } ?>

    <?php include '../includes/footer.html'; ?>

    <?php if(isset($_SESSION['username'])) { ?>
        <script src="../assets/js/homepageJS.js"></script>
    <?php } ?>


</body>
</html>
