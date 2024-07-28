<?php

namespace App\Models\Seguridad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

final class BotLog extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $connection = 'seguridad';

    protected $fillable = ['ip', 'user_agent'];

    protected static $recordEvents = ['created'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(logName: 'bot')
            ->logAll()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(callback: fn (string $eventName) => 'La IP :subject.ip ha sido detectada como sospechosa');
    }
}
