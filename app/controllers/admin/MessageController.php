<?php
class AdminMessageController extends Controller {
    public function index(): void {
        $this->requireAdmin();
        $messages = (new Message())->all('created_at', 'DESC');
        $flash    = $this->getFlash();
        $csrf     = $this->csrfToken();
        $this->view('admin/messages/index', compact('messages', 'flash', 'csrf'), 'admin');
    }

    public function show(int $id): void {
        $this->requireAdmin();
        $message = (new Message())->find($id);
        if (!$message) $this->redirect('/admin/messages');
        if (!$message['is_read']) (new Message())->markRead($id);
        $this->view('admin/messages/show', compact('message'), 'admin');
    }

    public function delete(int $id): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        (new Message())->delete($id);
        $this->flash('success', 'Mensagem apagada.');
        $this->redirect('/admin/messages');
    }
}
