<?php 
    include('../../Includes/config.php');

    if (!empty(isset($_POST['code_plat']))) {
        $code_plat = trim($_POST['code_plat']);
    }
    if (!empty(isset($_POST['nom']))) {
        $nom =(trim($_POST['nom']));
    }
    if (!empty(isset($_POST['cuisson_plat']))) {
        $cuisson = trim($_POST['cuisson_plat']);
    }
  
    if (!empty(isset($_POST['prix']))) {
        $prix = trim($_POST['prix']);
    }
    if (isset($_POST['quantite'])) {
        $quantite = trim($_POST['quantite']);
    }
   
   
    $sql = "INSERT INTO `plats`(`code_plat`, `nom_plat`, `cuisson_plat`,`prix_plat`,`quantite_plat`) VALUES
    (?,?,?,?,?)";
    $query = $pdo->prepare($sql);
    $array = array($code_plat,$nom, $cuisson, $prix,$quantite);
    $query->execute($array);
    echo '<script type="text/javascript">alert("Enregistrement reussi");</script>';
    header('location:../Lister/ListerPlats.php');

    
?>