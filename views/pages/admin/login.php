<?php
$title = "Connexion";
ob_start();
?>


<div class="container">
    <h2>Connexion Administrateur</h2>
    <?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST" action="index.php?action=login_admin">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</div>


<?php $content = ob_get_clean(); ?>
<?php include 'views/pages/client/layout.php'; ?>