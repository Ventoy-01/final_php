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
                        <li class="nav-item">
                            <a class="nav-link " href="./index.php">
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
                            <a class="nav-link" href="../Includes/logout.php">
                                <i class="fas fa-sign-out-alt"></i> Se deconnecter
                            </a>
                        </li>

                        <!--  -->
                        <div class="c-connect">
                            <li>
                                <i class="fas fa-c-circle"></i>
                                <?php 
              echo $_SESSION['prenom']." ".$_SESSION['nom'];
              ?>
                            </li>
                        </div>

                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 ">
                <div
                    class="sidebar-header text-center py-3 d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">CAFETERIA DU CHCL</h1>
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
                    <form action="./ajouterClients.php" method="post" class="contact-form">
                    <input type="submit" class="btn btn-orange my-20" value="Ajouter">
                </form>
                <?php
          $c = $_SESSION['prenom'];
          $sql = "SELECT * FROM clients where 1";
          $query = $pdo->prepare($sql);
          $query->execute();
          $resultat = $query->fetchAll(PDO::FETCH_OBJ);
          if ($query->rowCount()>=1) {
            ?>
                <section class="tableau">
                    <table style="border-collapse:collapse;">
                        <tr>
                            <th>Code</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Sexe</th>
                            <th>Telephone</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        <tbody>
                            <?php
          }
          else{
            echo '<script type="text/javascript">alert("aucun Enregistrement ");</script>';
            ?>
                <div class="genere">  
                <button id="myBtn" class="btn btn-orange my-10"><i class="fa-solid fa-c-plus"></i> 
                Ajouter un client</button>
          </div>

            <?php

            
          
          }
          ?>
            <div id="myModal" class="modal">

            <!-- // Modal Content   -->
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Ajouter un Client</h2>
                    <span class="close">&times;</span>     
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="contact-form">
        
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" id="name">
                        <label for="prenom">Prenom</label>
                        <input type="text" name="date_fin" id="prenom" />
                        <label for="sexe">Sexe</label>
                        Masculin: <input type="radio" name="sexe" id="sexe" value="Masculin" />
                        Feminin: <input type="radio" name="sexe" id="sexe" value="Feminim" /> <br/>
                        <label for="nom">Telephone</label>
                        <input type="text" name="telephone" id="telephone" />
                        <input type="submit" class="btn btn-orange my-20" value="envoyer">
                    </form>
                </div>
            </div>
         
            </div>
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
                                <td><?php echo $value->nom; ?></td>
                                <td><?php echo $value->prenom; ?></td>
                                <td><?php echo $value->sexe; ?></td>
                                <td><?php echo $value->telephone; ?></td>
                                <td><?php echo $value->date_save; ?></td>
                                <td>
                                    <a href="modifier.php?codeid=<?php echo $value->code_client; ?>" class="btn-small btn-small-warning" title="Modifier">
                                        <i class="fas fa-edit"></i> Modifier
                                    </a>
                                    <a href="supprimer.php?codeid=<?php echo $value->code_client; ?>" class="btn-small btn-small-danger" title="Supprimer">
                                        <i class="fas fa-trash"></i> Supprimer
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        <?php }}?>
                    </table>

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