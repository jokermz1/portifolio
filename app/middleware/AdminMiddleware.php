<?php
class AdminMiddleware {
    public function handle(): void {
        if (!isset($_SESSION['admin_id'])) {
            header('Location: ' . BASE_URL . '/admin/login');
            exit;
        }
    }
}
