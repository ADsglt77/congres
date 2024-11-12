
<?php


class ControleurActivites {

    public function index() {
        $activites = Activites::getActivites();
        include 'vue/vueActivites.php';  // Appelle la vue pour afficher la liste des activités
    }

    public function show($id) {
        $activite = Activites::getActivite($id);
        include 'vue/vueActiviteDetail.php';  // Appelle la vue pour afficher le détail d'une activité
    }

    public function create() {
        include 'vue/vueAjouterActivite.php';  // Affiche le formulaire pour créer une activité
    }

    public function store() {
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $prix = floatval($_POST['prix']);
        Activites::ajouterActivite($nom, $description, $prix);
        header('Location: /activites');  // Redirige vers la liste des activités
    }

    public function edit($id) {
        $activite = Activites::getActivite($id);
        include 'vue/vueModifierActivite.php';  // Affiche le formulaire pour modifier une activité
    }

    public function update($id) {
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $prix = floatval($_POST['prix']);
        Activites::modifierActivite($id, $nom, $description, $prix);
        header('Location: /activites');
    }

    public function delete($id) {
        Activites::supprimerActivite($id);
        header('Location: /activites');
    }
}
