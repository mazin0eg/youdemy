<?php

class Utilisateur {
    protected $id;
    protected $nom;
    protected $email;
    protected $motDePasse;
    protected $role;

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

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getMotDePasse() {
        return $this->motDePasse;
    }

    public function setMotDePasse($motDePasse) {
        $this->motDePasse = $motDePasse;
    }

    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }
}

class Etudiant extends Utilisateur {
    public function consulterCatalogue() {
        // Logic to consult course catalog
    }

    public function sInscrireCours($cours) {
        // Logic to enroll in a course
    }

    public function voirMesCours() {
        // Logic to view enrolled courses
    }
}

class Enseignant extends Utilisateur {
    public function ajouterCours($cours) {
        // Logic to add a course
    }

    public function modifierCours($cours) {
        // Logic to modify a course
    }

    public function supprimerCours($cours) {
        // Logic to delete a course
    }

    public function consulterStatistiques() {
        // Logic to view statistics
    }
}


class Administrateur extends Utilisateur {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    // Fetch all users
    public function afficherUtilisateurs() {
        $stmt = $this->db->prepare("SELECT * FROM utilisateurs");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch all courses
    public function afficherCours() {
        $stmt = $this->db->prepare("SELECT * FROM cours");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch global statistics
    public function consulterStatistiquesGlobales() {
        $stats = [];
        
        // Total users
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total FROM utilisateurs");
        $stmt->execute();
        $stats['total_users'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        // Total courses
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total FROM cours");
        $stmt->execute();
        $stats['total_courses'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        return $stats;
    }

    // Delete a user by ID
    public function supprimerUtilisateur($id) {
        $stmt = $this->db->prepare("DELETE FROM utilisateurs WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true; // Successfully deleted
        } else {
            return false; // Failed to delete
        }
    }

    // Delete a course by ID
    public function supprimerCours($id) {
        $stmt = $this->db->prepare("DELETE FROM cours WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true; // Successfully deleted
        } else {
            return false; // Failed to delete
        }
    }

    // Fetch a specific user by ID
    public function selectionnerUtilisateur($id) {
        $stmt = $this->db->prepare("SELECT * FROM utilisateurs WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fetch a specific course by ID
    public function selectionnerCours($id) {
        $stmt = $this->db->prepare("SELECT * FROM cours WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Fetch all tags
public function afficherTags() {
    $stmt = $this->db->prepare("SELECT * FROM tags");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return all tags as an associative array
}

// Add a new tag
public function ajouterTag($nom) {
    $stmt = $this->db->prepare("INSERT INTO tags (nom) VALUES (:nom)");
    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
    
    if ($stmt->execute()) {
        return true; // Tag added successfully
    } else {
        return false; // Failed to add the tag
    }
}

// Delete a tag by ID
public function supprimerTag($id) {
    $stmt = $this->db->prepare("DELETE FROM tags WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        return true; // Tag deleted successfully
    } else {
        return false; // Failed to delete the tag
    }
}

}




?>