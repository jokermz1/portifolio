<?php
class ResumeItem extends Model {
    protected string $table = 'resume_items';

    /** Retorna todos os itens ativos agrupados por tipo */
    public function byType(): array {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table}
             WHERE is_active = 1
             ORDER BY type ASC, sort_order ASC"
        );
        $stmt->execute();
        $grouped = ['education' => [], 'experience' => []];
        foreach ($stmt->fetchAll() as $item) {
            $grouped[$item['type']][] = $item;
        }
        return $grouped;
    }

    /** Retorna apenas um tipo */
    public function ofType(string $type): array {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table}
             WHERE type = ? AND is_active = 1
             ORDER BY sort_order ASC"
        );
        $stmt->execute([$type]);
        return $stmt->fetchAll();
    }
}
