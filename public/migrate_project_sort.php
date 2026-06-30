<?php
/**
 * Migração: coluna sort_order na tabela projects (ordenação manual das publicações)
 * Aceder via browser: http://localhost/portifolio/migrate_project_sort.php
 * Apagar este ficheiro depois de executar.
 */

require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/config/database.php';

try {
    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', DB_HOST, DB_NAME, DB_CHARSET);
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    $cols = $pdo->query("SHOW COLUMNS FROM projects LIKE 'sort_order'")->fetchAll();
    if ($cols) {
        echo '<p style="color:orange; font-family:monospace;">⚠️ A coluna <code>sort_order</code> já existe. Nada a fazer.</p>';
    } else {
        $pdo->exec("ALTER TABLE projects ADD COLUMN sort_order INT NOT NULL DEFAULT 0 AFTER is_published");
        echo '<p style="color:limegreen; font-family:monospace; font-size:1.1rem;">
            ✔ Coluna <code>sort_order</code> adicionada com sucesso.<br><br>
            <strong style="color:orange;">⚠️ Pode apagar este ficheiro agora.</strong>
        </p>';
    }
} catch (PDOException $e) {
    echo '<p style="color:red; font-family:monospace;">Erro: ' . htmlspecialchars($e->getMessage()) . '</p>';
}
