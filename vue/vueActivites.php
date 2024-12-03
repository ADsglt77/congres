<?php
    include "./vue/entete.php";
?>
<h1>Bienvenue à l'inscription aux activités</h1>

<h1>Liste des Activités</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prix</th>
        <th>Date</th>
        <th>Heure</th>
    </tr>
    <?php foreach ($LesActivites as $activite) { ?>
        <tr>
            <td style='padding: 15px;'><?php echo $activite->id; ?></td>
            <td style='padding: 15px;'><?php echo $activite->nom; ?></td>
            <td style='padding: 15px;'><?php echo $activite->prix; ?> €</td>
            <td style='padding: 15px;'><?php echo $activite->date_activite; ?></td>
            <td style='padding: 15px;'><?php echo $activite->heure; ?></td>
        </tr>
    <?php } ?>
</table>

<?php
    include "./vue/pied.php";
?>
