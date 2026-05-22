<?php
declare(strict_types=1);

define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH',  ROOT_PATH . '/app');

// ── Config ──────────────────────────────────────────────────
require_once ROOT_PATH . '/config/config.php';
require_once ROOT_PATH . '/config/database.php';

// ── Session ─────────────────────────────────────────────────
session_name(SESSION_NAME);
session_start();

// ── Core ────────────────────────────────────────────────────
require_once APP_PATH . '/core/Database.php';
require_once APP_PATH . '/core/Model.php';
require_once APP_PATH . '/core/View.php';
require_once APP_PATH . '/core/Controller.php';
require_once APP_PATH . '/core/Router.php';

// ── Middleware ───────────────────────────────────────────────
require_once APP_PATH . '/middleware/AuthMiddleware.php';
require_once APP_PATH . '/middleware/AdminMiddleware.php';

// ── Models ───────────────────────────────────────────────────
require_once APP_PATH . '/models/User.php';
require_once APP_PATH . '/models/Project.php';
require_once APP_PATH . '/models/Post.php';
require_once APP_PATH . '/models/Service.php';
require_once APP_PATH . '/models/Skill.php';
require_once APP_PATH . '/models/Comment.php';
require_once APP_PATH . '/models/Message.php';
require_once APP_PATH . '/models/Setting.php';
require_once APP_PATH . '/models/Faq.php';
require_once APP_PATH . '/models/TeamMember.php';
require_once APP_PATH . '/models/ResumeItem.php';

// ── Controllers (públicos) ───────────────────────────────────
require_once APP_PATH . '/controllers/HomeController.php';
require_once APP_PATH . '/controllers/PortfolioController.php';
require_once APP_PATH . '/controllers/BlogController.php';
require_once APP_PATH . '/controllers/ServiceController.php';
require_once APP_PATH . '/controllers/ContactController.php';
require_once APP_PATH . '/controllers/AuthController.php';
require_once APP_PATH . '/controllers/UserController.php';
require_once APP_PATH . '/controllers/CommentController.php';
require_once APP_PATH . '/controllers/FaqController.php';
require_once APP_PATH . '/controllers/TeamController.php';
require_once APP_PATH . '/controllers/AboutController.php';

// ── Controllers (admin) ──────────────────────────────────────
require_once APP_PATH . '/controllers/admin/AuthController.php';
require_once APP_PATH . '/controllers/admin/DashboardController.php';
require_once APP_PATH . '/controllers/admin/PortfolioController.php';
require_once APP_PATH . '/controllers/admin/BlogController.php';
require_once APP_PATH . '/controllers/admin/CommentController.php';
require_once APP_PATH . '/controllers/admin/UserController.php';
require_once APP_PATH . '/controllers/admin/ServiceController.php';
require_once APP_PATH . '/controllers/admin/SettingController.php';
require_once APP_PATH . '/controllers/admin/MessageController.php';
require_once APP_PATH . '/controllers/admin/FaqController.php';
require_once APP_PATH . '/controllers/admin/TeamController.php';
require_once APP_PATH . '/controllers/admin/ResumeController.php';
require_once APP_PATH . '/controllers/admin/SkillController.php';
require_once APP_PATH . '/controllers/admin/AboutMeController.php';

// ── Dispatch ─────────────────────────────────────────────────
$router = new Router();
require_once ROOT_PATH . '/routes.php';
$router->dispatch(
    $_SERVER['REQUEST_METHOD'],
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);
