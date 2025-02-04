<?php
ob_start();
?>

<h1 class="text-success">Votre commande a été passée avec succès !</h1>


<div class="mt-5">
    <a href="index.php?action=mes_commandes" class="btn btn-primary">Voir mes commandes</a>
    <a href="index.php" class="btn btn-secondary">Retour à l'accueil</a>
</div>


<?php $content = ob_get_clean(); ?>
<?php include 'views/pages/client/layout.php'; ?>