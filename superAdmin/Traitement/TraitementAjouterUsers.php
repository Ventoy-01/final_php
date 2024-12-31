<?php 
    include('../../Includes/config.php');

    if (!empty(isset($_POST['code_user']))) {
        $code_user = trim($_POST['code_user']);
    }
    if (!empty(isset($_POST['nom_user']))) {
        $nom_user =htmlspecialchars(trim($_POST['nom_user']));
    }
    if (!empty(isset($_POST['prenom_user']))) {
        $prenom_user = trim($_POST['prenom_user']);
    }
  
    if (!empty(isset($_POST['pseudo_user']))) {
        $pseudo_user = trim($_POST['pseudo_user']);
    }
    if (isset($_POST['password_user'])) {
        $password_user = sha1($_POST['password_user']);
    }
    if (!empty(isset($_POST['role_user']))) {
        $role_user = trim($_POST['role_user']);
    }
   
try { 
    $sql = "INSERT INTO `users`(`code_user`, `nom_user`, `prenom_user`,`pseudo_user`,`password_user`, `role_user`) VALUES
    (?,?,?,?,?,?)";
    $query = $pdo->prepare($sql);
    $array = array($code_user,$nom_user, $prenom_user, $pseudo_user,$password_user,$role_user);
    $query->execute($array);
    echo '<script type="text/javascript">alert("Enregistrement reussi");</script>';
    header('location:../Lister/ListerUsers.php');
    exit();
} catch (PDOException $e) {
    echo '<script type="text/javascript">alert("Une erreur / pseudo peut etre existant");</script>';
    echo '<script>setTimeout(function() { window.location.href = "../Ajouter/ajouterUsers.php"; }, 500);</script>';
    exit();}

    
?>