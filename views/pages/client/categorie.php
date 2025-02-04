<?php ob_start(); ?>
<h2 class="text-gold fw-bold mb-4"><?= htmlspecialchars($title) ?></h2>
<div class="row g-4">
    <?php foreach ($produits as $produit): ?>
        <div class="col-md-4">
            <div class="card shadow-lg border-0 hover-card fixed-card-height">
                <img src="<?= htmlspecialchars($produit['image']) ?>" class="card-img-top rounded-top"
                    alt="<?= htmlspecialchars($produit['designation']) ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($produit['designation']) ?></h5>
                    <p class="card-text fw-bold text-gold"><?= number_format($produit['prix'], 2) ?> €</p>
                    <a href="index.php?action=produit&id=<?= $produit['id'] ?>" class="btn btn-gold w-100">Voir Détails</a>
                </div>
            </div>
        </div>
    <?php endforeach;
    ?>

    <?php $content = ob_get_clean(); ?>
    <?php include 'views/pages/client/layout.php'; ?>