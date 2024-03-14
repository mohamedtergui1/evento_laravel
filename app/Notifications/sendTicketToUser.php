<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Support\Facades\Storage;

class sendTicketToUser extends Notification
{
    use Queueable;

    protected $reservation;
    protected $pdfPath;

    /**
     * Create a new notification instance.
     *
     * @param mixed $ticket
     */
    public function __construct($reservation , $pdfPath)
    {
        $this->reservation = $reservation;
        $this->pdfPath = $pdfPath;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param object $notifiable
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param object $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(object $notifiable): MailMessage
    {
        $pdfPath = Storage::disk('public')->path($this->pdfPath);

        return (new MailMessage)
            ->line("hey mester {$this->reservation->user->name}")
            ->line('reservation ID: ' . $this->reservation->id)
            ->line('Event: ' . $this->reservation->event->title)
            ->line('Date: ' . $this->reservation->event->date)
            ->action('View reservation', url('/reservations/' . $this->reservation->id))
            ->attach($pdfPath, [
                'as' => 'reservation_ticket.pdf',
                'mime' => 'application/pdf',
            ])
            ->line('Thank you for using our application!');
    }
    /**
     * Get the array representation of the notification.
     *
     * @param object $notifiable
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

}
