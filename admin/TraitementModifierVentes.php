<?php 
    include('../Includes/config.php');
 
    if (!empty(isset($_POST['quantite']))) {
        $quantite = trim($_POST['quantite']);
    }

    if (!empty(isset($_POST['codeid']))) {
        $codeid = trim($_POST['codeid']);
    }
    $sql = "UPDATE `ventes` SET `Nonbre_plats`=:quantite WHERE Code_vente=:codeid";
    $query = $pdo->prepare($sql);
    $query->bindParam(':quantite',$quantite,PDO::PARAM_STR);
    $query->bindParam(':codeid',$codeid,PDO::PARAM_STR);
    $query->execute();
    echo '<script type="text/javascript">alert("Modification reussie");</script>';
    header('location:./ListerVentes.php');

    
?>