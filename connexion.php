<?php
require_once 'classes/Player.php';

if (isset($_POST['login'])) {
  $pseudo = htmlspecialchars($_POST['pseudo']);
  $password = htmlspecialchars($_POST['password']);
  
}
$player = new Player();
$player->login($pseudo, $password);
// Affichage Message d'erreur
echo $player->getError();

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CONNEXION</title>
</head>

<body>
  <?php require_once "includes/header.php" ?>
  <h1>Connexion</h1>
  <form method="POST" action="">
    <input type="text" name="pseudo" placeholder="Pseudo" />
    <input type="password" name="password" placeholder="Mot de passe" />
    <input type="submit" name="login" value="Je me connecte" />
</body>

</html>