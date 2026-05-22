<?php
class AdminCommentController extends Controller {
    public function pending(): void {
        $this->requireAdmin();
        $comments = (new Comment())->pending();
        $flash    = $this->getFlash();
        $csrf     = $this->csrfToken();
        $this->view('admin/comments/pending', compact('comments', 'flash', 'csrf'), 'admin');
    }

    public function all(): void {
        $this->requireAdmin();
        $page     = max(1, (int) $this->input('page', 1));
        $comments = (new Comment())->allWithUser(20, $page);
        $total    = (new Comment())->count();
        $flash    = $this->getFlash();
        $csrf     = $this->csrfToken();
        $this->view('admin/comments/all', compact('comments', 'total', 'page', 'flash', 'csrf'), 'admin');
    }

    public function approve(int $id): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        (new Comment())->approve($id);
        $this->flash('success', 'Comentário aprovado e publicado.');
        $this->redirectBack();
    }

    public function reject(int $id): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        (new Comment())->reject($id);
        $this->flash('success', 'Comentário rejeitado.');
        $this->redirectBack();
    }

    public function delete(int $id): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        (new Comment())->delete($id);
        $this->flash('success', 'Comentário apagado permanentemente.');
        $this->redirectBack();
    }
}
