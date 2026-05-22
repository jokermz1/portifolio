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
            Admin Panel
            <span>painel de controlo</span>
        </div>
    </a>

    <p class="sidebar-section-label">Principal</p>
    <ul class="sidebar-nav">
        <li>
            <a class="nav-link <?= adminActive('/admin', $uri, $base) ?>"
               href="<?= BASE_URL ?>/admin">
                <i class="bi bi-speedometer2"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a class="nav-link <?= adminActive('/admin/portfolio', $uri, $base) ?>"
               href="<?= BASE_URL ?>/admin/portfolio">
                <i class="bi bi-folder2-open"></i>
                Portfólio
            </a>
        </li>
        <li>
            <a class="nav-link <?= adminActive('/admin/blog', $uri, $base) ?>"
               href="<?= BASE_URL ?>/admin/blog">
                <i class="bi bi-journal-text"></i>
                Blog
            </a>
        </li>
        <li>
            <a class="nav-link <?= adminActive('/admin/services', $uri, $base) ?>"
               href="<?= BASE_URL ?>/admin/services">
                <i class="bi bi-gear"></i>
                Serviços
            </a>
        </li>
    </ul>

    <p class="sidebar-section-label">Gestão</p>
    <ul class="sidebar-nav">
        <li>
            <a class="nav-link <?= adminActive('/admin/comments', $uri, $base) ?>"
               href="<?= BASE_URL ?>/admin/comments/pending">
                <i class="bi bi-chat-dots"></i>
                Comentários
                <?php $pending = (new Comment())->countPending();
                if ($pending > 0): ?>
                    <span class="nav-badge badge bg-warning text-dark"><?= $pending ?></span>
                <?php endif; ?>
            </a>
        </li>
        <li>
            <a class="nav-link <?= adminActive('/admin/messages', $uri, $base) ?>"
               href="<?= BASE_URL ?>/admin/messages">
                <i class="bi bi-envelope"></i>
                Mensagens
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
                Utilizadores
            </a>
        </li>
    </ul>

    <p class="sidebar-section-label">Conteúdo</p>
    <ul class="sidebar-nav">
        <li>
            <a class="nav-link <?= adminActive('/admin/about', $uri, $base) ?>"
               href="<?= BASE_URL ?>/admin/about">
                <i class="bi bi-person-circle"></i>
                About Me
            </a>
        </li>
        <li>
            <a class="nav-link <?= adminActive('/admin/resume', $uri, $base) ?>"
               href="<?= BASE_URL ?>/admin/resume">
                <i class="bi bi-file-person"></i>
                Currículo
            </a>
        </li>
        <li>
            <a class="nav-link <?= adminActive('/admin/skills', $uri, $base) ?>"
               href="<?= BASE_URL ?>/admin/skills">
                <i class="bi bi-bar-chart-line"></i>
                Skills
            </a>
        </li>
        <li>
            <a class="nav-link <?= adminActive('/admin/faqs', $uri, $base) ?>"
               href="<?= BASE_URL ?>/admin/faqs">
                <i class="bi bi-question-circle"></i>
                FAQs
            </a>
        </li>
        <li>
            <a class="nav-link <?= adminActive('/admin/team', $uri, $base) ?>"
               href="<?= BASE_URL ?>/admin/team">
                <i class="bi bi-people-fill"></i>
                Team
            </a>
        </li>
        <li>
            <a class="nav-link <?= adminActive('/admin/settings', $uri, $base) ?>"
               href="<?= BASE_URL ?>/admin/settings">
                <i class="bi bi-sliders"></i>
                Definições
            </a>
        </li>
    </ul>

    <div class="sidebar-footer">
        <a href="<?= BASE_URL ?>/admin/logout" class="nav-link">
            <i class="bi bi-box-arrow-left"></i>
            Terminar Sessão
        </a>
    </div>
</nav>
