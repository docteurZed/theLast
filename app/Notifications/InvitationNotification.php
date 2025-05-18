<?php

namespace App\Notifications;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvitationNotification extends Notification
{
    use Queueable;
    private $invitation;

    /**
     * Create a new notification instance.
     */
    public function __construct(Invitation $invitation)
    {
        $this->invitation = $invitation;
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
            ->subject("Votre invitation officielle à " . config('app.name'))
            ->greeting("Bonjour cher(e) {$this->invitation->user->first_name} {$this->invitation->user->name},")
            ->line("Vous êtes cordialement invité(e) à **{$this->invitation->event->name}**, un événement inoubliable pour célébrer la fin de notre parcours.")
            ->line("Votre **invitation numérique personnalisée** est désormais disponible. Elle contient un QR code unique, indispensable pour accéder aux lieux des événements.")
            ->line("Ce code est également requis à l’entrée si vous ne présentez pas le QR code : **{$this->invitation->user->personal_code}**.")
            ->action('Voir mon invitation', url(route('invitation', ['code' => $this->invitation->user->personal_code, 'token' => $this->invitation->code])))
            ->line("Merci de conserver ce lien précieusement. Il est personnel et ne doit pas être partagé.")
            ->salutation('Au plaisir de vous y retrouver,')
            ->line("— L’équipe d’organisation de **" . config('app.name') . "**");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
