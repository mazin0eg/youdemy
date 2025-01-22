
<?php
require_once '../db/database.php';
class Utilisateur {
    
    protected $id;
    protected $nom;
    protected $email;
    protected $motDePasse;
    protected $role;

    public function __construct($id, $nom, $email, $motDePasse, $role) {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->motDePasse = $motDePasse;
        $this->role = $role;
    }
    public static function login($email, $password) {
        try {
            $db = new Database();
            $conn = $db->connect();

            $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['mot_de_passe'])) {
                
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['user_name'] = $user['nom'];

                // Redirect based on role
                switch ($user['role']) {
                    case 'Admin':
                        header("Location: dashboard.php");
                        break;
                    case 'Enseignant':
                        header("Location: enseignant-dashboard.php");
                        break;
                    case 'Etudiant':
                        header("Location: etudiant-dashboard.php");
                        break;
                    default:
                        header("Location: login.php?error=Invalid role");
                        break;
                }
                exit;
            } else {
                throw new Exception("Invalid email or password");
            }
        } catch (Exception $e) {
            header("Location: login.php?error=" . urlencode($e->getMessage()));
            exit;
        }
    }

    public static function register($nom, $email, $password, $role = 'Visiteur') {
        try {
            $db = new Database();
            $conn = $db->connect();

            // Check if email already exists
            $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                throw new Exception("Email already exists");
            }

            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user
            $stmt = $conn->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe, role) VALUES (:nom, :email, :mot_de_passe, :role)");
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':mot_de_passe', $hashedPassword);
            $stmt->bindParam(':role', $role);
            $stmt->execute();

            
            header("Location: login.php?success=1");
            exit;
        } catch (Exception $e) {
            header("Location: register.php?error=" . urlencode($e->getMessage()));
            exit;
        }
    }

    public static function logout() {
     
        session_start();

       
        session_unset();

        session_destroy();

        header("Location: login.php");
        exit;
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

   
        private $db;
    
        public function __construct() {
            $database = new Database();
            $this->db = $database->connect();
        }
    
        public function getAvailableCourses() {
            $query = "SELECT cours.id, titre, image, date_creation, tags.nom as tags FROM cours
            JOIN tags on cours.tags = tags.id"; 
    
            $stmt = $this->db->prepare($query);
            $stmt->execute();
    
         
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function inscrireCours($etudiantId, $coursId) {
            try {
                $query = "INSERT INTO inscriptions (etudiant_id, cours_id) VALUES (:etudiant_id, :cours_id)";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':etudiant_id', $etudiantId, PDO::PARAM_INT);
                $stmt->bindParam(':cours_id', $coursId, PDO::PARAM_INT);
    
                return $stmt->execute();
            } catch (PDOException $e) {
                echo "Erreur lors de l'inscription au cours : " . $e->getMessage();
                return false;
            }
        }
}

class Enseignant extends Utilisateur {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    // Méthode pour ajouter un cours
    public function ajouterCours($cours) {
        try {
            // Vérifier les champs obligatoires
            // if (empty($cours['titre']) || empty($cours['description']) || empty($cours['enseignant_id'])) {
            //     throw new Exception("Les champs 'titre', 'description' et 'enseignant_id' sont obligatoires.");
            // }
    
            // // Gérer les champs optionnels
            // $image = !empty($cours['image']) ? $cours['image'] : null;
            // $tags = !empty($cours['tags']) ? $cours['tags'] : null;
            // $video = !empty($cours['video']) ? $cours['video'] : null;
    
            // Requête SQL
            $query = "INSERT INTO cours (titre, description, image, tags, video, enseignant_id, date_creation)
                      VALUES (:titre, :description, :image, :tags, :video, :enseignant_id, NOW())";
    
            $stmt = $this->db->prepare($query);
    
            // Lier les paramètres
            $stmt->bindParam(':titre', $cours['titre']);
            $stmt->bindParam(':description', $cours['description']);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':tags', $tags);
            $stmt->bindParam(':video', $video);
            $stmt->bindParam(':enseignant_id', $cours['enseignant_id'], PDO::PARAM_INT);
    
            // Exécuter la requête
            if ($stmt->execute()) {
                echo "Cours ajouté avec succès avec vidéo !";
                return true;
            } else {
                throw new Exception("Échec de l'exécution de la requête.");
            }
        } catch (PDOException $e) {
            echo "Erreur PDO lors de l'ajout du cours : " . $e->getMessage();
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    
        return false;
    }
    

    public function getTags() {
    try {
        $query = "SELECT id, nom FROM tags";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des tags : " . $e->getMessage();
        return [];
    }
}

    

public function modifierCours($cours) {
    try {
        $query = "UPDATE cours SET titre = :titre, description = :description, image = :image, tags = :tags, video = :video WHERE id = :id";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':titre', $cours['titre']);
        $stmt->bindParam(':description', $cours['description']);
        $stmt->bindParam(':image', $cours['image']);
        $stmt->bindParam(':tags', $cours['tags']);
        $stmt->bindParam(':video', $cours['video']);
        $stmt->bindParam(':id', $cours['id'], PDO::PARAM_INT);

        return $stmt->execute();
    } catch (PDOException $e) {
        echo "Erreur lors de la modification du cours : " . $e->getMessage();
        return false;
    }
}

public function supprimerCours($courseId) {
    try {
        $query = "DELETE FROM cours WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $courseId, PDO::PARAM_INT);
        return $stmt->execute();
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression du cours : " . $e->getMessage();
        return false;
    }
}

public function getCourses($enseignantId) {
    try {
        $query = "SELECT * FROM cours WHERE enseignant_id = :enseignant_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':enseignant_id', $enseignantId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des cours : " . $e->getMessage();
        return [];
    }
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