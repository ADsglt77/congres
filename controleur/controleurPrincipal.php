<?php
function controleurPrincipal($action){
    $lesActions = array();
    $lesActions["activites"] = "activites.php";
    $lesActions["congressiste"] = "congressiste.php";

 
    if (array_key_exists ( $action , $lesActions )){
        return $lesActions[$action];
    }
    else{
        return $lesActions["activites"];
    }
}
?>