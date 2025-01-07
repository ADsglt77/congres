<?php

include "model/activites.php";

$UneActivite = new Activites();
$LesActivites = $UneActivite->getLesActivites();

if (isset($_POST["ajouter"])) {
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

if(isset($_GET["supp"])) {
    $nouvelleActivite = new Activites();
    $nouvelleActivite->setId($_GET["supp"]);

    // Supprimer l'activité et les affiliations
    if($nouvelleActivite->supprimerActiviteEtAffiliations()) {
        header("location: index.php");
    } else {
        echo "<p>Erreur lors de la suppression de l'activité et des affiliations.</p>";
    }
}

if (isset($_POST["modifier"])) {
    
        $modifierActivite = new Activites();
        $modifierActivite->setId($_GET["modif"]);
        $modifierActivite->setNom($_POST["nom"]);
        $modifierActivite->setPrix($_POST["prix"]);
        $modifierActivite->setDate($_POST["date"]);
        $modifierActivite->setHeure($_POST["heure"]);

        if ($modifierActivite->modifierActivite()) {
            header("location: index.php?action=activites");
        } else {
            echo "<p>Erreur lors de la modification de l'activité.</p>";
        }
}

include_once "vue/vueActivites.php";