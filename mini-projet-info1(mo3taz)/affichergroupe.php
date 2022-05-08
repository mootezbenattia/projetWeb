<?php
   session_start();
   if($_SESSION["autoriser"]!="oui"){
      header("location:login.php");
      exit();
   }
   if(date("H")<18)
      $bienvenue="Bonjour et bienvenue ".
      $_SESSION["prenomNom"].
      " dans votre espace personnel";
   else

      $bienvenue="Bonsoir et bienvenue ".
      $_SESSION["prenomNom"].
      " dans votre espace personnel";
      include("./auth-php-mysql/connexion.php");
?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCO-ENICAR Afficher Etudiants</title>
    <!-- Bootstrap core CSS -->
<link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap core JS-JQUERY -->
<script src="./assets/dist/js/jquery.min.js"></script>
<script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="./assets/jumbotron.css" rel="stylesheet">
    <!--icon library-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    

</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">SCO-Enicar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
        
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="index.php" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Groupes</a>              <div class="dropdown-menu" aria-labelledby="dropdown01">
                
                <a class="dropdown-item" href="afficherEtudiantsParClasse.php">Etudiants par Groupe</a>
                <a class="dropdown-item" href="affichergroupe.php">Lister tous les groupes</a>
      
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Etudiants</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="ajouterEtudiant.php">Ajouter Etudiant</a>
                <a class="dropdown-item" href="afficherEtudiants.php">Lister tous les étudiants</a>
      
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Absences</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="absence.php">Saisir Absence</a>
                <a class="dropdown-item" href="etatAbsence.php">État des absences pour un groupe</a>
              </div>
            </li>
      
           
          </ul>
        
      
          <form class="form-inline my-2 my-lg-0">
          <a class="nav-link" href="./auth-php-mysql/deconnexion.php">Se Déconnecter <span class="sr-only">(current)</span></a>
          </form>
        </div>
      </nav>
      
<main role="main">
        <div class="jumbotron">
            <div class="container">
              <h1 class="display-4">Liste des groupes</h1>
              <p>Cliquer sur le bouton afin d'actualiser la liste!</p>
            </div>
          </div>

<div class="container">
<div class="row">
<div class="table-responsive"> 


 <table class="table table-striped table-hover">
  <button type="button" class="btn btn-info my-5"><a href="ajoutergroupe.php" class="text-light"> Ajouter groupe </a></button>
     <!--Ligne Entete-->
     <tr>
         <th>
            ID
         </th>
         <th>
             NomGroupe
         </th>

         <th>
             Actions
         </th>
         
     </tr>
     
     <?php 
 
    
    
     $req="SELECT * FROM groupe";
    $reponse = $pdo->query($req);
    if($reponse->rowCount()>0) {
        
    while ($row = $reponse ->fetch(PDO::FETCH_ASSOC)) {
            $groupe = array();
           echo' <tr>
            <td>'
                .$groupe["id"] = $row["id"].'
            </td>
            <td>'
            .$groupe["nomGroupe"] = $row["nomGroupe"].' 
            </td>
           <td>
           <button type="button" class="btn btn-success"><a href="updategroupe.php ? updateid='.$row["id"].'" class="text-light"><i class="fas fa-edit"></i></a></button>
           <button type="button" class="btn btn-danger"><a href="deletegroupe.php ? deleteid='.$row["id"].'" class="text-light"><i class="far fa-trash-alt"></i></a></button>
           </td>
         
           </tr>';
            
        
    }
    }
    
    
      ?>
 </table>
 <br>
 </div>
 <button  type="button" class="btn btn-primary btn-block active">Actualiser</button>
</div>
</div>

</main>

<div class="container">
<footer class="container text-center m-5">
    <p>&copy; ENICAR 2021-2022</p>
  </footer>
  </div>
</body>
</html>