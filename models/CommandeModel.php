<?php

class CommandeModel
{
    private $db;

    public function __construct()
    {
        require_once('Database.php');
        $this->db = Database::getInstance()->getConnection();
    }

    public function createCommande($user_id, $nom, $adresse, $ville, $telephone, $mode_paiement,$total)
    {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO commande (user_id, nom, adresse, ville, telephone, mode_paiement, date_commande, total) 
                 VALUES (:user_id, :nom, :adresse, :ville, :telephone, :mode_paiement, NOW(), :total)"
            );

            $stmt->execute([
                'user_id' => $user_id,
                'nom' => $nom,
                'adresse' => $adresse,
                'ville' => $ville,
                'telephone' => $telephone,
                'mode_paiement' => $mode_paiement,
                'total' => $total,
            ]);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la création de la commande : " . $e->getMessage());
        }
    }

    public function getCommandesByUser($userId, $dateStart = '', $dateEnd = '', $sortOrder = 'recent') {
        $query = "SELECT * FROM commande WHERE user_id = ?";
        $params = [$userId];

        // Add date filters if provided
        if (!empty($dateStart)) {
            $query .= " AND date_commande >= ?";
            $params[] = $dateStart;
        }
        if (!empty($dateEnd)) {
            $query .= " AND date_commande <= ?";
            $params[] = $dateEnd;
        }

        // Add sorting
        if ($sortOrder === 'asc') {
            $query .= " ORDER BY total ASC";
        } elseif ($sortOrder === 'desc') {
            $query .= " ORDER BY total DESC";
        } else {
            $query .= " ORDER BY date_commande DESC";
        }

        // Prepare and execute the query
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        

        // Fetch results
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLignesCommandeByCommandeId($commandeId) {
        $query = "SELECT lc.*, p.designation, p.prix 
                  FROM ligne_commande lc
                  JOIN produit p ON lc.produit_id = p.id
                  WHERE lc.commande_id = ?";

        $stmt = $this->db->prepare($query);
        $stmt->execute([$commandeId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


public function getAllCommandesByClient()
{
    $query = "SELECT c.*, u.nom AS client_nom, u.email AS client_email 
              FROM commande c
              JOIN users u ON c.user_id = u.id
              WHERE u.type = 'client'
              ORDER BY c.date_commande DESC";

    $stmt = $this->db->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function deleteCommandeWithLignes($commandeId)
{
    try {
        // Supprimer les lignes de commande associées
        $stmt = $this->db->prepare("DELETE FROM ligne_commande WHERE commande_id = ?");
        $stmt->execute([$commandeId]);

        // Supprimer la commande
        $stmt = $this->db->prepare("DELETE FROM commande WHERE id = ?");
        $stmt->execute([$commandeId]);
    } catch (PDOException $e) {
        throw new Exception("Erreur lors de la suppression de la commande : " . $e->getMessage());
    }
}

/*    public function getAllCommandes()
{
    $query = "SELECT * FROM commande ORDER BY date_commande DESC";
    $stmt = $this->db->query($query);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function updateStatutCommande($commandeId, $statut)
{
    $query = "UPDATE commande SET statut = ? WHERE id = ?";
    $stmt = $this->db->prepare($query);
    $stmt->execute([$statut, $commandeId]);
}

public function deleteCommande($commandeId)
{
    $query = "DELETE FROM commande WHERE id = ?";
    $stmt = $this->db->prepare($query);
    $stmt->execute([$commandeId]);
}*/


}

?>