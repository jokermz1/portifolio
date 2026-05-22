<?php
class AdminAuthController extends Controller {
    public function loginForm(): void {
        if ($this->isAdmin()) $this->redirect('/admin');
        $flash = $this->getFlash();
        $csrf  = $this->csrfToken();
        $this->view('admin/auth/login', compact('flash', 'csrf'), 'admin_bare');
    }

    public function login(): void {
        $this->verifyCsrf();
        $email    = trim($this->input('email', ''));
        $password = $this->input('password', '');

        if ($email !== ADMIN_EMAIL || !password_verify($password, ADMIN_PASSWORD_HASH)) {
            $this->flash('error', 'Credenciais inválidas.');
            $this->redirect('/admin/login');
        }

        $_SESSION['admin_id']    = 1;
        $_SESSION['admin_email'] = $email;
        $this->redirect('/admin');
    }

    public function logout(): void {
        unset($_SESSION['admin_id'], $_SESSION['admin_email']);
        $this->redirect('/admin/login');
    }
}
