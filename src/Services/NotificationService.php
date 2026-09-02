<?php

namespace UserNotification\Services;

use UserNotification\Models\UserNotification;

class NotificationService
{
    public function create(array $userIds, string $title, string $body, ?string $link = null)
    {
        $rows = [];
        foreach (array_unique(array_map('intval', $userIds)) as $userId) {
            if ($userId > 0) $rows[] = ['user_id' => $userId, 'title' => $title, 'body' => $body, 'link' => $link, 'created_at' => now(), 'updated_at' => now()];
        }
        if ($rows) UserNotification::insert($rows);
        return count($rows);
    }
}
