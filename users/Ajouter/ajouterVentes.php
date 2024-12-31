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
    <title>CAFETERIA | ADD VENTES</title>
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
          <li><a href="../Lister/ListerVentes.php">Lister Ventes</a></li> 
          <li><a href="../../Includes/logout.php">Se deconnecter</a></li>
        </ul>
      </nav>
    </section>
    <br><br>
    <h1 style="text-align: center;">Ajouter un Vente</h1>


    <section class="contact">
    <form action="../Traitement/TraitementAjouterVentes.php" method="post" class="contact-form">

        <input type="hidden" name="code_vente" value="<?php echo "Vente-".rand(0001,9000) ?>" />
        
        <label for="code_client">Code Client</label>
        <input type="text" name="code_client" id="code_client" required />

        <label for="code_plat">Code Plat</label>
        <input type="text" name="code_plat" id="code_plat" required/>

        <input type="hidden" name="code_user" value="<?php echo $_SESSION['code_user'] ?>" />


        <label for="quantite">Nombre de Plats</label>
        <input type="number" name="quantite" id="quantite" value="<?php echo 1 ?>" disabled/>

        
        <input type="submit" class="btn btn-orange my-20" value="envoyer">
    </form>
    </section>
        <footer class="fouter">
                <h5>Phoenix @copyright 2024</h5>
            </footer>
  </body>
</html>

