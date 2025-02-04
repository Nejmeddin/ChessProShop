<?php
$title = "Passer une commande";
ob_start();
?>
<h1 class="text-center">Détail de la commande #<?= htmlspecialchars($commandeId) ?></h1>

<!-- Order Details Table -->
<table class="table table-striped table-bordered mt-4">
    <thead>
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Prix unité</th>
            <th>Sous-total</th>
        </tr>
    </thead>
    <tbody>
        <?php $total = 0; ?>
        <?php foreach ($commandeDetails as $ligne): ?>
        <tr>
            <td><?= htmlspecialchars($ligne['designation']) ?></td>
            <td><?= htmlspecialchars($ligne['quantite']) ?></td>
            <td><?= htmlspecialchars($ligne['prix']) ?> €</td>
            <td><?= htmlspecialchars($ligne['quantite'] * $ligne['prix']) ?> €</td>
        </tr>
        <?php $total += $ligne['quantite'] * $ligne['prix']; ?>
        <?php endforeach; ?>
        <tr>
            <td colspan="3" class="text-right font-weight-bold">Total :</td>
            <td><?= htmlspecialchars($total) ?> €</td>
        </tr>
    </tbody>
</table>

<div class="mt-4 text-center">
    <?php if (isset($_SESSION['admin_id'])): ?>
    <!-- Si admin_id est défini, le bouton affiche "Retour" -->
    <a href="index.php?action=admin_commandes" class="btn btn-secondary">Retour</a>
    <?php else: ?>
    <!-- Sinon, le bouton affiche "Retour à mes commandes" -->
    <a href="index.php?action=mes_commandes" class="btn btn-secondary">Retour à mes commandes</a>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
include 'views/pages/client/layout.php';
?>