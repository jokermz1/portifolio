<?php
class Testimonial extends Model {
    protected string $table = 'testimonials';

    /** Depoimentos aprovados E marcados como destaque — para a página inicial. */
    public function featuredApproved(int $limit = 10): array {
        $stmt = $this->db->prepare(
            "SELECT t.*, u.avatar AS user_avatar, u.name AS user_name
             FROM {$this->table} t
             LEFT JOIN users u ON t.user_id = u.id
             WHERE t.status = 'approved' AND t.is_featured = 1
             ORDER BY t.created_at DESC
             LIMIT :limit"
        );
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /** Todos os depoimentos aprovados (usado como fallback caso nenhum esteja em destaque). */
    public function approved(int $limit = 10): array {
        $stmt = $this->db->prepare(
            "SELECT t.*, u.avatar AS user_avatar, u.name AS user_name
             FROM {$this->table} t
             LEFT JOIN users u ON t.user_id = u.id
             WHERE t.status = 'approved'
             ORDER BY t.created_at DESC
             LIMIT :limit"
        );
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function pending(): array {
        $stmt = $this->db->query(
            "SELECT t.*, u.avatar AS user_avatar, u.name AS user_name
             FROM {$this->table} t
             LEFT JOIN users u ON t.user_id = u.id
             WHERE t.status = 'pending'
             ORDER BY t.created_at DESC"
        );
        return $stmt->fetchAll();
    }

    /** Todos os depoimentos (admin), já com a foto de perfil do utilizador. */
    public function allWithUser(): array {
        $stmt = $this->db->query(
            "SELECT t.*, u.avatar AS user_avatar, u.name AS user_name
             FROM {$this->table} t
             LEFT JOIN users u ON t.user_id = u.id
             ORDER BY t.created_at DESC"
        );
        return $stmt->fetchAll();
    }

    public function countPending(): int {
        return $this->count("status = 'pending'");
    }

    public function approve(int $id): bool {
        return $this->update($id, ['status' => 'approved']);
    }

    public function reject(int $id): bool {
        return $this->update($id, ['status' => 'rejected']);
    }

    public function toggleFeatured(int $id): bool {
        $row = $this->find($id);
        if (!$row) return false;
        return $this->update($id, ['is_featured' => $row['is_featured'] ? 0 : 1]);
    }
}
