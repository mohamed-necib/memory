<?php
require_once 'classes/Player.php';

if (isset($_POST['register'])) {
  $pseudo = htmlspecialchars($_POST['pseudo']);
  $password = htmlspecialchars($_POST['password']);
  $password_confirm = htmlspecialchars($_POST['password_confirm']);
  $score = 0;
}

$player = new Player();
$player->register($pseudo, $password, $password_confirm, $score);
// Affichage Message d'erreur
echo $player->getError();

?>


<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription</title>
</head>

<body>
  <?php require_once "includes/header.php" ?>
  <h1>Inscription</h1>
  <form method="POST" action="">
    <input type="text" name="pseudo" placeholder="Pseudo" />
    <input type="password" name="password" placeholder="Mot de passe" />
    <input type="password" name="password_confirm" placeholder="Confirmation du mot de passe" />
    <input type="submit" name="register" value="Je m'inscris" />
</body>

</html>