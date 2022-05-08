<?php
include("./auth-php-mysql/connexion.php");
session_start();

if (isset($_POST['classe'])) {
  $classe = $_POST['classe'];
  $req = "select * from etudiant where groupeID =$classe";
  $stmt = $pdo->query($req);
 
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SCO-ENICAR Saisir Absence</title>
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
        <h1 class="display-4">Signaler l'absence pour tout un groupe</h1>
        <p>Pour signaler, annuler ou justifier une absence, choisissez d'abord le groupe, le module puis l'étudiant concerné!</p>
      </div>
    </div>

    <div class="container">
      <form action="" method="POST">
        <div class="form-group">
          <label for="semaine">Choisir une semaine:</label><br>
          <input id="semaine" type="week" name="debut" size="10" class="datepicker" />
        </div>

        <div class="form-group">
          <label for="classe">Choisir un groupe:</label><br>
          <?php
          $req = "SELECT * FROM  groupe ";
          $groupe = $pdo->query($req);
          echo "<select id='classe' name='classe' class='custom-select custom-select-sm custom-select-lg'>";
          while (($row = $groupe->fetch(PDO::FETCH_ASSOC))) {
            echo " <option value='" . $row['id'] . "'>" . $row['nomGroupe'] . "</option>";
          }
          echo "</select>";
          ?>
          <button class="btn btn-danger " name="choisir"> choisir</button><br>
        </div>
        <?php
        if (isset($_POST['choisir'])) {

          echo '<table rules="cols" frame="box">


  <tr><th> listes des étudiants</th>';

        ?>
          <?php
          $w = 7;
          for ($i = 1; $i <= 365; $i++) {
            $week = date("W", mktime(0, 0, 0, 1, $i, date("Y")));
            if ($week == $w) {
              for ($d = 0; $d < 6; $d++) {
                $date = date("l d/m/Y", mktime(0, 0, 0, 1, $i + $d, date("Y")));
                echo '<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">' . date("l" . "\r" . date("d/m/Y"), mktime(0, 0, 0, 1, $i + $d, date("Y"))) . "</th>" . "<br/>";
              }
              break;
            }
          }
          ?>
          <?php
          echo '</tr><tr><td>&nbsp;</td>
<th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th>
</tr>';

          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          ?>
        <?php
            $name = $row["nom"];
            $prenom = $row["prenom"];

            echo '<tr class="row_3"><td><b>' . $name . " " . $prenom . '</b></td>';
            $w = 7;
            for ($i = 1; $i <= 365; $i++) {
              $week = date("W", mktime(0, 0, 0, 1, $i, date("Y")));
              if ($week == $w) {
                for ($d = 0; $d < 6; $d++) {
                  echo '<td><input type="checkbox" name="check[]" value=""></td><td><input type="checkbox" name="check[]" value="' . date("l" . "\r" . date("d/m/Y"), mktime(0, 0, 0, 1, $i + $d, date("Y"))) . '"></td>';
                }
                break;
              }
            }
            echo "</tr>";
          }
        }
        if (isset($_POST['enregister'])) {

          $abscences = $_POST['check'];
          $n = count($abscences);

          for ($i = 0; $i < $n; $i++) {
            var_dump($abscences[$i]);
            $req = "insert into abscence (date) values ($abscences[$i])";
            $reponse = $pdo->exec($req) or die("error");
          }
        }
        ?>




        </table>
        <br>
        <!--Bouton Valider-->
        <button type="submit" class="btn btn-primary btn-block" name="enregister">Valider</button>
      </form>
    </div>
  </main>

  <footer class="container">
    <p>&copy; ENICAR 2021-2022</p>
  </footer>
</body>

</html>