<?php 
    include('../../Includes/config.php');

    if (!empty(isset($_POST['nom_plat']))) {
        $nom =(trim($_POST['nom_plat']));
    }
    if (!empty(isset($_POST['cuisson_plat']))) {
        $cuisson = trim($_POST['cuisson_plat']);
    }
  
    if (!empty(isset($_POST['prix_plat']))) {
        $prix = trim($_POST['prix_plat']);
    }
    if (isset($_POST['quantite_plat'])) {
        $quantite = trim($_POST['quantite_plat']);
    }
   
    if (!empty(isset($_POST['codeid']))) {
        $codeid = trim($_POST['codeid']);
    }
    $sql = "UPDATE `plats` SET `nom_plat`=:nom,`cuisson_plat`=:cuisson,`prix_plat`=:prix,
    `quantite_plat`=:quantite WHERE code_plat=:codeid";
    $query = $pdo->prepare($sql);
    $query->bindParam(':nom',$nom,PDO::PARAM_STR);
    $query->bindParam(':cuisson',$cuisson,PDO::PARAM_STR);
    $query->bindParam(':prix',$prix,PDO::PARAM_STR);
    $query->bindParam(':quantite',$quantite,PDO::PARAM_STR);
    $query->bindParam(':codeid',$codeid,PDO::PARAM_STR);
    $query->execute();
    echo '<script type="text/javascript">alert("Modification reussie");</script>';
    header('location:../Lister/ListerPlats.php');

    
?>