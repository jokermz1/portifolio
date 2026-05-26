<?php
class AdminBlogController extends Controller {
    public function index(): void {
        $this->requireAdmin();
        $posts = (new Post())->all('created_at', 'DESC');
        $flash = $this->getFlash();
        $csrf  = $this->csrfToken();
        $this->view('admin/blog/index', compact('posts', 'flash', 'csrf'), 'admin');
    }

    public function create(): void {
        $this->requireAdmin();
        $csrf = $this->csrfToken();
        $this->view('admin/blog/create', compact('csrf'), 'admin');
    }

    public function store(): void {
        $this->requireAdmin();
        $this->verifyCsrf();

        $model = new Post();
        $data  = [
            'title'        => $this->sanitize($this->input('title', '')),
            'excerpt'      => $this->sanitize($this->input('excerpt', '')),
            'content'      => $this->input('content', ''),
            'external_url' => $this->sanitize($this->input('external_url', '')),
            'is_published' => (int) $this->input('is_published', 0),
        ];
        $data['slug'] = $model->generateSlug($data['title']);
        if ($data['is_published']) $data['published_at'] = date('Y-m-d H:i:s');

        $img = $this->uploadImage('posts');
        if ($img) $data['image'] = $img;

        $extra = $this->uploadImages('posts');
        if ($extra) $data['images'] = json_encode($extra);

        $data['links'] = $this->parseLinks();

        $model->create($data);
        $this->flash('success', 'Post criado com sucesso.');
        $this->redirect('/admin/blog');
    }

    public function edit(int $id): void {
        $this->requireAdmin();
        $post = (new Post())->find($id);
        if (!$post) $this->redirect('/admin/blog');
        $csrf  = $this->csrfToken();
        $flash = $this->getFlash();
        $this->view('admin/blog/edit', compact('post', 'csrf', 'flash'), 'admin');
    }

    public function update(int $id): void {
        $this->requireAdmin();
        $this->verifyCsrf();

        $model = new Post();
        $post  = $model->find($id);
        if (!$post) $this->redirect('/admin/blog');

        $wasPublished = (int) $post['is_published'];
        $isPublished  = (int) $this->input('is_published', 0);

        $data = [
            'title'        => $this->sanitize($this->input('title', '')),
            'excerpt'      => $this->sanitize($this->input('excerpt', '')),
            'content'      => $this->input('content', ''),
            'external_url' => $this->sanitize($this->input('external_url', '')),
            'is_published' => $isPublished,
        ];
        if ($isPublished && !$wasPublished) {
            $data['published_at'] = date('Y-m-d H:i:s');
        }

        $img = $this->uploadImage('posts');
        if ($img) $data['image'] = $img;

        $kept  = $_POST['keep_images'] ?? [];
        $extra = $this->uploadImages('posts');
        $all   = array_values(array_unique(array_merge($kept, $extra)));
        $data['images'] = $all ? json_encode($all) : null;

        $data['links'] = $this->parseLinks();

        $model->update($id, $data);
        $this->flash('success', 'Post atualizado.');
        $this->redirect('/admin/blog');
    }

    public function delete(int $id): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        (new Post())->delete($id);
        $this->flash('success', 'Post apagado.');
        $this->redirect('/admin/blog');
    }
}
