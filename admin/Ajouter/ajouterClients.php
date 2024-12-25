<?php 
  session_start();
  if (!isset($_SESSION['prenom_user']) || !isset($_SESSION['nom_user'])) {
    header("Location: ../../connection.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="../../css/style.css" />
    <link
      rel="stylesheet"
      media="only screen and (max-width:500px)"
      href="../../css/style.mobile.css"
    />
    <title>CAFETERIA | ADD CLIENT</title>
    <script
      src="https://kit.fontawesome.com/b7f94dbfeb.js"
      crossorigin="anonymous"
    ></script>
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

    <h1 style="text-align: center;">Ajouter un Clients</h1>
    <section class="contact">
    <form action="../Traitement/TraitementAjouterClients.php" method="post" class="contact-form">

        <input type="hidden" name="code_client" value="<?php echo "Client-".rand(0001,9000) ?>" />
        
        <label for="nom">Nom Client</label>
        <input type="text" name="nom" id="nom" required/>

        <label for="sexe">Type Client</label>
        Etudiant: <input type="radio" name="type_client" id="sexe" value="etudiant" required/>
        Professeur: <input type="radio" name="type_client" id="sexe" value="professeur" required/> <br/>
        Personnel admin: <input type="radio" name="type_client" id="sexe" value="personnel_admin" required/> <br/>
        Inviter: <input type="radio" name="type_client" id="sexe" value="inviter" required/> <br/>

        <label for="telephone">Telephone</label>
        <input type="text" name="telephone" id="telephone" required/>
        
        <input type="submit" class="btn btn-orange my-20" value="envoyer">
    </form>
      </form>
    </section>
        <footer class="fouter">
                <h5>Phoenix @copyright 2024</h5>
            </footer>
  </body>
</html>

