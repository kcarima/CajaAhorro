<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class UpdateUserLastLoginDate
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(Login $event)
    {
        $event->user->update([
            'last_login' => Carbon::now(),
            'last_login_ip' => request()->getClientIp(),
            'intentos_login' => 0,
            'fecha_intentos_login' => null,
        ]);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
