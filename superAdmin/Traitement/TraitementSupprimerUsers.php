<?php
// Démarrer la session
session_start();
include('../../Includes/config.php');

if (isset($_GET['codeid'])) {
    // Vérifiez si le code utilisateur est fourni et non vide
    if (!empty(trim($_GET['codeid']))) {
        $code_user = htmlspecialchars(trim($_GET['codeid'])); // Nettoyage de la variable
    } else {
        $_SESSION['error'] = "Code utilisateur non fourni";
        header('location: ../Lister/ListerUsers.php');
        exit();
    }

    try {
        // Préparer la requête de suppression
        $sql = $pdo->prepare("DELETE FROM users WHERE code_user = :codeid");
        $sql->execute([':codeid' => $code_user]);

        // Vérifiez si une ligne a été supprimée
        if ($sql->rowCount() > 0) {
            $_SESSION['success'] = "Utilisateur supprimé avec succès.";
        } else {
            $_SESSION['error'] = "Aucun utilisateur trouvé avec ce code.";
        }

        // Redirection vers la liste des utilisateurs
        header('location: ../Lister/ListerUsers.php');
        exit();

    } catch (Exception $e) {
        // Gestion des erreurs
        error_log($e->getMessage());
        $_SESSION['error'] = "Une erreur est survenue lors de la suppression de l'utilisateur.";
        header('location: ../Lister/ListerUsers.php');
        exit();
    }
} else {
    $_SESSION['error'] = "Paramètre codeid manquant dans l'URL.";
    header('location: ../Lister/ListerUsers.php');
    exit();
}
