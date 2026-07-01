<?php
/**
 * ╔══════════════════════════════════════════════════════════════╗
 * ║  MODELO DE CREDENCIAIS                                         ║
 * ╠══════════════════════════════════════════════════════════════╣
 * ║  Copie este ficheiro para config/env.php e preencha com os    ║
 * ║  seus valores reais:                                          ║
 * ║      cp config/env.example.php config/env.php                 ║
 * ║  O env.php NÃO é versionado (está no .gitignore).             ║
 * ╚══════════════════════════════════════════════════════════════╝
 */

// ── Base de dados ────────────────────────────────────────────
define('DB_HOST',    'localhost');
define('DB_NAME',    'nome_da_base_de_dados');
define('DB_USER',    'utilizador_bd');
define('DB_PASS',    'senha_da_bd');
define('DB_CHARSET', 'utf8mb4');

// ── URL base do site (sem barra final) ───────────────────────
define('BASE_URL',   'http://localhost/portifolio');

// ── Credenciais do administrador ─────────────────────────────
// Gere o hash com:
//   php -r "echo password_hash('a_sua_senha', PASSWORD_BCRYPT, ['cost'=>12]);"
define('ADMIN_EMAIL',         'admin@exemplo.com');
define('ADMIN_PASSWORD_HASH', '$2y$12$substitua_pelo_seu_hash_bcrypt_aqui');
