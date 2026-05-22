<?php
class CommentController extends Controller {
    public function store(): void {
        $this->requireAuth();
        $this->verifyCsrf();

        $entityType = $this->input('entity_type', '');
        $entityId   = (int) $this->input('entity_id', 0);
        $parentId   = ((int) $this->input('parent_id', 0)) ?: null;
        $type       = $this->input('type', 'comment');
        $content    = $this->sanitize($this->input('content', ''));

        if (!in_array($entityType, ['project', 'post'], true) || !$entityId || !$content) {
            $this->flash('error', 'Dados inválidos. Tente novamente.');
            $this->redirectBack();
        }
        if (!in_array($type, ['comment', 'suggestion', 'critique'], true)) {
            $type = 'comment';
        }

        (new Comment())->create([
            'user_id'     => (int) $_SESSION['user_id'],
            'entity_type' => $entityType,
            'entity_id'   => $entityId,
            'parent_id'   => $parentId,
            'type'        => $type,
            'content'     => $content,
            'ip_address'  => $this->getIP(),
            'status'      => 'pending',
        ]);

        $this->flash('success', 'Comentário submetido! Será publicado após moderação. Obrigado!');
        $this->redirectBack();
    }

    public function update(int $id): void {
        $this->requireAuth();
        $this->verifyCsrf();

        $model   = new Comment();
        $comment = $model->find($id);

        if (!$comment || (int) $comment['user_id'] !== (int) $_SESSION['user_id']) {
            $this->flash('error', 'Sem permissão para editar este comentário.');
            $this->redirectBack();
        }

        $content = $this->sanitize($this->input('content', ''));
        if (!$content) {
            $this->flash('error', 'O comentário não pode estar vazio.');
            $this->redirectBack();
        }

        $model->update($id, [
            'content'   => $content,
            'is_edited' => 1,
            'edited_at' => date('Y-m-d H:i:s'),
            'status'    => 'pending',    // volta à fila de moderação
        ]);

        $this->flash('success', 'Comentário atualizado. Aguarda nova moderação.');
        $this->redirectBack();
    }

    public function delete(int $id): void {
        $this->requireAuth();
        $this->verifyCsrf();

        $model   = new Comment();
        $comment = $model->find($id);

        if (!$comment || (int) $comment['user_id'] !== (int) $_SESSION['user_id']) {
            $this->flash('error', 'Sem permissão para apagar este comentário.');
            $this->redirectBack();
        }

        $model->delete($id);
        $this->flash('success', 'Comentário apagado.');
        $this->redirectBack();
    }
}
