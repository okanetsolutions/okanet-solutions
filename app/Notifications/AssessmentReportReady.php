<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AssessmentReportReady extends Notification
{
    public function __construct(public int $assessmentId) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Tu informe preliminar está disponible — Okanet Solutions')
            ->greeting('Tu evaluación está lista')
            ->line('Inicia sesión con tu correo verificado para consultar tu informe privado.')
            ->action('Consultar informe', route('security.assessments.show', $this->assessmentId))
            ->line('Desde tu cuenta también puedes solicitar el informe completo y asesoría.');
    }
}
