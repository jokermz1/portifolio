<?php
class AdminPortfolioController extends Controller {
    public function index(): void {
        $this->requireAdmin();
        $projects = (new Project())->all('created_at', 'DESC');
        $flash    = $this->getFlash();
        $this->view('admin/portfolio/index', compact('projects', 'flash'), 'admin');
    }

    public function create(): void {
        $this->requireAdmin();
        $csrf       = $this->csrfToken();
        $categories = (new Project())->categories();
        $this->view('admin/portfolio/create', compact('csrf', 'categories'), 'admin');
    }

    public function store(): void {
        $this->requireAdmin();
        $this->verifyCsrf();

        $model = new Project();
        $data  = [
            'title'        => $this->sanitize($this->input('title', '')),
            'description'  => $this->sanitize($this->input('description', '')),
            'content'      => $this->input('content', ''),
            'category'     => $this->sanitize($this->input('category', '')),
            'project_url'  => $this->sanitize($this->input('project_url', '')),
            'is_featured'  => (int) $this->input('is_featured', 0),
            'is_published' => (int) $this->input('is_published', 1),
        ];
        $data['slug'] = $model->generateSlug($data['title']);

        $img = $this->uploadImage('projects');
        if ($img) $data['image'] = $img;

        $model->create($data);
        $this->flash('success', 'Projeto criado com sucesso.');
        $this->redirect('/admin/portfolio');
    }

    public function edit(int $id): void {
        $this->requireAdmin();
        $model   = new Project();
        $project = $model->find($id);
        if (!$project) $this->redirect('/admin/portfolio');
        $csrf       = $this->csrfToken();
        $flash      = $this->getFlash();
        $categories = $model->categories();
        $this->view('admin/portfolio/edit', compact('project', 'csrf', 'flash', 'categories'), 'admin');
    }

    public function update(int $id): void {
        $this->requireAdmin();
        $this->verifyCsrf();

        $model   = new Project();
        $project = $model->find($id);
        if (!$project) $this->redirect('/admin/portfolio');

        $data = [
            'title'        => $this->sanitize($this->input('title', '')),
            'description'  => $this->sanitize($this->input('description', '')),
            'content'      => $this->input('content', ''),
            'category'     => $this->sanitize($this->input('category', '')),
            'project_url'  => $this->sanitize($this->input('project_url', '')),
            'is_featured'  => (int) $this->input('is_featured', 0),
            'is_published' => (int) $this->input('is_published', 1),
        ];

        $img = $this->uploadImage('projects');
        if ($img) $data['image'] = $img;

        $model->update($id, $data);
        $this->flash('success', 'Projeto atualizado.');
        $this->redirect('/admin/portfolio');
    }

    public function delete(int $id): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        (new Project())->delete($id);
        $this->flash('success', 'Projeto apagado.');
        $this->redirect('/admin/portfolio');
    }
}
