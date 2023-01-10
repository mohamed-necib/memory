<?php
require_once "classes/Player.php";
session_start();
if (isset($_POST['deconnexion'])) {
  $deconnexion = new Player();
  $deconnexion->logout();
}

?>



<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
</head>

<body>

  <header>
    <nav>
      <ul>
        <?php if (!isset($_SESSION['pseudo'])) : ?>
          <li><a href="index.php">Accueil</a></li>
          <li><a href="inscription.php">Inscription</a></li>
          <li><a href="connexion.php">Connexion</a></li>

        <?php else : ?>
          <form method="post" action="">
            <input type="submit" name="deconnexion" value="Se déconnecter">
            <button><a href="game.php">Jouer</a></button>
          </form>
        <?php endif; ?>
      </ul>
    </nav>

  </header>

</body>

</html>