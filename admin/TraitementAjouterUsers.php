<?php 
    include('../Includes/config.php');

    if (!empty(isset($_POST['code_user']))) {
        $code_user = trim($_POST['code_user']);
    }
    if (!empty(isset($_POST['nom']))) {
        $nom =htmlspecialchars(trim($_POST['nom']));
    }
    if (!empty(isset($_POST['prenom']))) {
        $prenom = trim($_POST['prenom']);
    }
  
    if (!empty(isset($_POST['email']))) {
        $email = trim($_POST['email']);
    }
    if (isset($_POST['password'])) {
        $password = sha1($_POST['password']);
    }
    if (!empty(isset($_POST['role']))) {
        $role = trim($_POST['role']);
    }
   
   
    $sql = "INSERT INTO `users`(`code_user`, `nom`, `prenom`,`email`,`password`, `role`) VALUES
    (?,?,?,?,?,?)";
    $query = $pdo->prepare($sql);
    $array = array($code_user,$nom, $prenom, $email,$password,$role);
    $query->execute($array);
    echo '<script type="text/javascript">alert("Enregistrement reussi");</script>';
    header('location:../admin/ListerUsers.php');

    
?>