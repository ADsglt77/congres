<?php

require_once './config/database.php';
require_once './class/Facture.php';
require_once './class/Congressiste.php';
require_once './class/Session.php';
require_once './class/Activite.php';
require_once './class/Hotel.php';

// Connexion à la base de données
$database = new Database();
$db = $database->getConnexion();

// Instancier les classes nécessaires
$facture = new Facture($db);
$congressiste = new Congressiste($db);

// Variables pour afficher les montants
$hotelCost = 0;
$sessionCost = 0;
$activiteCost = 0;
$totalCost = 0;

// Récupération des données POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $id_congressiste = $_POST['id_congressiste'];

    if (!empty($id_congressiste) && $facture->factureExiste($id_congressiste)) {
        echo "<div class='notif info'>";
        echo "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'><!-- Icon from Sargam Icons by Abhimanyu Rana - https://github.com/planetabhi/sargam-icons/blob/main/LICENSE.txt --><g fill='none'><path fill='white' fill-opacity='.16' d='M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2'/><path stroke='white' stroke-linecap='round' stroke-linejoin='round' stroke-miterlimit='10' stroke-width='1.5' d='M12 16h.008M12 8v5m10-1c0-5.523-4.477-10-10-10S2 6.477 2 12s4.477 10 10 10s10-4.477 10-10'/></g></svg>";
        echo "<p>Une facture existe déjà pour ce congressiste<p>";
        echo "</div>";
    } else {
        $reglee = isset($_POST['reglee']) ? 1 : 0; // Facture réglée ou non

        // Calculer les montants
        if (!empty($id_congressiste)) {
            $hotelCost = $facture->calculateHotelCost($id_congressiste);
            $sessionCost = $facture->calculateSessionsCostByCongressiste($id_congressiste);
            $activiteCost = $facture->calculateActivitesCostByCongressiste($id_congressiste);
            $totalCost = $hotelCost + $sessionCost + $activiteCost;
        }

        // Si "Créer la facture" est cliqué
        if (isset($_POST['create_facture'])) {
            $success = $facture->addFacture($date, $id_congressiste, $reglee);
            if ($success) {
                header("Location: ./index.php?action=defaut");
                exit();
            } else {
                echo "<div class='notif error'>";
                echo "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'><!-- Icon from Sargam Icons by Abhimanyu Rana - https://github.com/planetabhi/sargam-icons/blob/main/LICENSE.txt --><g fill='none'><path fill='white' fill-opacity='.16' d='M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2'/><path stroke='white' stroke-linecap='round' stroke-linejoin='round' stroke-miterlimit='10' stroke-width='1.5' d='M12 16h.008M12 8v5m10-1c0-5.523-4.477-10-10-10S2 6.477 2 12s4.477 10 10 10s10-4.477 10-10'/></g></svg>";
                echo "<p>La facture n'a pas été ajoutée<p>";
                echo "</div>";
            }
        }
    }
}

// Inclure la vue du formulaire de création de facture
include "./vue/vueAjouterFacture.php";
