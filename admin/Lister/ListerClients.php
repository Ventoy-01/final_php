<?php 
  session_start();
  include('../../Includes/config.php');
    if (!isset($_SESSION['prenom_user']) || !isset($_SESSION['nom_user'])) {
        header("Location: ../../connection.php");
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
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/modal.css">
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
                            <a class="nav-link " href="../index.php">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./ListerPlats.php">
                                <i class="fas fa-utensils"></i> Plats
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
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
                                <i class="fas fa-c-tie"></i> Utilisateurs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../Includes/logout.php">
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
                        </div>

                        <li class="nav-item " >  
                               <?php 
                                    echo "Phoenix @copyright 2024";
                                ?>
                        </li>

                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 ">
                <div
                    class="sidebar-header text-center py-3 d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">CAFETERIA DU CHCL</h1>
                </div>
                <?php
                if (isset($_SESSION['success'])) {
                    echo "<div class='alert alert-success'>".$_SESSION['success']."</div>";
                    unset($_SESSION['success']);
                }elseif(isset($_SESSION['error'])){
                    echo "<div class='alert alert-danger'>".$_SESSION['error']."</div>";
                    unset($_SESSION['error']);
                }
                ?>
                <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Liste des Clients</h1>
                    <form action="../Ajouter/ajouterClients.php" method="post">
                        <input type="submit" class="btn btn-orange" id="openModalBtn" value="Ajouter">
                    </form>                
                </div>

                <style>
                .tableau {
                    padding: 100px 50px 100px 50px;
                }

                td,
                th {
                    border: 2px solid black;
                    padding: 10px;
                }

                .text1 {
                    color: black
                }
                </style>
             
                <?php
          $c = $_SESSION['prenom_user'];
          $sql = "SELECT * FROM clients where 1";
          $query = $pdo->prepare($sql);
          $query->execute();
          $resultat = $query->fetchAll(PDO::FETCH_OBJ);
          if ($query->rowCount()>=1) {
            ?>
                <div class="table-responsive">
                <table class="table table-bordered">
                        <tr>
                            <th>Code</th>
                            <th>Nom</th>
                            <th>Type Client</th>
                            <th>Telephone</th>
                            <th>Action</th>
                        </tr>
                        <tbody>
                            <?php
          }
          else{
            echo "<div class='alert alert-danger'>".'Aucune Clients'."</div>";

            
          
          }
          ?>
                    <?php
                    $sql = "SELECT * FROM clients where 1";
                    $query = $pdo->prepare($sql);
                    $query->execute();
                    $resultat = $query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount()>=1) {
                      foreach ($resultat as $value) {

                ?>
                            <tr>
                                <td><?php echo $value->code_client; ?></td>
                                <td><?php echo $value->nom_client; ?></td>                
                                <td><?php echo $value->type_client; ?></td>
                                <td><?php echo $value->phone_client; ?></td>
                                <td>
                                    <a href="../Modifier/modifierClients.php?codeid=<?php echo $value->code_client; ?>" class="btn-small btn-small-warning" title="Modifier">
                                        <i class="fas fa-edit"></i> Modifier
                                    </a>
                                    <a href="../Traitement/TraitementSupprimerClients.php?codeid=<?= $value->code_client; ?>" class="btn-small btn-small-danger"
                                    onclick="return confirm('Voulez-vous vraiment supprimer ce Client ?')">
                                        <i class="fas fa-trash"></i>Supprimer
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        <?php }}?>
                    </table>

            </main>
            <!-- <footer class="fouter">
                <h5>Phoenix @copyright 2024</h5>
            </footer> -->
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Script -->
    <script src="../../js/script.js"></script>
</body>

</html>