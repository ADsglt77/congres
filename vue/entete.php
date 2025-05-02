<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <title>Gestion des Factures</title>
    </head>
<body>
    <div class="user">
        <?php
        if (isset($_SESSION['login'])) { // Si l'utilisateur est connecté
            echo "Connecté en tant que : " . htmlspecialchars($_SESSION['login']);
        } else {
            echo "";
        }
        ?>
    </div>
        <?php
        if (isset($_SESSION['login'])) { // Si l'utilisateur est connecté
            echo '<nav>';
                echo '<ul>';
                    if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === false) {
                        echo '<li><a href="./?action=defaut">Voir Facture</a></li>';
                    }
                    if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true) {
                        echo '<li><a href="./?action=ajoutFacture">Ajouter une Facture</a></li>';
                        echo '<li><a href="?filtre=toutes">Voir Toutes les Factures</a></li>';
                        echo'<li><a href="?filtre=reglees">Voir les Factures Réglées</a></li>';
                        echo'<li><a href="?filtre=non_reglees">Voir les Factures Non Réglées</a></li>';
                    }
                    echo '<li><a href="./?action=deconnexion">Se déconnecter</a></li>';
                echo '</ul>';
            echo '</nav>';
        }
        ?>
</body>
</html>
