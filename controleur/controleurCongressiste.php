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
    $unCongressiste->setId($_POST["id_congressiste"]);
    $idActivite = $_POST["id_activite"];

    if ($unCongressiste->inscrireActivite($idActivite)) {
        $message = "Le congressiste a été inscrit à l'activité avec succès.";
    } else {
        $message = "Erreur : le congressiste est déjà inscrit.";
    }
    $activiteSelectionnee = $_POST["id_activite"];
    $congressisteSelectionne = $_POST["id_congressiste"];
}

// Annulation de l'inscription
if (isset($_POST["annuler"])) {
    $unCongressiste->setId($_POST["id_congressiste"]);
    $idActivite = $_POST["id_activite"];

    if ($unCongressiste->annulerInscription($idActivite)) {
        $message = "L'inscription a été annulée avec succès.";
    } else {
        $message = "Erreur : impossible de désaffilier (facture existante).";
    }
    $activiteSelectionnee = $_POST["id_activite"];
    $congressisteSelectionne = $_POST["id_congressiste"];
}

// Inclure la vue
include_once "vue/vueCongressiste.php";
