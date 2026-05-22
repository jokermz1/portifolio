<?php
class AdminServiceController extends Controller {
    public function index(): void {
        $this->requireAdmin();
        $services = (new Service())->all('sort_order');
        $flash    = $this->getFlash();
        $csrf     = $this->csrfToken();
        $this->view('admin/services/index', compact('services', 'flash', 'csrf'), 'admin');
    }

    public function create(): void {
        $this->requireAdmin();
        $csrf = $this->csrfToken();
        $this->view('admin/services/create', compact('csrf'), 'admin');
    }

    public function store(): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        (new Service())->create([
            'title'       => $this->sanitize($this->input('title', '')),
            'description' => $this->sanitize($this->input('description', '')),
            'icon'        => $this->sanitize($this->input('icon', '')),
            'sort_order'  => (int) $this->input('sort_order', 0),
            'is_active'   => (int) $this->input('is_active', 1),
        ]);
        $this->flash('success', 'Serviço criado.');
        $this->redirect('/admin/services');
    }

    public function edit(int $id): void {
        $this->requireAdmin();
        $service = (new Service())->find($id);
        if (!$service) $this->redirect('/admin/services');
        $csrf = $this->csrfToken();
        $this->view('admin/services/edit', compact('service', 'csrf'), 'admin');
    }

    public function update(int $id): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        (new Service())->update($id, [
            'title'       => $this->sanitize($this->input('title', '')),
            'description' => $this->sanitize($this->input('description', '')),
            'icon'        => $this->sanitize($this->input('icon', '')),
            'sort_order'  => (int) $this->input('sort_order', 0),
            'is_active'   => (int) $this->input('is_active', 1),
        ]);
        $this->flash('success', 'Serviço atualizado.');
        $this->redirect('/admin/services');
    }

    public function delete(int $id): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        (new Service())->delete($id);
        $this->flash('success', 'Serviço apagado.');
        $this->redirect('/admin/services');
    }
}
