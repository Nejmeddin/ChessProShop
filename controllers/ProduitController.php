<?php
require_once "models/productModel.php";

class ProduitController
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }
    public function index()
    {
        $title = "Tous les produits";
        $produits = array_map(function ($produit) {
            return (array) $produit;
        }, $this->productModel->findAllProduct());
        include 'views/pages/client/categorie.php';
    }


    public function pieces()
    {
        $title = "Pièces";
        $produits = array_map(function ($produit) {
            return (array) $produit;
        }, $this->productModel->findByCategory(1));
        include 'views/pages/client/categorie.php';
    }

    public function boards()
    {
        $title = "Boards";
        $produits = array_map(function ($produit) {
            return (array) $produit;
        }, $this->productModel->findByCategory(3)); // Id 1 pour les plateaux, à ajuster si nécessaire
        include 'views/pages/client/categorie.php';
    }

    public function horloges()
    {
        $title = "Horloges";
        $produits = array_map(function ($produit) {
            return (array) $produit;
        }, $this->productModel->findByCategory(2)); // Id 2 pour les horloges, à ajuster si nécessaire
        include 'views/pages/client/categorie.php';
    }

    public function show($id)
    {
        // Récupérer un produit spécifique
        $produit = $this->productModel->findProduct($id);
        include "views/pages/client/boardProduit.php";
    }

    
    public function update($id, $data)
    {
        // Mettre à jour un produit
        $this->productModel->updateProduct($id, $data);
        header("Location: index.php?action=index");
    }



    public function detailProduct($id)
    {
        // Charger le modèle Produit
        require_once 'models/productModel.php';
        $productModel = new productModel();

        // Récupérer les détails du produit par ID
        $produit = $productModel->getProductById($id);

        // Vérifier si le produit existe
        if (!$produit) {
            // Rediriger vers une page d'erreur ou afficher un message
            header('Location: index.php?action=allProduit');
            exit;
        }

        // Charger la vue pour afficher les détails du produit
        $title = $produit['designation'];
        require_once 'views/pages/client/detail.php';
    }


    public function adminIndex()
{
    $title = "Gestion des Produits";
    $produits = $this->productModel->findAllProduct();
    include 'views/pages/admin/products/index.php';
}

public function create()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'designation' => $_POST['designation'],
            'prix' => $_POST['prix'],
            'quantite' => $_POST['quantite'],
            'description' => $_POST['description'],
            'code_categorie' => $_POST['code_categorie']
        ];

        // Gestion de l'image
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $targetDir = "uploads/products/";
            $imageName = basename($_FILES['image']['name']);
            $targetFilePath = $targetDir . $imageName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                $data['image'] = $targetFilePath;
            }
        }

        $this->productModel->insertProduct($data);
        header('Location: index.php?action=admin_products');
        exit;
    }
    include 'views/pages/admin/products/create.php';
}

public function edit($id)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'designation' => $_POST['designation'],
            'prix' => $_POST['prix'],
            'quantite' => $_POST['quantite'],
            'description' => $_POST['description'],
            'code_categorie' => $_POST['code_categorie']
        ];

        // Gestion de l'image
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $targetDir = "uploads/products/";
            $imageName = basename($_FILES['image']['name']);
            $targetFilePath = $targetDir . $imageName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                $data['image'] = $targetFilePath;
            }
        }

        $this->productModel->updateProduct($id, $data);
        header('Location: index.php?action=admin_products');
        exit;
    }

    $produit = $this->productModel->findProduct($id);
    include 'views/pages/admin/products/edit.php';
}

public function delete($id)
{
    $this->productModel->deleteProduct($id);
    header('Location: index.php?action=admin_products');
    exit;
}

}
?>