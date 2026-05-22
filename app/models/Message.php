<?php
class Message extends Model {
    protected string $table = 'messages';

    public function unread(): array {
        return $this->where('is_read', 0);
    }

    public function countUnread(): int {
        return $this->count("is_read = 0");
    }

    public function markRead(int $id): bool {
        return $this->update($id, ['is_read' => 1]);
    }
}
