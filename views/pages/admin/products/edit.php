<?php
ob_start();
?>

<h1>Modifier le produit</h1>

<form action="index.php?action=edit_product&id=<?= htmlspecialchars($produit->id) ?>" method="POST"
    enctype="multipart/form-data">
    <div class="form-group">
        <label for="designation">Désignation</label>
        <input type="text" id="designation" name="designation" class="form-control"
            value="<?= htmlspecialchars($produit->designation) ?>" required>
    </div>
    <div class="form-group">
        <label for="prix">Prix</label>
        <input type="number" id="prix" name="prix" class="form-control" step="0.01"
            value="<?= htmlspecialchars($produit->prix) ?>" required>
    </div>
    <div class="form-group">
        <label for="quantite">Quantité</label>
        <input type="number" id="quantite" name="quantite" class="form-control"
            value="<?= htmlspecialchars($produit->quantite) ?>" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" class="form-control"
            required><?= htmlspecialchars($produit->description) ?></textarea>
    </div>
    <div class="form-group">
        <label for="code_categorie">Catégorie</label>
        <select id="code_categorie" name="code_categorie" class="form-control" required>
            <option value="1" <?= $produit->code_categorie == 1 ? 'selected' : '' ?>>Pièces</option>
            <option value="2" <?= $produit->code_categorie == 2 ? 'selected' : '' ?>>Horloges</option>
            <option value="3" <?= $produit->code_categorie == 3 ? 'selected' : '' ?>>Boards</option>
        </select>
    </div>
    <div class="form-group">
        <label for="image">Image actuelle</label>
        <div>
            <img src="<?= htmlspecialchars($produit->image) ?>" alt="Image produit" style="width: 150px; height: auto;">
        </div>
    </div>
    <div class="form-group">
        <label for="image">Changer l'image</label>
        <input type="file" id="image" name="image" class="form-control-file">
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
    <a href="index.php?action=admin_products" class="btn btn-secondary">Annuler</a>
</form>

<?php $content = ob_get_clean(); ?>
<?php include 'views/pages/admin/layout.php'; ?>