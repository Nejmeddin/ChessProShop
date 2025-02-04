<?php
$title = "Passer une commande";
ob_start();
?>

<div class="container mt-5">
    <h2 class="text-gold fw-bold text-center mb-4">Détails de votre commande</h2>

    <form method="POST" action="index.php?action=enregistrer_commande">
        <!-- Nom complet -->
        <div class="mb-3">
            <label for="nom" class="form-label">Nom complet</label>
            <input type="text" class="form-control" name="nom" required>
        </div>

        <!-- Adresse -->
        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse complète</label>
            <input type="text" class="form-control" name="adresse" required>
        </div>

        <!-- Ville -->
        <div class="mb-3">
            <label for="ville" class="form-label">Ville</label>
            <input type="text" class="form-control" name="ville" required>
        </div>

        <!-- Numéro de téléphone -->
        <div class="mb-3">
            <label for="telephone" class="form-label">Numéro de téléphone</label>
            <input type="tel" class="form-control" name="telephone" required>
        </div>

        <!-- Option de paiement -->
        <div class="mb-3">
            <label for="paiement" class="form-label">Mode de paiement</label>
            <select class="form-select" name="paiement" required>
                <option value="espèce">Espèce</option>
                <option value="carte">Carte bancaire</option>
            </select>
        </div>

        <!-- Bouton de soumission -->
        <button type="submit" class="btn btn-gold w-100">Valider la commande</button>
    </form>
</div>

<?php
$content = ob_get_clean();
include 'views/pages/client/layout.php';
?>