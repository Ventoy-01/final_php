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
    <link rel="stylesheet" media="only screen and (max-width:500px)" href="../../css/style.mobile.css" />
    <title>CAFETERIA | ADD USERS</title>
    <script src="https://kit.fontawesome.com/b7f94dbfeb.js" crossorigin="anonymous"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
</head>

<body>
    <section class="header">
        <nav>
            <h1>
                <i class="fa-solid fa-mug-hot"></i>
                <a href="../index.php">Bonjour, <?php echo $_SESSION['prenom_user']." ".$_SESSION['nom_user'] ?></a>
            </h1>
            <ul>
                <li><a href="../Lister/ListerUsers.php">Lister Users</a></li>
                <li><a href="../../Includes/logout.php">Se deconnecter</a></li>
            </ul>
        </nav>
    </section>
    <br><br>
    <h1 style="text-align: center;">Ajouter un Utilisateur</h1>

    <div class="form-container">
        <form action="../Traitement/TraitementAjouterUsers.php" method="post" class="contact-form ">
            <!-- Champ caché pour le code utilisateur généré automatiquement -->
            <input type="hidden" name="code_user" value="<?php echo htmlspecialchars(('User-'.rand(0001,9000) )); ?>" />

            <!-- Champ caché pour définir le rôle par défaut -->
            <input type="hidden" name="role_user" value="user" />

            <!-- Nom -->
            <label for="nom_user">Nom</label>
            <input type="text" name="nom_user" id="nom_user" required />

            <!-- Prénom -->
            <label for="prenom_user">Prénom</label>
            <input type="text" name="prenom_user" id="prenom_user" required />

            <!-- Pseudo -->
            <label for="pseudo_user">Pseudo</label>
            <input type="text" name="pseudo_user" id="pseudo_user" required />

            <!-- Mot de passe -->
            <label for="password_user">Mot de passe</label>
            <input type="password" name="password_user" id="password_user" required minlength="4" />

            <!-- Bouton de soumission -->
            <input type="submit" class="btn btn-orange my-20" value="Valider" />
        </form>
    </div>




    </section>
    <footer class="fouter">
        <h5>Phoenix @copyright 2024</h5>
    </footer>
    <script src="../js/script.js"></script>
</body>

</html>