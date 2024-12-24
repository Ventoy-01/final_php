<?php 
    include('../Includes/config.php');

    if (!empty(isset($_POST['nom']))) {
        $nom =(trim($_POST['nom']));
    }
    if (!empty(isset($_POST['prenom']))) {
        $prenom = trim($_POST['prenom']);
    }
 
    if (!empty(isset($_POST['sexe']))) {
        $sexe = trim($_POST['sexe']);
    }
    if (!empty(isset($_POST['telephone']))) {
        $telephone = trim($_POST['telephone']);
    }
  
    if (!empty(isset($_POST['codeid']))) {
        $codeid = trim($_POST['codeid']);
    }
    $sql = "UPDATE `clients` SET `nom`=:nom,`prenom`=:prenom,
  `sexe`=:sexe,`telephone`=:telephone WHERE code_client=:codeid";
    $query = $pdo->prepare($sql);
    $query->bindParam(':nom',$nom,PDO::PARAM_STR);
    $query->bindParam(':prenom',$prenom,PDO::PARAM_STR);
    $query->bindParam(':sexe',$sexe,PDO::PARAM_STR);
    $query->bindParam(':telephone',$telephone,PDO::PARAM_STR);
    $query->bindParam(':codeid',$codeid,PDO::PARAM_STR);
    $query->execute();
    echo '<script type="text/javascript">alert("Modification reussie");</script>';
    header('location:./ListerClients.php');

    
?>