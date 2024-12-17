<?php
require_once "model/congressiste.php";
require_once "model/activites.php";


$congressisteModel = new Congressiste();
$LesCongressistes = $congressisteModel->getLesCongressistes();

$activiteModel = new Activites();
$LesActivites = $activiteModel->getLesActivites();

if (isset($_POST["ajouter"])) {
    $idCongressiste = (int)$_POST["id_congressiste"];
    $idActivites = $_POST["id_activite"];

    $congressiste = new Congressiste();
    $congressiste->setId($idCongressiste);

    $success = true;
    foreach ($idActivites as $idActivite) {
        $idActivite = (int)$idActivite;
        if (!$congressiste->inscrireActivite($idActivite)) {
            $success = false;
        }
    }

    if ($success) {
        echo "<p style='color: green;'>Inscription réussie pour toutes les activités sélectionnées !</p>";
    } else {
        echo "<p style='color: red;'>Erreur lors de l'inscription à certaines activités.</p>";
    }
}


include "vue/vueCongressiste.php";
