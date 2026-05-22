<?php
class TeamController extends Controller {
    public function index(): void {
        $members  = (new TeamMember())->active();
        $settings = (new Setting())->allKeyed();
        $this->view('team/index', compact('members', 'settings'));
    }
}
