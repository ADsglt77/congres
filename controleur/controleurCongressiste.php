<?php

include "model/congressiste.php";

$message = ""; // Variable pour afficher les messages d'erreur ou de confirmation
$LesActivites = []; // Contiendra les activités
$LesCongressistes = []; // Contiendra les congressistes
$activiteSelectionnee = null;
$congressisteSelectionne = null;
$activitesInscrites = []; // Contiendra les activités auxquelles le congressiste est inscrit

// Initialiser un objet Congressiste
$unCongressiste = new Congressiste();

// Étape 1 : Charger les activités
$LesActivites = $unCongressiste->getToutesActivites(); // Méthode à ajouter au modèle Congressiste

// Charger tous les congressistes
$LesCongressistes = $unCongressiste->getTousCongressistes();

// Étape 2 : Gestion de la sélection d'un congressiste
if (isset($_POST["voir_inscriptions"])) {
    $congressisteSelectionne = $unCongressiste->getCongressisteById($_POST["id_congressiste"]);
    $activitesInscrites = $unCongressiste->getActivitesInscrites($congressisteSelectionne->id);
}

// Inscription et désinscription d'un congressiste aux activités
if (isset($_POST["inscrire"])) {
    if (isset($_POST["id_congressiste"])) {
        $unCongressiste->setId((int)$_POST["id_congressiste"]);
        $idActivites = $_POST["id_activites"] ?? []; // Si aucune activité n'est cochée, $idActivites sera un tableau vide
        $activitesInscrites = $unCongressiste->getActivitesInscrites($unCongressiste->getId());

        $success = true;
        $errors = [];

        // Inscrire aux nouvelles activités
        foreach ($idActivites as $idActivite) {
            $idActivite = (int)$idActivite;
            if (!in_array($idActivite, $activitesInscrites)) {
                if (!$unCongressiste->inscrireActivite($idActivite)) {
                    $errors[] = "Erreur : le congressiste est déjà inscrit à l'activité ID: $idActivite.";
                    $success = false;
                }
            }
        }

        // Désinscrire des activités décochées
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
    } else {
        $message = "Erreur : veuillez sélectionner un congressiste.";
    }
    $congressisteSelectionne = $_POST["id_congressiste"] ?? null;
}

// Inclure la vue
include_once "vue/vueCongressiste.php";