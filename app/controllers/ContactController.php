<?php
class ContactController extends Controller {
    public function index(): void {
        $flash    = $this->getFlash();
        $csrf     = $this->csrfToken();
        $settings = (new Setting())->allKeyed();
        $user     = $this->currentUser();
        $this->view('contact/index', compact('flash', 'csrf', 'settings', 'user'));
    }

    public function send(): void {
        $this->verifyCsrf();

        $name    = $this->sanitize($this->input('name', ''));
        $email   = filter_var($this->input('email', ''), FILTER_SANITIZE_EMAIL);
        $subject = $this->sanitize($this->input('subject', ''));
        $content = $this->sanitize($this->input('content', ''));

        if (!$name || !$content || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->flash('error', 'Preencha todos os campos obrigatórios corretamente.');
            $this->redirect('/contact');
        }

        (new Message())->create(compact('name', 'email', 'subject', 'content'));
        $this->flash('success', 'Mensagem enviada! Responderei em breve.');
        $this->redirect('/contact');
    }
}
