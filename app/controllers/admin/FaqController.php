<?php
class AdminFaqController extends Controller {
    public function index(): void {
        $this->requireAdmin();
        $faqs  = (new Faq())->all('sort_order');
        $flash = $this->getFlash();
        $csrf  = $this->csrfToken();
        $this->view('admin/faqs/index', compact('faqs', 'flash', 'csrf'), 'admin');
    }

    public function create(): void {
        $this->requireAdmin();
        $csrf = $this->csrfToken();
        $this->view('admin/faqs/create', compact('csrf'), 'admin');
    }

    public function store(): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        (new Faq())->create([
            'question'   => $this->sanitize($this->input('question', '')),
            'answer'     => $this->sanitize($this->input('answer', '')),
            'sort_order' => (int) $this->input('sort_order', 0),
            'is_active'  => (int) $this->input('is_active', 1),
        ]);
        $this->flash('success', 'FAQ criada com sucesso.');
        $this->redirect('/admin/faqs');
    }

    public function edit(int $id): void {
        $this->requireAdmin();
        $faq = (new Faq())->find($id);
        if (!$faq) $this->redirect('/admin/faqs');
        $csrf  = $this->csrfToken();
        $flash = $this->getFlash();
        $this->view('admin/faqs/edit', compact('faq', 'csrf', 'flash'), 'admin');
    }

    public function update(int $id): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        $model = new Faq();
        if (!$model->find($id)) $this->redirect('/admin/faqs');
        $model->update($id, [
            'question'   => $this->sanitize($this->input('question', '')),
            'answer'     => $this->sanitize($this->input('answer', '')),
            'sort_order' => (int) $this->input('sort_order', 0),
            'is_active'  => (int) $this->input('is_active', 1),
        ]);
        $this->flash('success', 'FAQ atualizada.');
        $this->redirect('/admin/faqs');
    }

    public function delete(int $id): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        (new Faq())->delete($id);
        $this->flash('success', 'FAQ apagada.');
        $this->redirect('/admin/faqs');
    }
}
