    <?php

    class Activites {
        private int $Id;
        private string $Nom;
        private float $Prix;
        private string $Heure;
        private string $Date;

        public function __construct() {

        }

        public function getId(): int {
            return $this->Id;
        }

        public function setId(int $nouveauId): void {
            $this->Id = $nouveauId;
        }

        public function getNom(): string {
            return $this->Nom;
        }

        public function setNom(string $nouveauNom): void {
            $this->Nom = $nouveauNom;
        }

        public function getDescription(): string {
            return $this->description;
        }


        public function getPrix(): float {
            return $this->Prix;
        }

        public function setPrix(float $nouveauPrix): void {
            $this->Prix = $nouveauPrix;
        }

        public function getHeure(): string {
            return $this->Heure;
        }

        public function setHeure(string $nouvelleHeure): void {
            $this->Heure = $nouvelleHeure;
        }

        public function getDate(): string {
            return $this->Date;
        }

        public function setDate(string $nouvelleDate): void {
            $this->Date = $nouvelleDate;
        }

        public function getLesActivites() {
            include "bd.php";
            $req = "SELECT * FROM activite";
            $stmt = $pdo->prepare($req);
            $stmt->execute();
            $lesActivites = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $lesActivites;
        }

        public function getActiviteById() {
            include "bd.php";
            $req = "SELECT * FROM activite WHERE id = ?";
            $stmt = $pdo->prepare($req);
            $stmt->bindValue(1, $this->Id);
            $stmt->execute();
            $UneActivite = $stmt->fetch(PDO::FETCH_OBJ);
            return $UneActivite;
        }

        public function ajouterActivite() {
            include "bd.php";
            $req = "INSERT INTO activite VALUES (null, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($req);
            $stmt->bindValue(1, $this->Nom);
            $stmt->bindValue(2, $this->Prix);
            $stmt->bindValue(3, $this->Date);
            $stmt->bindValue(4, $this->Heure);
            return $stmt->execute();
        }

        public function supprimerActivite() {
            include "bd.php";
            $req = "DELETE FROM activite WHERE id = ?";
            $stmt = $pdo->prepare($req);
            $stmt->bindValue(1, $this->Id);
            return $stmt->execute();
        }

        public function modifierActivite() {
            include "bd.php";
            $req = "UPDATE activite SET nom = ?, prix = ?, date_activite = ?, heure = ? WHERE id = ?";
            $stmt = $pdo->prepare($req);
            $stmt->bindValue(1, $this->Nom);
            $stmt->bindValue(2, $this->Prix);
            $stmt->bindValue(3, $this->Date);
            $stmt->bindValue(4, $this->Heure);
            $stmt->bindValue(5, $this->Id);
            return $stmt->execute();
        }
        public function supprimerActiviteEtAffiliations() {
            include "bd.php";
        
            // Supprimer les enregistrements associés dans participer_activite
            $reqSuppressionAffiliations = "DELETE FROM participer_activite WHERE id_activite = ?";
            $stmt = $pdo->prepare($reqSuppressionAffiliations);
            $stmt->bindValue(1, $this->Id, PDO::PARAM_INT);
            $stmt->execute();
        
            // Supprimer les congressistes associés (si nécessaire)
            $reqSuppressionCongressistes = "DELETE FROM congressiste WHERE id IN (SELECT id_congressiste FROM participer_activite WHERE id_activite = ?)";
            $stmt = $pdo->prepare($reqSuppressionCongressistes);
            $stmt->bindValue(1, $this->Id, PDO::PARAM_INT);
            $stmt->execute();
        
            // Supprimer l'activité
            $reqSuppressionActivite = "DELETE FROM activite WHERE id = ?";
            $stmt = $pdo->prepare($reqSuppressionActivite);
            $stmt->bindValue(1, $this->Id, PDO::PARAM_INT);
            return $stmt->execute();
        }
    }
