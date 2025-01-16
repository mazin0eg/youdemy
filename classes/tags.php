<?php

class Tag {
    private $db;
    private $id;
    private $nom;

     public function __construct() {
        $this->db = (new Database())->connect(); // Connexion à la base de données
     }
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }
    public function recupererTousLestag() {
        $stmt = $this->db->prepare("SELECT * FROM tags");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
    
}
?>