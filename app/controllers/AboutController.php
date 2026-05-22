<?php
class AboutController extends Controller {
    public function index(): void {
        $settings = (new Setting())->allKeyed();
        $user     = $this->currentUser();

        try {
            $skills = (new Skill())->all('sort_order');
        } catch (PDOException $e) {
            $skills = [];
        }

        try {
            $resume = (new ResumeItem())->byType();
        } catch (PDOException $e) {
            $resume = ['education' => [], 'experience' => []];
        }

        $this->view('about/index', compact('settings', 'skills', 'resume', 'user'));
    }
}
