<?php

include "model/activites.php";

// On ajoute une activité
$nouvelleActivite = new Activites();
$nouvelleActivite->ajouterActivite();



if (isset($_POST["submit"])){
    $nom = $_POST["nom"];
    $prix = $_POST["prix"];
    $date = $_POST["date"];
    $heure = $_POST["heure"];
    
    $AjouterActivite = ajouterActivite($nom, $prix, $date, $heure);
}

include_once "vue/vueActivites.php";