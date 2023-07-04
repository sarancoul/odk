<?php
$conn = new mysqli("localhost", "root", "", "portail");
$req = "";
// Vérifier la connexion
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données: " . $conn->connect_error);
}
if(isset($_GET['id'])){
    // ajouter d'un requette qui nous permettre d'afficher tous les apprenants ;
    $req = $_GET['id'];
}else{
    die("Il y'a rien a supprimé vas t'en");
}


    // Récupérer tous les apprenants
    $sql = "DELETE FROM apprenants WHERE id=".$req;
    $result = $conn->query($sql);
    if($result){
        header('location:liste_apprenant.php');
    }
 
?>