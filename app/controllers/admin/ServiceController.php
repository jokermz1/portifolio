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
        $data = [
            'title'        => $this->sanitize($this->input('title', '')),
            'description'  => $this->sanitize($this->input('description', '')),
            'icon'         => $this->sanitize($this->input('icon', '')),
            'external_url' => $this->sanitize($this->input('external_url', '')),
            'sort_order'   => (int) $this->input('sort_order', 0),
            'is_active'    => (int) $this->input('is_active', 1),
        ];
        $img = $this->uploadImage('services');
        if ($img) $data['image'] = $img;
        $extra = $this->uploadImages('services');
        if ($extra) $data['images'] = json_encode($extra);
        $data['links'] = $this->parseLinks();
        (new Service())->create($data);
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
        $service = (new Service())->find($id);
        if (!$service) $this->redirect('/admin/services');
        $data = [
            'title'        => $this->sanitize($this->input('title', '')),
            'description'  => $this->sanitize($this->input('description', '')),
            'icon'         => $this->sanitize($this->input('icon', '')),
            'external_url' => $this->sanitize($this->input('external_url', '')),
            'sort_order'   => (int) $this->input('sort_order', 0),
            'is_active'    => (int) $this->input('is_active', 1),
        ];
        $img = $this->uploadImage('services');
        if ($img) $data['image'] = $img;
        $kept  = $_POST['keep_images'] ?? [];
        $extra = $this->uploadImages('services');
        $all   = array_values(array_unique(array_merge($kept, $extra)));
        $data['images'] = $all ? json_encode($all) : null;
        $data['links'] = $this->parseLinks();
        (new Service())->update($id, $data);
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
