<?php

include_once "model/congressiste.php"; // Utilisation de include_once pour éviter les doublons
include_once "model/accompagnant.php"; // Idem pour Accompagnant

$message = "";
$LesActivites = [];
$LesCongressistes = [];
$LesAccompagnants = []; // Liste des accompagnants disponibles
$congressisteSelectionne = null;
$activitesInscrites = [];
$activitesInscritesAccompagnant = [];

$unCongressiste = new Congressiste();

// Charger toutes les activités, congressistes et accompagnants
$LesActivites = $unCongressiste->getToutesActivites();
$LesCongressistes = $unCongressiste->getTousCongressistes();
$LesAccompagnants = (new Accompagnant())->getTousAccompagnants(); // Récupère tous les accompagnants

// Voir les inscriptions d’un congressiste
if (isset($_POST["voir_inscriptions"])) {
    if (isset($_POST["id_congressiste"])) {
        $congressisteSelectionne = $unCongressiste->getCongressisteById($_POST["id_congressiste"]);
        $activitesInscrites = $unCongressiste->getActivitesInscrites($congressisteSelectionne->id);

        // Charger les activités de l'accompagnant s'il y en a un
        if (!empty($congressisteSelectionne->id_accompagnant)) {
            $accompagnant = new Accompagnant($congressisteSelectionne->id_accompagnant, $pdo);  // Modification ici
            $activitesInscritesAccompagnant = $accompagnant->getActivitesInscrites($accompagnant->getId());
        }
    } else {
        $message = "Erreur : Aucun congressiste sélectionné.";
    }
}

// Mettre à jour les inscriptions
if (isset($_POST["inscrire"])) {
    if (isset($_POST["id_congressiste"])) {
        $unCongressiste->setId((int)$_POST["id_congressiste"]);
        $idActivites = $_POST["id_activites"] ?? [];
        $activitesInscrites = $unCongressiste->getActivitesInscrites($unCongressiste->getId());

        $success = true;
        $errors = [];

        // Inscription aux nouvelles activités (congressiste)
        foreach ($idActivites as $idActivite) {
            $idActivite = (int)$idActivite;
            if (!in_array($idActivite, $activitesInscrites)) {
                if (!$unCongressiste->inscrireActivite($idActivite)) {
                    $errors[] = "Erreur : le congressiste est déjà inscrit à l'activité ID: $idActivite.";
                    $success = false;
                }
            }
        }

        // Désinscription des activités décochées (congressiste)
        foreach ($activitesInscrites as $idActivite) {
            if (!in_array($idActivite, $idActivites)) {
                if (!$unCongressiste->annulerInscription($idActivite)) {
                    $errors[] = "Erreur : impossible de désaffilier de l'activité ID: $idActivite.";
                    $success = false;
                }
            }
        }

        // Gérer l'accompagnant si présent
        $congressisteSelectionne = $unCongressiste->getCongressisteById($unCongressiste->getId());
        if (!empty($congressisteSelectionne->id_accompagnant)) {
            $accompagnant = new Accompagnant($congressisteSelectionne->id_accompagnant, $pdo); // Modification ici
            $activitesInscritesAccompagnant = $accompagnant->getActivitesInscrites($accompagnant->getId());
            $idActivitesAccompagnant = $_POST["id_activites_accompagnant"] ?? [];

            // Inscription accompagnant aux activités où le congressiste est déjà inscrit
            foreach ($idActivitesAccompagnant as $idActivite) {
                $idActivite = (int)$idActivite;

                // Vérification si le congressiste est inscrit à l'activité avant d'ajouter l'accompagnant
                if (in_array($idActivite, $idActivites)) {
                    if (!in_array($idActivite, $activitesInscritesAccompagnant)) {
                        if (!$accompagnant->inscrireActivite($idActivite, $unCongressiste->getId())) {
                            $errors[] = "Erreur : impossible d'inscrire l'accompagnant à l'activité ID: $idActivite.";
                            $success = false;
                        }
                    }
                } else {
                    $errors[] = "Erreur : le congressiste n'est pas inscrit à l'activité ID: $idActivite, impossible d'inscrire l'accompagnant.";
                    $success = false;
                }
            }

            // Désinscription des activités décochées (accompagnant)
            foreach ($activitesInscritesAccompagnant as $idActivite) {
                if (!in_array($idActivite, $idActivitesAccompagnant)) {
                    if (!$accompagnant->annulerInscription($idActivite)) {
                        $errors[] = "Erreur : impossible de désaffilier l'accompagnant de l'activité ID: $idActivite.";
                        $success = false;
                    }
                }
            }

            // Rechargement pour affichage
            $activitesInscritesAccompagnant = $accompagnant->getActivitesInscrites($accompagnant->getId());
        }

        // Recharger les activités inscrites du congressiste
        $activitesInscrites = $unCongressiste->getActivitesInscrites($unCongressiste->getId());

        if ($success) {
            $message = "Inscriptions mises à jour avec succès.";
        } else {
            foreach ($errors as $error) {
                $message .= "<p>$error</p>";
            }
        }
    } else {
        $message = "Erreur : veuillez sélectionner un congressiste.";
    }
}

include_once "vue/vueCongressiste.php";  // Utilisation de include_once ici aussi
