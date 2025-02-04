<?php
ob_start();
?>


<h1 class="text-center">Mes Commandes</h1>

<!-- Filter and Sorting Form -->
<form method="GET" class="mb-4" action="index.php">
    <input type="hidden" name="action" value="mes_commandes">
    <div class="row">
        <div class="col-md-4">
            <label for="date_start">Date de début :</label>
            <input type="date" id="date_start" name="date_start" class="form-control"
                value="<?= htmlspecialchars($filterDateStart) ?>">
        </div>
        <div class="col-md-4">
            <label for="date_end">Date de fin :</label>
            <input type="date" id="date_end" name="date_end" class="form-control"
                value="<?= htmlspecialchars($filterDateEnd) ?>">
        </div>
        <div class="col-md-4">
            <label for="sort">Trier par :</label>
            <select id="sort" name="sort" class="form-control">
                <option value="recent" <?= $sortOrder === 'recent' ? 'selected' : '' ?>>Récemment commandé</option>
                <option value="asc" <?= $sortOrder === 'asc' ? 'selected' : '' ?>>Prix croissant</option>
                <option value="desc" <?= $sortOrder === 'desc' ? 'selected' : '' ?>>Prix décroissant</option>
            </select>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col text-center">
            <button type="submit" class="btn btn-primary">Appliquer</button>
        </div>
    </div>
</form>

<!-- Commandes Table -->
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Date de commande</th>
            <th>Prix total</th>
            <th>Adresse de livraison</th>
            <th>Numéro de téléphone</th>
            <th>Détails</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($commandes)): ?>
        <?php foreach ($commandes as $commande): ?>
        <tr>
            <td><?= htmlspecialchars($commande['date_commande']) ?></td>
            <td><?= htmlspecialchars($commande['total']) ?> €</td>
            <td><?= htmlspecialchars($commande['adresse']) ?></td>
            <td><?= htmlspecialchars($commande['telephone']) ?></td>
            <td><a href="index.php?action=detail_commande&id=<?= htmlspecialchars($commande['id']) ?>"
                    class="btn btn-info">Détails</a></td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
            <td colspan="5" class="text-center">Aucune commande trouvée</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>


<?php $content = ob_get_clean(); ?>
<?php include 'views/pages/client/layout.php'; ?>