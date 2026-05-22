<?php
class Post extends Model {
    protected string $table = 'posts';

    public function published(): array {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE is_published = 1 ORDER BY published_at DESC"
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function publishedPaginated(int $page = 1, int $perPage = 6): array {
        $offset = ($page - 1) * $perPage;
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE is_published = 1 ORDER BY published_at DESC LIMIT :limit OFFSET :offset"
        );
        $stmt->bindValue(':limit',  $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset,  PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function countPublished(): int {
        $stmt = $this->db->query("SELECT COUNT(*) FROM {$this->table} WHERE is_published = 1");
        return (int) $stmt->fetchColumn();
    }

    public function recentPublished(int $limit = 4, int $excludeId = 0): array {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE is_published = 1 AND id != ?
             ORDER BY published_at DESC LIMIT ?"
        );
        $stmt->bindValue(1, $excludeId, PDO::PARAM_INT);
        $stmt->bindValue(2, $limit,     PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function prevNext(int $id): array {
        $p = $this->db->prepare(
            "SELECT id, title, slug FROM {$this->table}
             WHERE is_published = 1 AND id < ? ORDER BY id DESC LIMIT 1"
        );
        $p->execute([$id]);
        $n = $this->db->prepare(
            "SELECT id, title, slug FROM {$this->table}
             WHERE is_published = 1 AND id > ? ORDER BY id ASC LIMIT 1"
        );
        $n->execute([$id]);
        return ['prev' => $p->fetch(), 'next' => $n->fetch()];
    }

    public function findBySlug(string $slug): array|false {
        return $this->findWhere('slug', $slug);
    }

    public function generateSlug(string $title): string {
        $base  = strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', '-', $title), '-'));
        $slug  = $base;
        $count = 1;
        while ($this->findBySlug($slug)) {
            $slug = $base . '-' . $count++;
        }
        return $slug;
    }

    public function publish(int $id): bool {
        return $this->update($id, [
            'is_published' => 1,
            'published_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
