<?php
class TestimonialController extends Controller {
    /** Submissão de um review — apenas utilizadores com sessão iniciada. Vai para moderação. */
    public function store(): void {
        $user = $this->currentUser();
        if (!$user) {
            $this->flash('error', 'Precisa de iniciar sessão para deixar uma avaliação.');
            $this->redirect('/login');
        }
        $this->verifyCsrf();

        $name     = $this->sanitize($this->input('name', ''));
        $location = $this->sanitize($this->input('location', ''));
        $role     = $this->sanitize($this->input('role', ''));
        $content  = $this->sanitize($this->input('content', ''));
        $rating   = (int) $this->input('rating', 5);
        $rating   = max(1, min(5, $rating));

        if (mb_strlen($name) < 2 || mb_strlen($content) < 5) {
            $this->flash('error', 'Indique o seu nome e uma mensagem com pelo menos 5 caracteres.');
            $this->redirect('/#testimonial');
        }

        (new Testimonial())->create([
            'user_id'     => (int) $user['id'],
            'name'        => $name,
            'location'    => $location ?: null,
            'role'        => $role ?: null,
            'rating'      => $rating,
            'content'     => $content,
            'status'      => 'pending',
            'is_featured' => 0,
            'ip_address'  => $this->getIP(),
        ]);

        $this->flash('success', 'Obrigado pela sua avaliação! Será publicada após revisão.');
        $this->redirect('/#testimonial');
    }
}
