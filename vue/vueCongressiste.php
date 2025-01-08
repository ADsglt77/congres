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
</style>

<div class="container">
    <div class="titre">
        <h1>Gestion des inscriptions</h1>
    </div>

    <div class="center">
        <?php if (!empty($message)) : ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

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
                            <td><?php echo htmlspecialchars($congressiste->id); ?></td>
                            <td><?php echo htmlspecialchars($congressiste->nom_congressiste); ?></td>
                            <td><?php echo htmlspecialchars($congressiste->adresse); ?></td>
                            <td><a href="./?action=congressiste&id=<?php echo $congressiste->id; ?>">Voir les inscriptions</a></tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>

        <!-- Étape 1 : Choisir une activité -->
        <section>
            <h2>Étape 1 : Choisissez une activité</h2>
            <form method="POST">
                <select name="id_activite" required>
                    <option value="">-- Sélectionnez une activité --</option>
                    <?php foreach ($LesActivites as $activite) : ?>
                        <option value="<?php echo $activite->id; ?>" 
                            <?php echo (!empty($activiteSelectionnee) && $activiteSelectionnee == $activite->id) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($activite->nom) . " - " . htmlspecialchars($activite->prix) . " €"; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" name="choisir_activite">Valider l'activité</button>
            </form>
        </section>

        <!-- Étape 2 : Choisir un congressiste -->
        <?php if (!empty($activiteSelectionnee)) : ?>
            <section>
                <h2>Étape 2 : Choisissez un congressiste</h2>
                <form method="POST">
                    <input type="hidden" name="id_activite" value="<?php echo htmlspecialchars($activiteSelectionnee); ?>">
                    <select name="id_congressiste" required>
                        <option value="">-- Sélectionnez un congressiste --</option>
                        <?php foreach ($LesCongressistes as $congressiste) : ?>
                            <option value="<?php echo $congressiste->id; ?>" 
                                <?php echo (!empty($congressisteSelectionne) && $congressisteSelectionne == $congressiste->id) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($congressiste->nom_congressiste); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" name="choisir_congressiste">Valider le congressiste</button>
                </form>
            </section>
        <?php endif; ?>

        <!-- Étape 3 : Inscrire ou annuler -->
        <?php if (!empty($activiteSelectionnee) && !empty($congressisteSelectionne)) : ?>
            <section>
                <h2>Étape 3 : Inscrire ou annuler</h2>
                <form method="POST">
                    <input type="hidden" name="id_activite" value="<?php echo htmlspecialchars($activiteSelectionnee); ?>">
                    <input type="hidden" name="id_congressiste" value="<?php echo htmlspecialchars($congressisteSelectionne); ?>">
                    <button type="submit" name="inscrire">Inscrire à l'activité</button>
                    <button type="submit" name="annuler" class="danger">Annuler l'inscription</button>
                </form>
            </section>
        <?php endif; ?>
    </div>
</div>

<?php include "./vue/pied.php"; ?>