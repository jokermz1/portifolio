<?php
class Setting extends Model {
    protected string $table = 'settings';
    private static array $cache = [];

    public function get(string $key, mixed $default = null): mixed {
        if (array_key_exists($key, self::$cache)) return self::$cache[$key];
        $row = $this->findWhere('key', $key);
        return self::$cache[$key] = ($row ? $row['value'] : $default);
    }

    public function set(string $key, mixed $value): void {
        self::$cache[$key] = $value;
        $existing = $this->findWhere('key', $key);
        if ($existing) {
            $this->update((int) $existing['id'], ['value' => $value]);
        } else {
            parent::create(['key' => $key, 'value' => $value]);
        }
    }

    public function setMany(array $data): void {
        foreach ($data as $key => $value) $this->set($key, $value);
    }

    public function allKeyed(): array {
        $rows = parent::all('key');
        $result = [];
        foreach ($rows as $row) $result[$row['key']] = $row['value'];
        return $result;
    }
}
