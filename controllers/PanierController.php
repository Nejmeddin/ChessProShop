<?php

class PanierController
{
    public function ajouterPanier()
    {
        require_once('controllers/ProduitController.php');
        $ProduitController = new ProduitController();
        $produit_id = $_POST['produit_id'];
        $quantite = $_POST['quantite'];

        // Vérifie si le panier existe dans la session, sinon le créer
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }

        // Ajouter le produit au panier
        if (isset($_SESSION['panier'][$produit_id])) {
            $_SESSION['panier'][$produit_id] += $quantite;
        } else {
            $_SESSION['panier'][$produit_id] = $quantite;
        }
        /*echo '<pre>';
        print_r($_SESSION['panier']);
        echo '</pre>';*/
        // Redirection vers la page des produits
        $ProduitController->detailProduct($produit_id);
        exit();
    }

    public function afficherPanier()
    {
        require_once('models/productModel.php');
        $produitModel = new productModel();

        $panier = isset($_SESSION['panier']) ? $_SESSION['panier'] : [];

        // Récupérer les détails des produits dans le panier
        $produits = [];
        foreach ($panier as $produit_id => $quantite) {
            $produit = $produitModel->getProductById($produit_id);
            if ($produit) {
                $produit['quantite'] = $quantite;
                $produits[] = $produit;
            }
        }

        // Charger la vue
        $title = "Mon Panier";
        require('views/pages/client/panier.php');
    }

    public function supprimerPanier() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
    
            // Vérifier si le produit est dans le panier
            if (isset($_SESSION['panier'][$id])) {
                $_SESSION['panier'][$id]--; // Décrémenter la quantité
    
                // Supprimer si la quantité atteint 0
                if ($_SESSION['panier'][$id] <= 0) {
                    unset($_SESSION['panier'][$id]);
                }
            }
        }
        // Rediriger vers le panier
        header('Location: index.php?action=panier');
        exit();
    }
    

}