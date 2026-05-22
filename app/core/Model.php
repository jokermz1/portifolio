<?php
abstract class Model {
    protected PDO $db;
    protected string $table;
    protected string $primaryKey = 'id';

    public function __construct() {
        $this->db = Database::connect();
    }

    public function find(int $id): array|false {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function all(string $orderBy = 'id', string $dir = 'ASC'): array {
        $dir  = strtoupper($dir) === 'DESC' ? 'DESC' : 'ASC';
        $stmt = $this->db->query("SELECT * FROM {$this->table} ORDER BY `{$orderBy}` {$dir}");
        return $stmt->fetchAll();
    }

    public function where(string $column, mixed $value): array {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE `{$column}` = ?");
        $stmt->execute([$value]);
        return $stmt->fetchAll();
    }

    public function findWhere(string $column, mixed $value): array|false {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE `{$column}` = ? LIMIT 1");
        $stmt->execute([$value]);
        return $stmt->fetch();
    }

    public function create(array $data): int {
        $columns      = implode(', ', array_map(fn($c) => "`{$c}`", array_keys($data)));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $stmt = $this->db->prepare("INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})");
        $stmt->execute(array_values($data));
        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool {
        $sets = implode(', ', array_map(fn($c) => "`{$c}` = ?", array_keys($data)));
        $stmt = $this->db->prepare("UPDATE {$this->table} SET {$sets} WHERE `{$this->primaryKey}` = ?");
        return $stmt->execute([...array_values($data), $id]);
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE {$this->primaryKey} = ?");
        return $stmt->execute([$id]);
    }

    public function count(string $condition = '', array $params = []): int {
        $sql = "SELECT COUNT(*) FROM {$this->table}";
        if ($condition) $sql .= " WHERE {$condition}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return (int) $stmt->fetchColumn();
    }

    public function paginate(int $page, int $perPage = 10, string $condition = '', array $params = [], string $orderBy = 'id DESC'): array {
        $offset = ($page - 1) * $perPage;
        $total  = $this->count($condition, $params);
        $sql    = "SELECT * FROM {$this->table}";
        if ($condition) $sql .= " WHERE {$condition}";
        $sql .= " ORDER BY {$orderBy} LIMIT {$perPage} OFFSET {$offset}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return [
            'data'         => $stmt->fetchAll(),
            'total'        => $total,
            'per_page'     => $perPage,
            'current_page' => $page,
            'last_page'    => max(1, (int) ceil($total / $perPage)),
        ];
    }
}
