
<?php

require 'model/Activites.php';
require 'controleur/ControleurActivites.php';
include "./controleur/controleurPrincipal.php";

$controleur = new ControleurActivites();

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'create') {
        $controleur->create();
    } elseif ($action == 'store') {
        $controleur->store();
    } elseif ($action == 'edit' && isset($_GET['id'])) {
        $controleur->edit($_GET['id']);
    } elseif ($action == 'update' && isset($_GET['id'])) {
        $controleur->update($_GET['id']);
    } elseif ($action == 'delete' && isset($_GET['id'])) {
        $controleur->delete($_GET['id']);
    } elseif ($action == 'show' && isset($_GET['id'])) {
        $controleur->show($_GET['id']);
    } else {
        $controleur->index();
    }
} else {
    $controleur->index();  // Par défaut, afficher la liste des activités
}
