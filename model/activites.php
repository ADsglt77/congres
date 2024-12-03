    <?php

    class Activites {
        private int $Id;
        private string $Nom;
        private string $description;
        private float $prix;
        private time $heure;
        private date $date;

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

        public function setDescription(string $nouvelleDescription): void {
            $this->description = $nouvelleDescription;
        }

        public function getPrix(): float {
            return $this->prix;
        }

        public function setPrix(float $nouveauPrix): void {
            $this->prix = $nouveauPrix;
        }

        public function getHeure(): time {
            return $this->heure;
        }

        public function setHeure(time $nouvelleHeure): void {
            $this->heure = $nouvelleHeure;
        }

        public function getDate(): date {
            return $this->date;
        }

        public function setDate(date $nouvelleDate): void {
            $this->date = $nouvelleDate;
        }

        public function getLesActivites() {
            include "bd.php";
            $req = "SELECT * FROM activite";
            $stmt = $pdo->prepare($req);
            $stmt->execute();
            $lesActivites = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $lesActivites;
        }
        public function ajouterActivite() {
            include "bd.php";
            $req = "INSERT INTO activite (nom, description, prix, heure, date) VALUES (:nom, :description, :prix, :heure,)";
            $stmt = $pdo->prepare($req);
            $stmt->bindParam(':nom', $this->Nom);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':prix', $this->prix);
            $stmt->bindParam(':heure', $this->heure);
            $stmt->bindParam(':date', $this->date);
            $stmt->execute();
        }
    }
