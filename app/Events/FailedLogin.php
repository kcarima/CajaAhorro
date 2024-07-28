<?php

namespace App\Events;

use App\Models\Seguridad\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Laravel\Fortify\Fortify;

final class FailedLogin
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Failed $event)
    {
        $username = $event->credentials[Fortify::username()];
        $user = User::where(Fortify::username(), 'like', $username)->first();

        if ($user) {
            $user->fill([
                'intentos_login' => $user->intentos_login + 1,
                'fecha_intentos_login' => Carbon::now(),
            ]);
            $user->save();
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
