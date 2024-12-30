<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="./css/accueil.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Reddit+Mono:wght@200..900&display=swap"
      rel="stylesheet"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/031a9e5271.js"
      crossorigin="anonymous"
    ></script>
    <title>Connexion</title>
  </head>
  <body>
    <!-- Header -->
    <section class="header">
      <nav>
        <ul>
          <h1>
            <i class="fa-solid fa-mug-hot"></i>
            <a href="./index.html">CAFETERIA DU CHCL</a>
          </h1>
            <li><a class="btn" href="./accueil.php">Les Plats</a></li>
        </ul>
      </nav>
    </section>

    <!-- Contact Section -->
    <section class="contact">
      <form action="./TraitementLogin.php" method="post" class="contact-form">
        <h2>Connexion</h2>
        <div class="form-group">
          <label for="pseudo_user">Pseudo</label>
          <input
            type="text"
            name="pseudo_user"
            id="pseudo_user"
            placeholder="Entrez votre pseudo"
            required
          />
        </div>
        <div class="form-group">
          <label for="password_user">Mot de passe</label>
          <input
            type="password"
            name="password_user"
            id="password_user"
            placeholder="Entrez votre mot de passe"
            required
          />
        </div>
        <button type="submit" class="btn btn-orange">Se connecter</button>
      </form>
    </section>

    <!-- Footer -->
    <footer class="pied">
        <p>Phoenix @copyright 2024</p>
    </footer>
  </body>
</html>
