<?php
/**
 * Setup inicial — corre UMA VEZ via browser: http://localhost/portifolio/database/setup.php
 * Depois apague ou mova este ficheiro para fora do htdocs.
 */

require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/config/database.php';

// ── Lê o schema.sql e executa ───────────────────────────────
try {
    $dsn = sprintf('mysql:host=%s;charset=%s', DB_HOST, DB_CHARSET);
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    $sql = file_get_contents(__DIR__ . '/schema.sql');
    foreach (explode(';', $sql) as $statement) {
        $statement = trim($statement);
        if ($statement) $pdo->exec($statement);
    }
    echo '<p style="color:green">✔ Base de dados criada com sucesso.</p>';
} catch (PDOException $e) {
    echo '<p style="color:red">Erro: ' . $e->getMessage() . '</p>';
    exit;
}

// ── Gera o hash da senha de admin ───────────────────────────
$password = $_POST['admin_password'] ?? '';
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Setup</title></head>
<body style="font-family:monospace;padding:2rem;background:#111;color:#eee;">
<h2>⚙️ Setup do Portfólio</h2>

<?php if ($password): ?>
    <?php $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]); ?>
    <p style="color:#0f0">✔ Hash gerado. Copie para <code>config/config.php</code>:</p>
    <pre style="background:#222;padding:1rem;border-radius:4px;word-break:break-all;">define('ADMIN_EMAIL', '<?= htmlspecialchars($_POST['admin_email'] ?? '') ?>');
define('ADMIN_PASSWORD_HASH', '<?= $hash ?>');</pre>
    <p style="color:orange">⚠️ Apague este ficheiro depois de configurar!</p>
<?php endif; ?>

<form method="POST">
    <p>Email do admin:</p>
    <input type="email" name="admin_email" value="admin@portfolio.local"
           style="width:300px;padding:8px;background:#222;color:#eee;border:1px solid #444;">
    <p>Senha do admin:</p>
    <input type="password" name="admin_password" placeholder="Mínimo 8 caracteres"
           style="width:300px;padding:8px;background:#222;color:#eee;border:1px solid #444;" required>
    <br><br>
    <button type="submit" style="padding:8px 20px;background:#6200ea;color:#fff;border:none;cursor:pointer;">
        Gerar Hash
    </button>
</form>
</body>
</html>
