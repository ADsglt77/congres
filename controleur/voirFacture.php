<?php
include_once 'class/Facture.php';
include 'config/database.php';

$db = new Database();
$connection = $db->getConnexion();
$facture = new Facture($connection);

// Récupérer l'ID de la facture depuis l'URL
$id_facture = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_facture <= 0) {
    die("
        echo '<div class='notif error'>';
        echo '<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'><!-- Icon from Sargam Icons by Abhimanyu Rana - https://github.com/planetabhi/sargam-icons/blob/main/LICENSE.txt --><g fill='none'><path fill='white' fill-opacity='.16' d='M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2'/><path stroke='white' stroke-linecap='round' stroke-linejoin='round' stroke-miterlimit='10' stroke-width='1.5' d='M12 16h.008M12 8v5m10-1c0-5.523-4.477-10-10-10S2 6.477 2 12s4.477 10 10 10s10-4.477 10-10'/></g></svg>';
        echo '<p>ID de facture invalide<p>';
        echo '</div>';
        "
    );
}

// Récupérer les informations de la facture
$factureInfo = $facture->getFactureInfo($id_facture);
// Vérifier si la facture existe
if (!$factureInfo) {
    die("
        echo '<div class='notif error'>';
        echo '<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'><!-- Icon from Sargam Icons by Abhimanyu Rana - https://github.com/planetabhi/sargam-icons/blob/main/LICENSE.txt --><g fill='none'><path fill='white' fill-opacity='.16' d='M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2'/><path stroke='white' stroke-linecap='round' stroke-linejoin='round' stroke-miterlimit='10' stroke-width='1.5' d='M12 16h.008M12 8v5m10-1c0-5.523-4.477-10-10-10S2 6.477 2 12s4.477 10 10 10s10-4.477 10-10'/></g></svg>';
        echo '<p>Facture introuvable<p>';
        echo '</div>';
        "
    );
}

// Vérifier si l'utilisateur est admin ou appartient à la facture
$id_congressiste = $factureInfo['id_congressiste'];

if ($_SESSION['is_admin']) {
    // L'admin peut accéder à toutes les factures
    $userAuthorized = true;
} else {
    // Si ce n'est pas un admin, vérifier que l'utilisateur est celui auquel la facture appartient
    $userAuthorized = ($_SESSION['id_congressiste'] == $id_congressiste);
}

if (!$userAuthorized) {
    die('
        <div class="notif error">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><!-- Icon from Sargam Icons by Abhimanyu Rana - https://github.com/planetabhi/sargam-icons/blob/main/LICENSE.txt --><g fill="none"><path fill="white" fill-opacity=".16" d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2"/><path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="M12 16h.008M12 8v5m10-1c0-5.523-4.477-10-10-10S2 6.477 2 12s4.477 10 10 10s10-4.477 10-10"/></g></svg>
        <p>Vous n\'êtes pas autorisé à voir cette facture<p>
        </div>
    ');
}

// Calcul des montants
$hotelCost = $facture->calculateHotelCost($id_congressiste);
$sessionCost = $facture->calculateSessionsCostByCongressiste($id_congressiste);
$activiteCost = $facture->calculateActivitesCostByCongressiste($id_congressiste);
$totalCost = $hotelCost + $sessionCost + $activiteCost;

// Calcul du total après déduction de l'acompte
$totalAfterAcompte = $totalCost - $factureInfo['acompte'];

// Récupérer les détails des activités et des sessions
$activiteDetails = $facture->getActiviteDetails($id_congressiste);
$sessionDetails = $facture->getSessionDetails($id_congressiste);

// Organiser les détails pour la vue
$detailsFacture = [
    'facture' => $factureInfo,
    'hotel' => $facture->getHotelDetails($id_congressiste),
    'activites' => $activiteDetails,
    'sessions' => $sessionDetails,
    'montants' => [
        'hotel' => $hotelCost,
        'sessions' => $sessionCost,
        'activites' => $activiteCost,
        'total' => $totalCost,
        'totalAfterAcompte' => $totalAfterAcompte
    ]
];

// Inclure la vue
include "./vue/vueDetailFacture.php";
?>