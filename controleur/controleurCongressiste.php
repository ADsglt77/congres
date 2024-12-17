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
    $errors = [];
    foreach ($idActivites as $idActivite) {
        $idActivite = (int)$idActivite;
        if ($congressiste->estDejaInscrit($idActivite)) {
            $errors[] = "Le congressiste est déjà inscrit à l'activité ID: $idActivite.";
            $success = false;
        } else {
            if (!$congressiste->inscrireActivite($idActivite)) {
                $errors[] = "Erreur lors de l'inscription à l'activité ID: $idActivite.";
                $success = false;
            }
        }
    }

    if ($success) {
        echo "<p style='color: green;'>Inscription réussie pour toutes les activités sélectionnées !</p>";
    } else {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }
}

include "vue/vueCongressiste.php";