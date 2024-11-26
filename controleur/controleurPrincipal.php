<?php
function controleurPrincipal($action){
    $lesActions = array();
    $lesActions["activites"] = "activites.php";
    $lesActions["congressiste"] = "congressiste.php";
    $lesActions["accueil"] = "../vue/accueil.php";


 
    if (array_key_exists ( $action , $lesActions )){
        return $lesActions[$action];
    }
    else{
        return $lesActions["accueil"];
    }
}
?>