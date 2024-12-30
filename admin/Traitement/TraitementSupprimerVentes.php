<?php
// Démarrer la session
session_start();
include('../../Includes/config.php');

if (isset($_GET['codeid'])) {
    // Vérifiez si le code utilisateur est fourni et non vide
    $code_vente = trim($_GET['codeid']);
    if (!empty($code_vente)) {
        $code_vente = htmlspecialchars($code_vente); // Nettoyage de la variable
    } else {
        $_SESSION['error'] = "Code vente non fourni.";
        header('location: ../Lister/ListerVentes.php');
        exit();
    }

    try {
        // Préparer la requête de suppression
        $sql = $pdo->prepare("DELETE FROM ventes WHERE code_vente = :code_vente");
        $sql->execute([':code_vente' => $code_vente]);

        // Vérifiez si une ligne a été supprimée
        if ($sql->rowCount() > 0) {
            $_SESSION['success'] = "Vente supprimée avec succès.";
        } else {
            $_SESSION['error'] = "Aucune vente trouvée avec ce code.";
        }

        // Redirection vers la liste des ventes
        header('location: ../Lister/ListerVentes.php');
        exit();
    } catch (PDOException $e) {
        // Gestion des erreurs
        error_log($e->getMessage()); // Enregistrer l'erreur dans les logs
        $_SESSION['error'] = "Impossible de supprimer cette vente. Vérifiez les dépendances (achats ou autres).";
        header('location: ../Lister/ListerVentes.php');
        exit();
    }
} else {
    $_SESSION['error'] = "Paramètre 'codeid' manquant dans l'URL.";
    header('location: ../Lister/ListerVentes.php');
    exit();
}
