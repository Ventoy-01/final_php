<?php
session_start();
include('../../Includes/config.php'); // Inclure la configuration de la base de données

// Vérification des données POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pseudo_user = !empty($_POST['pseudo_user']) ? trim($_POST['pseudo_user']) : null;
    $old_password = !empty($_POST['old_password']) ? trim($_POST['old_password']) : null;
    $new_password = !empty($_POST['new_password']) ? trim($_POST['new_password']) : null;
    $confirm_password = !empty($_POST['confirm_password']) ? trim($_POST['confirm_password']) : null;

    // Vérifier que tous les champs sont remplis
    if (!$pseudo_user || !$old_password || !$new_password || !$confirm_password) {
        echo '<script>alert("Tous les champs sont requis.");</script>';
        echo '<script>setTimeout(function() { window.location.href = "../changeSuperPassword.php"; }, 500);</script>';
        exit();
    }

    // Vérifier que les nouveaux mots de passe correspondent
    if ($new_password !== $confirm_password) {
        echo '<script>alert("Le nouveau mot de passe et sa confirmation ne correspondent pas.");</script>';
        echo '<script>setTimeout(function() { window.location.href = "../changeSuperPassword.php"; }, 500);</script>';
        exit();
    }

    try {
        // Récupérer l'utilisateur avec le pseudo fourni
        $sql = "SELECT * FROM users WHERE pseudo_user = :pseudo_user";
        $query = $pdo->prepare($sql);
        $query->execute([':pseudo_user' => $pseudo_user]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            echo '<script>alert("Pseudo incorrect ou utilisateur introuvable.");</script>';
            echo '<script>setTimeout(function() { window.location.href = "../changeSuperPassword.php"; }, 500);</script>';
            exit();
        }

        // Vérifier l'ancien mot de passe
        if (!(sha1($old_password) == $user['password_user'])) {
            echo '<script>alert("Ancien mot de passe incorrect.");</script>';
            echo '<script>setTimeout(function() { window.location.href = "../changeSuperPassword.php"; }, 500);</script>';
            exit();
        }

        // Hashage du nouveau mot de passe
        $hashed_password = sha1($new_password);

        // Mise à jour du mot de passe dans la base de données
        $sql = "UPDATE users SET password_user = :new_password WHERE pseudo_user = :pseudo_user";
        $query = $pdo->prepare($sql);
        $query->execute([
            ':new_password' => $hashed_password,
            ':pseudo_user' => $pseudo_user
        ]);

        // Succès
        echo '<script>alert("Mot de passe modifié avec succès.");</script>';
        echo '<script>setTimeout(function() { window.location.href = "../index.php"; }, 500);</script>';
        exit();
    } catch (PDOException $e) {
        error_log($e->getMessage());
        echo '<script>alert("Une erreur est survenue. Veuillez réessayer.");</script>';
        echo '<script>setTimeout(function() { window.location.href = "../changeSuperPassword.php"; }, 500);</script>';
        exit();
    }
} else {
    echo '<script>alert("Accès non autorisé.");</script>';
    echo '<script>setTimeout(function() { window.location.href = "../index.php"; }, 500);</script>';
    exit();
}
?>
