<?php 
    include('../Includes/config.php');

    if (!empty(isset($_POST['code_client']))) {
        $code_client = trim($_POST['code_client']);
    }
    if (!empty(isset($_POST['nom']))) {
        $nom =htmlspecialchars(trim($_POST['nom']));
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
   
   
    $sql = "INSERT INTO `clients`(`code_client`, `nom`, `prenom`, `sexe`, `telephone`) VALUES
    (?,?,?,?,?)";
    $query = $pdo->prepare($sql);
    $array = array($code_client,$nom, $prenom, $sexe,$telephone);
    $query->execute($array);
    echo '<script type="text/javascript">alert("Enregistrement reussi");</script>';
    header('location:../admin/ListerClients.php');

    
?>