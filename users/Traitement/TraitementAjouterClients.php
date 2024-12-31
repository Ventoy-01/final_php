<?php 
    include('../../Includes/config.php');

    if (!empty(isset($_POST['code_client']))) {
        $code_client = trim($_POST['code_client']);
    }
    if (!empty(isset($_POST['nom']))) {
        $nom =htmlspecialchars(trim($_POST['nom']));
    }

    if (!empty(isset($_POST['type_client']))) {
        $type_client = trim($_POST['type_client']);
    }
   
    if (!empty(isset($_POST['telephone']))) {
        $phone= trim($_POST['telephone']);
    }

    function validerNumeroHaitienStatique($numero) {
        $regex = '/^[2345][0-9]{7}$/';
        return preg_match($regex, $numero) === 1;
    }
    if (!validerNumeroHaitienStatique($phone_client)) {
        echo '<script>alert("numéro Haiti invalide");</script>';
        echo '<script>setTimeout(function() { window.location.href = "../Ajouter/ajouterClients.php"; }, 500);</script>';
        exit();
    } else {
        $phone_client= "+509 ".$phone;
    }
   
   
    $sql = "INSERT INTO `clients`(`code_client`, `nom_client`, `type_client`,`phone_client`) VALUES
    (?,?,?,?)";
    $query = $pdo->prepare($sql);
    $array = array($code_client, $nom, $type_client, $phone_client);
    $query->execute($array);
    echo '<script type="text/javascript">alert("Enregistrement reussi");</script>';
    header('location:../Lister/ListerClients.php');

    
?>