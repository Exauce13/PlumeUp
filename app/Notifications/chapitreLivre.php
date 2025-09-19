<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class chapitreLivre extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $chapitres;
    public function __construct($chapitres)
    {
        $this->chapitres = $chapitres;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                ->subject('Nouveau chapitre publiée')
                ->line($this->chapitres->histoire->user->name . ' a publié un nouveau chapitre de l\'histoire:' . $this->chapitres->histoire->titre_book)
                ->line($this->chapitres->numerochapitre)
                ->line($this->chapitres->titre_chapitre)
                ->action('Lire maintenant', url('storage/' . $this->chapitres->url_chapitre));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => $this->chapitres->histoire->user->name . ' a publié un nouveau chapitre du livre : ' . $this->chapitres->histoire->titre_book,
            'chapitres_id' => $this->chapitres->id,
            'url' => asset('storage/' . $this->chapitres->url_chapitre),
        ];
    }
}
