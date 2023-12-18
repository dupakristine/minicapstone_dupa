<?php

namespace App\Notifications;
use App\Models\Plugin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DownloadNotification extends Notification
{
    use Queueable;

    protected $plugin;

    /**
     * Create a new notification instance.
     */
    public function __construct(Plugin $plugin)
    {
        $this->plugin = $plugin;
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
        ->line('Thank you for ordering your milktea with us! We are delighted to serve you.')
        ->line('Your choice of "' . $this->plugin->name . '" is a wonderful selection.')
        ->line('Our baristas are hard at work crafting your perfect cup. Get ready to savor the delightful flavors!')
        ->action('Go Back', url('/')) // You can replace this with the actual order tracking link
        ->line('If you have any questions or need assistance, feel free to reach out.')
        ->line('We appreciate your business and hope you enjoy every sip!');

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
