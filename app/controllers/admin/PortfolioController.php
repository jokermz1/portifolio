<?php
class AdminPortfolioController extends Controller {
    public function index(): void {
        $this->requireAdmin();
        $projects = (new Project())->ordered();
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
            'client'       => $this->sanitize($this->input('client', '')),
            'project_url'  => $this->sanitize($this->input('project_url', '')),
            'is_featured'  => (int) $this->input('is_featured', 0),
            'is_published' => (int) $this->input('is_published', 1),
            'sort_order'   => max(0, (int) $this->input('sort_order', 0)),
        ];
        $data['slug'] = $model->generateSlug($data['title']);

        $img = $this->uploadImage('projects');
        if ($img) $data['image'] = $img;

        $extra = $this->uploadImages('projects');
        if ($extra) {
            $caps    = $_POST['image_captions'] ?? [];
            $gallery = [];
            foreach ($extra as $i => $f) {
                $gallery[] = ['file' => $f, 'caption' => $this->sanitize($caps[$i] ?? '')];
            }
            $data['images'] = json_encode($gallery, JSON_UNESCAPED_UNICODE);
        }

        $data['links'] = $this->parseLinks();

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
            'client'       => $this->sanitize($this->input('client', '')),
            'project_url'  => $this->sanitize($this->input('project_url', '')),
            'is_featured'  => (int) $this->input('is_featured', 0),
            'is_published' => (int) $this->input('is_published', 1),
            'sort_order'   => max(0, (int) $this->input('sort_order', 0)),
        ];

        $img = $this->uploadImage('projects');
        if ($img) $data['image'] = $img;

        // Galeria: mantém as imagens existentes (com legenda) e acrescenta as novas
        $kept     = $_POST['keep_images']    ?? [];
        $captions = $_POST['image_captions'] ?? [];
        $gallery  = [];
        foreach ($kept as $file) {
            $gallery[] = ['file' => $file, 'caption' => $this->sanitize($captions[$file] ?? '')];
        }
        foreach ($this->uploadImages('projects') as $file) {
            $gallery[] = ['file' => $file, 'caption' => ''];
        }
        $data['images'] = $gallery ? json_encode($gallery, JSON_UNESCAPED_UNICODE) : null;

        $data['links'] = $this->parseLinks();

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
