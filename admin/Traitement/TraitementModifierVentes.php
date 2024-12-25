<?php 
    include('../../Includes/config.php');
 
    if (!empty(isset($_POST['nbre_plat']))) {
        $quantite = trim($_POST['nbre_plat']);
    }

    if (!empty(isset($_POST['codeid']))) {
        $codeid = trim($_POST['codeid']);
    }
    $sql = "UPDATE `ventes` SET `nbre_plat`=:quantite WHERE Code_vente=:codeid";
    $query = $pdo->prepare($sql);
    $query->bindParam(':quantite',$quantite,PDO::PARAM_STR);
    $query->bindParam(':codeid',$codeid,PDO::PARAM_STR);
    $query->execute();
    echo '<script type="text/javascript">alert("Modification reussie");</script>';
    header('location:../Lister/ListerVentes.php');

    
?>