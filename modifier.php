<?php
// Récupérer l'ID de l'apprenant à modifier depuis la requête GET ou POST
$apprenantId = $_GET['id']; 

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les nouvelles valeurs des champs du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    // Récupérer les autres champs du formulaire de la même manière

    // Se connecter à la base de données
    $conn = new mysqli('localhost', 'root', '', 'portail');

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion à la base de données : " . $conn->connect_error);
    }

    // Exécuter la requête de mise à jour
    $sql = "UPDATE apprenants SET nom = '$nom', prenom = '$prenom' WHERE id = $apprenantId";

    if ($conn->query($sql) === TRUE) {
        echo "Informations de l'apprenant mises à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour des informations de l'apprenant : " . $conn->error;
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>
