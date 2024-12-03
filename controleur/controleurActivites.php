<?php

include "model/activites.php";

// On récupère les activités etc ...
$UneActivite = new Activites();
$LesActivites = $UneActivite->getLesActivites();

// On ajoute une activité
$nouvelleActivite = new Activites();
$nouvelleActivite->ajouterActivite();

include_once "vue/vueActivites.php";