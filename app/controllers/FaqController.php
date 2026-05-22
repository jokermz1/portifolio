<?php
class FaqController extends Controller {
    public function index(): void {
        $faqs     = (new Faq())->active();
        $settings = (new Setting())->allKeyed();
        $this->view('faqs/index', compact('faqs', 'settings'));
    }
}
