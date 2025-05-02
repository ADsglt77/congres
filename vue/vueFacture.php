<?php 
include "./vue/entete.php";
?>

<style>
    h1 {
        color: rgb(var(--primary));
        margin-bottom: var(--spacing-6);
        text-align: center;
    }

    .search-form {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: var(--spacing-4);
        max-width: 600px;
        margin: 0 auto var(--spacing-8) auto;
        min-width: auto;
        padding: 0;
    }

    .search-input {
        flex: 1;
        padding: var(--spacing-3) var(--spacing-4);
        border-radius: var(--radius-md);
        border: 1px solid rgba(var(--border), 1);
    }

    .cards-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: var(--spacing-6);
        margin-bottom: var(--spacing-8);
    }

    .card {
        background-color: rgb(var(--surface));
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-md);
        padding: var(--spacing-6);
        border: 1px solid rgba(var(--border), 1);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
    }

    .card h3 {
        color: rgb(var(--primary));
        margin-bottom: var(--spacing-4);
        font-size: var(--txt-xl);
    }

    .card p {
        margin-bottom: var(--spacing-2);
        color: rgb(var(--text-secondary));
    }

    .card p strong {
        color: rgb(var(--text-primary));
    }

    .card .button {
        display: flex;
        flex-direction: column;
        margin-top: var(--spacing-4);
        margin-right: var(--spacing-2);
        padding: var(--spacing-2) var(--spacing-4);
        border-radius: var(--radius-md);
        font-weight: 500;
        font-size: var(--txt-sm);
        text-align: center;
        transition: all 0.2s ease;
    }

    .button-toggle {
        background-color: rgb(var(--secondary));
        color: white;
        border: 1px solid rgb(var(--secondary));
    }

    .button-toggle:hover {
        background-color: rgba(var(--secondary), 0.9);
        box-shadow: var(--shadow-md);
    }
    
    .button-details {
        background-color: transparent;
        color: rgb(var(--primary));
        border: 1px solid rgb(var(--primary));
    }

    .button-details:hover {
        background-color: rgba(var(--primary), 0.05);
        color: rgb(var(--primary));
    }

    @media (max-width: 768px) {
        .search-form {
            flex-direction: column;
            align-items: stretch;
        }
        
        .cards-container {
            grid-template-columns: 1fr;
        }
        
        .card .button {
            display: block;
            width: 100%;
            margin-right: 0;
            margin-bottom: var(--spacing-2);
        }
    }
</style>

<h1>Liste des Factures</h1>

<?php
if ($_SESSION['is_admin']) {
    echo '<form method="GET" action="" class="search-form">';
        echo '<input type="hidden" name="action" value="defaut">';
        // Utilisation de guillemets simples pour éviter le conflit avec les doubles guillemets de l'attribut
        echo '<input type="text" name="search" placeholder="Rechercher par nom de congressiste..." value="';
        echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; // Concatenation de la valeur
        echo '" class="search-input">';
    echo '<button type="submit" class="button">Rechercher</button>';
    echo '</form>';
}
?>


<?php
// Vérifier si des factures sont disponibles
if ($factures && $factures->rowCount() > 0) {
    echo '<div class="cards-container">';

    // Parcourir les factures et afficher chaque carte
    while ($row = $factures->fetch(PDO::FETCH_ASSOC)) {
        $regleeText = $row['reglee'] ? 'Oui' : 'Non';
        $toggleAction = $row['reglee'] ? 'Marquer comme non Réglée' : 'Marquer comme réglée';

        echo '<div class="card">';
        echo "<h3>Facture #" . htmlspecialchars($row['id_facture']) . "</h3>";
        echo "<p><strong>Date :</strong> " . htmlspecialchars($row['date']) . "</p>";
        echo "<p><strong>Réglée :</strong> $regleeText</p>";
        echo "<p><strong>Congressiste :</strong> " . 
             (!empty($row['congressiste_nom']) ? htmlspecialchars($row['congressiste_nom']) : 'Inconnu') . " " . 
             (!empty($row['congressiste_prenom']) ? htmlspecialchars($row['congressiste_prenom']) : '') . 
             "</p>";
        echo "<p><strong>Organisme Payeur :</strong> " . 
             (!empty($row['organisme_nom']) ? htmlspecialchars($row['organisme_nom']) : 'N/A') . 
             "</p>";

        // Si l'utilisateur est admin, afficher le bouton "Marquer Réglée"
        if ($_SESSION['is_admin']) {
            echo '<a href="./?toggle=' . htmlspecialchars($row['id_facture']) . '" class="button button-toggle">' . htmlspecialchars($toggleAction) . '</a>';
        }
        
        echo '<a href="./?action=voirFacture&id=' . htmlspecialchars($row['id_facture']) . '" class="button button-details">Voir détails</a>';
        echo '</div>';
    }

    echo '</div>';
} else {
    echo "<p>Aucune facture trouvée.</p>";
}
?>

<?php 
include "./vue/pied.php";
?>