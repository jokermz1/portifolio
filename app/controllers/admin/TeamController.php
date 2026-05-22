<?php
class AdminTeamController extends Controller {
    public function index(): void {
        $this->requireAdmin();
        $members = (new TeamMember())->all('sort_order');
        $flash   = $this->getFlash();
        $csrf    = $this->csrfToken();
        $this->view('admin/team/index', compact('members', 'flash', 'csrf'), 'admin');
    }

    public function create(): void {
        $this->requireAdmin();
        $csrf = $this->csrfToken();
        $this->view('admin/team/create', compact('csrf'), 'admin');
    }

    public function store(): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        $data = [
            'name'             => $this->sanitize($this->input('name', '')),
            'role'             => $this->sanitize($this->input('role', '')),
            'bio'              => $this->sanitize($this->input('bio', '')),
            'sort_order'       => (int) $this->input('sort_order', 0),
            'is_active'        => (int) $this->input('is_active', 1),
            'social_facebook'  => $this->sanitize($this->input('social_facebook', '')),
            'social_twitter'   => $this->sanitize($this->input('social_twitter', '')),
            'social_instagram' => $this->sanitize($this->input('social_instagram', '')),
            'social_linkedin'  => $this->sanitize($this->input('social_linkedin', '')),
            'social_youtube'   => $this->sanitize($this->input('social_youtube', '')),
        ];
        $img = $this->uploadImage('team', 'photo');
        if ($img) $data['photo'] = $img;
        (new TeamMember())->create($data);
        $this->flash('success', 'Membro criado com sucesso.');
        $this->redirect('/admin/team');
    }

    public function edit(int $id): void {
        $this->requireAdmin();
        $member = (new TeamMember())->find($id);
        if (!$member) $this->redirect('/admin/team');
        $csrf  = $this->csrfToken();
        $flash = $this->getFlash();
        $this->view('admin/team/edit', compact('member', 'csrf', 'flash'), 'admin');
    }

    public function update(int $id): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        $model  = new TeamMember();
        $member = $model->find($id);
        if (!$member) $this->redirect('/admin/team');
        $data = [
            'name'             => $this->sanitize($this->input('name', '')),
            'role'             => $this->sanitize($this->input('role', '')),
            'bio'              => $this->sanitize($this->input('bio', '')),
            'sort_order'       => (int) $this->input('sort_order', 0),
            'is_active'        => (int) $this->input('is_active', 1),
            'social_facebook'  => $this->sanitize($this->input('social_facebook', '')),
            'social_twitter'   => $this->sanitize($this->input('social_twitter', '')),
            'social_instagram' => $this->sanitize($this->input('social_instagram', '')),
            'social_linkedin'  => $this->sanitize($this->input('social_linkedin', '')),
            'social_youtube'   => $this->sanitize($this->input('social_youtube', '')),
        ];
        $img = $this->uploadImage('team', 'photo');
        if ($img) $data['photo'] = $img;
        $model->update($id, $data);
        $this->flash('success', 'Membro atualizado.');
        $this->redirect('/admin/team');
    }

    public function delete(int $id): void {
        $this->requireAdmin();
        $this->verifyCsrf();
        (new TeamMember())->delete($id);
        $this->flash('success', 'Membro apagado.');
        $this->redirect('/admin/team');
    }
}
