<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderFinishedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;

    public $sendToAll;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order, $sendToAll = false)
    {
        $this->order = $order;
        $this->sendToAll = $sendToAll;
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
        if (!$this->sendToAll) return;
        return (new MailMessage)
            ->from('bedzstudio@gmail.com', 'BedžStudio')
            ->view('emails.order_finished', ['order' => $this->order])
            ->subject('BedžStudio - porudžbina ' . $this->order->order_number . ' isporučena');
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
            'title'  => 'Porudžbenica ' . $this->order->order_number . ' je isporučena!',
            'data'   =>  $this->order
        ];
    }
}
