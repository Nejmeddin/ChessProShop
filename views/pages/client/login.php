<?php
$title = "Connexion";
ob_start();
?>

<div class="container mt-5">
    <h2 class="text-center text-gold">Connexion</h2>
    <form method="POST" action="index.php?action=login">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <button type="submit" class="btn btn-gold w-100">Se connecter</button>
    </form>
    <p class="mt-3 text-center">Pas encore de compte ? <a href="index.php?action=auth2">Inscrivez-vous ici</a></p>

</div>

<?php $content = ob_get_clean(); ?>
<?php include 'views/pages/client/layout.php'; ?>