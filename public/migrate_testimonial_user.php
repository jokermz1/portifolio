<?php
/**
 * Migração: coluna user_id na tabela testimonials (associar avaliação à conta)
 * Aceder via browser: http://localhost/portifolio/migrate_testimonial_user.php
 * Apagar este ficheiro depois de executar.
 */

require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/config/database.php';

try {
    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', DB_HOST, DB_NAME, DB_CHARSET);
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    $cols = $pdo->query("SHOW COLUMNS FROM testimonials LIKE 'user_id'")->fetchAll();
    if ($cols) {
        echo '<p style="color:orange; font-family:monospace;">⚠️ A coluna <code>user_id</code> já existe. Nada a fazer.</p>';
    } else {
        $pdo->exec("ALTER TABLE testimonials ADD COLUMN user_id INT UNSIGNED DEFAULT NULL AFTER id");
        echo '<p style="color:limegreen; font-family:monospace; font-size:1.1rem;">
            ✔ Coluna <code>user_id</code> adicionada com sucesso.<br><br>
            <strong style="color:orange;">⚠️ Pode apagar este ficheiro agora.</strong>
        </p>';
    }
} catch (PDOException $e) {
    echo '<p style="color:red; font-family:monospace;">Erro: ' . htmlspecialchars($e->getMessage()) . '</p>';
}
