<?php
require_once "activites.php";
 
class Congressiste {
    private int $Id;
    private bool $petitDej;
    private string $Nom;
    private string $Adresse;
    private int $CodePostal;
    private string $DateInscription;
    private string $PrefHotel;
    private int $IdOrganisme;
    private int $IdHotel;
    private array $activites = [];
 
    public function __construct() {}
 
    public function getId(): int {
        return $this->Id;
    }
 
    public function setId(int $nouvelId): void {
        $this->Id = $nouvelId;
    }
 
    public function getNom(): string {
        return $this->Nom;
    }
 
    public function setNom(string $nouveauNom): void {
        $this->Nom = $nouveauNom;
    }
 
    public function getAdresse(): string {
        return $this->Adresse;
    }
 
    public function setAdresse(string $nouvelleAdresse): void {
        $this->Adresse = $nouvelleAdresse;
    }
 
    public function getCodePostal(): int {
        return $this->CodePostal;
    }
 
    public function setCodePostal(int $nouveauCodePostal): void {
        $this->CodePostal = $nouveauCodePostal;
    }
 
    public function getDateInscription(): date {
        return $this->DateInscription;
    }
 
    public function setDateInscription(date $nouvelleDateInscription): void {
        $this->DateInscription = $nouvelleDateInscription;
    }
 
    public function getPrefHotel(): string {
        return $this->PrefHotel;
    }
 
    public function setPrefHotel(string $nouvellePrefHotel): void {
        $this->PrefHotel = $nouvellePrefHotel;
    }
 
    public function getIdOrganisme(): int {
        return $this->IdOrganisme;
    }
 
    public function setIdOrganisme(int $nouveauIdOrganisme): void {
        $this->IdOrganisme = $nouveauIdOrganisme;
    }
 
    public function getIdHotel(): int {
        return $this->IdHotel;
    }
 
    public function setIdHotel(int $nouveauIdHotel): void {
        $this->IdHotel = $nouveauIdHotel;
    }
 
    public function getActivites(): array {
        return $this->activites;
    }
 
    public function setActivites(array $nouvellesActivites): void {
        $this->activites = $nouvellesActivites;
    }
   
    public function getLesCongressistes() {
        include "bd.php";
        $req = "SELECT * FROM congressiste";
        $stmt = $pdo->prepare($req);
        $stmt->execute();
        $lesCongressistes = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $lesCongressistes;
    }
 
    public function getCongressisteById() {
        include "bd.php";
        $req = "SELECT * FROM congressiste WHERE id = ?";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(1, $this->Id);
        $stmt->execute();
        $UnCongressiste = $stmt->fetch(PDO::FETCH_OBJ);
        return $UnCongressiste;
    }
 
    public function inscrireActivite(int $idActivite): bool {
        include "bd.php";
        $req = "INSERT INTO participer_activite (id_congressiste, id_activite) VALUES (?, ?)";
        $stmt = $pdo->prepare($req);
        return $stmt->execute([$this->Id, $idActivite]);
    }  

    public function estDejaInscrit(int $idActivite): bool {
    include "bd.php";
    $req = "SELECT COUNT(*) FROM participer_activite WHERE id_congressiste = :idCongressiste AND id_activite = :idActivite";
    $stmt = $pdo->prepare($req);
    $stmt->execute(['idCongressiste' => $this->Id, 'idActivite' => $idActivite]);
    return $stmt->fetchColumn() > 0;
}
}
?>