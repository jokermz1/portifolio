<?php
class AdminResumeController extends Controller {

    public function index(): void {
        $this->requireAdmin();
        $flash = $this->getFlash();
        $csrf  = $this->csrfToken();

        try {
            $items = (new ResumeItem())->all('sort_order');
        } catch (PDOException $e) {
            // Table doesn't exist yet — show migration warning
            $items = null;
        }

        $this->view('admin/resume/index', compact('items', 'flash', 'csrf'), 'admin');
    }

    public function create(): void {
        $this->requireAdmin();
        $csrf = $this->csrfToken();
        $this->view('admin/resume/create', compact('csrf'), 'admin');
    }

    public function store(): void {
        $this->requireAdmin();
        $this->verifyCsrf();

        (new ResumeItem())->create([
            'type'        => in_array($this->input('type'), ['education','experience'])
                                ? $this->input('type') : 'education',
            'title'       => $this->sanitize($this->input('title', '')),
            'period'      => $this->sanitize($this->input('period', '')),
            'subtitle'    => $this->sanitize($this->input('subtitle', '')),
            'description' => $this->sanitize($this->input('description', '')),
            'sort_order'  => (int) $this->input('sort_order', 0),
            'is_active'   => (int) $this->input('is_active', 1),
        ]);

        $this->flash('success', 'Item de currículo criado com sucesso.');
        $this->redirect('/admin/resume');
    }

    public function edit(int $id): void {
        $this->requireAdmin();
        $item = (new ResumeItem())->find($id);
        if (!$item) $this->redirect('/admin/resume');
        $csrf  = $this->csrfToken();
        $flash = $this->getFlash();
        $this->view('admin/resume/edit', compact('item', 'csrf', 'flash'), 'admin');
    }

    public function update(int $id): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        $model = new ResumeItem();
        if (!$model->find($id)) $this->redirect('/admin/resume');

        $model->update($id, [
            'type'        => in_array($this->input('type'), ['education','experience'])
                                ? $this->input('type') : 'education',
            'title'       => $this->sanitize($this->input('title', '')),
            'period'      => $this->sanitize($this->input('period', '')),
            'subtitle'    => $this->sanitize($this->input('subtitle', '')),
            'description' => $this->sanitize($this->input('description', '')),
            'sort_order'  => (int) $this->input('sort_order', 0),
            'is_active'   => (int) $this->input('is_active', 1),
        ]);

        $this->flash('success', 'Item atualizado.');
        $this->redirect('/admin/resume');
    }

    public function delete(int $id): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        (new ResumeItem())->delete($id);
        $this->flash('success', 'Item apagado.');
        $this->redirect('/admin/resume');
    }

    /** Guarda o resumo de texto (settings) */
    public function summary(): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        (new Setting())->set('resume_summary', $this->sanitize($this->input('resume_summary', '')));
        $this->flash('success', 'Sumário guardado.');
        $this->redirect('/admin/resume');
    }
}
