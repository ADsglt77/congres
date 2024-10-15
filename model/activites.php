<?php
 
class  Activites{
    private int $Id;
    private string $Nom;
    private string $description;
    private decimal $prix;

    public function getId(): int{
        return $this->Id;
    }
    public function setId(int $nouveauId): void{
        $this->Id = $nouveauId;
    }
    public function getNom(): string{
        return $this->Nom;
    }
    public function setNom(string $nouveauNom): void{
        $this->Nom = $nouveauNom;
    }
    public function getDescription(): string{
        return $this->description;
    }
    public function setDescription(string $nouvelleDescription): void{
        $this->description = $nouvelleDescription;
    }
    public function getPrix(): decimal{
        return $this->prix;
    }
    public function setPrix(decimal $nouveauPrix): void{
        $this->prix = $nouveauPrix;
    }
    public function __construct(int $unId , string $unNom, string $uneDescription, decimal $unPrix){ {
        $this->Id = $unId;
        $this->Nom = $unNom;
        $this->description = $uneDescription;
        $this->prix = $unPrix;
    }
}
    public static function getActivites(){
        include "bd.php";
        $requete = "SELECT * FROM activites";
        $stmt = $pdo->prepare($requete);
        $stmt->execute();
        $lesActivites = $stmt->fetchAll();
        return $lesActivites;
    }
    public static function getActivite($id){
        include "bd.php";
        $requete = "SELECT * FROM activites WHERE id = ?";
        $stmt = $pdo->prepare($requete);
        $stmt->execute(array($id));
        $activite = $stmt->fetch();
        return $activite;
    }
    public static function ajouterActivite($nom, $description, $prix){
        include "bd.php";
        $requete = "INSERT INTO activites (nom, description, prix) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($requete);
        $stmt->execute(array($nom, $description, $prix));
    }
    public static function modifierActivite($id, $nom, $description, $prix){
        include "bd.php";
        $requete = "UPDATE activites SET nom = ?, description = ?, prix = ? WHERE id = ?";
        $stmt = $pdo->prepare($requete);
        $stmt->execute(array($nom, $description, $prix, $id));
    }
    public static function supprimerActivite($id){
        include "bd.php";
        $requete = "DELETE FROM activites WHERE id = ?";
        $stmt = $pdo->prepare($requete);
        $stmt->execute(array($id));
    }
    
}


?>