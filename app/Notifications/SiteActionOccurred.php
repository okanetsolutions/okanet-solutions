<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeEncrypted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SiteActionOccurred extends Notification implements ShouldBeEncrypted, ShouldQueue
{
    use Queueable;

    public function __construct(
        public readonly string $description,
        public readonly ?string $actorName,
        public readonly ?string $actorEmail,
        public readonly string $method,
        public readonly string $routeName,
        public readonly string $routeUri,
        public readonly ?string $ipAddress,
        public readonly string $occurredAt,
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
        $actor = $this->actorName && $this->actorEmail
            ? $this->actorName.' ('.$this->actorEmail.')'
            : 'Visitante no autenticado';

        return (new MailMessage)
            ->subject('[Okanet] Actividad: '.$this->description)
            ->greeting('Nueva actividad en el sitio')
            ->line('Acción: '.$this->description)
            ->line('Persona: '.$actor)
            ->line('Ruta: '.$this->method.' '.$this->routeUri.' ('.$this->routeName.')')
            ->line('Dirección IP: '.($this->ipAddress ?? 'No disponible'))
            ->line('Fecha y hora (UTC): '.$this->occurredAt);
    }
}
