<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Cavalier Royal') ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/layout.css"> <!-- Lien vers le CSS -->
</head>

<body>
    <!-- Header -->
    <?php include "views/includes/header.php"; ?>

    <!-- Main content -->
    <div class="container my-5">
        <div class="row">
            <!-- Sidebar -->
            <aside class="col-md-3 sticky-top">
                <?php include "views/includes/sidebar.php"; ?>
            </aside>

            <!-- Main Section -->
            <main class="col-md-9">

                <?= $content; ?>
            </main>
        </div>
    </div>

    <!-- Footer -->
    <?php include "views/includes/footer.php"; ?>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>