<?php
// Assure-toi que ta connexion à la base de données est initialisée
require_once './config/database.php'; 
require_once './class/User.php'; 

$database = new Database(); 
$db = $database->getConnexion(); 
$user = new User($db); 

if (isset($_POST["validerConnexion"])) {
    $login = $_POST["login"];
    $mdp = $_POST["mdp"];

    if ($user->verifyUser($login, $mdp)) {
        // Vérification si l'utilisateur est admin
        if ($login === 'admin') {
            $_SESSION['is_admin'] = true;  // L'utilisateur est admin
        } else {
            $_SESSION['is_admin'] = false; // Utilisateur normal
            // Récupérer l'id du congressiste lié à cet utilisateur
            $id_congressiste = $user->getIdCongressisteByLogin($login);
            $_SESSION['id_congressiste'] = $id_congressiste;
        }

        // Sauvegarder le login dans la session
        $_SESSION['login'] = $login;

        // Rediriger en fonction du rôle
        if ($_SESSION['is_admin']) {
            header("Location: ./?action=default.php");
        } else {
            header("Location: ./?action=default");
        }
        exit();
    } else {
        echo "<div class='notif error'>";
        echo "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'><!-- Icon from Sargam Icons by Abhimanyu Rana - https://github.com/planetabhi/sargam-icons/blob/main/LICENSE.txt --><g fill='none'><path fill='white' fill-opacity='.16' d='M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2'/><path stroke='white' stroke-linecap='round' stroke-linejoin='round' stroke-miterlimit='10' stroke-width='1.5' d='M12 16h.008M12 8v5m10-1c0-5.523-4.477-10-10-10S2 6.477 2 12s4.477 10 10 10s10-4.477 10-10'/></g></svg>";
        echo "<p>Erreur de connexion<p>";
        echo "</div>";
    }
}


include "./vue/vueConnexion.php";
?>
