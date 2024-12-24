<?php 
       session_start();
       include('../Includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="../Css/style.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Reddit+Mono:wght@200..900&display=swap"
      rel="stylesheet"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/031a9e5271.js"
      crossorigin="anonymous"
    ></script>
    <title>Document</title>
  </head>
  <body>
  <section class="header">
      <nav>
        <h1>
          <i class="fa-solid fa-mug-hot"></i>
          <a href="./index.php">CAFE TRIO</a>
        </h1>
        <ul>
          <li><a href="./index.php">Accueil</a></li>
          <li><a href="./contact.php">Ajouter</a></li>
          <li><a class="active" href="./Lister.php">Lister</a></li>
          
          <li><a href="../Includes/logout.php">Se deconnecter</a></li>
        </ul>
      </nav>
    </section>
        <h1>Page de suppression</h1>
    <section class="contact">
        
    <?php
    
                    $cid = $_GET['codeid'];
                    $sql = "SELECT * FROM clients where code_client=:cid ";
                    $query = $pdo->prepare($sql);
                    $query->bindParam(':cid', $cid, PDO::PARAM_STR);
                    $query->execute();
                    $resultat = $query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount()>0) {
                      foreach ($resultat as $value) {

                ?>
      <form action="./TraitementSupprimerClients.php" method="post" class="contact-form">
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" disabled value="<?php echo $value->nom ?>"/>
        <label for="prenom">prenom</label>
        <input type="text" name="prenom" disabled id="prenom" value="<?php echo $value->prenom ?>"/>
        
        <input type="hidden" name="codeid" value="<?php echo $_GET['codeid'] ?>" />

        <label for="telephone">Telephone</label>
        <input type="telephone" name="telephone" disabled id="telephone" value="<?php echo $value->telephone ?>" />
        

       
      
        <input type="submit" class="btn btn-orange my-20" value="Supprimer ">
      </form>
      <?php }}?>
    </section>
    <footer>
      <p>Copyright @ - 2024</p>
    </footer>
  </body>
</html>
