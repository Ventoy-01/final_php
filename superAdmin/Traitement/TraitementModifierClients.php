<?php 
    include('../../Includes/config.php');

    if (!empty(isset($_POST['nom_client']))) {
        $nom =(trim($_POST['nom_client']));
    }
 
    if (!empty(isset($_POST['type_client']))) {
        $type_client = trim($_POST['type_client']);
    }
    
    if (!empty(isset($_POST['phone_client']))) {
        $telephone = trim($_POST['phone_client']);
    }
  
    if (!empty(isset($_POST['codeid']))) {
        $codeid = trim($_POST['codeid']);
    }
    $sql = "UPDATE `clients` SET `nom_client`=:nom,`type_client`=:type_client,
  `phone_client`=:telephone WHERE `code_client`=:codeid";
    $query = $pdo->prepare($sql);
    $query->bindParam(':codeid', $codeid, PDO::PARAM_STR);
    $query->bindParam(':nom', $nom, PDO::PARAM_STR);
    $query->bindParam(':type_client', $type_client, PDO::PARAM_STR);
    $query->bindParam(':telephone', $telephone, PDO::PARAM_STR);
    $query->execute();
    echo '<script type="text/javascript">alert("Modification reussie");</script>';
    header('location:../Lister/ListerClients.php');

    
?>