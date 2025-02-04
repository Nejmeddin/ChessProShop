<header class="bg-dark py-2">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <!-- Brand Logo -->
            <a class="navbar-brand text-gold fw-bold d-flex align-items-center" href="index.php">
                <img src="img\logo.webp" alt="Cavalier Royal" width="45" class="me-2">
                Cavalier Royal
            </a>

            <!-- Navbar Toggler for Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="index.php">Accueil</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-light" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?action=login_admin" class="btn btn-outline-light ms-3"
                            title="Connexion Administrateur">
                            <i class="fas fa-user-shield"></i>
                        </a>
                    </li>
                </ul>

                <!-- Search Bar -->
                <form class="d-flex ms-lg-3 my-2 my-lg-0" action="#" method="get">
                    <input class="form-control me-2" type="search" placeholder="Rechercher un produit..."
                        aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>

                <!-- User Actions -->
                <ul class="navbar-nav ms-3 align-items-center">
                    <?php if (isset($_SESSION['user'])): ?>
                    <!-- Si l'utilisateur est connecté -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" id="userMenu" role="button"
                            data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> <?= htmlspecialchars($_SESSION['user']['nom']); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="index.php?action=profile">Mon Profil</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="index.php?action=logout">Déconnexion</a>
                            </li>
                        </ul>
                    </li>
                    <?php else: ?>
                    <!-- Si l'utilisateur n'est pas connecté -->
                    <li class="nav-item">
                        <a href="index.php?action=auth1" class="btn btn-outline-light btn-sm me-2">Login</a>

                    </li>
                    <li class="nav-item">
                        <a href="index.php?action=auth2" class="btn btn-outline-light btn-sm me-2">Sign In</a>
                    </li>
                    <?php endif; ?>

                    <!-- Lien Panier -->
                    <li class="nav-item">
                        <a class="nav-link text-light" href="index.php?action=panier">
                            Panier <i class="bi bi-cart"></i>
                            <?php if (!empty($_SESSION['panier'])): ?>
                            <span class="badge bg-danger"><?= count($_SESSION['panier']); ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>