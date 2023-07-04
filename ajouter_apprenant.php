<?php

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données soumises
    $target = "uploads/";    
    $promotion = $_POST["promotion"];
    $matricule = $_POST["promotion"].generer_matricule(4);
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $age = $_POST["age"];
    $date_naissance = $_POST["date_naissance"];
    $email = $_POST["email"];
    $telephone = $_POST["telephone"];
    $photo = $matricule.".".strtolower(pathinfo($_FILES['photo']['name'],PATHINFO_EXTENSION));// ($_FILES['photo']['name']);
   
    $annee_certification = $_POST["annee_certification"];
    $message = "";

     //Enregistrer la photo dans un dossier sur le serveur
    $file_tmp_name=$_FILES['photo']['tmp_name'];
    
    move_uploaded_file($file_tmp_name,"uploads/".$photo);

    // Connexion à la base de données
    $conn = new mysqli("localhost", "root", "", "portail");

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Erreur de connexion à la base de données: " . $conn->connect_error);
    }

    // Préparer la requête d'insertion
    $sql = "INSERT INTO apprenants (matricule, nom, prenom, age, date_naissance, email, telephone, promotion, photo, annee_certification) 
        VALUES ('$matricule', '$nom', '$prenom', $age, '$date_naissance', '$email', $telephone, '$promotion', '$photo', $annee_certification)";

    // Exécuter la requête
    if ($conn->query($sql) === TRUE) {
      // $message = '<div class="alert alert-primary" role="alert">Apprenant enregistré avec succès.</div>'
        //echo "";
        header('location:liste_apprenant.php');
    } else {
        echo "Erreur lors de l'enregistrement de l'apprenant: " . $conn->error;
    }


  // Fermer la connexion à la base de données
  $conn->close();
    
}
//générer le matricule automatiquement
function generer_matricule($longueur) {
  $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  $matricule = '';
  $maxIndex = strlen($caracteres) - 1;

  for ($i = 0; $i < $longueur; $i++) {
      $randomIndex = rand(0, $maxIndex);
      $matricule .= $caracteres[$randomIndex];
  }

  return $matricule;
}

?>

