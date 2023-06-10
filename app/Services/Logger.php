<?php

namespace App\Services;

use App\Models\Activity;

class Logger
{
    public static function log(string $type, string $action, int $userId = null)
    {
        if (!$userId && auth()->user()) {
            $userId = auth()->user()->id;
        }

        Activity::query()->create([
            'user_id' => $userId,
            'type' => $type,
            'action' => $action,
        ]);
    }
}
