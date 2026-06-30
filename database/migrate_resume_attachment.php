<?php
/**
 * Migração: colunas attachment na tabela resume_items
 * Aceder via browser: http://localhost/portifolio/database/migrate_resume_attachment.php
 * Apagar este ficheiro depois de executar.
 */

require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/config/database.php';

try {
    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', DB_HOST, DB_NAME, DB_CHARSET);
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    // Verifica se as colunas já existem
    $cols = $pdo->query("SHOW COLUMNS FROM resume_items LIKE 'attachment'")->fetchAll();
    if ($cols) {
        echo '<p style="color:orange; font-family:monospace;">⚠️ A coluna <code>attachment</code> já existe. Nada a fazer.</p>';
    } else {
        $pdo->exec(file_get_contents(__DIR__ . '/add_resume_attachment.sql'));
        echo '<p style="color:limegreen; font-family:monospace; font-size:1.1rem;">
            ✔ Colunas <code>attachment</code> e <code>attachment_name</code> adicionadas com sucesso.<br><br>
            <strong style="color:orange;">⚠️ Pode apagar este ficheiro agora.</strong>
        </p>';
    }

} catch (PDOException $e) {
    echo '<p style="color:red; font-family:monospace;">Erro: ' . htmlspecialchars($e->getMessage()) . '</p>';
}
