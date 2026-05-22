<?php
/**
 * Setup inicial — aceder em: http://localhost/portifolio/public/setup.php
 * APAGUE este ficheiro depois de configurar o admin!
 */

define('ROOT_PATH', dirname(__DIR__));
require_once ROOT_PATH . '/config/config.php';
require_once ROOT_PATH . '/config/database.php';

$dbOk  = false;
$error = '';

// ── Cria/actualiza a base de dados ──────────────────────────
try {
    $dsn = sprintf('mysql:host=%s;charset=%s', DB_HOST, DB_CHARSET);
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    $sql = file_get_contents(ROOT_PATH . '/database/schema.sql');
    // Executa statement a statement (ignora comentários vazios)
    foreach (array_filter(array_map('trim', explode(';', $sql))) as $stmt) {
        if ($stmt) $pdo->exec($stmt);
    }
    $dbOk = true;
} catch (PDOException $e) {
    $error = $e->getMessage();
}

// ── Gera hash da senha de admin ─────────────────────────────
$hash    = '';
$adminOk = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['admin_password'])) {
    $hash    = password_hash($_POST['admin_password'], PASSWORD_BCRYPT, ['cost' => 12]);
    $adminOk = true;
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Setup — Portfólio</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: monospace; background: #0d0d0d; color: #e0e0e0; padding: 2rem; max-width: 700px; margin: 0 auto; }
        h2 { color: #a78bfa; }
        .ok   { color: #4ade80; }
        .err  { color: #f87171; }
        .warn { color: #fbbf24; }
        pre   { background: #1a1a1a; padding: 1rem; border-radius: 6px; overflow-x: auto; word-break: break-all; white-space: pre-wrap; border: 1px solid #333; }
        input { width: 100%; padding: 10px; margin: 6px 0 16px; background: #1a1a1a; color: #e0e0e0; border: 1px solid #444; border-radius: 4px; font-size: 1rem; }
        button { padding: 10px 24px; background: #7c3aed; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 1rem; }
        button:hover { background: #6d28d9; }
        hr { border-color: #333; margin: 2rem 0; }
        .step { background: #1a1a1a; border: 1px solid #333; border-radius: 6px; padding: 1.2rem; margin-bottom: 1rem; }
        .step h3 { margin-top: 0; color: #a78bfa; }
    </style>
</head>
<body>
<h2>⚙️ Setup do Portfólio MVC</h2>

<!-- Passo 1 — BD -->
<div class="step">
    <h3>Passo 1 — Base de Dados</h3>
    <?php if ($dbOk): ?>
        <p class="ok">✔ Base de dados <strong><?= DB_NAME ?></strong> criada/atualizada com sucesso.</p>
    <?php else: ?>
        <p class="err">✘ Erro: <?= htmlspecialchars($error) ?></p>
        <p class="warn">Verifique as credenciais em <code>config/database.php</code> e se o MySQL está a correr.</p>
    <?php endif; ?>
</div>

<!-- Passo 2 — Hash do admin -->
<div class="step">
    <h3>Passo 2 — Credenciais do Admin</h3>

    <?php if ($adminOk): ?>
        <p class="ok">✔ Hash gerado! Copie as linhas abaixo para <code>config/config.php</code>:</p>
        <pre>define('ADMIN_EMAIL',         '<?= htmlspecialchars($_POST['admin_email'] ?? '') ?>');
define('ADMIN_PASSWORD_HASH', '<?= $hash ?>');</pre>
        <p class="warn">⚠️ Substitua as duas linhas correspondentes em <code>config/config.php</code> e depois <strong>apague este ficheiro</strong>.</p>
    <?php endif; ?>

    <form method="POST">
        <label>Email do admin:</label>
        <input type="email" name="admin_email" value="<?= htmlspecialchars($_POST['admin_email'] ?? 'admin@portfolio.local') ?>" required>

        <label>Senha do admin <small style="color:#888">(mín. 8 caracteres)</small>:</label>
        <input type="password" name="admin_password" minlength="8" required>

        <button type="submit">Gerar Hash da Senha</button>
    </form>
</div>

<!-- Passo 3 — instruções -->
<div class="step">
    <h3>Passo 3 — Próximos passos</h3>
    <ol style="line-height:2">
        <li>Copie o hash gerado para <code>config/config.php</code></li>
        <li>Mova os assets para <code>public/</code>:
            <pre>css/vendor.css  → public/css/vendor.css
js/script.js    → public/js/script.js
images/         → public/images/</pre>
        </li>
        <li>Aceda ao site: <a href="<?= BASE_URL ?>/" style="color:#a78bfa"><?= BASE_URL ?>/</a></li>
        <li>Aceda ao admin: <a href="<?= BASE_URL ?>/admin/login" style="color:#a78bfa"><?= BASE_URL ?>/admin/login</a></li>
        <li class="warn">Apague <code>public/setup.php</code> depois de terminar!</li>
    </ol>
</div>

</body>
</html>
