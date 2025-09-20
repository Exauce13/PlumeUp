<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class webtoonChapitre extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $imageswebtoon;
    public function __construct($imageswebtoon)
    {
        $this->imageswebtoon = $imageswebtoon;
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
                    ->subject('Nouveau chapitre de webtoon.')
                    ->line($this->imageswebtoon->histoire->user->name . ' a publié un nouveau chapitre du webtoon:' . $this->imageswebtoon->histoire->titre_book)
                    ->line($this->imageswebtoon->numerochapitre)
                    ->line($this->imageswebtoon->titre_chapitre)
                    ->action('Lire maintenant', url('storage/' . $this->imageswebtoon->image_path));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->imageswebtoon->histoire->user->name . ' a publié un nouveau chapitre du livre : ' . $this->imageswebtoon->histoire->titre_book,
            'chapitres_id' => $this->imageswebtoon->id,
            'url' => asset('storage/' . $this->imageswebtoon->image_path),
        ];
    }
}
