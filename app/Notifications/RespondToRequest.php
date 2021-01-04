<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RespondToRequest extends Notification
{
    use Queueable;

    public $request_id;
    public $subject = 'Respond To Your Request';
    public $message = 'Your Request Has Been ';

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($requestID, $status)
    {
        $this->request_id = $requestID;
        $this->message = $this->message . $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
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
            ->subject($this->subject)
            ->line($this->message)
            ->action('Visit Cashuce', url('/'))
            ->line('Cashuce Team!');
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
            'redirectURL' => "/dashboard/requests/$this->request_id",
            'message' => $this->message,
            'date' => Carbon::today()->format('Y-m-d'),
        ];
    }
}
