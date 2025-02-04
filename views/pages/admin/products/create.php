<?php
ob_start();
?>


<h1>Ajouter un produit</h1>
<form action="index.php?action=create_product" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="designation">Désignation</label>
        <input type="text" class="form-control" name="designation" required>
    </div>
    <div class="form-group">
        <label for="prix">Prix</label>
        <input type="number" step="0.01" class="form-control" name="prix" required>
    </div>
    <div class="form-group">
        <label for="quantite">Quantité</label>
        <input type="number" class="form-control" name="quantite" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" rows="4"></textarea>
    </div>
    <div class="form-group">
        <label for="code_categorie">Catégorie</label>
        <select class="form-control" name="code_categorie" required>
            <option value="1">Catégorie 1</option>
            <option value="2">Catégorie 2</option>
            <option value="3">Catégorie 3</option>
        </select>
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control" name="image" accept="image/*">
    </div>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>

<?php $content = ob_get_clean(); ?>
<?php include 'views/pages/admin/layout.php'; ?>