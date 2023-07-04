<!-- definir la limite de la liste à afficher au nombre de 10 -->
<?php
$conn = new mysqli("localhost", "root", "", "portail");
$req = "order by id DESC LIMIT 10 ";
// Vérifier la connexion
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données: " . $conn->connect_error);
}
if(isset($_GET['app']) && $_GET['app'] == "all"){
    // ajouter d'un requette qui nous permettre d'afficher tous les apprenants ;
    $req = "";
}

    // Récupérer tous les apprenants
    $sql = "SELECT * FROM apprenants ".$req;
    //echo $sql;
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Portail ODK - Liste des apprenants</title>
  <script src="modal.js" defer></script>
  <link rel="stylesheet" href="css/modal.css">
  
  <style>

    body {
 
}
    table {
  /* width: 100%; */
   border-collapse: collapse;  
}

table th,
table td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #000;
  /* width: 100%; */

}
/* la couleur des antete de la table */
table th {
  background: linear-gradient(45deg, orange, tomato); 
}
.button {
  display: inline-block;
  background-color: #ff7d01;
  color: #fff;
  padding: 10px 20px;
  text-decoration: none;
  border-radius: 8px;
  cursor: pointer;
  background: linear-gradient(45deg, orange, tomato);
}

.btn{
  
  background-color: #000;
  color: #fff;
  padding: 10px 20px;
  
  width: 40px;
  text-decoration: none;
  border-radius:  50px;
  cursor: pointer;
 
}

header {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
/* //le rond des images   */
 .img-thumb{ 
    width: 50px;
    height: 50px;
    border-radius: 75px;
    border: 1px solid #ff7d01;
}
.modal {
    display:none;
    position: fixed;
    background: rgba(0,0,0,0.6);
    height: 100%;
    vertical-align: middle;
    text-align: center;
    left: 0;
    right: 0;
    MARGIN: AUTO
}
a.wastedbasket{
        font-size:28px;
        color: red;
        opacity: 0.7;
        cursor: pointer;
        text-decoration:none;
}
a.wastedbasket:hover{
    opacity:1;
}
  </style>
</head>

<body>
    <div id="modal" class="modal">
        <form action="edit.php" method="post">
        <div class="modal-container">
            <img id="imgModal" class="modalElem" src="images/profil.jpg" alt="">
            <!-- <label for="nom">Nom</label> -->
            <input type="text" class="modalElem" id="matricule" name="matricule" readonly value="P1KJDH" required>

            <input type="text" class="modalElem" id="nom" name="nom" value="Coulibaly" required>
            
            <!-- <label for="prenom">Prenom</label> -->
            <input type="text" class="modalElem" id="prenom" name="prenom" value="Saran" required>
        
            <!-- <label for="age">Âge</label> -->
            <input type="number" class="modalElem" id="age" name="age"  value="20" required>
        
            <!-- <label for="date_naissance">Date de naissance</label> -->
            <input type="date" class="modalElem" id="date_naissance" name="date_naissance" value="2003-01-01" required>
        
            <!-- <label for="email">Adresse e-mail</label> -->
            <input type="email" class="modalElem" id="email" name="email" value="example@gmail.com" required>
    
            <!-- <label for="telephone">Numéro de téléphone</label> -->
            <input type="tel" class="modalElem" id="telephone" name="telephone" value="89789876" required>
            
            <!-- <label for="promotion">Promotion</label> -->
            <input type="text" class="modalElem" id="promotion" name="promotion" value="P2" required>
            
            <!-- <label for="annee_certification">Année de certification:</label> -->
            <input type="text" class="modalElem" id="annee_certification" name="annee_certification" value="2023" required>

        </div>
        </form>
    </div>
    
  <header>
    <h1 style="padding-left:10px">Liste des apprenants</h1>
    <a href="Accueil.html" class="button">Ajouter un apprenant</a>
    <a href="index.html" class="btn">Retour</a>
 </header>
  

  <table>
    <thead>
      <tr>
        <th>Photo</th>
        <th>Matricule</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Age</th>
        <th>Date de naissance</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Promotion</th>
        <th>Année de certification</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
    <!-- En résumé, ce code génère une table HTML à partir des données de la base de données, avec une image, des informations personnelles et des liens pour supprimer des lignes -->
      <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
           $imgsrc = ($row['photo'] == null ) ? 'images/defautl.png' : "uploads/".$row['photo'];
          echo "<tr class='rows'>";
          echo "<td><img class='img-thumb' src='" .$imgsrc. "'></td>";
          echo "<td>" . $row['matricule'] . "</td>";
          echo "<td>" . $row['nom'] . "</td>";
          echo "<td>" . $row['prenom'] . "</td>";
          echo "<td>" . $row['age'] . "</td>";
          echo "<td>" . $row['date_naissance'] . "</td>";
          echo "<td>" . $row['email'] . "</td>";
          echo "<td>" . $row['telephone'] . "</td>";
          echo "<td>" . $row['promotion'] . "</td>";
          echo "<td>" . $row['annee_certification'] . "</td>";
          echo "<td><a href='delete.php?id=". $row['id'] ."' class='wastedbasket'>&#128465; </a><a href='edit.php?id=". $row['id'] ."' class='wastedbasket'>&#9998;</a></td>";
          //echo "<td><a href='modifier.php?id=".$row['id']."' classe='modifier'>&#128465</a></td>";
          
          echo "</tr>";
          
          
        }
      } else {
        echo "<tr><td colspan='10'>Aucun apprenant inscrit.</td></tr>";
      }
      ?>
    </tbody>
  </table>

<!-- //button qui permet d'afficher le reste du contenu de la page si ca depasse 10 -->
    <?php if(!isset($_GET['app'])):?>
    <div style="text-align:center">
        <a href="liste_apprenant.php?app=all" class="button">Afficher tout</a>
    </div>
    
    <?php endif?>

</body>

</html>