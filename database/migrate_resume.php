<?php
/**
 * Migração: tabela resume_items
 * Aceder via browser: http://localhost/portifolio/database/migrate_resume.php
 * Apagar este ficheiro depois de executar.
 */

require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/config/database.php';

try {
    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', DB_HOST, DB_NAME, DB_CHARSET);
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    $sql = file_get_contents(__DIR__ . '/add_resume.sql');

    // Executa linha a linha, ignorando comentários
    foreach (explode(';', $sql) as $stmt) {
        $stmt = trim($stmt);
        // Ignora linhas vazias e comentários puros
        if (empty($stmt) || str_starts_with($stmt, '--')) continue;
        $pdo->exec($stmt);
    }

    echo '<p style="color:limegreen; font-family:monospace; font-size:1.1rem;">
        ✔ Tabela <code>resume_items</code> criada com sucesso.<br>
        ✔ Chave <code>resume_summary</code> adicionada às settings.<br><br>
        <strong style="color:orange;">⚠️ Pode apagar este ficheiro agora.</strong>
    </p>';

} catch (PDOException $e) {
    echo '<p style="color:red; font-family:monospace;">Erro: ' . htmlspecialchars($e->getMessage()) . '</p>';
}
