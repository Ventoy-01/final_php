<?php 
    include('../Includes/config.php');

    if (!empty(isset($_POST['nom']))) {
        $nom =(trim($_POST['nom']));
    }
    if (!empty(isset($_POST['prenom']))) {
        $prenom = trim($_POST['prenom']);
    }
 
    if (!empty(isset($_POST['email']))) {
        $email = trim($_POST['email']);
    }
    if (!empty(isset($_POST['password']))) {
        $password = sha1(trim($_POST['password']));
    }
  
    if (!empty(isset($_POST['codeid']))) {
        $codeid = trim($_POST['codeid']);
    }
    $sql = "UPDATE `users` SET `nom`=:nom,`prenom`=:prenom,
  `email`=:email,`password`=:password WHERE code_user=:codeid";
    $query = $pdo->prepare($sql);
    $query->bindParam(':nom',$nom,PDO::PARAM_STR);
    $query->bindParam(':prenom',$prenom,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':password',$password,PDO::PARAM_STR);
    $query->bindParam(':codeid',$codeid,PDO::PARAM_STR);
    $query->execute();
    echo '<script type="text/javascript">alert("Modification reussie");</script>';
    header('location:./ListerUsers.php');

    
?>