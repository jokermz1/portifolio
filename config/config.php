<?php
define('BASE_URL',   'http://localhost/portifolio/public');
define('APP_NAME',   'Portfólio');
define('APP_VERSION','1.0.0');

// Upload paths
define('UPLOAD_PATH', dirname(__DIR__) . '/public/uploads/');
define('UPLOAD_URL',  BASE_URL . '/uploads/');

// Admin credentials (change ADMIN_PASSWORD_HASH with: password_hash('suasenha', PASSWORD_BCRYPT))
#define('ADMIN_EMAIL',         'admin@portfolio.local');
#define('ADMIN_PASSWORD_HASH', '$2y$12$placeholder_run_setup_to_generate');

define('ADMIN_EMAIL',         'aristidesestevao265@gmail.com');
define('ADMIN_PASSWORD_HASH', '$2y$12$W70SEnomq0lZIidNPbIU7O6b5OklcREHVRMDzbnwav9mFCN5SVI.a');

// Session name
define('SESSION_NAME', 'portfolio_session');
