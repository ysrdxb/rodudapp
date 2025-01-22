<?php

namespace App\Notifications;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Pusher\Pusher;

class NewOrderPlaced extends Notification
{
    use Queueable;

    protected $order;
    protected $message;

    public function __construct($order, $message)
    {
        $this->order = $order;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast'];
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        $this->sendNotificationViaPusher();

        return new BroadcastMessage([
            'message' => $this->message,
            'order_id' => $this->order->id,
        ]);
    }

    /**
     * Send the notification via Pusher.
     */
    private function sendNotificationViaPusher()
    {
        $pusher = new Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id'),
            [
                'cluster' => config('broadcasting.connections.pusher.options.cluster'),
                'useTLS' => true,
            ]
        );

        $pusher->trigger("order-channel", 'order-updated', [
            'message' => $this->message,
        ]);
    }
}
