<?php

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données soumises
    $matricule = $_POST["matricule"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $age = $_POST["age"];
    $date_naissance = $_POST["date_naissance"];
    $email = $_POST["email"];
    $telephone = $_POST["telephone"];
    //$photo = $_FILES['photo']['name'];
    $promotion = $_POST["promotion"];
    $annee_certification = $_POST["annee_certification"];

    $message = "";

     /* Enregistrer la photo dans un dossier sur le serveur
    $file_tmp_name=$_FILES['photo']['tmp_name'];
    move_uploaded_file($file_tmp_name,"./images/$photo");*/

    // Connexion à la base de données
    $conn = new mysqli("localhost", "root", "", "portail");

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Erreur de connexion à la base de données: " . $conn->connect_error);
    }

    // Préparer la requête d'insertion
    $sql = "INSERT INTO apprenants (matricule, nom, prenom, age, date_naissance, email, telephone, promotion, annee_certification) 
        VALUES ('$matricule', '$nom', '$prenom', $age, '$date_naissance', '$email', $telephone, '$promotion', $annee_certification)";

    // Exécuter la requête
    if ($conn->query($sql) === TRUE) {
      // $message = '<div class="alert alert-primary" role="alert">Apprenant enregistré avec succès.</div>'
        //echo "";
    } else {
        echo "Erreur lors de l'enregistrement de l'apprenant: " . $conn->error;
    }

    // Récupérer tous les apprenants
$sql = "SELECT * FROM apprenants";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Portail ODK - Liste des apprenants</title>
  <link rel="stylesheet" href="/css/style.css">
  
  <style>

    body {
     border: 2px solid #000000;
}

    table {
  width: 100%;
  border-collapse: collapse;
  border: 2px solid #000;
}

table th,
table td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

table th {
  background-color: #f2f2f2;
}
  </style>
</head>
<body>
  
  <h1>Liste des apprenants</h1>

  <table>
    <thead>
      <tr>
        <th>Matricule</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Age</th>
        <th>Date de naissance</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Photo</th>
        <th>Promotion</th>
        <th>Année de certification</th>
      </tr>
    </thead>
    <tbody>

      <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row['matricule'] . "</td>";
          echo "<td>" . $row['nom'] . "</td>";
          echo "<td>" . $row['prenom'] . "</td>";
          echo "<td>" . $row['age'] . "</td>";
          echo "<td>" . $row['date_naissance'] . "</td>";
          echo "<td>" . $row['email'] . "</td>";
          echo "<td>" . $row['telephone'] . "</td>";
          echo "<td>" . $row['photo'] . "</td>";
          echo "<td>" . $row['promotion'] . "</td>";
          echo "<td>" . $row['annee_certification'] . "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='10'>Aucun apprenant inscrit.</td></tr>";
      }
      ?>
    </tbody>
  </table>

  <?php
  // Fermer la connexion à la base de données
  $conn->close();
  
      
}

?>

