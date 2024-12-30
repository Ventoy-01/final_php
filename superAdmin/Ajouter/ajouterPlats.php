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
    <title>CAFETERIA | ADD PLATS</title>
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
          <li><a href="../Lister/ListerPlats.php">Lister Plats</a></li> 
          <li><a href="../../Includes/logout.php">Se deconnecter</a></li>
        </ul>
      </nav>
    </section>

    <section class="contact">
    <form action="../Traitement/TraitementAjouterPlats.php" method="post" class="contact-form">

        <input type="hidden" name="code_plat" value="<?php echo "Plat-".rand(0001,9000) ?>" />
        
        <label for="nom">Nom Plat</label>
        <input type="text" name="nom" id="nom" required />

        <label for="cuisson_plat">Type Cuisson</label>
        Cru: <input type="radio" name="cuisson_plat" id="cuisson_plat" value="Cru" required/>
        Cuit: <input type="radio" name="cuisson_plat" id="cuisson_plat" value="Cuit" required/> <br/>
        Grille: <input type="radio" name="cuisson_plat" id="cuisson_plat" value="Grille" required/> <br/>        

        <label for="prix">Prix</label>
        <input type="number" name="prix" id="prix" required/>
        
        <label for="quantite">Quantite Plats</label>
        <input type="number" name="quantite" id="quantite" required/>
        
        <input type="submit" class="btn btn-orange my-20" value="envoyer">
    </form>
      </form>
    </section>
        <footer class="fouter">
                <h5>Phoenix @copyright 2024</h5>
            </footer>
  </body>
</html>

