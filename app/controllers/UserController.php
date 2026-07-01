<?php
class UserController extends Controller {
    public function profile(): void {
        $this->requireAuth();
        $user         = $this->currentUser();
        $comments     = (new Comment())->userCommentsWithTarget((int) $user['id']);
        $testimonials = (new Testimonial())->userTestimonials((int) $user['id']);
        $flash        = $this->getFlash();
        $csrf         = $this->csrfToken();
        $this->view('user/profile', compact('user', 'comments', 'testimonials', 'flash', 'csrf'));
    }

    public function update(): void {
        $this->requireAuth();
        $this->verifyCsrf();

        $user = $this->currentUser();
        $data = [
            'name' => $this->sanitize($this->input('name', $user['name'])),
            'bio'  => $this->sanitize($this->input('bio', '')),
        ];

        if (!empty($_FILES['avatar']['name'])) {
            $filename = $this->uploadImage('avatars', 'avatar');
            if ($filename) $data['avatar'] = $filename;
        }

        $newPassword = $this->input('new_password', '');
        if ($newPassword) {
            $userModel = new User();
            if (!$userModel->verifyPassword($this->input('current_password', ''), $user['password_hash'])) {
                $this->flash('error', 'Senha atual incorreta.');
                $this->redirect('/profile');
            }
            if (strlen($newPassword) < 8) {
                $this->flash('error', 'A nova senha precisa de pelo menos 8 caracteres.');
                $this->redirect('/profile');
            }
            $data['password_hash'] = password_hash($newPassword, PASSWORD_BCRYPT, ['cost' => 12]);
        }

        (new User())->update((int) $user['id'], $data);
        $_SESSION['user_name'] = $data['name'];
        $this->flash('success', 'Perfil atualizado com sucesso.');
        $this->redirect('/profile');
    }
}
