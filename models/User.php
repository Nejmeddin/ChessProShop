<?php
require_once 'Database.php';

class User
{
    // Trouver un utilisateur par email
    public static function findByEmail($email)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Vérifier si l'email existe déjà
    public static function emailExists($email)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }

    // Créer un nouvel utilisateur
    public static function create($name, $email, $password)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("
            INSERT INTO users (nom, email, mot_de_passe, type, date_inscription) 
            VALUES (?, ?, ?, 'client', NOW())
        ");
        return $stmt->execute([$name, $email, $password]);
    }
    
    public static function authenticate($email, $password) {
        $user = self::findByEmail($email);
        if ($user && password_verify($password, $user['mot_de_passe'])) {
            return $user;
        }
        return false;
    }
    

    // Récupérer tous les clients
public static function getAllClients()
{
    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("SELECT * FROM users WHERE type = 'client'");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Supprimer un utilisateur par ID
public static function deleteById($id)
{
    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
    return $stmt->execute([$id]);
}


   
}