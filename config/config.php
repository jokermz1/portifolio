<?php
// ── Credenciais sensíveis (não versionadas) ──────────────────
$envFile = __DIR__ . '/env.php';
if (!file_exists($envFile)) {
    die('Configuração em falta: copie <code>config/env.example.php</code> para <code>config/env.php</code> e preencha as credenciais.');
}
require_once $envFile;   // define BASE_URL, DB_*, ADMIN_*

// ── Aplicação ────────────────────────────────────────────────
define('APP_NAME',   'Portfólio');
define('APP_VERSION','1.0.0');

// ── Upload paths ─────────────────────────────────────────────
define('UPLOAD_PATH', dirname(__DIR__) . '/public/uploads/');
define('UPLOAD_URL',  BASE_URL . '/uploads/');

// ── Sessão ───────────────────────────────────────────────────
define('SESSION_NAME', 'portfolio_session');

// ── Internacionalização (i18n) ───────────────────────────────
define('LANG_PATH',    dirname(__DIR__) . '/lang');
define('DEFAULT_LANG', 'en');   // idioma inicial (pt | en | fr | es)
