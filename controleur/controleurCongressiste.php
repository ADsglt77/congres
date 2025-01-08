<?php

include "model/congressiste.php";

$message = ""; // Variable pour afficher les messages d'erreur ou de confirmation
$LesActivites = []; // Contiendra les activités
$LesCongressistes = []; // Contiendra les congressistes
$activiteSelectionnee = null;
$congressisteSelectionne = null;

// Initialiser un objet Congressiste
$unCongressiste = new Congressiste();

// Étape 1 : Charger les activités
$LesActivites = $unCongressiste->getToutesActivites(); // Méthode à ajouter au modèle Congressiste

// Charger tous les congressistes
$LesCongressistes = $unCongressiste->getTousCongressistes();

// Étape 2 : Gestion de la sélection d'une activité
if (isset($_POST["choisir_activite"])) {
    $activiteSelectionnee = $_POST["id_activite"];
    $LesCongressistes = $unCongressiste->getTousCongressistes();
}

// Étape 3 : Gestion de la sélection d'un congressiste
if (isset($_POST["choisir_congressiste"])) {
    $activiteSelectionnee = $_POST["id_activite"];
    $congressisteSelectionne = $_POST["id_congressiste"];
    $LesCongressistes = $unCongressiste->getTousCongressistes(); // Recharger les congressistes
}

// Inscription d'un congressiste à une activité
if (isset($_POST["inscrire"])) {
    if (isset($_POST["id_congressiste"]) && isset($_POST["id_activites"])) {
        $unCongressiste->setId((int)$_POST["id_congressiste"]);
        $idActivites = $_POST["id_activites"];

        $success = true;
        $errors = [];
        foreach ($idActivites as $idActivite) {
            $idActivite = (int)$idActivite;
            if (!$unCongressiste->inscrireActivite($idActivite)) {
                $errors[] = "Erreur : le congressiste est déjà inscrit à l'activité ID: $idActivite.";
                $success = false;
            }
        }

        if ($success) {
            $message = "Le congressiste a été inscrit aux activités sélectionnées avec succès.";
        } else {
            foreach ($errors as $error) {
                $message .= "<p>$error</p>";
            }
        }
    } else {
        $message = "Erreur : veuillez sélectionner un congressiste et des activités.";
    }
    $activiteSelectionnee = $_POST["id_activite"] ?? null;
    $congressisteSelectionne = $_POST["id_congressiste"] ?? null;
}

// Annulation de l'inscription
if (isset($_POST["annuler"])) {
    if (isset($_POST["id_congressiste"]) && isset($_POST["id_activite"])) {
        $unCongressiste->setId((int)$_POST["id_congressiste"]);
        $idActivite = (int)$_POST["id_activite"];

        if ($unCongressiste->annulerInscription($idActivite)) {
            $message = "L'inscription a été annulée avec succès.";
        } else {
            $message = "Erreur : impossible de désaffilier (facture existante).";
        }
    } else {
        $message = "Erreur : veuillez sélectionner un congressiste et une activité.";
    }
    $activiteSelectionnee = $_POST["id_activite"] ?? null;
    $congressisteSelectionne = $_POST["id_congressiste"] ?? null;
}

// Inclure la vue
include_once "vue/vueCongressiste.php";