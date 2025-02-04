<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\layout_admin.css">
    <title>
        <?php echo $titre;
        ?>
    </title>
</head>

<body>
    <?php include 'views/includes/admin_header.php'; ?>

    <main class="admin-main">
        <?php
        // Dynamic content will be injected here
        if (isset($content)) {
            echo $content;
        } else {
            echo "<p>Bienvenue dans l'espace administrateur.</p>";
        }
        ?>
    </main>

    <?php include 'views/includes/admin_footer.php'; ?>
</body>

</html>