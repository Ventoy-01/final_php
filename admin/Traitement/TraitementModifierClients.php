<?php 
    include('../../Includes/config.php');

    if (!empty(isset($_POST['nom_client']))) {
        $nom =(trim($_POST['nom_client']));
    }
 
    if (!empty(isset($_POST['type_client']))) {
        $type_client = trim($_POST['type_client']);
    }
    
    if (!empty(isset($_POST['phone_client']))) {
        $phone = trim($_POST['phone_client']);
    }
  
    if (!empty(isset($_POST['codeid']))) {
        $codeid = trim($_POST['codeid']);
    }
    
    if (!empty(isset($_GET['id']))) {
        $id = trim($_GET['id']);
    }


    function validerNumeroHaitienStatique($numero) {
        $regex = '/^[2345][0-9]{7}$/';
        return preg_match($regex, $numero) === 1;
    }
    if (!validerNumeroHaitienStatique($phone)) {
        echo '<script>alert("numéro Haiti invalide");</script>';
        echo '<script>setTimeout(function() {window.location.href = "../Modifier/ModifierClients.php?codeid=' . $id . '";}, 500);</script>';
        exit();
    } 
    else {
        $telephone = "+509 ".$phone;
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