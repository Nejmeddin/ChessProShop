<?php

class CommandeController
{
    public function enregistrerCommande()
    {

        require_once('models/CommandeModel.php');
        require_once('models/LigneCommandeModel.php');

        // Vérifier si le panier et l'utilisateur sont définis
        if (!isset($_SESSION['panier']) || empty($_SESSION['panier']) || !isset($_SESSION['user'])) {
            die("Erreur : Panier vide ou utilisateur non connecté.");
        }

        $panier = $_SESSION['panier'];
        $user = $_SESSION['user']; // Supposons que les infos utilisateur contiennent un ID

        // Récupérer les données du formulaire
        $nom = $_POST['nom'];
        $adresse = $_POST['adresse'];
        $ville = $_POST['ville'];
        $telephone = $_POST['telephone'];
        $mode_paiement = $_POST['paiement'];
        $total = $_SESSION['total'];
        try {
            // Créer une nouvelle commande
            $commandeModel = new CommandeModel();
            $commande_id = $commandeModel->createCommande(
                $user['id'],
                $nom,
                $adresse,
                $ville,
                $telephone,
                $mode_paiement,
                $total,
            );

            // Ajouter les lignes de commande
            $ligneCommandeModel = new LigneCommandeModel();
            foreach ($panier as $produit_id => $quantite) {
                $ligneCommandeModel->addLigneCommande($commande_id, $produit_id, $quantite);
            }

            // Vider le panier
            unset($_SESSION['panier']);

            // Rediriger vers une page de confirmation
            header("Location: index.php?action=confirmation_reussite");
            exit();

        } catch (Exception $e) {
            die("Erreur lors de l'enregistrement de la commande : " . $e->getMessage());
        }
    }

    public function getUserCommandes($userId, $dateStart = '', $dateEnd = '', $sortOrder = 'recent')
    {
        // Include the model
        require_once 'models/CommandeModel.php';
        $commandeModel = new CommandeModel();

        // Fetch commandes from the model
        return $commandeModel->getCommandesByUser($userId, $dateStart, $dateEnd, $sortOrder);
    }

    public function showMesCommandes()
    {
        // Start session and verify user
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=auth1');
            exit;
        }
        $userId = $_SESSION['user_id'];

        // Get filter and sorting options from GET request
        $filterDateStart = isset($_GET['date_start']) ? $_GET['date_start'] : '';
        $filterDateEnd = isset($_GET['date_end']) ? $_GET['date_end'] : '';
        $sortOrder = isset($_GET['sort']) ? $_GET['sort'] : 'recent';

        // Fetch commandes
        $commandes = $this->getUserCommandes($userId, $filterDateStart, $filterDateEnd, $sortOrder);

        // Load the view
        include 'views\pages\client\mes_commandes.php';
    }

    public function showCommandeDetail($commandeId)
    {
        require_once 'models/CommandeModel.php';
        $commandeModel = new CommandeModel();
        if (isset($_SESSION['admin_id'])) {
            $commandeDetails = $commandeModel->getLignesCommandeByCommandeId($commandeId);
            include 'views\pages\client\commande_detail.php';
            exit;
        }

        $userId = $_SESSION['user_id'];
        $commandeDetails = $commandeModel->getLignesCommandeByCommandeId($commandeId);

        // Vérifier si la commande appartient à l'utilisateur connecté
        /* if (empty($commandeDetails) || $commandeDetails[0]['user_id'] != $userId) {
             echo "<div class='alert alert-danger'>Vous n'avez pas l'autorisation d'afficher cette commande.</div>";
             exit;
         }*/

        include 'views\pages\client\commande_detail.php';
    }


    //partie admin 

    // Partie admin ajoutée
    

    public function getAllClientCommandes()
    {
        require_once 'models/CommandeModel.php';
        $commandeModel = new CommandeModel();
    
        // Récupérer toutes les commandes des utilisateurs de type 'client'
        return $commandeModel->getAllCommandesByClient();
    }
    
    public function deleteCommande($commandeId)
    {
        require_once 'models/CommandeModel.php';
        $commandeModel = new CommandeModel();
    
        try {
            // Supprimer la commande et ses lignes de commande associées
            $commandeModel->deleteCommandeWithLignes($commandeId);
            header('Location: index.php?action=admin_commandes'); // Redirection après suppression
            exit;
        } catch (Exception $e) {
            echo "Erreur lors de la suppression de la commande : " . $e->getMessage();
        }
    }
    
    public function showAllCommandes()
    {
        require_once 'models/CommandeModel.php';
        $commandeModel = new CommandeModel();
        // Vérifier si l'utilisateur est admin
        if (!isset($_SESSION['admin_id'])) {
            echo "Accès refusé.";
            exit;
        }
    
        // Récupérer toutes les commandes
        $commandes =$commandeModel->getAllCommandesByClient();
    
        // Charger la vue
        include 'views/pages/admin/commandes.php';
    }
    




    

}
?>