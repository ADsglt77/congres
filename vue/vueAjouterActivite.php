<?php
    include "./vue/entete.php";
?>
<h1>Bienvenue à l'inscription aux activités</h1>

<h1>Liste des Activités</h1>
<form action="./?action=activites" method="POST">
    <input type="text" name="nom" placeholder="Nom de l'Activité" /><br />
    <input type="text" name="prix" placeholder="Prix de l'activité" /><br />
    <input type="date" name="date" placeholder="Date de l'Activité" /><br />
    <input type="heure" name="heure" placeholder="Heure de l'Activité" /><br />
    <input type="submit" />Ajouter</input>
</form>

<?php
    include "./vue/pied.php";
?>
