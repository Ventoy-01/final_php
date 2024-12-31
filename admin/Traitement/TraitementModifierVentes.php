<?php 
include('../../Includes/config.php');

// Vérification des données POST et GET
$quantite = isset($_POST['nbre_plat']) ? trim($_POST['nbre_plat']) : null;
$codeid = isset($_POST['codeid']) ? trim($_POST['codeid']) : null;
$code_plat = isset($_POST['code_plat']) ? trim($_POST['code_plat']) : null;
$id = isset($_GET['id']) ? trim($_GET['id']) : null;

if (!$quantite || !$codeid || !$code_plat) {
    setErrorAndRedirect("Données invalides. Veuillez vérifier vos informations.", "../Lister/ListerVentes.php", $id);
}

// Fonction pour afficher un message d'erreur et rediriger
function setErrorAndRedirect($message, $redirectUrl, $id) {
    $_SESSION['error'] = $message;
    echo '<script>alert("' . addslashes($message) . '");</script>';
    echo '<script>setTimeout(function() { window.location.href = "' . $redirectUrl . '?codeid=' . $id . '"; }, 500);</script>';
    exit();
}

// Vérification de l'existence du plat
$sqlp = "SELECT quantite_plat FROM plats WHERE code_plat = :code_plat";
$query = $pdo->prepare($sqlp);
$query->execute([':code_plat' => $code_plat]);
$resultatQuantite = $query->fetch(PDO::FETCH_ASSOC);

if (!$resultatQuantite) {
    setErrorAndRedirect("Code plat inexistant.", "../Modifier/modifierVentes.php", $id);
}

// Quantité disponible du plat
$quantiteDisponible = (int)$resultatQuantite['quantite_plat'];

// Calculer le nombre de plats vendus pour ce code_plat
$sqlVendus = "SELECT SUM(nbre_plat) AS total_vendus FROM ventes WHERE code_plat = :code_plat";
$query = $pdo->prepare($sqlVendus);
$query->execute([':code_plat' => $code_plat]);
$resultatVendus = $query->fetch(PDO::FETCH_ASSOC);
$nombreVendus = (int)$resultatVendus['total_vendus'];

// Calcul du nombre restant
$nombreRestant = $quantiteDisponible - $nombreVendus;
if ($quantite > $nombreRestant) {
    setErrorAndRedirect("La quantité demandée dépasse la quantité restante. Quantité restante : $nombreRestant.", "../Modifier/modifierVentes.php", $id);
}

// Vérifier si le client a déjà effectué une vente aujourd'hui
$date_vente = date('Y-m-d'); // Date actuelle au format 'YYYY-MM-DD'
$sqlVenteJour = "SELECT * FROM ventes WHERE code_client = :code_client AND DATE(date_vente) = :date_vente";
$query = $pdo->prepare($sqlVenteJour);
$query->execute([
    ':code_client' => $codeid,
    ':date_vente' => $date_vente
]);

if ($query->rowCount() > 0) {
    setErrorAndRedirect("Le client a déjà effectué un achat aujourd'hui.", "../Lister/ListerVentes.php", $id);
}

// Mise à jour de la vente
$sql = "UPDATE ventes SET nbre_plat = :quantite WHERE code_vente = :codeid";
$query = $pdo->prepare($sql);
$query->bindParam(':quantite', $quantite, PDO::PARAM_INT);
$query->bindParam(':codeid', $codeid, PDO::PARAM_STR);

if ($query->execute()) {
    echo '<script type="text/javascript">alert("Modification réussie.");</script>';
    header('Location: ../Lister/ListerVentes.php');
    exit();
} else {
    setErrorAndRedirect("Une erreur est survenue lors de la modification.", "../Modifier/modifierVentes.php", $id);
}
?>
