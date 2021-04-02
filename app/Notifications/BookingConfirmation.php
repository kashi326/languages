<?php

namespace App\Notifications;

use App\Teacher;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingConfirmation extends Notification
{
    use Queueable;
    public $lesson;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($lesson)
    {
        $this->lesson = $lesson;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if($notifiable->role == 'user'){
            $teacher = Teacher::find($this->lesson->teacher_id);
            return (new MailMessage)
            ->greeting("Hi $notifiable->name  $notifiable->lastname!")
            ->line("Your class/appointment has been booked with $teacher->name.")
            ->line("When: ".date("Y-m-d",strtotime($this->lesson->schedule_date)).".")
            ->line("Time: ".date("H:i:s",strtotime($this->lesson->schedule_date)).".")
            ->line('Booking ID: ID-'.$this->lesson->id);
        }
        else{
            $user = User::find($this->lesson->user_id);
            return (new MailMessage)
            ->greeting("Hi $notifiable->name  $notifiable->lastname!")
            ->line("A class/appointment has been booked with You by $user->name.")
            ->line("When: ".date("Y-m-d",strtotime($this->lesson->schedule_date)).".")
            ->line("Time: ".date("H:i:s",strtotime($this->lesson->schedule_date)).".")
            ->line('Booking ID: ID-'.$this->lesson->id);
        }
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
            //
        ];
    }
}
