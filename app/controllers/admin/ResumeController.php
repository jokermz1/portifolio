<?php
class AdminResumeController extends Controller {

    public function index(): void {
        $this->requireAdmin();
        $flash = $this->getFlash();
        $csrf  = $this->csrfToken();

        try {
            $items = (new ResumeItem())->all('sort_order');
        } catch (PDOException $e) {
            $items = null;
        }

        $this->view('admin/resume/index', compact('items', 'flash', 'csrf'), 'admin');
    }

    public function create(): void {
        $this->requireAdmin();
        $csrf = $this->csrfToken();
        $this->view('admin/resume/create', compact('csrf'), 'admin');
    }

    public function store(): void {
        $this->requireAdmin();
        $this->verifyCsrf();

        $data = [
            'type'        => in_array($this->input('type'), ['education','experience'])
                                ? $this->input('type') : 'education',
            'title'       => $this->sanitize($this->input('title', '')),
            'period'      => $this->sanitize($this->input('period', '')),
            'subtitle'    => $this->sanitize($this->input('subtitle', '')),
            'description' => $this->sanitize($this->input('description', '')),
            'sort_order'  => (int) $this->input('sort_order', 0),
            'is_active'   => (int) $this->input('is_active', 1),
        ];

        if (!empty($_FILES['attachment']['name'])) {
            $uploaded = $this->uploadAttachment('attachment');
            if ($uploaded) {
                $data['attachment']      = $uploaded['filename'];
                $data['attachment_name'] = $uploaded['original'];
            }
        }

        (new ResumeItem())->create($data);

        $this->flash('success', 'Item de currículo criado com sucesso.');
        $this->redirect('/admin/resume');
    }

    public function edit(int $id): void {
        $this->requireAdmin();
        $item = (new ResumeItem())->find($id);
        if (!$item) $this->redirect('/admin/resume');
        $csrf  = $this->csrfToken();
        $flash = $this->getFlash();
        $this->view('admin/resume/edit', compact('item', 'csrf', 'flash'), 'admin');
    }

    public function update(int $id): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        $model = new ResumeItem();
        $item  = $model->find($id);
        if (!$item) $this->redirect('/admin/resume');

        $data = [
            'type'        => in_array($this->input('type'), ['education','experience'])
                                ? $this->input('type') : 'education',
            'title'       => $this->sanitize($this->input('title', '')),
            'period'      => $this->sanitize($this->input('period', '')),
            'subtitle'    => $this->sanitize($this->input('subtitle', '')),
            'description' => $this->sanitize($this->input('description', '')),
            'sort_order'  => (int) $this->input('sort_order', 0),
            'is_active'   => (int) $this->input('is_active', 1),
        ];

        // Remover anexo existente se solicitado
        if ($this->input('remove_attachment') && !empty($item['attachment'])) {
            $this->deleteAttachmentFile($item['attachment']);
            $data['attachment']      = null;
            $data['attachment_name'] = null;
        }

        // Novo ficheiro de anexo
        if (!empty($_FILES['attachment']['name'])) {
            if (!empty($item['attachment'])) {
                $this->deleteAttachmentFile($item['attachment']);
            }
            $uploaded = $this->uploadAttachment('attachment');
            if ($uploaded) {
                $data['attachment']      = $uploaded['filename'];
                $data['attachment_name'] = $uploaded['original'];
            }
        }

        $model->update($id, $data);

        $this->flash('success', 'Item atualizado.');
        $this->redirect('/admin/resume');
    }

    public function delete(int $id): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        $item = (new ResumeItem())->find($id);
        if ($item && !empty($item['attachment'])) {
            $this->deleteAttachmentFile($item['attachment']);
        }
        (new ResumeItem())->delete($id);
        $this->flash('success', 'Item apagado.');
        $this->redirect('/admin/resume');
    }

    public function summary(): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        (new Setting())->set('resume_summary', $this->sanitize($this->input('resume_summary', '')));
        $this->flash('success', 'Sumário guardado.');
        $this->redirect('/admin/resume');
    }

    private function uploadAttachment(string $inputName): array|false {
        if (empty($_FILES[$inputName]['name'])) return false;
        $allowed = ['pdf','jpg','jpeg','png','webp','doc','docx'];
        $ext     = strtolower(pathinfo($_FILES[$inputName]['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed)) return false;
        if ($_FILES[$inputName]['size'] > 15 * 1024 * 1024) return false;

        $original = pathinfo($_FILES[$inputName]['name'], PATHINFO_FILENAME);
        $original = substr(preg_replace('/[^a-zA-Z0-9_\-áéíóúàâêôãõçÁÉÍÓÚÀÂÊÔÃÕÇ ]/', '', $original), 0, 80);
        $filename  = 'resume_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
        $dest      = UPLOAD_PATH . 'resume/' . $filename;

        if (!is_dir(UPLOAD_PATH . 'resume/')) {
            mkdir(UPLOAD_PATH . 'resume/', 0755, true);
        }

        if (!move_uploaded_file($_FILES[$inputName]['tmp_name'], $dest)) return false;
        return ['filename' => $filename, 'original' => $original ?: $filename];
    }

    private function deleteAttachmentFile(string $filename): void {
        $path = UPLOAD_PATH . 'resume/' . $filename;
        if (file_exists($path)) unlink($path);
    }
}
