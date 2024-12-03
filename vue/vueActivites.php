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

<h1>Ajouter Activites</h1>
<form action="./?action=activites" method="POST">
    <input type="text" name="nom" placeholder="Nom de l'Activité" required/><br />
    <input type="text" name="prix" placeholder="Prix de l'activité" required/><br />
    <input type="time" name="heure" placeholder="Date de l'Activité" required/><br />
    <input type="date" name="date" placeholder="Heure de l'Activité" required/><br />
    <input type="submit" name="submit" value="Ajouter"/>
</form>

<?php
    include "./vue/pied.php";
?>
