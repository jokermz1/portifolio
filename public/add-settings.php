<?php
/**
 * Adiciona novos settings à BD — corre uma vez e apaga.
 * http://localhost/portifolio/public/add-settings.php
 */
define('ROOT_PATH', dirname(__DIR__));
require_once ROOT_PATH . '/config/config.php';
require_once ROOT_PATH . '/config/database.php';

try {
    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', DB_HOST, DB_NAME, DB_CHARSET);
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    $new = [
        'owner_phone'   => '',
        'owner_address' => '',
        'social_facebook' => '',
        'social_youtube'  => '',
        'awards'          => '15',
    ];

    $stmt = $pdo->prepare("INSERT IGNORE INTO settings (`key`, value) VALUES (?, ?)");
    foreach ($new as $key => $value) {
        $stmt->execute([$key, $value]);
    }
    echo '<p style="color:green;font-family:monospace;">✔ Settings adicionados. <a href="/">Ir ao site</a></p>';
    echo '<p style="color:orange;font-family:monospace;">Apague este ficheiro: public/add-settings.php</p>';
} catch (PDOException $e) {
    echo '<p style="color:red;font-family:monospace;">Erro: ' . $e->getMessage() . '</p>';
}
