<?php
class HomeController extends Controller {
    public function index(): void {
        $projects = (new Project())->homeShowcase(6);
        $services = (new Service())->active();
        $skills   = (new Skill())->byCategory();
        $settings = (new Setting())->allKeyed();
        // Prioriza os depoimentos em destaque; se houver menos de 2,
        // recorre a todos os aprovados para o carrossel ter conteúdo suficiente.
        $testimonialModel = new Testimonial();
        $testimonials     = $testimonialModel->featuredApproved();
        if (count($testimonials) < 2) {
            $testimonials = $testimonialModel->approved();
        }
        $flash    = $this->getFlash();
        $csrf     = $this->csrfToken();
        $user     = $this->currentUser();

        $this->view('home/index', compact('projects', 'services', 'skills', 'settings', 'testimonials', 'flash', 'csrf', 'user'));
    }
}
