<?php
class AdminSettingController extends Controller {
    public function index(): void {
        $this->requireAdmin();
        $settings = (new Setting())->allKeyed();
        $skills   = (new Skill())->all('sort_order');
        $flash    = $this->getFlash();
        $csrf     = $this->csrfToken();

        $stats = [
            'projects_done' => (new Project())->count('is_published = 1'),
            'clients'       => (new User())->count('is_active = 1'),
        ];

        $this->view('admin/settings', compact('settings', 'skills', 'flash', 'csrf', 'stats'), 'admin');
    }

    public function update(): void {
        $this->requireAdmin();
        $this->verifyCsrf();

        $fields = [
            'site_name', 'owner_name', 'owner_title', 'owner_bio',
            'owner_email', 'owner_phone', 'owner_whatsapp', 'owner_address',
            'cv_url', 'hero_text', 'years_experience', 'projects_done', 'clients', 'awards',
            'social_facebook', 'social_github', 'social_linkedin',
            'social_twitter', 'social_instagram', 'social_youtube',
            'theme_primary', 'theme_primary_2', 'theme_accent',
        ];

        $model = new Setting();
        $data  = [];
        foreach ($fields as $field) {
            $data[$field] = $this->sanitize($this->input($field, ''));
        }

        // Owner photo upload
        if (!empty($_FILES['owner_photo']['name'])) {
            $filename = $this->uploadImage('avatars', 'owner_photo');
            if ($filename) $data['owner_photo'] = $filename;
        }

        // Site logo upload
        if (!empty($_FILES['site_logo']['name'])) {
            $filename = $this->uploadImage('logos', 'site_logo');
            if ($filename) $data['site_logo'] = $filename;
        }

        $model->setMany($data);
        $this->flash('success', 'Definições guardadas com sucesso.');
        $this->redirect('/admin/settings');
    }
}
