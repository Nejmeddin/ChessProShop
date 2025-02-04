<?php ob_start(); ?>
<h2 class="text-gold fw-bold mb-4">Détails du produit</h2>
<div class="card shadow-lg border-0">
    <img src="<?= htmlspecialchars($produit['image']) ?>" class="card-img-top"
        alt="<?= htmlspecialchars($produit['designation']) ?>">
    <div class="card-body">
        <h3 class="card-title"><?= htmlspecialchars($produit['designation']) ?></h3>
        <p class="card-text"><?= htmlspecialchars($produit['description']) ?></p>
        <p class="card-text fw-bold text-gold">Prix : <?= number_format($produit['prix'], 2) ?> €</p>
        <form method="post" action="index.php?action=ajouter_panier">
            <input type="hidden" name="produit_id" value="<?= $produit['id']; ?>">
            <input type="hidden" name="quantite" value="1">
            <button type="submit" class="btn btn-primary">Ajouter au panier</button>
        </form>

    </div>
</div>
<a href="index.php?action=allProduits" class="btn btn-secondary mt-3">Retour au catalogue</a>
<?php $content = ob_get_clean(); ?>
<?php include 'views/pages/client/layout.php'; ?>