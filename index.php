<?php
session_start();
// Autoloader pour charger les fichiers nécessaires automatiquement
require_once 'controllers/ProduitController.php';


// Vérifie l'action passée dans l'URL
$action = isset($_GET['action']) ? $_GET['action'] : 'allProduits';

// Instancier le contrôleur Produit
$produitController = new ProduitController();

// Gérer le routage
switch ($action) {
    case 'allProduits':
        $produitController->index(); // Afficher tous les produits
        break;

    case 'pieceProduits':
        $produitController->pieces(); // Afficher les produits "pièces"
        break;

    case 'boardProduits':
        $produitController->boards(); // Afficher les produits "plateaux"
        break;

    case 'horlogeProduits':
        $produitController->horloges(); // Afficher les produits "horloges"
        break;

    case 'produit':
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $produitController->detailProduct($_GET['id']);
        } else {
            header('Location: index.php?action=allproduit');
        }
        break;

    case 'ajouter_panier':
        require_once('controllers/PanierController.php');
        $controller = new PanierController();
        $controller->ajouterPanier();
        break;

    case 'panier':
        require_once('controllers/PanierController.php');
        $controller = new PanierController();
        $controller->afficherPanier();
        break;

    case 'supprimer_panier':
        require_once('controllers/PanierController.php');
        $controller = new PanierController();
        $controller->supprimerPanier();
        break;

    // Authentification
    case 'auth1':
        include 'views/pages/client/login.php';
        break;
    case 'auth2':
        include 'views/pages/client/registrer.php';
        break;
    case 'login':
        require_once('controllers/AuthController.php');
        $authController = new AuthController();
        $authController->login();
        break;
    case 'register':
        require_once('controllers/AuthController.php');
        $authController = new AuthController();
        $authController->register();
        break;
    case 'logout':
        require_once('controllers/AuthController.php');
        $authController = new AuthController();
        $authController->logout();
        break;

    case 'commande':
        if (isset($_SESSION['user'])) {
            include 'views/pages/client/commande.php';
        } else {
            $_SESSION['redirect_after_login'] = 'commande';
            header("Location: index.php?action=auth1");
            exit;
        }
        break;
    case 'enregistrer_commande':
        require_once('controllers/CommandeController.php');
        $commandeController = new CommandeController();
        $commandeController->enregistrerCommande();
        break;

    case 'confirmation_reussite':
        include 'views/pages/client/confirmation_reussite.php';
        break;

    case 'mes_commandes':
        require_once('controllers/CommandeController.php');
        // Instantiate the controller and call the method
        $commandeController = new CommandeController();
        $commandeController->showMesCommandes();
        break;

    case 'detail_commande':
        require_once('controllers/CommandeController.php');
        // Instantiate the controller and call the method
        $commandeController = new CommandeController();
        // Vérifier si commandeid est défini et valide
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $commandeController->showCommandeDetail($_GET['id']);
        } else {
            echo "Erreur : L'identifiant de la commande est manquant ou invalide.";
        }
        break;

    case 'auth3':
        include 'views/pages/admin/login.php';
        break;
    case 'login_admin':
        require_once 'controllers/AdminController.php';
        $controller = new AdminController();
        $controller->loginAdmin();
        break;

    case 'admin_dashboard':

        if (!isset($_SESSION['admin_id'])) {
            header('Location: index.php?action=login_admin');
            exit;
        }
        require_once 'views/pages/admin/dashboard.php';
        break;

    case 'admin_commandes':
        require_once('controllers/CommandeController.php');
        $commandeController = new CommandeController();
        $commandeController->showAllCommandes();
        break;

    case 'delete_commande':
        require_once('controllers/CommandeController.php');
        if (isset($_GET['id'])) {
            $commandeController = new CommandeController();
            $commandeController->deleteCommande($_GET['id']);
        }
        break;

    case 'admin_products':
        $produitController->adminIndex();
        break;
    case 'create_product':
        $produitController->create();
        break;
    case 'edit_product':
        $produitController->edit($_GET['id']);
        break;
    case 'delete_product':
        $produitController->delete($_GET['id']);
        break;

    case 'admin_clients':
        require_once 'controllers/AdminController.php';
        $adminController = new AdminController();
        $adminController->listClients();
        break;
    case 'delete_client':
        require_once 'controllers/AdminController.php';
        $adminController = new AdminController();
        $adminController->deleteClient();
        break;



    default:
        echo "Page non trouvée.";
        break;
}