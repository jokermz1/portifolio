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

        // Contactos adicionais (JSON)
        $data['owner_contacts_extra'] = $this->parseContacts();

        $model->setMany($data);
        $this->flash('success', 'Informação do About Me guardada com sucesso.');
        $this->redirect('/admin/about');
    }

    private function parseContacts(): string {
        $types  = $_POST['contact_type']  ?? [];
        $labels = $_POST['contact_label'] ?? [];
        $values = $_POST['contact_value'] ?? [];

        $iconMap = [
            'email'     => 'bi-envelope-fill',
            'phone'     => 'bi-telephone-fill',
            'whatsapp'  => 'bi-whatsapp',
            'address'   => 'bi-geo-alt-fill',
            'skype'     => 'bi-skype',
            'telegram'  => 'bi-telegram',
            'website'   => 'bi-globe',
            'other'     => 'bi-chat-dots-fill',
        ];

        $contacts = [];
        foreach ($values as $i => $val) {
            $val = trim($val);
            if ($val === '') continue;
            $type  = $types[$i]  ?? 'other';
            $label = trim($labels[$i] ?? '');
            if ($label === '') $label = ucfirst($type);
            $contacts[] = [
                'type'  => $type,
                'icon'  => $iconMap[$type] ?? 'bi-chat-dots-fill',
                'label' => htmlspecialchars($label, ENT_QUOTES, 'UTF-8'),
                'value' => htmlspecialchars($val, ENT_QUOTES, 'UTF-8'),
            ];
        }

        return json_encode($contacts, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    private function uploadPdf(string $inputName): string {
        if (empty($_FILES[$inputName]['name'])) return '';
        $ext = strtolower(pathinfo($_FILES[$inputName]['name'], PATHINFO_EXTENSION));
        if ($ext !== 'pdf') return '';
        if ($_FILES[$inputName]['size'] > 10 * 1024 * 1024) return '';
        $filename = 'cv_' . time() . '.pdf';
        $dest = UPLOAD_PATH . 'cv/' . $filename;
        return move_uploaded_file($_FILES[$inputName]['tmp_name'], $dest) ? $filename : '';
    }
}
