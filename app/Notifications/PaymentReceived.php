<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentReceived extends Notification
{
    use Queueable;

    private $payment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($payment)
    {
        $this->payment = $payment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if($notifiable->role != 'user'){
            $user = User::find($this->payment->user_id);
          return (new MailMessage)
            ->greeting("Hi $notifiable->name  $notifiable->lastname!")
            ->line("A new student got registered for your course and paid ".$this->payment->amount." fee.")
            ->line("Your class/appointment has been booked with $user->name $user->lastname.")
            ->action('Go to Dashboard', url('/dashboard'))
            ->line('Thank you for using our application!');
        }
        else{
          return (new MailMessage)
          ->greeting("Hi $notifiable->name  $notifiable->lastname!")
            ->line("Thank you for using the LanguagesApp. We have successfully received your payment of ".$this->payment->amount.".")
            ->line("You can access your subscription information from your setting page. If you have any further question please contact us.")
            ->action('Go to Dashboard', url('/setting'))
            ->line('Thank you for using our application!');
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
            'payment_id' => $this->payment->id,
            'amount'     => $this->payment->amount,
        ];
    }
}
