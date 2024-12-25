<?php
// Démarrer la session
session_start();
include('../../Includes/config.php');

if (isset($_GET['codeid'])) {
    // Vérifiez si le code utilisateur est fourni et non vide
    if (!empty(trim($_GET['codeid']))) {
        $code_plat = htmlspecialchars(trim($_GET['codeid'])); // Nettoyage de la variable
    } else {
        $_SESSION['error'] = "Code plat non fourni";
        header('location: ../Lister/ListerPlats.php');
        exit();
    }

    try {
        // Préparez la requête avec un paramètre nommé pour éviter les injections SQL
        $sql = "DELETE FROM plats WHERE code_plat = :code_plat";
        $query = $pdo->prepare($sql);
    
        // Exécutez la requête en liant la valeur du paramètre
        $query->execute([':code_plat' => $code_plat]);
    
        // Vérifiez si une ligne a été supprimée
        if ($query->rowCount() > 0) {
            $_SESSION['success'] = "Plat supprimé avec succès.";
        } else {
            $_SESSION['error'] = "Aucun plat trouvé avec ce code.";
        }
    
        // Redirection vers la liste des plats
        header('location: ../Lister/ListerPlats.php');
        exit();

    } catch (Exception $e) {
        // Gestion des erreurs
        error_log($e->getMessage());
        $_SESSION['error'] = "Supprimer d'abord les achats de ce client";
        header('location: ../Lister/ListerPlats.php');
        exit();
    }
} else {
    $_SESSION['error'] = "Paramètre codeid manquant dans l'URL.";
    header('location: ../Lister/ListerPlats.php');
    exit();
}
