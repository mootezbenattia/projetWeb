<?php
  include("./auth-php-mysql/connexion.php");
  if(isset($_GET['deletecin'])){
      $cin=$_GET['deletecin'];
      $req="delete from etudiant where cin=$cin";
      $reponse = $pdo->query($req);
      if($reponse){
         header('location:afficherEtudiants.php');
         // echo"delete successfully";
      }else
      echo"error";

  }



 ?>