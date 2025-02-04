<?php
ob_start();
?>

<h1>Gestion des Produits</h1>
<a href="index.php?action=create_product" class="btn btn-success mb-3">Ajouter un produit</a>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Désignation</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Catégorie</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produits as $produit): ?>
        <tr>
            <td><?= htmlspecialchars($produit->id) ?></td>
            <td><img src="<?= htmlspecialchars($produit->image) ?>" alt="Produit" style="width: 100px; height: auto;">
            </td>
            <td><?= htmlspecialchars($produit->designation) ?></td>
            <td><?= htmlspecialchars($produit->prix) ?> €</td>
            <td><?= htmlspecialchars($produit->quantite) ?></td>
            <td><?= htmlspecialchars($produit->code_categorie) ?></td>
            <td>
                <a href="index.php?action=edit_product&id=<?= htmlspecialchars($produit->id) ?>"
                    class="btn btn-warning">Modifier</a>
                <a href="index.php?action=delete_product&id=<?= htmlspecialchars($produit->id) ?>"
                    class="btn btn-danger" onclick="return confirm('Confirmer la suppression ?');">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php $content = ob_get_clean(); ?>
<?php include 'views/pages/admin/layout.php'; ?>