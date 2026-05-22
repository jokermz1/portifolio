<?php
class BlogController extends Controller {
    public function index(): void {
        $perPage   = 6;
        $model     = new Post();
        $total     = $model->countPublished();
        $page      = max(1, (int) ($this->input('page', 1)));
        $totalPages = (int) ceil($total / $perPage);
        $page      = min($page, max(1, $totalPages));
        $posts     = $model->publishedPaginated($page, $perPage);
        $settings  = (new Setting())->allKeyed();
        $this->view('blog/index', compact('posts', 'page', 'totalPages', 'settings'));
    }

    public function show(string $slug): void {
        $model = new Post();
        $post  = $model->findBySlug($slug);
        if (!$post) {
            http_response_code(404);
            $this->view('errors/404', [], 'main');
            return;
        }
        $comments    = (new Comment())->forEntity('post', (int) $post['id']);
        $user        = $this->currentUser();
        $flash       = $this->getFlash();
        $csrf        = $this->csrfToken();
        $recentPosts = $model->recentPublished(4, (int) $post['id']);
        $prevNext    = $model->prevNext((int) $post['id']);
        $settings    = (new Setting())->allKeyed();

        $this->view('blog/show', compact(
            'post', 'comments', 'user', 'flash', 'csrf',
            'recentPosts', 'prevNext', 'settings'
        ));
    }
}
