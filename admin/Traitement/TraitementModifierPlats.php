<?php 
    include('../../Includes/config.php');

    // Récupération des données du formulaire
    if (!empty($_POST['nom_plat'])) {
        $nom = trim($_POST['nom_plat']);
    }
    if (!empty($_POST['cuisson_plat'])) {
        $cuisson = trim($_POST['cuisson_plat']);
    }
    if (!empty($_POST['prix_plat'])) {
        $prix = trim($_POST['prix_plat']);
    }
    if (isset($_POST['quantite_plat'])) {
        $quantite = (int)trim($_POST['quantite_plat']); // Conversion en entier pour comparaison
    }
    if (!empty($_POST['codeid'])) {
        $codeid = trim($_POST['codeid']);
    }

    // Vérification de l'existence du plat et récupération de la quantité vendue
    $sqlVendus = "SELECT SUM(nbre_plat) AS total_vendus FROM ventes WHERE code_plat = :code_plat";
    $query = $pdo->prepare($sqlVendus);
    $query->execute([':code_plat' => $codeid]);
    $vente = $query->fetch(PDO::FETCH_ASSOC);
    $quantiteVendue = (int)$vente['total_vendus'];

    // Validation : la nouvelle quantité ne peut pas être inférieure à la quantité vendue
    if ($quantite < $quantiteVendue) {
        echo '<script type="text/javascript">alert("Impossible de définir une quantité inférieure à la quantité déjà vendue.\n Quantité vendue : ' . $quantiteVendue . '");</script>';
        echo '<script>window.history.back();</script>';
        exit();
    }

    // Requête de mise à jour si validation réussie
    $sql = "UPDATE `plats` 
            SET `nom_plat` = :nom, 
                `cuisson_plat` = :cuisson, 
                `prix_plat` = :prix, 
                `quantite_plat` = :quantite 
            WHERE code_plat = :codeid";
    $query = $pdo->prepare($sql);
    $query->bindParam(':nom', $nom, PDO::PARAM_STR);
    $query->bindParam(':cuisson', $cuisson, PDO::PARAM_STR);
    $query->bindParam(':prix', $prix, PDO::PARAM_STR);
    $query->bindParam(':quantite', $quantite, PDO::PARAM_INT);
    $query->bindParam(':codeid', $codeid, PDO::PARAM_STR);
    $query->execute();

    echo '<script type="text/javascript">alert("Modification réussie");</script>';
    header('location:../Lister/ListerPlats.php');
    exit();
?>
