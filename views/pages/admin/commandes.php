<?php
ob_start();
?>

<h1 class="text-center">Commandes des Clients</h1>


<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Date</th>
            <th>Client</th>
            <th>Email</th>
            <th>Adresse</th>
            <th>Téléphone</th>
            <th>Montant Total</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($commandes)): ?>
        <?php foreach ($commandes as $commande): ?>
        <tr>
            <td><?= htmlspecialchars($commande['date_commande']) ?></td>
            <td><?= htmlspecialchars($commande['client_nom']) ?></td>
            <td><?= htmlspecialchars($commande['client_email']) ?></td>
            <td><?= htmlspecialchars($commande['adresse']) ?></td>
            <td><?= htmlspecialchars($commande['telephone']) ?></td>
            <td><?= htmlspecialchars($commande['total']) ?> €</td>
            <td>
                <a href="index.php?action=detail_commande&id=<?= htmlspecialchars($commande['id']) ?>"
                    class="btn btn-info btn-sm">Détails</a>
                <a href="index.php?action=delete_commande&id=<?= htmlspecialchars($commande['id']) ?>"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Voulez-vous vraiment supprimer cette commande ?');">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
            <td colspan="7" class="text-center">Aucune commande trouvée.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
$content = ob_get_clean();
include 'views/pages/admin/layout.php';
?>