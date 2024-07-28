<?php

namespace App\Actions\Seguridad\Log;

use Spatie\Activitylog\Models\Activity;

final class BuscarLog
{
    public static function handle(?string $search = '')
    {
        $activity = Activity::query();

        $activity->select(
            ['id', 'log_name', 'description', 'created_at', 'causer_id', 'causer_type']
        );

        $activity
            ->where(function ($q) use ($search) {
                $q->where('description', 'ilike', '%'.$search.'%');
            });

        return $activity->orderByDesc('created_at')->paginate();
    }
}
