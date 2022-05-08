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
?>
<?php
  include("./auth-php-mysql/connexion.php");
  $cin=$_GET['updatecin'];   
  $req="SELECT * FROM etudiant where cin=$cin";
  $reponse = $pdo->query($req);
  $row = $reponse ->fetch(PDO::FETCH_ASSOC);
    $nom=$row['nom'];
    $prenom=$row['prenom'];
    $email=$row['email'];
    $cin=$row['cin'];
    $classe=$row['classe'];
    $adresse=$row['adresse'];

  if(isset($_POST['update'])){
    $nom1=$_POST['nom'];
    $prenom1=$_POST['prenom'];
    $email1=$_POST['email'];
    $cin1=$_POST['cin'];
    $classe1=$_POST['classe'];
    $adresse1=$_POST['adresse'];
       $req="update etudiant set cin=$cin1,email='$email1',nom='$nom1',prenom='$prenom1',adresse='$adresse1',groupeID='$classe1' where cin=$cin";
       $reponse = $pdo->query($req);
       if($reponse){
         header('location:afficherEtudiants.php');
          //echo"updated successfully";
      }else
      echo"error";
}
    
    
    
  


   ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCO-ENICAR Ajouter Etudiant</title>
    <!-- Bootstrap core CSS -->
<link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap core JS-JQUERY -->
<script src="./assets/dist/js/jquery.min.js"></script>
<script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="./assets/jumbotron.css" rel="stylesheet">

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
              <a class="nav-link dropdown-toggle" href="index.php" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Groupes</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                
                <a class="dropdown-item" href="afficherEtudiantsParClasse.php">Etudiants par Groupe</a>
                <a class="dropdown-item" href="affichergroupe.php">Lister tous les groupes</a>
      
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Etudiants</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
               
                <a class="dropdown-item" href="afficherEtudiants.php">Lister tous les étudiants</a>
      
      
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Absences</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="absence.php">Saisir Absence</a>
                <a class="dropdown-item" href="etatAbsencephp">État des absences pour un groupe</a>
              </div>
            </li>
      
            <li class="nav-item active">
              <a class="nav-link" href="./auth-php-mysql/deconnexion.php">Se Déconnecter <span class="sr-only">(current)</span></a>
            </li>
      
          </ul>
        
      
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Saisir un groupe" aria-label="Chercher un groupe">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Chercher Groupe</button>
          </form>
        </div>
      </nav>
      
<main role="main">
        <div class="jumbotron">
            <div class="container">
              <h1 class="display-4">Modifier un étudiant</h1>
              <p>Remplir le formulaire ci-dessous afin de modifier un étudiant!</p>
              <br>
            </div>
          </div>


<div class="container">
 <form id="myform" method="POST" action="">
     <div class="form-group">
     <label for="nom">Nom:</label><br>
     <input type="text" id="nom" name="nom" class="form-control" required autofocus value=<?php echo $nom;?> >
    </div>
     <!--Prénom-->
     <div class="form-group">
     <label for="prenom">Prénom:</label><br>
     <input type="text" id="prenom" name="prenom" class="form-control" required  value=<?php echo $prenom;?> >
    </div>
     <!--Email-->
     <div class="form-group">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" class="form-control" required value=<?php echo $email;?> >
       </div>
     <!--CIN-->
     <div class="form-group">
     <label for="cin">CIN:</label><br>
     <input type="text" id="cin" name="cin"  class="form-control"   required pattern="[0-9]{8}" title="8 chiffres" value=<?php echo $cin;?>>
    </div>
     
     <!--Classe-->
     <div class="form-group">
     <label for="classe">Classe:</label><br>
     <?php
      $req="SELECT * FROM  groupe ";
      $groupe=$pdo->query($req);
      echo "<select id='classe' name='classe' class='custom-select custom-select-sm custom-select-lg'>";
      while(($row = $groupe->fetch(PDO::FETCH_ASSOC))){
      echo" <option value='".$row['id']."'>".$row['nomGroupe']."</option>";
  }
  echo"</select>";
  ?>
     <!--Adresse-->
     <div class="form-group">
     <label for="adresse">Adresse:</label><br>
     <textarea id="adresse" name="adresse" rows="10" cols="30" class="form-control" required ><?php echo $adresse;?>
     </textarea>
    </div>
     <!--Bouton Ajouter-->
     <button  type="submit" class="btn btn-primary btn-block"  name="update" onclick="ajouter()" >Update</button>


 </form> 
</div>  
</main>
<div id="demo"></div>

<script>
    function ajouter()
    {
        var xmlhttp = new XMLHttpRequest();
        var url="http://localhost/mini-projet-info1(mo3taz)/ajouterEtudiant.php";
        
        //Envoie Req
        xmlhttp.open("POST",url,true);

        form=document.getElementById("myForm");
        formdata=new FormData(form);

        xmlhttp.send(formdata);

        //Traiter Res

        xmlhttp.onreadystatechange=function()
            {   
                if(this.readyState==4 && this.status==200){
                // alert(this.responseText);
                    if(this.responseText=="OK")
                    {
                        document.getElementById("demo").innerHTML="L'ajout de l'étudiant a été bien effectué";
                        document.getElementById("demo").style.backgroundColor="green";
                    }
                    else
                    {
                        document.getElementById("demo").innerHTML="L'étudiant est déjà inscrit, merci de vérifier le CIN";
                        document.getElementById("demo").style.backgroundColor="#fba";
                    }
                }
            }
        
        
    }
    </script>
    

<footer class="container">
    <p>&copy; ENICAR 2021-2022</p>
  </footer>

<script  src="./assets/dist/js/inscrire.js"></script>
</body>
</html>