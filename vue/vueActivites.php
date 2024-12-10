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
            <td style='padding: 15px;'><a href='index.php?action=activites&id=<?php echo $activite->id ?>'>SUPPRIMER</a></td>
            <td><button onclick="openForm(<?php echo $activite->id; ?>)">Modifier</button></td>
 
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

<div id="editForm" style="display:none;">
    <h1>Modifier Activite</h1>
    <form action="./?action=modifierActivite" method="POST">
        <input type="hidden" id="editId" name="id" />
        <input type="text" id="editNom" name="nom" placeholder="Nom de l'Activité" required/><br />
        <input type="text" id="editPrix" name="prix" placeholder="Prix de l'activité" required/><br />
        <input type="time" id="editHeure" name="heure" required/><br />
        <input type="date" id="editDate" name="date" required/><br />
        <input type="submit" name="submit" value="Modifier"/>
    </form>
</div>
 
<script>
function openForm(id) {
    document.getElementById('editForm').style.display = 'block';
    // Populate the form with the activity data
    var activite = <?php echo json_encode($LesActivites); ?>.find(a => a.id == id);
    document.getElementById('editId').value = activite.id;
    document.getElementById('editNom').value = activite.nom;
    document.getElementById('editPrix').value = activite.prix;
    document.getElementById('editHeure').value = activite.heure;
    document.getElementById('editDate').value = activite.date_activite;
}
</script>
 
<?php
    include "./vue/pied.php";
?>