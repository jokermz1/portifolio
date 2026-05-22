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
}
