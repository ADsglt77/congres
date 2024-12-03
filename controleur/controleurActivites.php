<?php

include "model/activites.php";

// On récupère les activités etc ...
$UneActivite = new Activites();
$LesActivites = $UneActivite->getLesActivites();

include_once "vue/vueActivites.php";