<?php

namespace App\Models\Seguridad;

use App\Classes\Enums\StatusPassword;
use App\Classes\Enums\StatusUsuario;
use App\Classes\Enums\TipoUsuario;
use App\Models\SCA\Socio;
use App\Notifications\PasswordReset;
use App\Traits\DataCedula;
use App\Traits\GenerateUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;

final class User extends Authenticatable
{
    use CausesActivity;
    use DataCedula;
    use GenerateUuid;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use LogsActivity;
    use Notifiable;
    use SoftDeletes;
    use TwoFactorAuthenticatable;

    protected $connection = 'seguridad';

    protected $with = ['socio'];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'cedula',
        'tipo',
        'status',
        'email',
        'password',
        'last_login',
        'last_login_ip',
        'fecha_fin_suspension',
        'profile_photo_path',
        'status_password',
        'uuid',
        'intentos_login',
        'fecha_intentos_login',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'tipo' => TipoUsuario::class,
        'status' => StatusUsuario::class,
        'last_login' => 'datetime',
        'status_password' => StatusPassword::class,
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(logName: 'seguridad')
            ->logOnly(attributes: ['cedula', 'tipo', 'status', 'email', 'password', 'fecha_fin_suspension', 'profile_photo_path', 'status_password', 'intentos_login'])
            ->logOnlyDirty()
            ->dontLogIfAttributesChangedOnly(attributes: ['updated_at'])
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(callback: function (string $eventName) {
                $evento = match ($eventName) {
                    'created' => 'creado',
                    'updated' => 'actualizado',
                    'deleted' => 'eliminado',
                    'restored' => 'restaurado',
                    'default' => 'desconocido'
                };

                return "El usuario :subject.cedula ha sido $evento";
            });
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }

    public function is_admin(): bool
    {
        return $this->tipo == TipoUsuario::ROOT || $this->tipo == TipoUsuario::ADMINISTRADOR;
    }

    public function is_root(): bool
    {
        return $this->tipo == TipoUsuario::ROOT;
    }

    public function socio()
    {
        return $this->hasOne(Socio::class, 'cedula', 'cedula');
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultProfilePhotoUrl()
    {
        $name = trim(collect(explode(' ', $this->socio?->nombre))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
    }
}
