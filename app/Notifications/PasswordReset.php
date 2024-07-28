<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class PasswordReset extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public $token)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(mixed $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(mixed $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Está recibiendo este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta.') // Here are the lines you can safely override
            ->action('Reiniciar Contraseña', route('password.reset', $this->token))
            ->line('Este enlace de restablecimiento de contraseña caducará en 60 minutos.')
            ->line('Si no solicitó un restablecimiento de contraseña, no se requiere ninguna otra acción.');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(mixed $notifiable): array
    {
        return [
            //
        ];
    }
}
