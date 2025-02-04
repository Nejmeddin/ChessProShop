<?php
$title = "Connexion / Inscription";
ob_start();
?>

<div class="container mt-5">
    <h2 class="text-gold fw-bold text-center mb-4">Connexion / Inscription</h2>

    <div class="row">
        <!-- Formulaire de Connexion -->
        <div class="col-md-6">
            <h4 class="text-center">Connexion</h4>
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
        </div>

        <!-- Formulaire d'Inscription -->
        <div class="col-md-6">
            <h4 class="text-center">Inscription</h4>
            <form method="POST" action="index.php?action=register">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <button type="submit" class="btn btn-gold w-100">S'inscrire</button>
            </form>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include 'views/pages/client/layout.php'; ?>