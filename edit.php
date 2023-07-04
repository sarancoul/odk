<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données soumises
    $target = "uploads/";    
    $promotion = $_POST["promotion"];
    $matricule = $_POST["matricule"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $age = $_POST["age"];
    $date_naissance = $_POST["date_naissance"];
    $email = $_POST["email"];
    $telephone = $_POST["telephone"];
   // $photo = $matricule.".".strtolower(pathinfo($_FILES['photo']['name'],PATHINFO_EXTENSION));// ($_FILES['photo']['name']);
   
    $annee_certification = $_POST["annee_certification"];
    $message = "";

   // var_dump($matricule);
     //Enregistrer la photo dans un dossier sur le serveur
   // $file_tmp_name=$_FILES['photo']['tmp_name'];
    
  //  move_uploaded_file($file_tmp_name,"uploads/".$photo);

    // Connexion à la base de données
    $conn = new PDO("mysql:host=localhost;dbname=portail", "root", "");

  

    // Préparer la requête d'insertion
    $req = $conn->prepare("UPDATE apprenants SET  nom =?, prenom =?, age =?, date_naissance =?, email =?, telephone =?,
     promotion =?,  annee_certification =?  WHERE matricule =?");

//'$matricule', '$nom', '$prenom', $age, '$date_naissance', '$email', $telephone, '$promotion', '$photo', $annee_certification
    // Exécuter la requête
    if ($req->execute([$nom,$prenom, $age, $date_naissance, $email, $telephone, $promotion, $annee_certification,$matricule])) {
      // $message = '<div class="alert alert-primary" role="alert">Apprenant enregistré avec succès.</div>'
     //   echo " successs";
        header('location:liste_apprenant.php');
    } else {
        echo "Erreur lors de l'enregistrement de l'apprenant: " . $conn->error;
    }


  // Fermer la connexion à la base de données

    
}