<?php
class AdminSkillController extends Controller {

    public function index(): void {
        $this->requireAdmin();
        $skills = (new Skill())->all('sort_order');
        $flash  = $this->getFlash();
        $csrf   = $this->csrfToken();
        $this->view('admin/skills/index', compact('skills', 'flash', 'csrf'), 'admin');
    }

    public function create(): void {
        $this->requireAdmin();
        $csrf = $this->csrfToken();
        $this->view('admin/skills/create', compact('csrf'), 'admin');
    }

    public function store(): void {
        $this->requireAdmin();
        $this->verifyCsrf();

        (new Skill())->create([
            'name'       => $this->sanitize($this->input('name', '')),
            'level'      => min(100, max(0, (int) $this->input('level', 0))),
            'category'   => $this->sanitize($this->input('category', 'Geral')),
            'sort_order' => (int) $this->input('sort_order', 0),
        ]);

        $this->flash('success', 'Skill adicionada com sucesso.');
        $this->redirect('/admin/skills');
    }

    public function edit(int $id): void {
        $this->requireAdmin();
        $skill = (new Skill())->find($id);
        if (!$skill) $this->redirect('/admin/skills');
        $csrf  = $this->csrfToken();
        $flash = $this->getFlash();
        $this->view('admin/skills/edit', compact('skill', 'csrf', 'flash'), 'admin');
    }

    public function update(int $id): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        $model = new Skill();
        if (!$model->find($id)) $this->redirect('/admin/skills');

        $model->update($id, [
            'name'       => $this->sanitize($this->input('name', '')),
            'level'      => min(100, max(0, (int) $this->input('level', 0))),
            'category'   => $this->sanitize($this->input('category', 'Geral')),
            'sort_order' => (int) $this->input('sort_order', 0),
        ]);

        $this->flash('success', 'Skill atualizada.');
        $this->redirect('/admin/skills');
    }

    public function delete(int $id): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        (new Skill())->delete($id);
        $this->flash('success', 'Skill apagada.');
        $this->redirect('/admin/skills');
    }

    /** Guarda todas as skills de uma vez (lista editável) */
    public function saveBatch(): void {
        $this->requireAdmin();
        $this->verifyCsrf();

        $model = new Skill();

        // Apagar skills removidas
        $deleteRaw = trim($_POST['delete_ids'] ?? '');
        if ($deleteRaw !== '') {
            foreach (explode(',', $deleteRaw) as $id) {
                $id = (int) trim($id);
                if ($id > 0) $model->delete($id);
            }
        }

        // Guardar skills (criar ou atualizar)
        $ids        = $_POST['skill_id']       ?? [];
        $names      = $_POST['skill_name']     ?? [];
        $levels     = $_POST['skill_level']    ?? [];
        $categories = $_POST['skill_category'] ?? [];
        $orders     = $_POST['skill_order']    ?? [];

        foreach ($names as $i => $name) {
            $name = trim(htmlspecialchars(strip_tags($name)));
            if ($name === '') continue;

            $data = [
                'name'       => $name,
                'level'      => min(100, max(0, (int)($levels[$i] ?? 0))),
                'category'   => trim(htmlspecialchars(strip_tags($categories[$i] ?? 'Geral'))) ?: 'Geral',
                'sort_order' => (int)($orders[$i] ?? 0),
            ];

            $id = (int)($ids[$i] ?? 0);
            if ($id > 0) {
                $model->update($id, $data);
            } else {
                $model->create($data);
            }
        }

        $this->flash('success', 'Skills guardadas com sucesso.');
        $this->redirect('/admin/skills');
    }
}
