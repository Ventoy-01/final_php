<?php 
    include('../../Includes/config.php');

// Vérification des entrées avec sécurisation
$code_vente = !empty($_POST['code_vente']) ? trim($_POST['code_vente']) : null;
$code_user = !empty($_POST['code_user']) ? trim($_POST['code_user']) : null;
$code_client = !empty($_POST['code_client']) ? trim($_POST['code_client']) : null;
$code_plat = !empty($_POST['code_plat']) ? trim($_POST['code_plat']) : null;
$quantite = !empty($_POST['quantite']) ? trim($_POST['quantite']) : null;
$counterc = 0;
$counterp = 0;
// Vérification de l'existence du client
$sqlc = "SELECT * FROM clients where 1";
$query = $pdo->prepare($sqlc);
$query->execute();
$resultat = $query->fetchAll(PDO::FETCH_OBJ);
if ($query->rowCount()>=1) {
    foreach ($resultat as $value) {
        if ($value->code_client == $code_client) {
            $counterc++;
            $code_client = $value->code_client;
            break;
        }
    }
}

if ($counterc == 0) {
    echo '<script>alert("Code client inexistant");</script>';
    echo '<script>setTimeout(function() { window.location.href = "../Ajouter/ajouterVentes.php"; }, 500);</script>';
    exit; // Arrêter l'exécution après redirection
}

// Vérification de l'existence du plat
$sqlp = "SELECT * FROM plats where 1";
$query = $pdo->prepare($sqlp);
$query->execute();
$resultat = $query->fetchAll(PDO::FETCH_OBJ);
if ($query->rowCount()>=1) {
    foreach ($resultat as $value) {
        if ($value->code_plat == $code_plat) {
            $counterp++;
            $code_plat = $value->code_plat;
            break;
        }
    }
}

if ($counterp == 0) {
    echo '<script>alert("Code plat inexistant");</script>';
    echo '<script>setTimeout(function() { window.location.href = "../Ajouter/ajouterVentes.php"; }, 500);</script>';
    exit;
}

// Insertion des données dans la table ventes
$sql = "INSERT INTO `ventes` (`code_vente`, `code_client`, `code_plat`, `code_user`, `nbre_plat`) VALUES (?, ?, ?, ?,?)";
$query = $pdo->prepare($sql);
$query->execute([$code_vente, $code_client, $code_plat,$code_user, $quantite]);

// Succès de l'insertion
echo '<script>alert("Enregistrement réussi");</script>';
echo '<script>setTimeout(function() { window.location.href = "../Lister/ListerVentes.php"; }, 500);</script>';
?>
