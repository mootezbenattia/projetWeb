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
<?php include("./auth-php-mysql/connexion.php");?>

 

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
              <h1 class="display-4">Liste des étudiants</h1>
              <p>Cliquer sur le bouton afin d'actualiser la liste!</p>
            </div>
          </div>

<div class="container">
  <button type="button" class="btn btn-info my-5"><a href="ajouterEtudiant.php" class="text-light"> Ajouter Etudiant </a></button>
 
    
    
  
<div class="row">
<div class="table-responsive"> 
 <table class="table table-striped table-hover">
     <!--Ligne Entete-->
     <tr>
         <th>
             CIN
         </th>
         <th>
         Email  
         </th>
         <th>
         Nom  
         </th>
         <th>
         Prénom
         </th>
         <th>
         Adresse 
         </th>

         <th>
         Classe
         </th>

         <th>
          Actions
         </th>

     </tr>
<?php 
 
 
$req="SELECT * FROM etudiant";
$reponse = $pdo->query($req);
if($reponse->rowCount()>0) {
	
while ($row = $reponse ->fetch(PDO::FETCH_ASSOC)) {
        $etudiants= array();
       echo' <tr>
        <td>'
            .$etudiants["cin"] = $row["cin"].'
        </td>
        <td>'
        .$etudiants["email"] = $row["email"].' 
        </td>
        <td>'
        .$etudiants["nom"] = $row["nom"].'
        </td>
        <td>'
        .$etudiants["prenom"] = $row["prenom"].' 
        </td>
        <td>'
        .$etudiants["adresse"] = $row["adresse"].'
        </td>
        <td>';
        $x=$row['groupeID'];
        $req1="SELECT nomGroupe FROM groupe where id=$x";
        $response1 = $pdo->query($req1);
        $row1 = $response1 ->fetch(PDO::FETCH_ASSOC);
        echo $etudiants["groupeID"] = $row1["nomGroupe"].' 
       </td>
       <td>
       <button type="button" class="btn btn-success"><a href="update.php ? updatecin='.$row["cin"].'" class="text-light"><i class="fas fa-edit"></i></a></button>
       <button type="button" class="btn btn-danger"><a href="delete.php ? deletecin='.$row["cin"].'" class="text-light"><i class="far fa-trash-alt"></i></a></button>
       </td>
     
       </tr>';
        
    
}
}


  ?>
 </table>
 <br>
 </div>
 <button  type="button" class="btn btn-primary btn-block active" onclick="refresh()"  >Actualiser</button> 
</div>
</div>

</main>

<script>
    function refresh() {
        var xmlhttp = new XMLHttpRequest();
        var url = "http://localhost/mini-projet-info1/afficher.php";

    //Envoie de la requete
	xmlhttp.open("GET",url,true);
	xmlhttp.send();


     //Traiter la reponse
     xmlhttp.onreadystatechange=function()
            {  // alert(this.readyState+" "+this.status);
                if(this.readyState==4 && this.status==200){
                
                    myFunction(this.responseText);
                    alert(this.responseText);
                    console.log(this.responseText);
                    //console.log(this.responseText);
                }
            }


    //Parse la reponse JSON
	function myFunction(response){
		var obj=JSON.parse(response);
        //alert(obj.success);

        if (obj.success==1)
        {
		var arr=obj.etudiants;
		var i;
		var out="<table  border=1 >";
		for ( i = 0; i < arr.length; i++) {
			out+="<tr><td>"+
			arr[i].cin +
			"</td><td>"+
			arr[i].nom+
			"</td><td>"+
			arr[i].prenom+
			"</td><td>"+
			arr[i].adresse+
			"</td><td>"+
			arr[i].email+
			"</td></tr>" ;
		}
		out +="</table>";
		document.getElementById("demo").innerHTML=out;
       }
       else document.getElementById("demo").innerHTML="Aucune Inscriptions!";

    }
}
</script> 


<footer class="container">
    <p>&copy; ENICAR 2021-2022</p>
  </footer>
</body>
</html>