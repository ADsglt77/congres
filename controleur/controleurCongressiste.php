<?php
require_once "model/congressiste.php";
require_once "model/activites.php";


$congressisteModel = new Congressiste();
$LesCongressistes = $congressisteModel->getLesCongressistes();


$activiteModel = new Activites();
$LesActivites = $activiteModel->getLesActivites();


if (isset($_POST["ajouter"])) {
    $idCongressiste = (int)$_POST["id_congressiste"];
    $idActivite = (int)$_POST["id_activite"];

    $congressiste = new Congressiste();
    $congressiste->setId($idCongressiste);

    if ($congressiste->inscrireActivite($idActivite)) {
        echo "<p style='color: green;'>Inscription réussie !</p>";
    } else {
        echo "<p style='color: red;'>Erreur lors de l'inscription.</p>";
    }
}

include "vue/vueCongressiste.php";
