<?php 
include('../Includes/config.php');

// Vérification des entrées avec sécurisation
$code_vente = !empty($_POST['code_vente']) ? trim($_POST['code_vente']) : null;
$code_client = !empty($_POST['code_client']) ? trim($_POST['code_client']) : null;
$code_plat = !empty($_POST['code_plat']) ? trim($_POST['code_plat']) : null;
$quantite = !empty($_POST['quantite']) ? trim($_POST['quantite']) : null;

// Vérification de l'existence du client
$sqlc = "SELECT * FROM `clients` WHERE `code_client` = ?";
$queryc = $pdo->prepare($sqlc);
$queryc->execute([$code_client]);

if ($queryc->rowCount() == 0) {
    echo '<script>alert("Code client inexistant");</script>';
    echo '<script>setTimeout(function() { window.location.href = "../admin/ajouterVentes.php"; }, 500);</script>';
    exit; // Arrêter l'exécution après redirection
}

// Vérification de l'existence du plat
$sqlp = "SELECT * FROM `plats` WHERE `code_plat` = ?";
$queryp = $pdo->prepare($sqlp);
$queryp->execute([$code_plat]);

if ($queryp->rowCount() == 0) {
    echo '<script>alert("Code plat inexistant");</script>';
    echo '<script>setTimeout(function() { window.location.href = "../admin/ajouterVentes.php"; }, 500);</script>';
    exit;
}

// Insertion des données dans la table ventes
$sql = "INSERT INTO `ventes` (`code_vente`, `code_client`, `code_plat`, `quantite`) VALUES (?, ?, ?, ?)";
$query = $pdo->prepare($sql);
$query->execute([$code_vente, $code_client, $code_plat, $quantite]);

// Succès de l'insertion
echo '<script>alert("Enregistrement réussi");</script>';
echo '<script>setTimeout(function() { window.location.href = "../admin/ListerVentes.php"; }, 500);</script>';
?>
