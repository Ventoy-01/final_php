<?php 
  session_start();
  // if(isset(($_SESSION['code_user']) AND ($_SESSION['code_user'])) !==null) {
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
                            <a class="nav-link" href="./ListerPlats.php">
                                <i class="fas fa-utensils"></i> Plats
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./ListerClients.php">
                                <i class="fas fa-users"></i> Clients
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./ListerVentes.php">
                                <i class="fas fa-shopping-cart"></i> Vente
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./ListerUsers.php">
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
                                 echo $_SESSION['prenom']." ".$_SESSION['nom'];
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
                <div class="row">
                    <div class="col-md-3">
                        <div class="card text-white bg-prime mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Total Ventes aujourd.</h5>
                                <p class="card-text">75</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-su mb-3">
                            <div class="card-body" <h5 class="card-title">Delivered</h5>
                                <p class="card-text">357</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-da mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Canceled</h5>
                                <p class="card-text">65</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-war mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Revenue</h5>
                                <p class="card-text">$128</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="row mt-4 cercle">
                    <div class="col-md-3">
                        <canvas id="totalOrdersChart"></canvas>
                        <p class="text-center mt-2">Total Orders</p>
                    </div>
                    <div class="col-md-3">
                        <canvas id="customerGrowthChart"></canvas>
                        <p class="text-center mt-2">Customer Growth</p>
                    </div>
                    <div class="col-md-3">
                        <canvas id="totalRevenueChart"></canvas>
                        <p class="text-center mt-2">Total Revenue</p>
                    </div>
                </div>

                <div id="myModal" class="modal">

                    <!-- Modal Content  -->
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
                </div>
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