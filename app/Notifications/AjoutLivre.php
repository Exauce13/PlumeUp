<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AjoutLivre extends Notification
{
    use Queueable;

    protected $histoire;
    public function __construct($histoire)
    {
        $this->histoire = $histoire;
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
        if($this->histoire->type_book === "Bande dessinée & Webtoon")
        {
            return (new MailMessage)
            ->subject('Nouvelle histoire publiée')
            ->line($this->histoire->user->name . ' a publié une nouvelle histoire :')
            ->line($this->histoire->titre_book)
            ->action('Lire maintenant', url('storage/' . $this->histoire->album));
        }
        else
        {
            return (new MailMessage)
            ->subject('Nouvelle histoire publiée')
            ->line($this->histoire->user->name . ' a publié une nouvelle histoire :')
            ->line($this->histoire->titre_book)
            ->action('Lire maintenant', url('storage/' . $this->histoire->url_book));
        }
        
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => $this->histoire->user->name . ' a publié un nouveau livre : ' . $this->histoire->titre_book,
            'histoire_id' => $this->histoire->id,
            'url' => asset('storage/' . $this->histoire->fichier_path),   
        ];
    }
}
