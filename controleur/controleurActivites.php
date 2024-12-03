<?php

include "model/activites.php";

$UneActivite = new Activites();
$LesActivites = $UneActivite->getLesActivites();


if (isset($_POST["submit"])) {
    // Récupérer les données envoyées par le formulaire    
    $nouvelleActivite = new Activites();

    $nouvelleActivite->setNom($_POST["nom"]);
    $nouvelleActivite->setPrix($_POST["prix"]);
    $nouvelleActivite->setDate($_POST["date"]);
    $nouvelleActivite->setHeure($_POST["heure"]);

    

    if ($nouvelleActivite->ajouterActivite()) {
        header("location: index.php?action=");
    } else {
        echo "<p>Erreur lors de l'ajout de l'activité.</p>";
    }
}

include_once "vue/vueActivites.php";