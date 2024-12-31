<?php
// Inclure la configuration
include('../../Includes/config.php');

// Fonction pour gérer les erreurs et les redirections
function setErrorAndRedirect($message, $redirectUrl) {
    $_SESSION['error'] = $message;
    echo '<script>alert("' . addslashes($message) . '");</script>';
    echo '<script>setTimeout(function() { window.location.href = "' . $redirectUrl . '"; }, 500);</script>';
    exit();
}

// Vérification des entrées avec sécurisation
$code_vente = !empty($_POST['code_vente']) ? trim($_POST['code_vente']) : null;
$code_user = !empty($_POST['code_user']) ? trim($_POST['code_user']) : null;
$code_client = !empty($_POST['code_client']) ? trim($_POST['code_client']) : null;
$code_plat = !empty($_POST['code_plat']) ? trim($_POST['code_plat']) : null;
$quantite = 1;

// Vérification de l'existence du client
$sqlc = "SELECT code_client FROM clients WHERE code_client = :code_client";
$query = $pdo->prepare($sqlc);
$query->execute([':code_client' => $code_client]);
if ($query->rowCount() == 0) {
    setErrorAndRedirect("Code client inexistant", "../Ajouter/ajouterVentes.php");
}

// Vérification de l'existence du plat
$sqlp = "SELECT quantite_plat FROM plats WHERE code_plat = :code_plat";
$query = $pdo->prepare($sqlp);
$query->execute([':code_plat' => $code_plat]);
$resultatQuantite = $query->fetch(PDO::FETCH_ASSOC);
if (!$resultatQuantite) {
    setErrorAndRedirect("Code plat inexistant", "../Ajouter/ajouterVentes.php");
}

// Récupérer la quantité disponible du plat
$quantiteDisponible = (int)$resultatQuantite['quantite_plat'];

// Calculer le nombre de plats vendus
$sqlVendus = "SELECT COUNT(*) AS total_vendus FROM ventes WHERE code_plat = :code_plat";
$query = $pdo->prepare($sqlVendus);
$query->execute([':code_plat' => $code_plat]);
$resultatVendus = $query->fetch(PDO::FETCH_ASSOC);
$nombreVendus = (int)$resultatVendus['total_vendus'];

// Calcul du nombre restant
$nombreRestant = $quantiteDisponible - $nombreVendus;
if ($nombreRestant < 1) {
    setErrorAndRedirect("Le plat est en rupture de stock.", "../Ajouter/ajouterVentes.php");
}

// Vérifier si le client a déjà effectué une vente aujourd'hui
$date_vente = date('Y-m-d'); // Date actuelle au format 'YYYY-MM-DD'

// Requête pour vérifier les ventes du jour pour ce client
$sqlVenteJour = "SELECT COUNT(*) FROM ventes WHERE code_client = :code_client AND DATE(date_vente) = :date_vente";
$query = $pdo->prepare($sqlVenteJour);
$query->execute([
    ':code_client' => $code_client,
    ':date_vente' => $date_vente
]);

// Vérifier si une vente existe déjà pour ce client aujourd'hui
$result = $query->fetchColumn();
if ($result> 0) {
    // Une vente existe déjà pour ce client aujourd'hui
    setErrorAndRedirect("Le client a déjà effectué une vente aujourd'hui.", "../Lister/ListerVentes.php");
}

// Insérer les données dans la table ventes
try {
    $sqlInsert = "INSERT INTO ventes (code_vente, code_client, code_plat, code_user, nbre_plat) VALUES (?, ?, ?, ?, ?)";
    $query = $pdo->prepare($sqlInsert);
    $query->execute([$code_vente, $code_client, $code_plat, $code_user, $quantite]);

    // Succès de l'insertion
    $_SESSION['success'] = "Vente enregistrée avec succès.";
    echo '<script>alert("Enregistrement réussi");</script>';
    echo '<script>setTimeout(function() { window.location.href = "../Lister/ListerVentes.php"; }, 500);</script>';
    exit();
} catch (Exception $e) {
    error_log($e->getMessage());
    setErrorAndRedirect("Une erreur est survenue lors de l'enregistrement de la vente.", "../Lister/ListerVentes.php");
}
?>
