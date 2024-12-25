<?php 
    include('../../Includes/config.php');

    if (!empty(isset($_POST['nom_user']))) {
        $nom =(trim($_POST['nom_user']));
    }
    if (!empty(isset($_POST['prenom_user']))) {
        $prenom = trim($_POST['prenom_user']);
    }
 
    if (!empty(isset($_POST['pseudo_user']))) {
        $pseudo = trim($_POST['pseudo_user']);
    }
    if (!empty(isset($_POST['password_user']))) {
        $password = sha1(trim($_POST['password_user']));
    }
    else{
        $password = trim($_POST['password_hidden']);
    }
     
    if (!empty(isset($_POST['codeid']))) {
        $codeid = trim($_POST['codeid']);
    }
    if (!empty(isset($_POST['role_user']))) {
        $role = trim($_POST['role_user']);
    }

    $sql = "UPDATE `users` SET `nom_user`=:nom, `prenom_user`=:prenom,
   `role_user`=:role, `pseudo_user`=:pseudo, `password_user`=:password WHERE code_user=:codeid";
    $query = $pdo->prepare($sql);
    $query->bindParam(':nom',$nom,PDO::PARAM_STR);
    $query->bindParam(':prenom',$prenom,PDO::PARAM_STR);
    $query->bindParam(':pseudo',$pseudo,PDO::PARAM_STR);
    $query->bindParam(':password',$password,PDO::PARAM_STR);
    $query->bindParam(':codeid',$codeid,PDO::PARAM_STR);
    $query->bindParam(':role',$role,PDO::PARAM_STR);
    $query->execute();
    echo '<script type="text/javascript">alert("Modification reussie");</script>';
    header('location:../LIster/ListerUsers.php');

    
?>