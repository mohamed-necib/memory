<?php

class Player
{
  // ATTRIBUTS DE CONNEXION A LA BDD
  private $bdd;
  private $db_name;
  private $db_password;

  //ATTRIBUTS PUBLIC
  public $pseudo;
  public $password;
  public $error;



  public function __construct()
  {
    // CONNEXION A LA BASE DE DONNÉES
    $dsn = "mysql:host=localhost;dbname=memory";
    $db_name = "root";
    $db_password = "root";
    $options = array(
      PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );

    try {
      $this->bdd = new PDO($dsn, $db_name, $db_password, $options);
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      die();
    }
  }

  public function register($pseudo, $password, $password_confirm, $score)
  {
    require_once 'inscription.php';

    if (!empty($pseudo) && !empty($password) && !empty($password_confirm)) {
      $joueurs_length = strlen($pseudo);
      if ($joueurs_length <= 255) {
        if ($password == $password_confirm) {
          $password = password_hash($password, PASSWORD_BCRYPT);
          $insert_user = $this->bdd->prepare("INSERT INTO players(pseudo, password, score) VALUES(?, ?, ?)");
          $insert_user->execute(array($pseudo, $password, $score));
          $error = "Votre compte a bien été créé ! <a href=\"index.php\">Me connecter</a>";
        } else {
          $error = "Vos mots de passes ne correspondent pas !";
        }
      } else {
        $error = "Votre pseudo ne doit pas dépasser 255 caractères !";
      }
    } else {
      $error = "Tous les champs doivent être complétés !";
    }
  }

  public function login($pseudo, $password)
  {
    require_once 'connexion.php';

    if (!empty($pseudo) && !empty($password)) {
      $req_user = $this->bdd->prepare("SELECT * FROM players WHERE pseudo = ?");
      $req_user->execute(array($pseudo));
      $user_exist = $req_user->rowCount();
      if ($user_exist == 1) {
        $user_info = $req_user->fetch();
        $password_verify = password_verify($password, $user_info['password']);
        if ($password_verify) {
          session_start();
          $_SESSION['id'] = $user_info['id'];
          $_SESSION['pseudo'] = $user_info['pseudo'];
          $_SESSION['score'] = $user_info['score'];
          header("Location: game.php?id=" . $_SESSION['id']);
        } else {
          $error = "Mauvais mot de passe !";
        }
      } else {
        $error = "Mauvais pseudo !";
      }
    } else {
      $error = "Tous les champs doivent être complétés !";
    }
  }

  public function logout()
  {
    session_start();
    session_destroy();
    header("Location: connexion.php");
  }
}
