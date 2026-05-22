<nav id="header-nav" class="navbar navbar-expand-lg py-4" data-bs-theme="dark">
    <div class="container-fluid padding-side">
        <a class="navbar-brand" href="<?= BASE_URL ?>/">
            <?php
                $logoSrc = !empty($settings['site_logo'])
                    ? UPLOAD_URL . 'logos/' . htmlspecialchars($settings['site_logo'])
                    : BASE_URL . '/images/logo.png';
            ?>
            <img src="<?= $logoSrc ?>" alt="<?= htmlspecialchars($settings['site_name'] ?? 'Logo') ?>">
        </a>

        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                <button type="button" class="btn-close text-reset shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav text-center align-items-center justify-content-end flex-grow-1">
                    <li class="nav-item">
                        <a class="nav-link active pe-lg-5" href="<?= BASE_URL ?>/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pe-lg-5" href="<?= BASE_URL ?>/about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pe-lg-5" href="<?= BASE_URL ?>/blog">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pe-lg-5" href="<?= BASE_URL ?>/services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pe-lg-5" href="<?= BASE_URL ?>/portfolio">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pe-lg-5" href="<?= BASE_URL ?>/contact">Contact</a>
                    </li>

                    <?php if (isset($user) && $user): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link pe-lg-5 dropdown-toggle d-flex align-items-center gap-2" href="#" data-bs-toggle="dropdown">
                                <?php if (!empty($user['avatar'])): ?>
                                    <img src="<?= UPLOAD_URL ?>avatars/<?= htmlspecialchars($user['avatar']) ?>"
                                         class="rounded-circle" width="26" height="26" style="object-fit:cover" alt="">
                                <?php endif; ?>
                                <?= htmlspecialchars($user['name']) ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>/profile">My Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="<?= BASE_URL ?>/logout">Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link pe-lg-5" href="<?= BASE_URL ?>/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold border-bottom border-2 border-primary" href="<?= BASE_URL ?>/register">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</nav>
