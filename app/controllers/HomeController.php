<?php
class HomeController extends Controller {
    public function index(): void {
        $projects = (new Project())->homeShowcase(6);
        $services = (new Service())->active();
        $skills   = (new Skill())->byCategory();
        $settings = (new Setting())->allKeyed();
        $testimonials = (new Testimonial())->featuredApproved();
        $flash    = $this->getFlash();
        $csrf     = $this->csrfToken();
        $user     = $this->currentUser();

        $this->view('home/index', compact('projects', 'services', 'skills', 'settings', 'testimonials', 'flash', 'csrf', 'user'));
    }
}
