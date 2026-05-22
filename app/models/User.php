<?php
class User extends Model {
    protected string $table = 'users';

    public function findByEmail(string $email): array|false {
        return $this->findWhere('email', $email);
    }

    public function create(array $data): int {
        $data['password_hash'] = password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => 12]);
        unset($data['password'], $data['password_confirm']);
        return parent::create($data);
    }

    public function verifyPassword(string $password, string $hash): bool {
        return password_verify($password, $hash);
    }

    public function active(): array {
        return $this->where('is_active', 1);
    }
}
