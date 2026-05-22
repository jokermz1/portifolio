<?php
class AdminDashboardController extends Controller {
    public function index(): void {
        $this->requireAdmin();

        $stats = [
            'projects'         => (new Project())->count(),
            'posts'            => (new Post())->count(),
            'users'            => (new User())->count(),
            'messages_unread'  => (new Message())->countUnread(),
            'comments_pending' => (new Comment())->countPending(),
        ];

        $pendingComments = (new Comment())->pending();
        $unreadMessages  = (new Message())->unread();

        $this->view('admin/dashboard', compact('stats', 'pendingComments', 'unreadMessages'), 'admin');
    }
}
