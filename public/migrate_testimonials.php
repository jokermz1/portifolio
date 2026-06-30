<?php
/**
 * Migração: cria a tabela testimonials (reviews dos clientes)
 * Aceder via browser: http://localhost/portifolio/migrate_testimonials.php
 * Apagar este ficheiro depois de executar.
 */

require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/config/database.php';

try {
    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', DB_HOST, DB_NAME, DB_CHARSET);
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    $exists = $pdo->query("SHOW TABLES LIKE 'testimonials'")->fetchAll();
    if ($exists) {
        echo '<p style="color:orange; font-family:monospace;">⚠️ A tabela <code>testimonials</code> já existe. Nada a fazer.</p>';
    } else {
        $pdo->exec("
            CREATE TABLE testimonials (
              id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              name         VARCHAR(150)  NOT NULL,
              location     VARCHAR(150)  DEFAULT NULL,
              role         VARCHAR(150)  DEFAULT NULL,
              rating       TINYINT       NOT NULL DEFAULT 5,
              content      TEXT          NOT NULL,
              avatar       VARCHAR(255)  DEFAULT NULL,
              is_featured  TINYINT(1)    NOT NULL DEFAULT 0,
              status       ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending',
              ip_address   VARCHAR(45)   DEFAULT NULL,
              created_at   TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
              updated_at   TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB
        ");
        echo '<p style="color:limegreen; font-family:monospace; font-size:1.1rem;">
            ✔ Tabela <code>testimonials</code> criada com sucesso.<br><br>
            <strong style="color:orange;">⚠️ Pode apagar este ficheiro agora.</strong>
        </p>';
    }

} catch (PDOException $e) {
    echo '<p style="color:red; font-family:monospace;">Erro: ' . htmlspecialchars($e->getMessage()) . '</p>';
}
