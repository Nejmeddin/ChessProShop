<?php if (isset($_SESSION['success'])): ?>
<div class="alert alert-success"><?= $_SESSION['success']; ?></div>
<?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
<div class="alert alert-danger"><?= $_SESSION['error']; ?></div>
<?php unset($_SESSION['error']); ?>
<?php endif; ?>
<?php
ob_start();
?>
<h2>Liste des clients</h2>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Date d'inscription</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($clients)): ?>
        <?php foreach ($clients as $client): ?>
        <tr>
            <td><?= htmlspecialchars($client['id']); ?></td>
            <td><?= htmlspecialchars($client['nom']); ?></td>
            <td><?= htmlspecialchars($client['email']); ?></td>
            <td><?= htmlspecialchars($client['date_inscription']); ?></td>
            <td>
                <a href=" index.php?action=delete_client&id=<?= $client['id']; ?>"
                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?');">
                    Supprimer
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
            <td colspan="7" class="text-center">Aucun client trouvé.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php $content = ob_get_clean(); ?>
<?php include 'views/pages/admin/layout.php'; ?>