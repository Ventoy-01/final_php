<?php 
    include('../Includes/config.php');

    if (!empty(isset($_POST['codeid']))) {
        $codeid = trim($_POST['codeid']);
    }
    $sql = "DELETE FROM ventes WHERE code_vente=:codeid";
    $query = $pdo->prepare($sql);
    $query->bindParam(':codeid',$codeid,PDO::PARAM_STR);
    $query->execute();
    echo '<script type="text/javascript">alert("Suppression reussi");</script>';
    header('location:./ListerVentes.php');

    
?>