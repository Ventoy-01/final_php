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
          <a href="../index.php">Bonjour, <?php echo $_SESSION['prenom_user']." ".$_SESSION['nom_user'] ?></a>
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
                    $sql = "SELECT * FROM users where code_user=:cid ";
                    $query = $pdo->prepare($sql);
                    $query->bindParam(':cid', $cid, PDO::PARAM_STR);
                    $query->execute();
                    $resultat = $query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount()>0) {
                      foreach ($resultat as $value) {

                ?>
      <form action="../Traitement/TraitementModifierUsers.php" method="post" class="contact-form">

        <input type="hidden" name="codeid" value="<?php echo $value-> code_user?>" />

        <label for="nom_user">Nom</label>
        <input type="text" name="nom_user" id="nom"  value="<?php echo $value->nom_user ?>" required/>

        <label for="prenom_user">prenom</label>
        <input type="text" name="prenom_user" id="prenom" value="<?php echo $value->prenom_user ?>" required/>

        <label for="role_user">Role</label>
        User: <input type="radio" name="role_user" id="role_user" value="user" required/>
        Admin: <input type="radio" name="role_user" id="role_user" value="admin" required/> <br/>
        Super: <input type="radio" name="role_user" id="role_user" value="super" required/> <br/>  
    
        <label for="pseudo_user">Pseudo User</label>
        <input type="text" name="pseudo_user" value="<?php echo $value->pseudo_user ?>" id="pseudo_user" required/>

        <label for="password_user">Password</label>
        <input type="password" name="password_user" placeholder="Laisser vide pour conserver l'ancien mot de passe" id="password" />

        <input type="hidden" name="password_hidden" id="password" value="<?php echo $value->password_user ?>" required/>

        <input type="submit" class="btn btn-orange my-20" value="Modifier">
      </form>
      <?php }}?>
    </section>
    <footer>
      <p>Copyright @ - 2024</p>
    </footer>
  </body>
</html>