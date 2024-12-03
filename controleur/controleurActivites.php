<?php

include "model/activites.php";


// On récupère les activités etc ...
$LesActivites = getLesActivites();

include_once "vue/vueActivites.php";