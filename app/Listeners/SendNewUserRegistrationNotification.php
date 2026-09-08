<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\NewUserRegistered;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Notification;

class SendNewUserRegistrationNotification
{
    public function handle(Registered $event): void
    {
        $recipient = config('services.activity_notifications.recipient');

        if (! config('services.activity_notifications.enabled')
            || ! is_string($recipient)
            || blank($recipient)
            || ! $event->user instanceof User) {
            return;
        }

        Notification::route('mail', $recipient)->notify(new NewUserRegistered(
            userId: $event->user->id,
            name: $event->user->name,
            email: $event->user->email,
            registeredAt: ($event->user->created_at ?? now())->toIso8601String(),
        ));
    }
}
