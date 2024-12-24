<?php 
  session_start();
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="../Css/style.css" />
    <link
      rel="stylesheet"
      media="only screen and (max-width:500px)"
      href="../Css/style.mobile.css"
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
          <a href="./index.php">Bonjour, <?php echo $_SESSION['prenom']." ".$_SESSION['nom'] ?></a>
        </h1>
        <ul>
          <li><a  href="./index.php">Accueil</a></li>
          <li><a class="active" href="./contact.php">Ajouter</a></li>
          <li><a href="./Lister.php">Lister Clients</a></li> 
          <li><a href="./ListerUser.php">Liste User</a></li>         
          <li><a href="../Includes/logout.php">Se deconnecter</a></li>
        </ul>
      </nav>
    </section>
    <section class="contact">
    <form action="./TraitementAjouterClients.php" method="post" class="contact-form">

        <input type="hidden" name="code_client" value="<?php echo "TRIO-".rand(0001,9000) ?>" />
        
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="name" required />

        <label for="prenom">Prenom</label>
        <input type="text" name="prenom" id="prenom" required/>

        <label for="sexe">Sexe</label>
        Masculin: <input type="radio" name="sexe" id="sexe" value="Masculin" required/>
        Feminin: <input type="radio" name="sexe" id="sexe" value="Feminin" required/> <br/>

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

