<?php

include "model/congressiste.php";
include "model/activites.php";

$congressiste = new Congressiste();
$activites = new Activites();

// Variables pour le choix d'une activité et d'un congressiste
$activiteSelectionnee = $_POST['id_activite'] ?? null;
$congressisteSelectionne = $_POST['id_congressiste'] ?? null;

// Récupérer les activités et les congressistes
$LesActivites = $activites->getLesActivites();
$LesCongressistes = $congressiste->getTousCongressistes();

// Inscription d'un congressiste à une activité
if (isset($_POST['inscrire']) && $activiteSelectionnee && $congressisteSelectionne) {
    $congressiste->setId($congressisteSelectionne);
    if ($congressiste->inscrireActivite($activiteSelectionnee)) {
        $message = "Inscription réussie.";
    } else {
        $message = "Erreur : Une facture existe ou le congressiste est déjà inscrit.";
    }
}

// Annulation d'une inscription
if (isset($_POST['annuler']) && $activiteSelectionnee && $congressisteSelectionne) {
    $congressiste->setId($congressisteSelectionne);
    if ($congressiste->annulerInscription($activiteSelectionnee)) {
        $message = "Annulation réussie.";
    } else {
        $message = "Erreur : Annulation impossible. Une facture existe peut-être.";
    }
}

include "vue/vueCongressiste.php";
?>

