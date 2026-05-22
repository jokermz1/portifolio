<div class="admin-login-wrap">
    <div class="login-card">
        <div class="login-logo">
            <i class="bi bi-shield-lock-fill"></i>
        </div>

        <h1 class="login-title">Bem-vindo</h1>
        <p class="login-subtitle">Acesso restrito ao painel de administração</p>

        <?php if ($flash): ?>
            <div class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'danger' ?> mb-3">
                <?= htmlspecialchars($flash['message']) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= BASE_URL ?>/admin/login">
            <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                       placeholder="admin@exemplo.com" required autofocus>
            </div>

            <div class="mb-4">
                <label class="form-label">Senha</label>
                <input type="password" name="password" class="form-control"
                       placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i>Entrar no Painel
            </button>
        </form>

        <p class="text-center mt-4 mb-0" style="font-size:11px; color: var(--text-faint);">
            <a href="<?= BASE_URL ?>/" style="color: var(--text-muted); text-decoration:none;">
                <i class="bi bi-arrow-left me-1"></i>Voltar ao site
            </a>
        </p>
    </div>
</div>
