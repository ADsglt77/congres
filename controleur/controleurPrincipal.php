<?php
function controleurPrincipal($action){
    $lesActions = array();
    $lesActions["activites"] = "controleurActivites.php";
    $lesActions["congressiste"] = "controleurCongressiste.php";
    $lesActions["ajouter"] = "controleurAjouterActivite.php";

    if (array_key_exists ( $action , $lesActions )){
        return $lesActions[$action];
    }
    else{
        return $lesActions["activites"];
    }
}
?>