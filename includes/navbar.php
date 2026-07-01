<?php
// ── Item ativo da navbar (com base no 1.º segmento do caminho atual) ──
$__base = rtrim(parse_url(BASE_URL, PHP_URL_PATH) ?? '', '/');
$__path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
if ($__base && str_starts_with($__path, $__base)) {
    $__path = substr($__path, strlen($__base));
}
$__seg = explode('/', trim($__path, '/'))[0] ?? '';   // '' = página inicial
$navActive = fn (string $seg): string => $__seg === $seg ? ' active' : '';
?>
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
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><?= t('Menu') ?></h5>
                <button type="button" class="btn-close text-reset shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav text-center align-items-center justify-content-end flex-grow-1">
                    <li class="nav-item">
                        <a class="nav-link<?= $navActive('') ?> pe-lg-5" href="<?= BASE_URL ?>/"><?= t('Home') ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= $navActive('about') ?> pe-lg-5" href="<?= BASE_URL ?>/about"><?= t('About') ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= $navActive('blog') ?> pe-lg-5" href="<?= BASE_URL ?>/blog"><?= t('Blog') ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= $navActive('services') ?> pe-lg-5" href="<?= BASE_URL ?>/services"><?= t('Services') ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= $navActive('portfolio') ?> pe-lg-5" href="<?= BASE_URL ?>/portfolio"><?= t('Portfolio') ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= $navActive('contact') ?> pe-lg-5" href="<?= BASE_URL ?>/contact"><?= t('Contact') ?></a>
                    </li>
                    <li class="nav-item d-flex align-items-center justify-content-center pe-lg-4">
                        <button type="button" id="themeToggle" class="btn nav-link p-0 border-0 bg-transparent"
                                title="Alternar tema claro/escuro" aria-label="Alternar tema claro/escuro">
                            <i class="bi bi-moon-stars-fill theme-icon-dark" style="font-size:1.15rem;"></i>
                            <i class="bi bi-sun-fill theme-icon-light" style="font-size:1.15rem;"></i>
                        </button>
                    </li>

                    <!-- Seletor de idioma -->
                    <li class="nav-item dropdown pe-lg-4">
                        <a class="nav-link dropdown-toggle d-inline-flex align-items-center gap-1" href="#"
                           data-bs-toggle="dropdown" aria-expanded="false" title="<?= e_t('Language') ?>">
                            <i class="bi bi-translate" style="font-size:1.1rem;"></i>
                            <span class="text-uppercase"><?= htmlspecialchars(Lang::current()) ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <?php foreach (Lang::available() as $lcode => $llabel): ?>
                            <li>
                                <a class="dropdown-item <?= $lcode === Lang::current() ? 'active' : '' ?>"
                                   href="<?= BASE_URL ?>/lang/<?= $lcode ?>">
                                    <span class="text-uppercase fw-bold me-2" style="font-size:.7rem; opacity:.6;"><?= $lcode ?></span>
                                    <?= htmlspecialchars($llabel) ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
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
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>/profile"><?= t('My Profile') ?></a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="<?= BASE_URL ?>/logout"><?= t('Logout') ?></a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link<?= $navActive('login') ?> pe-lg-5" href="<?= BASE_URL ?>/login"><?= t('Login') ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold border-bottom border-2 border-primary<?= $navActive('register') ?>" href="<?= BASE_URL ?>/register"><?= t('Register') ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</nav>
