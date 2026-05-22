<header id="admin-topbar">
    <div class="topbar-left">
        <button class="topbar-toggle" id="sidebarToggle">
            <i class="bi bi-list fs-5"></i>
        </button>
        <span class="topbar-date">
            <?= date('d \d\e F \d\e Y') ?>
        </span>
    </div>

    <div class="topbar-right">
        <a href="<?= BASE_URL ?>/" target="_blank" class="topbar-site-link">
            <i class="bi bi-box-arrow-up-right" style="font-size:11px;"></i>
            Ver site
        </a>
        <div class="topbar-user">
            <div class="topbar-avatar">
                <i class="bi bi-person-fill"></i>
            </div>
            <?= htmlspecialchars($_SESSION['admin_email'] ?? 'Admin') ?>
        </div>
    </div>
</header>
