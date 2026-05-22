<?php
class ServiceController extends Controller {
    public function index(): void {
        $services = (new Service())->active();
        $settings = (new Setting())->allKeyed();
        $this->view('services/index', compact('services', 'settings'));
    }

    public function show(string $id): void {
        $model   = new Service();
        $service = $model->find((int) $id);
        if (!$service || !$service['is_active']) {
            http_response_code(404);
            $this->view('errors/404', [], 'main');
            return;
        }
        $services = $model->active();
        $settings = (new Setting())->allKeyed();
        $this->view('services/show', compact('service', 'services', 'settings'));
    }
}
