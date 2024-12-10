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

if(isset($_GET["id"])) {
    $nouvelleActivite = new Activites();

    $nouvelleActivite->setId($_GET["id"]);

    if($nouvelleActivite->supprimerActivite()) {
        header("location: index.php?action=");
    } else {
        echo "<p>Erreur lors de la suppression de l'activité.</p>";
    }
}
if (isset($_POST["modifier"])) {
    $activite = new Activites();
    $activite->setId($_POST["id"]);
    $activite->setNom($_POST["nom"]);
    $activite->setPrix($_POST["prix"]);
    $activite->setDate($_POST["date"]);
    $activite->setHeure($_POST["heure"]);
 
    if ($activite->modifierActivite()) {
        header("location: index.php?action=");
    } else {
        echo "<p>Erreur lors de la modification de l'activité.</p>";
    }
}
include_once "vue/vueActivites.php";