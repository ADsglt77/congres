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
            <td style='padding: 15px;'><a href='index.php?action=activites&supp=<?php echo $activite->id ?>'>SUPPRIMER</a></td>
            <td style='padding: 15px;'><a href='index.php?action=activites&modif=<?php echo $activite->id ?>'>MODIFIER</a></td>
        </tr>
    <?php } ?>
</table>

<h1>Ajouter Activites</h1>
<form action="./?action=activites" method="POST">
    <input type="text" name="nom" placeholder="Nom de l'Activité" required/><br />
    <input type="number" name="prix" placeholder="Prix de l'activité" required/><br />
    <input type="time" name="heure" placeholder="Date de l'Activité" required/><br />
    <input type="date" name="date" placeholder="Heure de l'Activité" required/><br />
    <input type="submit" name="ajouter" value="Ajouter"/>
</form>

<?php 
//print_r($_GET["modif"]);
if(isset($_GET["modif"])) {
    
    $nouvelleActivite = new Activites();
    $nouvelleActivite->setId((int) $_GET["modif"]);

    $activite = $nouvelleActivite->getActiviteById();

    ?>    
    <h1>Modifier Activite</h1>
    <form action="./?action=activites&modif=<?php echo $_GET['modif']; ?>" method="POST">
        <input type="text" name="nom" placeholder="Nom de l'Activité" value="<?php echo $activite->nom; ?>" required/><br />
        <input type="number" name="prix" placeholder="Prix de l'activité" value="<?php echo $activite->prix; ?>" required/><br />
        <input type="time" name="heure" value="<?php echo $activite->heure; ?>" required/><br />
        <input type="date" name="date" value="<?php echo $activite->date_activite; ?>" required/><br />
        <input type="submit" name="modifier" value="Modifier"/>
    </form>
    <?php
}
?>


<?php
    include "./vue/pied.php";
?>