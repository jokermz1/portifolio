<?php
class Faq extends Model {
    protected string $table = 'faqs';

    public function active(): array {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE is_active = 1 ORDER BY sort_order ASC"
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
