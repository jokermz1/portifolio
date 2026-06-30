<?php
class Project extends Model {
    protected string $table = 'projects';

    /**
     * Ordem das publicações: primeiro as que têm posição definida (sort_order >= 1),
     * por ordem crescente; depois as restantes (sort_order = 0) por data, mais recentes primeiro.
     */
    private const ORDER = "(sort_order = 0), sort_order ASC, created_at DESC";

    public function published(): array {
        $stmt = $this->db->query(
            "SELECT * FROM {$this->table} WHERE is_published = 1 ORDER BY " . self::ORDER
        );
        return $stmt->fetchAll();
    }

    public function featured(): array {
        $stmt = $this->db->query(
            "SELECT * FROM {$this->table} WHERE is_featured = 1 AND is_published = 1 ORDER BY " . self::ORDER
        );
        return $stmt->fetchAll();
    }

    /** Todos os projetos para o admin, pela mesma ordem que aparecem no site. */
    public function ordered(): array {
        $stmt = $this->db->query(
            "SELECT * FROM {$this->table} ORDER BY " . self::ORDER
        );
        return $stmt->fetchAll();
    }

    /**
     * Projetos para a vitrine da página inicial:
     * mostra todos os marcados como destaque e completa, se necessário,
     * com os mais recentes publicados até atingir o mínimo desejado.
     */
    public function homeShowcase(int $min = 6): array {
        $featured = $this->featured();

        if (count($featured) >= $min) {
            return $featured;
        }

        $needed = $min - count($featured);
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table}
             WHERE is_published = 1 AND is_featured = 0
             ORDER BY " . self::ORDER . "
             LIMIT :limit"
        );
        $stmt->bindValue(':limit', $needed, PDO::PARAM_INT);
        $stmt->execute();

        return array_merge($featured, $stmt->fetchAll());
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
            "SELECT * FROM {$this->table} WHERE is_published = 1 ORDER BY " . self::ORDER
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

    /**
     * Normaliza o campo `images` para uma lista uniforme de [{file, caption}].
     * Suporta o formato antigo (array de nomes de ficheiro) e o novo (array de objetos).
     */
    public static function galleryItems(mixed $images): array {
        $raw = is_array($images) ? $images : (json_decode((string) $images, true) ?: []);
        $out = [];
        foreach ($raw as $item) {
            if (is_string($item) && $item !== '') {
                $out[] = ['file' => $item, 'caption' => ''];
            } elseif (is_array($item) && !empty($item['file'])) {
                $out[] = ['file' => $item['file'], 'caption' => $item['caption'] ?? ''];
            }
        }
        return $out;
    }
}
