<?php
class AuthController extends Controller {
    public function loginForm(): void {
        if ($this->isLoggedIn()) $this->redirect('/profile');
        $flash = $this->getFlash();
        $csrf  = $this->csrfToken();
        $this->view('auth/login', compact('flash', 'csrf'));
    }

    public function login(): void {
        $this->verifyCsrf();
        $email    = trim($this->input('email', ''));
        $password = $this->input('password', '');

        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if (!$user || !$userModel->verifyPassword($password, $user['password_hash'])) {
            $this->flash('error', 'Email ou senha incorretos.');
            $this->redirect('/login');
        }
        if (!$user['is_active']) {
            $this->flash('error', 'Conta suspensa. Contacte o administrador.');
            $this->redirect('/login');
        }

        $_SESSION['user_id']   = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        $redirect = $_SESSION['redirect_after_login'] ?? (BASE_URL . '/profile');
        unset($_SESSION['redirect_after_login']);
        header('Location: ' . $redirect);
        exit;
    }

    public function registerForm(): void {
        if ($this->isLoggedIn()) $this->redirect('/profile');
        $flash = $this->getFlash();
        $csrf  = $this->csrfToken();
        $this->view('auth/register', compact('flash', 'csrf'));
    }

    public function register(): void {
        $this->verifyCsrf();

        $name     = $this->sanitize($this->input('name', ''));
        $email    = filter_var(trim($this->input('email', '')), FILTER_SANITIZE_EMAIL);
        $password = $this->input('password', '');
        $confirm  = $this->input('password_confirm', '');

        if (!$name || !$email || !$password) {
            $this->flash('error', 'Todos os campos são obrigatórios.');
            $this->redirect('/register');
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->flash('error', 'Email inválido.');
            $this->redirect('/register');
        }
        if (strlen($password) < 8) {
            $this->flash('error', 'A senha precisa de pelo menos 8 caracteres.');
            $this->redirect('/register');
        }
        if ($password !== $confirm) {
            $this->flash('error', 'As senhas não coincidem.');
            $this->redirect('/register');
        }

        $userModel = new User();
        if ($userModel->findByEmail($email)) {
            $this->flash('error', 'Este email já está registado.');
            $this->redirect('/register');
        }

        $id = $userModel->create(['name' => $name, 'email' => $email, 'password' => $password]);
        $_SESSION['user_id']   = $id;
        $_SESSION['user_name'] = $name;
        $this->flash('success', 'Conta criada com sucesso! Bem-vindo(a), ' . htmlspecialchars($name) . '.');
        $this->redirect('/profile');
    }

    public function logout(): void {
        unset($_SESSION['user_id'], $_SESSION['user_name']);
        $this->redirect('/login');
    }
}
