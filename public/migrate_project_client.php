<?php
/**
 * Migração: coluna client na tabela projects
 * Aceder via browser: http://localhost/portifolio/migrate_project_client.php
 * Apagar este ficheiro depois de executar.
 */

require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/config/database.php';

try {
    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', DB_HOST, DB_NAME, DB_CHARSET);
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    $cols = $pdo->query("SHOW COLUMNS FROM projects LIKE 'client'")->fetchAll();
    if ($cols) {
        echo '<p style="color:orange; font-family:monospace;">⚠️ A coluna <code>client</code> já existe. Nada a fazer.</p>';
    } else {
        $pdo->exec("ALTER TABLE projects ADD COLUMN client VARCHAR(150) DEFAULT NULL AFTER category");
        echo '<p style="color:limegreen; font-family:monospace; font-size:1.1rem;">
            ✔ Coluna <code>client</code> adicionada com sucesso.<br><br>
            <strong style="color:orange;">⚠️ Pode apagar este ficheiro agora.</strong>
        </p>';
    }
} catch (PDOException $e) {
    echo '<p style="color:red; font-family:monospace;">Erro: ' . htmlspecialchars($e->getMessage()) . '</p>';
}
