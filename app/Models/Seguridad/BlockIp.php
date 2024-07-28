<?php

namespace App\Models\Seguridad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

final class BlockIp extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $connection = 'seguridad';

    protected $fillable = ['ip'];

    protected static $recordEvents = ['created'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(logName: 'bot')
            ->logAll()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(callback: fn (string $eventName) => 'Se le ha prohibido el acceso a la IP :subject.ip');
    }
}
