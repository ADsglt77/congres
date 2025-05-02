<?php 
   include "./vue/entete.php";
?>  

<style>
    .connexion-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
    }

    .connexion-form {
        max-width: 450px;
        width: 100%;
        background-color: rgb(var(--surface));
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-md);
        padding: var(--spacing-8);
        border: 1px solid rgba(var(--border), 1);
    }

    .connexion-form h2 {
        color: rgb(var(--primary));
        margin-bottom: var(--spacing-6);
        text-align: center;
    }

    .connexion-form label {
        display: block;
        margin-bottom: var(--spacing-2);
        font-weight: 500;
        color: rgb(var(--text-secondary));
    }

    .connexion-form input[type="text"],
    .connexion-form input[type="password"] {
        margin-bottom: var(--spacing-4);
    }

    .button-container {
        display: flex;
        justify-content: space-between;
        margin-top: var(--spacing-6);
        gap: var(--spacing-4);
    }

    .button-container .button {
        flex: 1;
    }
</style>

<div class="connexion-container">
    <form method="POST" action="./?action=connexion" class="connexion-form">
       <h2>Connexion</h2>

       <!-- Champ Login -->
       <label for="login">Login*:</label>
       <input type="text" name="login" id="login" value="" required>

       <!-- Champ Mot de passe -->
       <label for="mdp">Mot de passe*:</label>
       <input type="password" name="mdp" id="mdp" value="" required>

       <!-- Boutons -->
       <div class="button-container">
          <input type="submit" value="Valider" name="validerConnexion" class="button">
          <input type="reset" value="Annuler" class="button">
       </div>
    </form>
</div>

<?php 
   include "./vue/pied.php";
?>