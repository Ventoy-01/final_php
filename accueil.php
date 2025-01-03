<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/accueil.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Nanum+Myeongjo&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>La Cafétéria du CHCL | Accueil</title>
</head>

<body>
    <!-- Navigation -->
    <section class="header">
        <nav>
            <ul>
                <h1>
                    <i class="fa-solid fa-mug-hot"></i>
                    <a href="./accueil.php">La Cafétéria du CHCL</a>
                </h1>
                <div class="lien">
                    <li><a class="btn" href="./connection.php">Login</a></li>
                    <li><a class="btn" href="./users/Ajouter/AutoAddUsers.php">Sign Up</a></li>
                </div>
            </ul>
        </nav>
    </section>

    <!-- Header -->
    <header>
        <div class="head">
            <div class="headcontent">
                <h2 class="double">
                    Découvrez <span class="change-color">nos saveurs</span> au cœur de votre quotidien
                </h2>
                <p class="text1">
                    Plongez dans une expérience culinaire unique où chaque plat est préparé avec soin et passion.
                    Savourez des recettes authentiques, créées pour ravir vos papilles.
                </p>
            </div>
        </div>
    </header>

    <!-- Main content -->
    <main>
        <div class="title1">Nos Spécialités Gourmandes</div>

        <!-- Cards Section -->
        <section class="section-card">
            <div class="cards">
                <div class="card">
                    <img class="img" src="./images/barbecue.webp" alt="Barbecue">
                    <div class="description">
                        <p>Riz au Poulet Rôti</p>
                        <p>Accompagné d'une sauce savoureuse</p>
                        <div class="ligne"></div>
                        <div class="prix">
                            <p>94$ - 120$</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <img class="img" src="./images/pizza.jpg" alt="Pizza">
                    <div class="description">
                        <p>Pizza Deluxe</p>
                        <p>11 ingrédients exquis pour un goût parfait</p>
                        <div class="ligne"></div>
                        <div class="prix">
                            <p>€15 - €20</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <img class="img" src="./images/viande.jpeg" alt="Viande">
                    <div class="description">
                        <p>Steak de Bœuf</p>
                        <p>450g avec légumes frais</p>
                        <div class="ligne"></div>
                        <div class="prix">
                            <p>€25 - €30</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <img class="img" src="./images/bon_gout" alt="Plat">
                    <div class="description">
                        <p>Pâté Sec</p>
                        <p>Servi avec une sauce poulet délicieuse</p>
                        <div class="ligne"></div>
                        <div class="prix">
                            <p>9$ - 20$</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Info Section -->
        <section class="card-info">
            <img src="./images/banner.png" alt="Bannière">
            <div class="text">
                <h2>Une équipe de <span class="change-color">chefs passionnés</span> à votre service</h2>
                <p>
                    Avec plus de 10 ans d'expertise, notre équipe se dédie à vous offrir des plats de qualité
                    supérieure, alliant tradition et modernité. Venez partager un moment de bonheur autour de nos
                    créations culinaires.
                </p>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="pied">
        <p>&copy; Phoenix 2024 | Tous droits réservés</p>
    </footer>

    <script src="https://kit.fontawesome.com/f546fde413.js" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
</body>

</html>