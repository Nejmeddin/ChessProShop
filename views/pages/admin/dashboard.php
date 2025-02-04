<?php
$title = "Admin Dashboard";
ob_start();
?>

<div class="container">
    <h1 class="text-center">Tableau de bord - Administrateur</h1>
    <div class="card-container">
        <div class="card" onclick="location.href='index.php?action=admin_commandes'">
            <i class="fa fa-shopping-cart"></i>
            <h2>Commandes</h2>
            <p>Gérez toutes les commandes des clients.</p>
        </div>
        <div class="card" onclick="location.href='index.php?action=admin_products'">
            <i class="fa fa-box"></i>
            <h2>Produits</h2>
            <p>Ajoutez, modifiez ou supprimez des produits.</p>
        </div>
        <div class="card" onclick="location.href='index.php?action=admin_clients'">
            <i class="fa fa-users"></i>
            <h2>Clients</h2>
            <p>Consultez et gérez les informations des clients.</p>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include 'views/pages/admin/layout.php'; ?>