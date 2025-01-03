<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="../css/accueil.css" />
    <link href="https://fonts.googleapis.com/css2?family=Reddit+Mono:wght@200..900&display=swap" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/031a9e5271.js" crossorigin="anonymous"></script>
    <title>Modifier Mot de Passe Admin</title>
</head>

<body>
    <!-- Header -->
    <section class="header">
        <nav>
            <ul >
                <h1>
                    <i class="fa-solid fa-mug-hot"></i>
                    <a href="./index.html">CAFETERIA DU CHCL</a>
                </h1>
                <li style="padding-left: 70%;"><a class="btn" href="./index">Retour</a></li>
            </ul>
        </nav>
    </section>

    <!-- Modification Mot de Passe Section -->
    <section class="contact">
        <form action="./Traitement/TraitementChangeAdminPassword.php" method="post" class="contact-form">
            <h2>Modifier votre mot de passe</h2>
            <div class="form-group">
                <label for="pseudo_user">Pseudo</label>
                <input type="text" name="pseudo_user" id="pseudo_user" placeholder="Entrez votre pseudo" required />
            </div>
            <div class="form-group">
                <label for="old_password">Ancien Mot de Passe</label>
                <input type="password" name="old_password" id="old_password" placeholder="Entrez votre ancien mot de passe"
                    required />
            </div>
            <div class="form-group">
                <label for="new_password">Nouveau Mot de Passe</label>
                <input type="password" name="new_password" id="new_password" placeholder="Entrez votre nouveau mot de passe"
                    required />
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmer Nouveau Mot de Passe</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirmez votre nouveau mot de passe"
                    required />
            </div>
            <button type="submit" class="btn btn-orange">Modifier le mot de passe</button>
        </form>
    </section>

    <!-- Footer -->
    <footer class="pied">
        <p>Phoenix @copyright 2024</p>
    </footer>
</body>

</html>
