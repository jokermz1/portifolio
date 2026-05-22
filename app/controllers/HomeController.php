<?php
class HomeController extends Controller {
    public function index(): void {
        $projects = (new Project())->featured();
        $services = (new Service())->active();
        $skills   = (new Skill())->byCategory();
        $settings = (new Setting())->allKeyed();
        $flash    = $this->getFlash();
        $csrf     = $this->csrfToken();
        $user     = $this->currentUser();

        $this->view('home/index', compact('projects', 'services', 'skills', 'settings', 'flash', 'csrf', 'user'));
    }
}
