<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserActivationNotification extends Notification
{
    use Queueable;
    private $user;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
            ->subject('Bienvenue sur la plateforme de '. config('app.name'))
            ->greeting("Bonjour cher(e) {$this->user->first_name} {$this->user->name},")
            ->line("L'équipe d'organisation de **" . config('app.name') . "** vous remercie chaleureusement pour l’intérêt que vous portez à ce projet qui nous rassemble tous.")
            ->line("Pour enrichir l'expérience et mieux organiser notre fête, une **plateforme en ligne** a été mise en place pour faciliter certaines interactions avant, pendant et après les événements.")
            ->line("Votre compte a été activé avec succès.")
            ->line("Vous pouvez dès maintenant vous connecter à l’aide des informations suivantes :")
            ->line("**Adresse e-mail :** {$this->user->email}")
            ->line("**Mot de passe :**" . strtolower($this->user->personal_code))
            ->line("Une fois connecté(e), pensez à modifier votre mot de passe depuis votre espace personnel.")
            ->action('Accéder à la plateforme', url(route('login')))
            ->line("N’hésitez pas à nous contacter si vous avez la moindre question.")
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
}
