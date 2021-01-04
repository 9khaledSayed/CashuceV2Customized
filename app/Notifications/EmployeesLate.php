<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmployeesLate extends Notification
{
    use Queueable;

    public $subject = 'Employees Late';
    public $message = 'Some employees did not log in today';
    public $lateEmployeesIDs;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($lateEmployeesIDs)
    {
        $this->lateEmployeesIDs = $lateEmployeesIDs;
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
            'redirectURL' => '/dashboard/employees/late_employees/' . $this->id,
            'message' => $this->message,
            'date' => Carbon::today()->format('Y-m-d'),
            'lateEmployeesIDs' => $this->lateEmployeesIDs
        ];
    }
}
