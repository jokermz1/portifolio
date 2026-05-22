<?php
class Project extends Model {
    protected string $table = 'projects';

    public function published(): array {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE is_published = 1 ORDER BY created_at DESC"
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function featured(): array {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE is_featured = 1 AND is_published = 1 ORDER BY created_at DESC"
        );
        $stmt->execute();
        return $stmt->fetchAll();
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

    public function allPublished(): array {
        $stmt = $this->db->query(
            "SELECT * FROM {$this->table} WHERE is_published = 1 ORDER BY created_at DESC"
        );
        return $stmt->fetchAll();
    }

    public function categories(): array {
        $stmt = $this->db->query(
            "SELECT DISTINCT category FROM {$this->table}
             WHERE is_published = 1 AND category IS NOT NULL AND category != ''
             ORDER BY category ASC"
        );
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function byCategory(): array {
        $rows    = $this->allPublished();
        $grouped = [];
        foreach ($rows as $row) {
            $grouped[$row['category'] ?? 'Geral'][] = $row;
        }
        return $grouped;
    }
}
