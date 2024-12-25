<?php
// Démarrer la session
session_start();
include('../../Includes/config.php');

if (isset($_GET['codeid'])) {
    // Vérifiez si le code utilisateur est fourni et non vide
    if (!empty(trim($_GET['codeid']))) {
        $code_client = htmlspecialchars(trim($_GET['codeid'])); // Nettoyage de la variable
    } else {
        $_SESSION['error'] = "Code vente non fourni";
        header('location: ../Lister/ListerVentes.php');
        exit();
    }

    try {
        // Préparer la requête de suppression
        $sql = $pdo->prepare("DELETE FROM ventes WHERE code_vente = :codeid");
        $sql->execute([':codeid' => $code_vente]);

        // Vérifiez si une ligne a été supprimée
        if ($sql->rowCount() > 0) {
            $_SESSION['success'] = "vente supprimé avec succès.";
        } else {
            $_SESSION['error'] = "Aucune vente trouvé avec ce code.";
        }

        // Redirection vers la liste des utilisateurs
        header('location: ../Lister/ListerVentes.php');
        exit();

    } catch (Exception $e) {
        // Gestion des erreurs
        error_log($e->getMessage());
        $_SESSION['error'] = "Supprimer d'abord les achats de ce client";
        header('location: ../Lister/ListerVentes.php');
        exit();
    }
} else {
    $_SESSION['error'] = "Paramètre codeid manquant dans l'URL.";
    header('location: ../Lister/ListerVentes.php');
    exit();
}
