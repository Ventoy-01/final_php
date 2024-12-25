<?php 
  session_start();
    include('../Includes/config.php');
    if (!isset($_SESSION['prenom_user']) || !isset($_SESSION['nom_user'])) {
        header("Location: ../connection.php");
        exit;
    }
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
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./Lister/ListerPlats.php">
                                <i class="fas fa-utensils"></i> Plats
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./Lister/ListerClients.php">
                                <i class="fas fa-users"></i> Clients
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./Lister/ListerVentes.php">
                                <i class="fas fa-shopping-cart"></i> Vente
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./Lister/ListerUsers.php">
                                <i class="fas fa-user-tie"></i> Utilisateurs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../Includes/logout.php">
                                <i class="fas fa-sign-out-alt"></i> Se deconnecter
                            </a>
                        </li>

                        <!--  -->
                        <div class="user-connect">
                            <li>
                                <i class="fas fa-user-circle"></i>
                                <?php 
                                 echo $_SESSION['prenom_user']." ".$_SESSION['nom_user'];
                                ?>
                            </li>
                            <li style="padding-left: 40px;">
                                <?php 
                                echo "Droit : ".$_SESSION['role'];
                                ?>
                            </li> 
                        </div>

                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="sidebar-header text-center py-3 d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">CAFETERIA DU CHCL</h1>
                </div>

                <!-- Stat Cards -->
                <?php
                    $code_user = $_SESSION['code_user'];
                    // Requête pour compter les ventes effectuées aujourd'hui
                    $sqlVentes = "SELECT COUNT(*) as totalVentes FROM ventes WHERE DATE(date_vente) = CURDATE() AND code_user = '$code_user'";
                    $queryVentes = $pdo->prepare($sqlVentes);
                    $queryVentes->execute();
                    $ventes = $queryVentes->fetch(PDO::FETCH_ASSOC)['totalVentes'];
                ?>

                <div class="row">
                    <div class="col-md-3">
                        <div class="card text-white bg-prime mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Vos Ventes aujourd.</h5>
                                <p class="card-text"><?php echo $ventes; ?></p>
                            </div>
                        </div>
                    </div>

                    <?php
                        $sqlc = "SELECT COUNT(*) as total FROM clients";
                        $queryc = $pdo->prepare($sqlc);
                        $queryc->execute();
                        $clients = $queryc->fetch(PDO::FETCH_ASSOC)['total'];
                    ?>

                    <div class="col-md-3">
                        <div class="card text-white bg-su mb-3">
                            <div class="card-body">
                                 <h5 class="card-title">Total Clients</h5>
                                <p class="card-text"><?php echo $clients; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                        $sqlc = "SELECT COUNT(*) as total FROM users";
                        $queryc = $pdo->prepare($sqlc);
                        $queryc->execute();
                        $users = $queryc->fetch(PDO::FETCH_ASSOC)['total'];
                    ?>
                    <div class="col-md-3">
                        <div class="card text-white bg-da mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Total Users</h5>
                                <p class="card-text"><?php echo $users; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                        $revenu = 0;

                        // Requête pour calculer le revenu total des ventes d'aujourd'hui
                        $sqlRevenu = "
                            SELECT SUM(ventes.nbre_plat * plats.prix_plat) AS revenuTotal 
                            FROM ventes 
                            JOIN plats ON ventes.code_plat = plats.code_plat 
                            WHERE DATE(ventes.date_vente) = CURDATE()
                            AND ventes.code_user = '$code_user'
                        ";

                        $queryRevenu = $pdo->prepare($sqlRevenu);
                        $queryRevenu->execute();
                        $result = $queryRevenu->fetch(PDO::FETCH_ASSOC);

                        if ($result && $result['revenuTotal'] !== null) {
                            $revenu = $result['revenuTotal'];
                        } else {
                            $revenu = 0; // Aucun revenu trouvé
                        }

                    ?>


                    <div class="col-md-3">
                        <div class="card text-white bg-war mb-3">
                            <div class="card-body">
                                <h5 class="card-title"> Vos Rev. Ajourd.</h5>
                                <p class="card-text"><?php echo $revenu ." HTG"; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                
                
                <!-- les grapiques 1 -->
                <!-- Charts -->
                <div style="margin-bottom: 70px;" class="row mt-4 cercle">
                    <!--  -->
                    <?php
                    try {
                        // Requête pour compter les utilisateurs par rôle
                        $sqlRoles = "
                            SELECT role_user, COUNT(*) AS count 
                            FROM users 
                            GROUP BY role_user
                        ";
                        $queryRoles = $pdo->prepare($sqlRoles);
                        $queryRoles->execute();
                    
                        // Stockez les résultats dans un tableau associatif
                        $rolesCounts = [
                            'admin' => 0,
                            'super' => 0,
                            'user' => 0
                        ];
                    
                        foreach ($queryRoles->fetchAll(PDO::FETCH_ASSOC) as $row) {
                            if (array_key_exists($row['role_user'], $rolesCounts)) {
                                $rolesCounts[$row['role_user']] = (int)$row['count'];
                            }
                        }
                    
                        // Encodez les données en JSON pour les injecter dans le JS
                        echo "<script>
                            const rolesData = " . json_encode($rolesCounts) . ";
                        </script>";
                    } catch (Exception $e) {
                        echo "Erreur : " . $e->getMessage();
                    }             
                    
                    ?>

                    <!--  -->
                    <div class="col-md-3">
                        <canvas id="totalOrdersChart"></canvas>
                        <p class="text-center mt-2">Users per Classes</p>
                    </div>

                    <!-- les graphiques 2  -->

                    <?php
                    try {
                        // Requête pour compter les clients par type_client
                        $sqlType = "
                            SELECT type_client, COUNT(*) AS count 
                            FROM clients 
                            GROUP BY type_client
                        ";
                        $queryType = $pdo->prepare($sqlType);
                        $queryType->execute();

                        // Stockez les résultats dans un tableau associatif
                        $typeCounts = [
                            'etudiant' => 0,
                            'professeur' => 0,
                            'personnel_admin' => 0,
                            'inviter' => 0
                        ];

                        foreach ($queryType->fetchAll(PDO::FETCH_ASSOC) as $row) {
                            if (array_key_exists($row['type_client'], $typeCounts)) {
                                $typeCounts[$row['type_client']] = (int)$row['count'];
                            }
                        }

                        // Encodez les données en JSON pour les injecter dans le JS
                        echo "<script>
                            const roleData = " . json_encode($typeCounts) . ";
                        </script>";
                    } catch (Exception $e) {
                        echo "Erreur : " . $e->getMessage();
                    }
                    ?>

                    <!-- les graphiques 3 -->
                    <div class="col-md-3">
                        <canvas id="customerGrowthChart"></canvas>
                        <p class="text-center mt-2">Clients per Type</p>
                    </div>
                    <!--  -->
                    <?php
                        try {
                            // Requête pour compter les ventes d'aujourd'hui
                            $sqlVentes = "SELECT COUNT(*) AS ventesAujourdhui FROM ventes WHERE DATE(date_vente) = CURDATE()";
                            $queryVentes = $pdo->prepare($sqlVentes);
                            $queryVentes->execute();
                            $ventesAujourdhui = (int)$queryVentes->fetch(PDO::FETCH_ASSOC)['ventesAujourdhui'];

                            // Requête pour le total des clients inscrits
                            $sqlClients = "SELECT COUNT(*) AS totalClients FROM clients";
                            $queryClients = $pdo->prepare($sqlClients);
                            $queryClients->execute();
                            $totalClients = (int)$queryClients->fetch(PDO::FETCH_ASSOC)['totalClients'];

                            // Encodez les données en JSON
                            echo "<script>
                                const ventesAujourdhui = $ventesAujourdhui;
                                const totalClients = $totalClients;
                            </script>";
                        } catch (Exception $e) {
                            echo "Erreur : " . $e->getMessage();
                        }
                        ?>

                    <!--  -->
                    <div class="col-md-3">
                        <canvas id="totalRevenueChart"></canvas>
                        <p class="text-center mt-2">Clients et Vente aujourd.</p>
                    </div>
                </div>

                <!-- <div id="myModal" class="modal">

                    Modal Content  
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2>Generer un rapport</h2>
                            <span class="close">&times;</span>
                        </div>
                        <div class="modal-body">
                            <form action="../html2pdffinal/file.php" method="post" class="contact-form">
                                <label for="date_deb">Date debut</label>
                                <input type="date" name="date_deb" id="date_deb" />
                                <label for="date_fin">Date fin</label>
                                <input type="date" name="date_fin" id="date_fin" />
                                <input type="submit" class="btn btn-orange my-20" value="envoyer">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="genere">
                    <button id="myBtn" class="btn btn-orange my-10"><i class="fa-solid fa-file-pdf"></i> Générer un
                        rapport</button>
                </div> -->
            </main>

            <footer class="fouter">
                <h5>Phoenix @copyright 2024</h5>
            </footer>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Script -->
    <script src="../js/script.js"></script>
</body>

</html>
<?php
  // };
  ?>