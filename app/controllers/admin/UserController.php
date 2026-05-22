<?php
class AdminUserController extends Controller {
    public function index(): void {
        $this->requireAdmin();
        $users = (new User())->all('created_at', 'DESC');
        $flash = $this->getFlash();
        $this->view('admin/users/index', compact('users', 'flash'), 'admin');
    }

    public function show(int $id): void {
        $this->requireAdmin();
        $user     = (new User())->find($id);
        if (!$user) $this->redirect('/admin/users');
        $comments = (new Comment())->userComments($id);
        $csrf     = $this->csrfToken();
        $this->view('admin/users/show', compact('user', 'comments', 'csrf'), 'admin');
    }

    public function toggle(int $id): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        $user = (new User())->find($id);
        if (!$user) $this->redirect('/admin/users');
        $newStatus = $user['is_active'] ? 0 : 1;
        (new User())->update($id, ['is_active' => $newStatus]);
        $msg = $newStatus ? 'Utilizador reativado.' : 'Utilizador suspenso.';
        $this->flash('success', $msg);
        $this->redirect('/admin/users');
    }
}
