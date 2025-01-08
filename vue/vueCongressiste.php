<?php include "./vue/entete.php"; ?>

<style>
select, button {
    padding: 10px;
    font-size: 16px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 100%;
    box-sizing: border-box;
}

select:focus, button:focus {
    outline: none;
    border-color: #5cb85c;
}

button {
    background-color: #5cb85c;
    color: white;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #4cae4c;
}

button.danger {
    background-color: #d9534f;
}

button.danger:hover {
    background-color: #c9302c;
}

.titre {
    margin-top: 50px;
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

.container {
    display: flex;
    justify-content: space-between;
}

.left, .right {
    width: 48%;
}
</style>

<div class="container">
    <div class="left">
        <div class="titre">
            <h1>Gestion des inscriptions</h1>
        </div>

        <div class="top">
            <?php if (!empty($message)) : ?>
                <p><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>
        </div>

        <!-- Liste des Congressistes -->
        <section>
            <h2>Liste des Congressistes</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>Voir les inscriptions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($LesCongressistes as $congressiste) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($congressiste->id, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($congressiste->nom_congressiste, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($congressiste->adresse, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="id_congressiste" value="<?php echo htmlspecialchars($congressiste->id, ENT_QUOTES, 'UTF-8'); ?>">
                                    <button type="submit" name="voir_inscriptions">Voir les inscriptions</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </div>

    <div class="right">
        <!-- Afficher les activités avec des cases à cocher -->
        <?php if (!empty($congressisteSelectionne) && is_object($congressisteSelectionne)) : ?>
            <section>
                <h2>Activités pour <?php echo htmlspecialchars($congressisteSelectionne->nom_congressiste, ENT_QUOTES, 'UTF-8'); ?></h2>
                <form method="POST">
                    <input type="hidden" name="id_congressiste" value="<?php echo htmlspecialchars($congressisteSelectionne->id, ENT_QUOTES, 'UTF-8'); ?>">
                    <table>
                        <thead>
                            <tr>
                                <th>Nom de l'activité</th>
                                <th>Prix</th>
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Sélectionner</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($LesActivites as $activite) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($activite->nom, ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($activite->prix, ENT_QUOTES, 'UTF-8'); ?> €</td>
                                    <td><?php echo htmlspecialchars($activite->date_activite, ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($activite->heure, ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><input type="checkbox" name="id_activites[]" value="<?php echo $activite->id; ?>" <?php echo in_array($activite->id, $activitesInscrites) ? 'checked' : ''; ?>></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <button type="submit" name="inscrire">Mettre à jour les inscriptions</button>
                </form>
            </section>
        <?php endif; ?>
    </div>
</div>

<?php include "./vue/pied.php"; ?>