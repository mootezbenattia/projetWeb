<?php

session_start();




@$login = $_POST["login"];
@$pass = md5($_POST["pass"]);
@$valider = $_POST["valider"];
$erreur = "";
if (isset($valider)) {

  include("<auth-php-mysql/connexion.php");
  $sel = $pdo->prepare("select * from enseignant where login=? and pass=? limit 1");
  $sel->execute(array($login, $pass));
  $tab = $sel->fetchAll();
  if (count($tab) > 0) { {
      $_SESSION["prenomNom"] = ucfirst(strtolower($tab[0]["prenom"])) . " " . strtoupper($tab[0]["nom"]);
      $_SESSION["autoriser"] = "oui";
      header("location:index.php");
    }
  } else
    $erreur = "Mauvais login ou mot de passe!";
}


?>







<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.88.1">
  <title>SCO-ENICAR Se Connecter</title>

  <!-- Bootstrap core CSS -->
  <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">



  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    .alert {
      padding: 20px;
      background-color: #f44336;
      color: white;
    }

    .closebtn {
      margin-left: 15px;
      color: white;
      font-weight: bold;
      float: right;
      font-size: 22px;
      line-height: 20px;
      cursor: pointer;
      transition: 0.3s;
    }

    .closebtn:hover {
      color: black;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="./assets/dist/css/signin.css" rel="stylesheet">
</head>

<body class="text-center" onLoad="document.fo.login.focus()">



  <form id="myForm" class="form-signin" name="fo" method="post" action="">
    <img class="mb-4" src="./assets/brand/user-login.svg" alt="" width="72" height="72">
    <?php
    if (!empty($erreur)) {
      echo '<div class="alert">
         <span class="closebtn" onclick="changeDisplay()" id="d">&times;</span> 
         <strong>' . $erreur . '</strong>.
       </div>';
    } ?>
    <h1 class="h3 mb-3 font-weight-normal">Veuillez vous connecter</h1>
    <label for="inputEmail" class="sr-only">Email </label>
    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name="login">
    <label for="inputPassword" class="sr-only">Mot de Passe</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="pass">

    <button class="btn btn-lg btn-primary btn-block" type="submit" name="valider">Se Connecter</button>
    <br><a href="inscription.php"> Créer un Compte</a>
    <p class="mt-5 mb-3 text-muted">&copy; SOC-Enicar 2021-2022</p>
  </form>
  <script>
   
    function changeDisplay(){
      var x=document.getElementById("d");
      x.parentElement.style.display="none";
    }
  </script>
</body>

</html>