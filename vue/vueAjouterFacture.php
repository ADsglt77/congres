<?php 
include "./vue/entete.php";
?>

<style>
    .ajout-facture-container {
        max-width: 800px;
        margin: 0 auto;
        background-color: rgb(var(--surface));
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-md);
        padding: var(--spacing-8);
        border: 1px solid rgba(var(--border), 1);
        margin-bottom: var(--spacing-8);
    }

    h2 {
        color: rgb(var(--primary));
        margin-bottom: var(--spacing-6);
        text-align: center;
    }

    form {
        min-width: auto;
        padding: 0;
        margin: 0;
    }

    label {
        display: block;
        margin-bottom: var(--spacing-2);
        font-weight: 500;
        color: rgb(var(--text-secondary));
    }

    input[type="date"],
    select {
        width: 100%;
        padding: var(--spacing-3) var(--spacing-4);
        margin-bottom: var(--spacing-6);
    }

    .facture-totals {
        background-color: rgba(var(--surface-alt), 0.6);
        border-radius: var(--radius-lg);
        padding: var(--spacing-6);
        margin-top: var(--spacing-4);
        border: 1px solid rgba(var(--border), 1);
    }

    .facture-totals label {
        font-weight: 600;
        color: rgb(var(--text-secondary));
        margin-top: var(--spacing-4);
        margin-bottom: var(--spacing-1);
    }

    .facture-totals span {
        display: block;
        font-size: var(--txt-lg);
        color: rgb(var(--text-primary));
        margin-bottom: var(--spacing-3);
    }

    .facture-totals ul {
        margin: var(--spacing-2) 0 var(--spacing-4) var(--spacing-6);
        list-style-type: disc;
    }

    .facture-totals li {
        margin-bottom: var(--spacing-2);
        color: rgb(var(--text-secondary));
    }

    .facture-totals label:nth-last-of-type(1) {
        font-size: var(--txt-lg);
        color: rgb(var(--primary));
        margin-top: var(--spacing-6);
        padding-top: var(--spacing-4);
        border-top: 1px solid rgba(var(--border), 1);
        font-weight: 700;
    }

    .facture-totals span:nth-last-of-type(1) {
        font-weight: 700;
        font-size: var(--txt-xl);
        color: rgb(var(--primary));
    }

    .error-message {
        background-color: rgba(var(--error), 0.1);
        color: rgb(var(--error));
        padding: var(--spacing-4);
        border-radius: var(--radius-md);
        margin-bottom: var(--spacing-6);
        border-left: 4px solid rgb(var(--error));
    }

    button.button {
        display: block;
        width: 100%;
        margin-top: var(--spacing-6);
        padding: var(--spacing-4);
        background-color: rgb(var(--primary));
        color: white;
        border: none;
        border-radius: var(--radius-md);
        font-weight: 600;
        cursor: pointer;
        font-size: var(--txt-lg);
    }

    button.button:hover {
        background-color: rgba(var(--primary), 0.9);
        box-shadow: var(--shadow-md);
    }

    @media (max-width: 768px) {
        .ajout-facture-container {
            padding: var(--spacing-4);
        }
        
        .facture-totals {
            padding: var(--spacing-4);
        }
    }
</style>

<div class="ajout-facture-container">
    <h2>Créer une facture</h2>

    <?php if (isset($messageErreur)): ?>
        <div class="error-message">
            <p><?= htmlspecialchars($messageErreur) ?></p>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <!-- Date -->
        <label for="date">Date :</label>
        <input type="date" id="date" name="date" value="<?= isset($_POST['date']) ? htmlspecialchars($_POST['date']) : '' ?>" required>

        <!-- Liste déroulante des congressistes -->
        <label for="id_congressiste">Congressiste :</label>
        <select id="id_congressiste" name="id_congressiste" onchange="this.form.submit()" required>
            <option value="">-- Sélectionnez un congressiste --</option>
            <?php
            require_once './class/Congressiste.php';

            $stmt = $congressiste->getAllCongressistes();

            if ($stmt) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $selected = (isset($_POST['id_congressiste']) && $_POST['id_congressiste'] == $row['id']) ? 'selected' : '';
                    echo "<option value='{$row['id']}' $selected>{$row['nom']} {$row['prenom']}</option>";
                }
            }
            ?>
        </select>

        <?php if (isset($_POST['id_congressiste']) && !empty($_POST['id_congressiste']) && !isset($messageErreur)): ?>
        <?php
        // Calcul des montants pour le congressiste sélectionné
        $id_congressiste = $_POST['id_congressiste'];
        $hotelCost = $facture->calculateHotelCost($id_congressiste);
        $sessionCost = $facture->calculateSessionsCostByCongressiste($id_congressiste);
        $activiteCost = $facture->calculateActivitesCostByCongressiste($id_congressiste);
        $totalCost = $hotelCost + $sessionCost + $activiteCost;

        // Récupération des sessions et activités associées
        $sessions = $facture->getSessionDetails($id_congressiste);
        $activites = $facture->getActiviteDetails($id_congressiste);
        ?>

        <div class="facture-totals">
            <!-- Montant Hôtel -->
            <label>Montant Hôtel :</label>
            <span><?= number_format($hotelCost, 2) ?> €</span>

            <!-- Sessions -->
            <label>Sessions :</label>
            <?php if (!empty($sessions)): ?>
                <ul>
                    <?php foreach ($sessions as $session): ?>
                        <li><?= htmlspecialchars($session['session_nom']) ?> - <?= number_format($session['session_prix'], 2) ?> €</li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Aucune session associée.</p>
            <?php endif; ?>
            <label>Montant pour les sessions :</label>
            <span><?= number_format($sessionCost, 2) ?> €</span>

            <!-- Activités -->
            <label>Activités Culturelles :</label>
            <?php if (!empty($activites)): ?>
                <ul>
                    <?php foreach ($activites as $activite): ?>
                        <li><?= htmlspecialchars($activite['activite_nom']) ?> - <?= number_format($activite['activite_prix'], 2) ?> €</li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Aucune activité associée.</p>
            <?php endif; ?>
            <label>Montant pour les activités :</label>
            <span><?= number_format($activiteCost, 2) ?> €</span>

            <!-- Montant Total -->
            <label>Montant Total :</label>
            <span><?= number_format($totalCost, 2) ?> €</span>

            <!-- Bouton pour créer la facture -->
            <input type="hidden" name="total_cost" value="<?= $totalCost ?>">
            <button type="submit" name="create_facture" class="button">Créer la Facture</button>
        </div>
        <?php endif; ?>
    </form>
</div>

<?php 
include "./vue/pied.php";
?>