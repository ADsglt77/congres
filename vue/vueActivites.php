<!-- vue/vueActivites.php -->
 <?php
 include "./vue/entete.php";
    ?>
<h1>Liste des Activités</h1>
<a href="/activites/create">Ajouter une nouvelle activité</a>
<ul>
    <?php foreach ($activites as $activite): ?>
        <li>
            <a href="/activites/show/<?= $activite['id'] ?>"><?= $activite['nom'] ?></a>
            - <a href="/activites/edit/<?= $activite['id'] ?>">Modifier</a>
            - <a href="/activites/delete/<?= $activite['id'] ?>">Supprimer</a>
        </li>
    <?php endforeach; ?>
</ul>
<!-- vue/vueAjouterActivite.php -->
<h1>Ajouter une Activité</h1>
<form action="/activites/store" method="POST">
    Nom: <input type="text" name="nom"><br>
    Description: <input type="text" name="description"><br>
    Prix: <input type="text" name="prix"><br>
    <button type="submit">Enregistrer</button>
</form>
<!-- vue/vueActiviteDetail.php -->
<h1>Détail de l'Activité</h1>
<p>Nom: <?= $activite['nom'] ?></p>
<p>Description: <?= $activite['description'] ?></p>
<p>Prix: <?= $activite['prix'] ?> €</p>
<a href="/activites">Retour à la liste des activités</a>

<?php
include "./vue/pied.php";
?>
