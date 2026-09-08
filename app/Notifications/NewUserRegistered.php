<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeEncrypted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserRegistered extends Notification implements ShouldBeEncrypted, ShouldQueue
{
    use Queueable;

    public function __construct(
        public readonly int $userId,
        public readonly string $name,
        public readonly string $email,
        public readonly string $registeredAt,
    ) {
        $this->afterCommit();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('[Okanet] Nueva persona registrada')
            ->greeting('Nueva persona registrada')
            ->line('Nombre: '.$this->name)
            ->line('Correo: '.$this->email)
            ->line('Identificador de usuario: '.$this->userId)
            ->line('Fecha y hora (UTC): '.$this->registeredAt)
            ->action('Ver usuario', route('admin.users.edit', $this->userId));
    }
}
