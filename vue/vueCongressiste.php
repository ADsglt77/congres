<?php
    include "./vue/entete.php";
?>

<style>
h1 {
    margin-top: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 18px;
    text-align: left;
}

th, td {
    padding: 12px;
    border: 1px solid #ddd;
}

th {
    background-color: #f4f4f4;
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:nth-child(odd) {
    background-color: #ffffff;
}

tr:hover {
    background-color: #f1f1f1;
}

form input[type="radio"] {
    margin: 10px 10px 10px 0;
    transform: scale(1.2); /* Agrandit légèrement les boutons radio */
}

form input[type="submit"] {
    margin: 10px 0;
    padding: 8px;
    font-size: 16px;
    background-color: #5cb85c;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

form input[type="submit"]:hover {
    background-color: #4cae4c;
}

.btn a {
    margin: 10px 0;
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    text-decoration: none;
    background-color: #5cb85c;
    color: white;
    display: inline-block;
}

.btn a:hover {
    background-color: #4cae4c;
}
</style>

<div class="container">
    <div class="center">

        <h1>Gestion des Congressistes</h1>
        <h2>Liste des Congressistes</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Code Postal</th>
                <th>Date d'Inscription</th>
                <th>Préférence Hôtel</th>
                <th></th>
            </tr>
            <?php foreach ($LesCongressistes as $congressiste) { ?>
                <tr>
                    <td><?php echo $congressiste->id; ?></td>
                    <td><?php echo $congressiste->nom_congressiste; ?></td>
                    <td><?php echo $congressiste->adresse; ?></td>
                    <td><?php echo $congressiste->codepostal; ?></td>
                    <td><?php echo $congressiste->date_inscription; ?></td>
                    <td><?php echo $congressiste->preference_hotel; ?></td>
                    <td><a href="?action=congressiste&ajouter=<?php echo $congressiste->id; ?>" style="color: blue;">AJOUTER À UNE ACTIVITÉ</a></td>
                </tr>
            <?php } ?>
        </table>

        <?php
        if(isset($_GET["ajouter"])) {
            $idCongressiste = (int)$_GET["ajouter"];
            ?>
            <h1>Choisir l'activité pour le congressiste <?php echo $congressiste->nom_congressiste; ?> :</h1>
            <form action="./?action=congressiste" method="POST">
                <?php foreach ($LesActivites as $activite) { ?>
                    <label>
                        <input type="radio" name="id_activite" value="<?php echo $activite->id; ?>" required>
                        <?php echo $activite->nom; ?>
                    </label>
                    <br>
                <?php } ?>
                <input type="hidden" name="id_congressiste" value="<?php echo $idCongressiste; ?>">
                <input type="submit" name="ajouter" value="Ajouter">
            </form>
        <?php } ?>
    </div>
</div>

<?php include "./vue/pied.php"; ?>