<?php
require_once "Database.php";
class ProductModel
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    function findAllProduct()
    {
        //selectionner tous les produits avec la class Database
        $req = "SELECT * FROM produit";
        $reponse = $this->pdo->query($req);
        $produits = $reponse->fetchAll(PDO::FETCH_OBJ);
        return $produits;
    }
    function findProduct($id)
    {
        $req = "SELECT * FROM produit WHERE id = :id";
        $requete = $this->pdo->prepare($req);
        $requete->execute(['id' => $id]);
        return ($requete->fetch(PDO::FETCH_OBJ));
    }
    function insertProduct($data)
    {
        $fields = implode(',', array_keys($data));
        $values = ':' . implode(',:', array_keys($data));
        $req = "INSERT INTO produit($fields) VALUES ($values)";
        $requete = $this->pdo->prepare($req);
        return ($requete->execute($data));
    }
    function deleteProduct($id)
    {
        $req = "DELETE FROM produit WHERE id = :id";
        $requete = $this->pdo->prepare($req);
        return ($requete->execute(['id' => $id]));
    }

    function updateProduct($id, $data)
    {
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ', ');

        $data['id'] = $id;
        $req = "UPDATE produit SET $fields WHERE id = :id";
        $requete = $this->pdo->prepare($req);
        return ($requete->execute($data));

    }
    public function findByCategory($num)
    {
        $req = "SELECT * FROM produit WHERE code_categorie = (SELECT id FROM categorie WHERE id = :num)";
        $requete = $this->pdo->prepare($req);
        $requete->execute(['num' => $num]);
        return $requete->fetchAll(PDO::FETCH_OBJ);
    }

    public function getProductById($id) {
        $query = $this->pdo->prepare('SELECT * FROM produit WHERE id = :id');
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }




    


}