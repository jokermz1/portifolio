<?php
/**
 * Migração: tabela resume_items
 * Aceder via browser: http://localhost/portifolio/public/migrate_resume.php
 * Apagar este ficheiro depois de executar.
 */

define('ROOT_PATH', dirname(__DIR__));
require_once ROOT_PATH . '/config/config.php';
require_once ROOT_PATH . '/config/database.php';

try {
    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', DB_HOST, DB_NAME, DB_CHARSET);
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    $sql = file_get_contents(ROOT_PATH . '/database/add_resume.sql');

    foreach (array_filter(array_map('trim', explode(';', $sql))) as $stmt) {
        if (str_starts_with($stmt, '--')) continue;
        $pdo->exec($stmt);
    }

    echo '<p style="font-family:monospace; font-size:1.1rem; background:#0d0d0d; color:#e0e0e0; padding:2rem;">
        <span style="color:#4ade80;">✔ Tabela <code>resume_items</code> criada com sucesso.</span><br>
        <span style="color:#4ade80;">✔ Chave <code>resume_summary</code> adicionada às settings.</span><br><br>
        <strong style="color:#fbbf24;">⚠️ Apague este ficheiro agora: <code>public/migrate_resume.php</code></strong><br><br>
        <a href="' . BASE_URL . '/about" style="color:#B775FF;">→ Ver página About</a> &nbsp;|&nbsp;
        <a href="' . BASE_URL . '/admin/resume" style="color:#B775FF;">→ Ir para Admin → Currículo</a>
    </p>';

} catch (PDOException $e) {
    echo '<p style="font-family:monospace; background:#0d0d0d; color:#f87171; padding:2rem;">
        <strong>Erro:</strong> ' . htmlspecialchars($e->getMessage()) . '
    </p>';
}
