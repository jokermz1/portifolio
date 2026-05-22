<?php
class PortfolioController extends Controller {
    public function index(): void {
        $model      = new Project();
        $projects   = $model->allPublished();
        $categories = $model->categories();
        $settings   = (new Setting())->allKeyed();
        $this->view('portfolio/index', compact('projects', 'categories', 'settings'));
    }

    public function show(string $slug): void {
        $model   = new Project();
        $project = $model->findBySlug($slug);
        if (!$project) {
            http_response_code(404);
            $this->view('errors/404', [], 'main');
            return;
        }
        $comments = (new Comment())->forEntity('project', (int) $project['id']);
        $user     = $this->currentUser();
        $flash    = $this->getFlash();
        $csrf     = $this->csrfToken();
        $settings = (new Setting())->allKeyed();
        $related  = [];
        if (!empty($project['category'])) {
            $all     = $model->allPublished();
            $related = array_filter($all, fn($p) =>
                $p['category'] === $project['category'] && $p['id'] !== $project['id']
            );
            $related = array_slice(array_values($related), 0, 3);
        }

        $this->view('portfolio/show', compact('project', 'comments', 'user', 'flash', 'csrf', 'settings', 'related'));
    }
}
