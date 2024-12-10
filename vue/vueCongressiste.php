<?php include "./vue/entete.php"; ?>

<h1>Gestion des inscriptions</h1>

<?php if (!empty($message)) : ?>
    <p><?php echo htmlspecialchars($message); ?></p>
<?php endif; ?>

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

<?php include "./vue/pied.php"; ?>




