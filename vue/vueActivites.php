<?php
    include "./vue/entete.php";
?>
<h1>Bienvenue à l'inscription aux activités</h1>

<h1>Liste des Activités</h1>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Description</th>
        <th>Prix</th>
    </tr>
    <?php foreach ($LesActivites as $activite) { ?>
        <tr>
            <td><?php echo $activite->getId(); ?></td>
            <td><?php echo $activite->getNom(); ?></td>
            <td><?php echo $activite->getDescription(); ?></td>
            <td><?php echo $activite->getPrix(); ?> €</td>
        </tr>
    <?php } ?>
</table>

<?php
    include "./vue/pied.php";
?>
