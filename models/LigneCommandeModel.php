<?php

class LigneCommandeModel
{
    private $db;

    public function __construct()
    {
        require_once('Database.php');
        $this->db = Database::getInstance()->getConnection();
    }

    public function addLigneCommande($commande_id, $produit_id, $quantite)
    {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO ligne_commande (commande_id, produit_id, quantite) 
                 VALUES (:commande_id, :produit_id, :quantite)"
            );

            $stmt->execute([
                'commande_id' => $commande_id,
                'produit_id' => $produit_id,
                'quantite' => $quantite
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'ajout de la ligne de commande : " . $e->getMessage());
        }
    }




}

?>