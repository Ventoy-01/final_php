<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="Css/style.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Reddit+Mono:wght@200..900&display=swap"
      rel="stylesheet"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/031a9e5271.js"
      crossorigin="anonymous"
    ></script>
    <title>Inscription</title>
  </head>
  <body>
    <section class="header">
      <nav>
        <h1>
          <i class="fa-solid fa-mug-hot"></i>
          <a href="./index.html"></a>CAFETERIA DU CHCL
        </h1>
        <ul>
          
          <li><a class="" href="./connection.php">Se connecter</a></li>
        </ul>
      </nav>
    </section>

    <section class="contact">
      <form action="Controlleur/TraitementSubscribe.php" method="post" class="contact-form">
      <label for="nom">Nom utilisateur: </label>
      <input type="text" name="user" id="user" /> 
      <label for="nom">Email: </label>
        <input type="email" name="email" id="email" />
        <label for="prenom">Password: </label>
        <input type="password" name="password" id="password" />
       
        <input type="submit" class="btn btn-orange my-20" value="S'inscrire">
      </form>
    </section>
    <footer>
      <h2>Jonas Clocin @copyright 2024</h2>
    </footer>
  </body>
</html>
