<?php
class AdminAboutMeController extends Controller {

    public function index(): void {
        $this->requireAdmin();
        $settings = (new Setting())->allKeyed();
        $flash    = $this->getFlash();
        $csrf     = $this->csrfToken();
        $this->view('admin/about/index', compact('settings', 'flash', 'csrf'), 'admin');
    }

    public function update(): void {
        $this->requireAdmin();
        $this->verifyCsrf();

        $fields = [
            'owner_name', 'owner_title', 'owner_bio',
            'owner_email', 'owner_phone', 'owner_address',
            'cv_url',
            'social_github', 'social_linkedin', 'social_twitter',
            'social_instagram', 'social_facebook', 'social_youtube',
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

        // CV PDF upload
        if (!empty($_FILES['cv_file']['name'])) {
            $filename = $this->uploadPdf('cv_file');
            if ($filename) $data['cv_file'] = $filename;
        }

        $model->setMany($data);
        $this->flash('success', 'Informação do About Me guardada com sucesso.');
        $this->redirect('/admin/about');
    }

    private function uploadPdf(string $inputName): string {
        if (empty($_FILES[$inputName]['name'])) return '';
        $ext = strtolower(pathinfo($_FILES[$inputName]['name'], PATHINFO_EXTENSION));
        if ($ext !== 'pdf') return '';
        if ($_FILES[$inputName]['size'] > 10 * 1024 * 1024) return ''; // max 10 MB
        $filename = 'cv_' . time() . '.pdf';
        $dest = UPLOAD_PATH . 'cv/' . $filename;
        return move_uploaded_file($_FILES[$inputName]['tmp_name'], $dest) ? $filename : '';
    }
}
