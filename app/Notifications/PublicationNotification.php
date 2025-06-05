<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PublicationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public string $type,              // ex: like, comment, message, vote
        public string $message,           // contenu à afficher
        public string $url,               // lien vers l'action
        public string $emailSubject,      // objet du mail
        public string $emailIntro         // intro dans le mail
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                ->subject($this->emailSubject)
                ->greeting("Bonjour cher(e) {$notifiable->first_name} {$notifiable->name},")
                ->line($this->emailIntro)
                ->line("Un nouveau contenu vous attend donc sur notre plateforme.")
                ->line("Pour en prendre connaissance, il vous suffit de vous connecter à votre espace personnel.")
                ->action('Découvrir maintenant', $this->url)
                ->line("Si vous avez la moindre question ou besoin d’assistance, notre équipe se tient à votre disposition pour vous accompagner.")
                ->salutation('À très bientôt,')
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

    public function toDatabase($notifiable)
    {
        return [
            'type' => $this->type,
            'message' => $this->message,
            'url' => $this->url,
        ];
    }
}
