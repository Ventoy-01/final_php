<?php 
  session_start();
  include('../Includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- fontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/modal.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block sidebar shadow-sm">
                <div class="position-sticky">
                    <div class="sidebar-header text-center py-3">
                        <h4 class="cafeteria-title">Cafeteria</h4>
                        <p class="text-muted">Tableau de bord de l'administration</p>
                    </div>
                    <ul class="nav flex-column">
                        <!-- Sidebar Links -->
                        <li class="nav-item"><a class="nav-link" href="./index.php"><i class="fas fa-home"></i> Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="./ListerPlats.php"><i class="fas fa-utensils"></i> Plats</a></li>
                        <li class="nav-item"><a class="nav-link" href="./ListerClients.php"><i class="fas fa-users"></i> Clients</a></li>
                        <li class="nav-item"><a class="nav-link" href="./ListerVentes.php"><i class="fas fa-shopping-cart"></i> Vente</a></li>
                        <li class="nav-item"><a class="nav-link active" href="#"><i class="fas fa-user-tie"></i> Utilisateurs</a></li>
                        <li class="nav-item"><a class="nav-link" href="../Includes/logout.php"><i class="fas fa-sign-out-alt"></i> Se déconnecter</a></li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                 <div
                    class="sidebar-header text-center py-3 d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">CAFETERIA DU CHCL</h1>
                </div>

                <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Liste des Utilisateurs</h1>
                    <form action="./ajouterUsers.php" method="post">
                        <input type="submit" class="btn btn-orange" id="openModalBtn" value="Ajouter">
                    </form>                
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Rôle</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM users";
                            $query = $pdo->prepare($sql);
                            $query->execute();
                            $resultat = $query->fetchAll(PDO::FETCH_OBJ);
                            foreach ($resultat as $value) {
                            ?>
                            <tr>
                                <td><?php echo $value->code_user; ?></td>
                                <td><?php echo $value->nom; ?></td>
                                <td><?php echo $value->prenom; ?></td>
                                <td><?php echo $value->email; ?></td>
                                <td><?php echo $value->role; ?></td>
                                <td>
                                    <?php if($value->role == 'user'){
                                        ?>
                                        <a href="./modifierUsers.php?codeid=<?php echo $value->code_user; ?>" class="btn-small btn-small-warning" title="Modifier">
                                            <i class="fas fa-edit"></i> Modifier
                                        </a>
                                        <a href="./supprimerUsers.php?codeid=<?php echo $value->code_user; ?>" class="btn-small btn-small-danger" title="Supprimer">
                                            <i class="fas fa-trash"></i> Supprimer
                                        </a>
                                    </td>
                                    <?php }
                                    else{
                                        echo "Action non autorisée";
                                    }
                                    ?>

                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!-- pours les admin et super -->
                 
            </main>
        </div>
    </div>
  

    <!-- Bootstrap JS Bundle -->
    <footer class="fouter">
            <h5>Phoenix @copyright 2024</h5>
        </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/script.js"></script>
</body>


</html>
