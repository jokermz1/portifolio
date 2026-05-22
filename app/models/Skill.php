<?php
class Skill extends Model {
    protected string $table = 'skills';

    public function byCategory(): array {
        $stmt = $this->db->query(
            "SELECT * FROM {$this->table} ORDER BY category, sort_order ASC"
        );
        $grouped = [];
        foreach ($stmt->fetchAll() as $skill) {
            $grouped[$skill['category']][] = $skill;
        }
        return $grouped;
    }
}
