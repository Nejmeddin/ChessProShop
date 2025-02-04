<?php ob_start(); ?>
<h2 class="text-gold fw-bold mb-4">Mon Panier</h2>

<?php if (empty($produits)): ?>
<p>Votre panier est vide.</p>
<?php else: ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Produit</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php 
    $totalPanier = 0;
    foreach ($produits as $produit): 
        $total = $produit['prix'] * $produit['quantite'];
        $totalPanier += $total;
        $_SESSION['total']=$totalPanier;
    ?>
        <tr>
            <td><?= htmlspecialchars($produit['designation']); ?></td>
            <td><?= number_format($produit['prix'], 2); ?> €</td>
            <td>
                <!-- Bouton pour décrémenter (supprime si quantité = 0) -->
                <a href="index.php?action=supprimer_panier&id=<?= $produit['id']; ?>"
                    class="btn btn-warning btn-sm">-</a>
                <?= $produit['quantite']; ?>
            </td>
            <td><?= number_format($total, 2); ?> €</td>
        </tr>
        <?php endforeach; ?>
    </tbody>

</table>
<h4 class="text-end fw-bold">Total : <?= number_format($totalPanier, 2); ?> €</h4>
<div class="text-end">
    <a href="index.php?action=commande" class="btn btn-success">Valider la commande</a>
</div>
<?php endif; ?>

<?php $content = ob_get_clean(); ?>
<?php include 'views/pages/client/layout.php'; ?>