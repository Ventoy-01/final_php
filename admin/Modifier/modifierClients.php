<?php 
    session_start();
    include('../../Includes/config.php');
    if (!isset($_SESSION['prenom_user']) || !isset($_SESSION['nom_user'])) {
      header("Location: ../../connection.php");
      exit;
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="../../css/style.css" />
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
          <a href="../index.php">Bonjour, <?php $_SESSION['prenom_user']." ".$_SESSION['nom_user'] ?></a>
        </h1>
        <ul>
          <li><a href="../Lister/ListerClients.php">Lister Clients</a></li> 
          <li><a href="../../Includes/logout.php">Se deconnecter</a></li>
        </ul>
      </nav>
    </section>
        <h1 style="text-align: center;">Formulaire de modification</h1>
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
                <form action="../Traitement/TraitementModifierClients.php" method="post" class="contact-form">

                    <input type="hidden" name="codeid" value="<?php echo $value-> code_client?>" />

                                        
                    <label for="nom_client">Nom Client</label>
                    <input type="text" name="nom_client" id="nom" value="<?php echo $value-> nom_client?>" required/>

                    <label for="sexe">Type Client</label>
                    Etudiant: <input type="radio" name="type_client" id="sexe" value="etudiant" required/>
                    Professeur: <input type="radio" name="type_client" id="sexe" value="professeur" required/> <br/>
                    Personnel admin: <input type="radio" name="type_client" id="sexe" value="personnel_admin" required/> <br/>
                    Inviter: <input type="radio" name="type_client" id="sexe" value="inviter" required/> <br/>

                    <label for="phone_client">Telephone</label>
                    <input type="text" name="phone_client" id="phone_client" value="<?php echo $value-> phone_client?>" required/>
                                <input type="submit" class="btn btn-orange my-20" value="Modifier">
                </form>
                <?php }}?>
    </section>
    <footer>
      <p>Copyright @ - 2024</p>
    </footer>
  </body>
</html>