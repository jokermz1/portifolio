<?php
$uri = $_SERVER['REQUEST_URI'];
$base = rtrim(parse_url(BASE_URL, PHP_URL_PATH), '/');

function adminActive(string $path, string $uri, string $base): string {
    $full = $base . $path;
    if ($path === '/admin' || $path === '/admin/dashboard') {
        return (rtrim($uri, '/') === rtrim($full, '/') || str_starts_with($uri, $base . '/admin/dashboard')) ? 'active' : '';
    }
    return str_starts_with($uri, $full) ? 'active' : '';
}
?>
<nav id="admin-sidebar">
    <a href="<?= BASE_URL ?>/admin" class="sidebar-brand">
        <div class="sidebar-brand-icon">
            <i class="bi bi-grid-1x2-fill"></i>
        </div>
        <div class="sidebar-brand-text">
            <?= t('Admin Panel') ?>
            <span><?= t('painel de controlo') ?></span>
        </div>
    </a>

    <p class="sidebar-section-label"><?= t('Principal') ?></p>
    <ul class="sidebar-nav">
        <li>
            <a class="nav-link <?= adminActive('/admin', $uri, $base) ?>"
               href="<?= BASE_URL ?>/admin">
                <i class="bi bi-speedometer2"></i>
                <?= t('Dashboard') ?>
            </a>
        </li>
        <li>
            <a class="nav-link <?= adminActive('/admin/portfolio', $uri, $base) ?>"
               href="<?= BASE_URL ?>/admin/portfolio">
                <i class="bi bi-folder2-open"></i>
                <?= t('Portfólio') ?>
            </a>
        </li>
        <li>
            <a class="nav-link <?= adminActive('/admin/blog', $uri, $base) ?>"
               href="<?= BASE_URL ?>/admin/blog">
                <i class="bi bi-journal-text"></i>
                <?= t('Blog') ?>
            </a>
        </li>
        <li>
            <a class="nav-link <?= adminActive('/admin/services', $uri, $base) ?>"
               href="<?= BASE_URL ?>/admin/services">
                <i class="bi bi-gear"></i>
                <?= t('Serviços') ?>
            </a>
        </li>
    </ul>

    <p class="sidebar-section-label"><?= t('Gestão') ?></p>
    <ul class="sidebar-nav">
        <li>
            <a class="nav-link <?= adminActive('/admin/comments', $uri, $base) ?>"
               href="<?= BASE_URL ?>/admin/comments/pending">
                <i class="bi bi-chat-dots"></i>
                <?= t('Comentários') ?>
                <?php $pending = (new Comment())->countPending();
                if ($pending > 0): ?>
                    <span class="nav-badge badge bg-warning text-dark"><?= $pending ?></span>
                <?php endif; ?>
            </a>
        </li>
        <li>
            <a class="nav-link <?= adminActive('/admin/testimonials', $uri, $base) ?>"
               href="<?= BASE_URL ?>/admin/testimonials">
                <i class="bi bi-star-half"></i>
                <?= t('Depoimentos') ?>
                <?php $pendingReviews = (new Testimonial())->countPending();
                if ($pendingReviews > 0): ?>
                    <span class="nav-badge badge bg-warning text-dark"><?= $pendingReviews ?></span>
                <?php endif; ?>
            </a>
        </li>
        <li>
            <a class="nav-link <?= adminActive('/admin/messages', $uri, $base) ?>"
               href="<?= BASE_URL ?>/admin/messages">
                <i class="bi bi-envelope"></i>
                <?= t('Mensagens') ?>
                <?php $unread = (new Message())->countUnread();
                if ($unread > 0): ?>
                    <span class="nav-badge badge bg-danger"><?= $unread ?></span>
                <?php endif; ?>
            </a>
        </li>
        <li>
            <a class="nav-link <?= adminActive('/admin/users', $uri, $base) ?>"
               href="<?= BASE_URL ?>/admin/users">
                <i class="bi bi-people"></i>
                <?= t('Utilizadores') ?>
            </a>
        </li>
    </ul>

    <p class="sidebar-section-label"><?= t('Conteúdo') ?></p>
    <ul class="sidebar-nav">
        <li>
            <a class="nav-link <?= adminActive('/admin/about', $uri, $base) ?>"
               href="<?= BASE_URL ?>/admin/about">
                <i class="bi bi-person-circle"></i>
                <?= t('About Me') ?>
            </a>
        </li>
        <li>
            <a class="nav-link <?= adminActive('/admin/resume', $uri, $base) ?>"
               href="<?= BASE_URL ?>/admin/resume">
                <i class="bi bi-file-person"></i>
                <?= t('Currículo') ?>
            </a>
        </li>
        <li>
            <a class="nav-link <?= adminActive('/admin/skills', $uri, $base) ?>"
               href="<?= BASE_URL ?>/admin/skills">
                <i class="bi bi-bar-chart-line"></i>
                <?= t('Skills') ?>
            </a>
        </li>
        <li>
            <a class="nav-link <?= adminActive('/admin/faqs', $uri, $base) ?>"
               href="<?= BASE_URL ?>/admin/faqs">
                <i class="bi bi-question-circle"></i>
                <?= t('FAQs') ?>
            </a>
        </li>
        <li>
            <a class="nav-link <?= adminActive('/admin/team', $uri, $base) ?>"
               href="<?= BASE_URL ?>/admin/team">
                <i class="bi bi-people-fill"></i>
                <?= t('Team') ?>
            </a>
        </li>
        <li>
            <a class="nav-link <?= adminActive('/admin/translations', $uri, $base) ?>"
               href="<?= BASE_URL ?>/admin/translations">
                <i class="bi bi-translate"></i>
                <?= t('Traduções') ?>
            </a>
        </li>
        <li>
            <a class="nav-link <?= adminActive('/admin/settings', $uri, $base) ?>"
               href="<?= BASE_URL ?>/admin/settings">
                <i class="bi bi-sliders"></i>
                <?= t('Definições') ?>
            </a>
        </li>
    </ul>

    <div class="sidebar-footer">
        <a href="<?= BASE_URL ?>/admin/logout" class="nav-link">
            <i class="bi bi-box-arrow-left"></i>
            <?= t('Terminar Sessão') ?>
        </a>
    </div>
</nav>
