<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class Activity extends Notification
{
    use Queueable;

    protected $data, $photo, $media, $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data, $photo, $type, $media, $avatar)
    {
        $this->type = $type;
        $this->media = $media;
        $this->avatar = $avatar;
        $this->data = $data;
        $this->photo =  $photo;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }



    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */

    public function toArray($notifiable)
    {
        return [
            'name' => $this->data->name,
            'id' => $this->data->id,
            'avatar' => $this->avatar,
            'photo' => $this->photo,
            'type' => $this->type,
            'media' => $this->media,
        ];
    }
}
