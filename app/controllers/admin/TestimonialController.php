<?php
class AdminTestimonialController extends Controller {
    public function index(): void {
        $this->requireAdmin();
        $pending     = (new Testimonial())->pending();
        $all         = (new Testimonial())->allWithUser();
        $flash       = $this->getFlash();
        $csrf        = $this->csrfToken();
        $this->view('admin/testimonials/index', compact('pending', 'all', 'flash', 'csrf'), 'admin');
    }

    public function approve(int $id): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        (new Testimonial())->approve($id);
        $this->flash('success', 'Avaliação aprovada.');
        $this->redirectBack();
    }

    public function reject(int $id): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        (new Testimonial())->reject($id);
        $this->flash('success', 'Avaliação rejeitada.');
        $this->redirectBack();
    }

    public function feature(int $id): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        (new Testimonial())->toggleFeatured($id);
        $this->flash('success', 'Destaque atualizado.');
        $this->redirectBack();
    }

    public function delete(int $id): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        (new Testimonial())->delete($id);
        $this->flash('success', 'Avaliação apagada permanentemente.');
        $this->redirectBack();
    }
}
