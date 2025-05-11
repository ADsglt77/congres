<?php

include "model/congressiste.php";

$message = "";
$LesActivites = [];
$LesCongressistes = [];
$congressisteSelectionne = null;
$activitesInscrites = [];

$unCongressiste = new Congressiste();

// Charger toutes les activités et congressistes
$LesActivites = $unCongressiste->getToutesActivites();
$LesCongressistes = $unCongressiste->getTousCongressistes();

// Voir les inscriptions d’un congressiste
if (isset($_POST["voir_inscriptions"])) {
    $congressisteSelectionne = $unCongressiste->getCongressisteById($_POST["id_congressiste"]);
    $activitesInscrites = $unCongressiste->getActivitesInscrites($congressisteSelectionne->id);
}

// Mettre à jour les inscriptions
if (isset($_POST["inscrire"])) {
    if (isset($_POST["id_congressiste"])) {
        $unCongressiste->setId((int)$_POST["id_congressiste"]);
        $idActivites = $_POST["id_activites"] ?? [];
        $activitesInscrites = $unCongressiste->getActivitesInscrites($unCongressiste->getId());

        $success = true;
        $errors = [];

        // Inscription aux nouvelles activités
        foreach ($idActivites as $idActivite) {
            $idActivite = (int)$idActivite;
            if (!in_array($idActivite, $activitesInscrites)) {
                if (!$unCongressiste->inscrireActivite($idActivite)) {
                    $errors[] = "Erreur : le congressiste est déjà inscrit à l'activité ID: $idActivite.";
                    $success = false;
                }
            }
        }

        // Désinscription des activités décochées
        foreach ($activitesInscrites as $idActivite) {
            if (!in_array($idActivite, $idActivites)) {
                if (!$unCongressiste->annulerInscription($idActivite)) {
                    $errors[] = "Erreur : impossible de désaffilier de l'activité ID: $idActivite.";
                    $success = false;
                }
            }
        }

        if ($success) {
            $message = "Le congressiste a été inscrit/désinscrit aux activités sélectionnées avec succès.";
        } else {
            foreach ($errors as $error) {
                $message .= "<p>$error</p>";
            }
        }

        // Recharger le congressiste pour l’affichage
        $congressisteSelectionne = $unCongressiste->getCongressisteById($unCongressiste->getId());
        $activitesInscrites = $unCongressiste->getActivitesInscrites($unCongressiste->getId());
    } else {
        $message = "Erreur : veuillez sélectionner un congressiste.";
    }
}

include_once "vue/vueCongressiste.php";
