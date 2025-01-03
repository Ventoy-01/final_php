<?php 
session_start();
include('./Includes/config.php');

if (isset($_POST['pseudo_user'], $_POST['password_user'])) {
    $pseudo_user = htmlspecialchars(trim($_POST['pseudo_user']));
    $password = sha1($_POST['password_user']);

    if (!empty($pseudo_user) && !empty($password)) {
        // Préparation de la requête pour éviter les injections SQL
        $query = $pdo->prepare("SELECT * FROM users WHERE pseudo_user = ? AND password_user = ?");
        $query->execute([$pseudo_user, $password]);
        $userInfo = $query->fetch(PDO::FETCH_ASSOC);

        

        if ($userInfo) {
                // Initialisation de la session utilisateur
                $_SESSION['code_user'] = $userInfo['code_user'];
                $_SESSION['role'] = $userInfo['role_user'];
                $_SESSION['pseudo_user'] = $userInfo['pseudo_user'];
                $_SESSION['prenom_user'] = $userInfo['prenom_user'];
                $_SESSION['nom_user'] = $userInfo['nom_user'];

                // Redirection selon le rôle
                switch ($userInfo['role_user']) {
                    case 'user':
                        header('Location: ./users/index.php?code_userentifier=' . $_SESSION['code_user']);
                        break;
                    case 'admin':
                        header('Location: ./admin/index.php?code_userentifier=' . $_SESSION['code_user']);
                        break;
                    case 'super':
                        header('Location: ./superAdmin/index.php?code_userentifier=' . $_SESSION['code_user']);
                        break;
                    default:
                        // Si le rôle n'est pas reconnu
                        echo '<script>alert("Rôle utilisateur non autorisé.");</script>';
                        die('<meta http-equiv="refresh" content="0;URL=./connection.php">');
                }
                exit; // Pour s'assurer que rien d'autre n'est exécuté après la redirection
            // } else {
            //     // Mot de passe incorrect
            //     echo '<script>alert("Mot de passe incorrect.");</script>';
            //     die('<meta http-equiv="refresh" content="0;URL=./connection.php">');
            // }
        } else {
            // Utilisateur introuvable
            echo '<script>alert("Pseudo ou utilisateur inexistant.");</script>';
            die('<meta http-equiv="refresh" content="0;URL=./connection.php">');
        }
    } else {
        // Champs vides
        echo '<script>alert("Veuillez remplir tous les champs.");</script>';
        die('<meta http-equiv="refresh" content="0;URL=./connection.php">');
    }
} else {
    // Accès direct à la page sans soumission de formulaire
    header('Location: ./connection.php');
    exit;
}
?>
