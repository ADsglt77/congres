<?php
include "./vue/entete.php";
?>

<style>
    .facture-container {
        max-width: 800px;
        margin: 0 auto;
        background-color: rgb(var(--surface));
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-md);
        padding: var(--spacing-8);
        border: 1px solid rgba(var(--border), 1);
        margin-bottom: var(--spacing-8);
    }

    .facture-header {
        margin-bottom: var(--spacing-6);
        border-bottom: 1px solid rgba(var(--border), 1);
        padding-bottom: var(--spacing-4);
    }

    .facture-header h2 {
        color: rgb(var(--primary));
        margin-bottom: var(--spacing-2);
    }

    .facture-section {
        margin-bottom: var(--spacing-6);
        padding-bottom: var(--spacing-4);
        border-bottom: 1px solid rgba(var(--border), 0.5);
    }

    .facture-section h3 {
        color: rgb(var(--secondary));
        font-size: var(--txt-xl);
        margin-bottom: var(--spacing-3);
    }

    .facture-section p {
        margin-bottom: var(--spacing-2);
        color: rgb(var(--text-secondary));
    }

    .facture-section p strong {
        color: rgb(var(--text-primary));
    }

    .facture-section ul {
        padding-left: var(--spacing-4);
    }

    .facture-section ul li {
        margin-bottom: var(--spacing-2);
        color: rgb(var(--text-secondary));
    }

    .facture-summary {
        background-color: rgba(var(--primary), 0.05);
        padding: var(--spacing-4);
        border-radius: var(--radius-md);
    }

    .facture-summary p:last-child {
        font-size: var(--txt-lg);
        color: rgb(var(--primary));
        font-weight: 600;
        margin-top: var(--spacing-2);
        padding-top: var(--spacing-2);
        border-top: 1px solid rgba(var(--border), 1);
    }

    .button-container {
        display: flex;
        justify-content: flex-start;
        margin-top: var(--spacing-6);
        gap: var(--spacing-4);
    }
    
    .button {
        display: inline-block;
        padding: var(--spacing-3) var(--spacing-6);
        border-radius: var(--radius-md);
        font-weight: 500;
        text-align: center;
        text-decoration: none;
        transition: all 0.2s ease;
        font-size: var(--txt-sm);
    }
    
    .button-return {
        background-color: transparent;
        color: rgb(var(--text-primary));
        border: 1px solid rgba(var(--border), 1);
    }
    
    .button-return:hover {
        background-color: rgba(var(--text-primary), 0.05);
        border-color: rgba(var(--text-primary), 0.7);
    }
    
    .button-pdf {
        background-color: rgb(var(--primary));
        color: white;
        border: 1px solid rgb(var(--primary));
    }
    
    .button-pdf:hover {
        background-color: rgba(var(--primary), 0.9);
        box-shadow: var(--shadow-sm);
    }

    .button-delete {
        background-color: rgb(var(--error));
        color: white;
        border: 1px solid rgb(var(--error));
    }

    .button-delete:hover {
        background-color: rgba(var(--error), 0.9);
        box-shadow: var(--shadow-sm);
    }

    @media (max-width: 768px) {
        .facture-container {
            padding: var(--spacing-4);
        }
        
        .button-container {
            flex-direction: column;
        }
        
        .button-container .button {
            width: 100%;
            text-align: center;
            margin-bottom: var(--spacing-2);
        }
    }
</style>

<div class="facture-container">
    <?php if ($detailsFacture && $detailsFacture['facture']) : ?>
        <?php $facture = $detailsFacture['facture']; ?>
        
        <div class="facture-header">
            <h2>Détails de la Facture #<?php echo htmlspecialchars($facture['id_facture']); ?></h2>
            <p><strong>Date :</strong> <?php echo htmlspecialchars($facture['date']); ?></p>
        </div>

        <div class="facture-section">
            <h3>Informations sur le Congressiste</h3>
            <p><strong>Nom :</strong> <?php echo htmlspecialchars($facture['congressiste_nom']); ?></p>
            <p><strong>Prénom :</strong> <?php echo htmlspecialchars($facture['congressiste_prenom']); ?></p>
            <p><strong>Acompte :</strong> <?php echo number_format($facture['acompte'], 2); ?> €</p>
        </div>

        <?php if ($detailsFacture['hotel']) : ?>
            <div class="facture-section">
                <h3>Hôtel</h3>
                <p><strong>Nom :</strong> <?php echo htmlspecialchars($detailsFacture['hotel']['hotel_nom']); ?></p>
                <p><strong>Prix par participant :</strong> <?php echo number_format($detailsFacture['hotel']['hotel_prix'], 2); ?> €</p>
                <?php if (!empty($detailsFacture['hotel']['petitdej_prix'])) : ?>
                    <p><strong>Petit-déjeuner :</strong> <?php echo number_format($detailsFacture['hotel']['petitdej_prix'], 2); ?> €</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="facture-section">
            <h3>Activités</h3>
            <?php if (!empty($detailsFacture['activites'])) : ?>
                <ul>
                    <?php foreach ($detailsFacture['activites'] as $activite) : ?>
                        <li><?= htmlspecialchars($activite['activite_nom']) . " - " . number_format($activite['activite_prix'], 2) . " €"; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p>Aucune activité sélectionnée.</p>
            <?php endif; ?>
        </div>

        <div class="facture-section">
            <h3>Sessions</h3>
            <?php if (!empty($detailsFacture['sessions'])) : ?>
                <ul>
                    <?php foreach ($detailsFacture['sessions'] as $session) : ?>
                        <li><?= htmlspecialchars($session['session_nom']) . " - " . number_format($session['session_prix'], 2) . " €"; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p>Aucune session sélectionnée.</p>
            <?php endif; ?>
        </div>

        <div class="facture-summary">
            <p><strong>Montant Hôtel :</strong> <?= number_format($detailsFacture['montants']['hotel'], 2); ?> €</p>
            <p><strong>Montant Sessions :</strong> <?= number_format($detailsFacture['montants']['sessions'], 2); ?> €</p>
            <p><strong>Montant Activités :</strong> <?= number_format($detailsFacture['montants']['activites'], 2); ?> €</p>
            <p><strong>Total :</strong> <?= number_format($detailsFacture['montants']['total'], 2); ?> €</p>
            <p><strong>Total après acompte :</strong> <?= number_format($detailsFacture['montants']['totalAfterAcompte'], 2); ?> €</p>
        </div>
    <?php else : ?>
        <p>Erreur : Aucun détail disponible pour cette facture.</p>
    <?php endif; ?>
    <div class="button-container">
    <a href="index.php?action=defaut" class="button button-return">Retour à la liste des factures</a>
    <a href="./?action=pdfFacture&id=<?= $facture['id_facture'] ?>" class="button button-pdf">Voir PDF</a>
    <?php
if ($_SESSION['is_admin']) {
    echo '<a href="index.php?action=supprimerFacture&id=' . $facture['id_facture'] . '" 
          class="button button-delete" 
          onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cette facture ?\');">
          Supprimer la facture
          </a>';
}
?>
</div>
</div>


<?php
include "./vue/pied.php";
?>