<?php 
  //connect to db
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "gestion-etudiants";
  
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="INSERT INTO enseignant(id, date, nom, prenom, login, pass) VALUES
    (1, '2022-03-12 15:58:08', 'Saad', 'Walid', 'walid.saadd@gmail.com', '25f9e794323b453885f5181f1b624d0b')";
    $conn->exec($sql);
    echo "new record created succssefully";
  }catch(PDOException $e) {
    echo"error" . "<br>" . $e->getMessage();
  }
   ?>