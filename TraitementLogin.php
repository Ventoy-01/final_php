<?php 
session_start();
include('./Includes/config.php');
if (isset($_POST['email'])) {
    $email =htmlspecialchars($_POST['email']);
}
if (isset($_POST['password'])) {
    $password = sha1($_POST['password']);
}
if (!empty($email) AND !empty($password)) {
$query = $pdo->prepare("select * from users where email=? AND password = ?");
$query->execute(array($email,$password));
$userExist = $query->rowCount();
$userInfo = $query->fetch();
$role = $userInfo['role'];
if ($userExist == 1 AND $role=='user') {
    $_SESSION['code_user'] = $userInfo['code_user'];
    $_SESSION['role'] = $userInfo['role'];
    $_SESSION['email'] = $userInfo['email'];
    $_SESSION['prenom'] = $userInfo['prenom'];
    $_SESSION['nom'] = $userInfo['nom'];
    header('location:./users/index.php?code_userentifier='.$_SESSION['code_user']);
}
elseif ($userExist == 1 AND $role=='admin') {
    $_SESSION['code_user'] = $userInfo['code_user'];
    $_SESSION['role'] = $userInfo['role'];
    $_SESSION['email'] = $userInfo['email'];
    $_SESSION['prenom'] = $userInfo['prenom'];
    $_SESSION['nom'] = $userInfo['nom'];
    header('location:./admin/index.php?code_userentifier='.$_SESSION['code_user']." ".$_SESSION['role']);
}
elseif ($userExist == 1 AND $role=='super') {
    $_SESSION['code_user'] = $userInfo['code_user'];
    $_SESSION['role'] = $userInfo['role'];
    $_SESSION['email'] = $userInfo['email'];
    $_SESSION['prenom'] = $userInfo['prenom'];
    $_SESSION['nom'] = $userInfo['nom'];
    header('location:./superAdmin/index.php?code_userentifier='.$_SESSION['code_user']." ".$_SESSION['role']);
}
else{
    echo '<script type="text/javascript">alert("Mail ou Mot de passe incorrect");</script>';
    die('<META HTTP-equiv="refresh" content=0;URL=./connection.php>'); 
}
}
?>