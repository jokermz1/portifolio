<?php
class Comment extends Model {
    protected string $table = 'comments';

    public function forEntity(string $type, int $id): array {
        $sql = "SELECT c.*, u.name AS user_name, u.avatar AS user_avatar
                FROM {$this->table} c
                JOIN users u ON c.user_id = u.id
                WHERE c.entity_type = ? AND c.entity_id = ?
                  AND c.parent_id IS NULL AND c.status = 'approved'
                ORDER BY c.created_at ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$type, $id]);
        $comments = $stmt->fetchAll();

        foreach ($comments as &$comment) {
            $comment['replies'] = $this->getReplies((int) $comment['id']);
        }
        return $comments;
    }

    public function getReplies(int $parentId): array {
        $sql = "SELECT c.*, u.name AS user_name, u.avatar AS user_avatar
                FROM {$this->table} c
                JOIN users u ON c.user_id = u.id
                WHERE c.parent_id = ? AND c.status = 'approved'
                ORDER BY c.created_at ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$parentId]);
        return $stmt->fetchAll();
    }

    public function pending(): array {
        $sql = "SELECT c.*, u.name AS user_name, u.email AS user_email
                FROM {$this->table} c
                JOIN users u ON c.user_id = u.id
                WHERE c.status = 'pending'
                ORDER BY c.created_at DESC";
        return $this->db->query($sql)->fetchAll();
    }

    public function allWithUser(int $perPage = 20, int $page = 1): array {
        $offset = ($page - 1) * $perPage;
        $sql = "SELECT c.*, u.name AS user_name, u.email AS user_email
                FROM {$this->table} c
                JOIN users u ON c.user_id = u.id
                ORDER BY c.created_at DESC
                LIMIT {$perPage} OFFSET {$offset}";
        return $this->db->query($sql)->fetchAll();
    }

    public function countPending(): int {
        return $this->count("status = 'pending'");
    }

    public function approve(int $id): bool {
        return $this->update($id, [
            'status'       => 'approved',
            'published_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function reject(int $id): bool {
        return $this->update($id, ['status' => 'rejected']);
    }

    public function userComments(int $userId): array {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = ? ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    /**
     * Comentários do utilizador, já com o slug e título da publicação-alvo
     * (post do blog ou projeto do portefólio) resolvidos, para criar o link
     * directo para a publicação.
     */
    public function userCommentsWithTarget(int $userId): array {
        $sql = "SELECT c.*,
                       COALESCE(p.slug,  pr.slug)  AS target_slug,
                       COALESCE(p.title, pr.title) AS target_title
                FROM {$this->table} c
                LEFT JOIN posts    p  ON c.entity_type = 'post'    AND c.entity_id = p.id
                LEFT JOIN projects pr ON c.entity_type = 'project' AND c.entity_id = pr.id
                WHERE c.user_id = ?
                ORDER BY c.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }
}
