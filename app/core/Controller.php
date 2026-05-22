<?php
abstract class Controller {

    protected function view(string $view, array $data = [], string $layout = 'main'): void {
        View::render($view, $data, $layout);
    }

    protected function redirect(string $path): never {
        header('Location: ' . BASE_URL . $path);
        exit;
    }

    protected function redirectBack(): never {
        $ref = $_SERVER['HTTP_REFERER'] ?? BASE_URL;
        header('Location: ' . $ref);
        exit;
    }

    protected function json(mixed $data, int $status = 200): never {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }

    protected function input(string $key, mixed $default = null): mixed {
        return $_POST[$key] ?? $_GET[$key] ?? $default;
    }

    protected function sanitize(string $value): string {
        return htmlspecialchars(strip_tags(trim($value)), ENT_QUOTES, 'UTF-8');
    }

    protected function isLoggedIn(): bool {
        return isset($_SESSION['user_id']);
    }

    protected function isAdmin(): bool {
        return isset($_SESSION['admin_id']);
    }

    protected function currentUser(): array|null {
        if (!$this->isLoggedIn()) return null;
        return (new User())->find((int) $_SESSION['user_id']) ?: null;
    }

    protected function requireAuth(): void {
        if (!$this->isLoggedIn()) {
            $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
            $this->redirect('/login');
        }
    }

    protected function requireAdmin(): void {
        if (!$this->isAdmin()) {
            $this->redirect('/admin/login');
        }
    }

    protected function flash(string $type, string $message): void {
        $_SESSION['flash'] = ['type' => $type, 'message' => $message];
    }

    protected function getFlash(): array|null {
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }
        return null;
    }

    protected function getIP(): string {
        return $_SERVER['HTTP_X_FORWARDED_FOR']
            ?? $_SERVER['HTTP_CLIENT_IP']
            ?? $_SERVER['REMOTE_ADDR']
            ?? '0.0.0.0';
    }

    protected function csrfToken(): string {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    protected function verifyCsrf(): void {
        $token = $_POST['_csrf'] ?? '';
        if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
            http_response_code(403);
            die('Token CSRF inválido. Volte atrás e tente novamente.');
        }
    }

    protected function uploadImage(string $folder, string $inputName = 'image'): string {
        if (empty($_FILES[$inputName]['name'])) return '';
        $ext = strtolower(pathinfo($_FILES[$inputName]['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) return '';
        $filename = $folder . '_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
        $dest = UPLOAD_PATH . $folder . '/' . $filename;
        return move_uploaded_file($_FILES[$inputName]['tmp_name'], $dest) ? $filename : '';
    }
}
