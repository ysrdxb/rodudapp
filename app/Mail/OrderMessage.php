<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $messageContent;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Order $order
     * @param string $messageContent
     */
    public function __construct(Order $order, string $messageContent)
    {
        $this->order = $order;
        $this->messageContent = $messageContent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Order Update')
                    ->view('emails.order_message')
                    ->with([
                        'order' => $this->order,
                        'messageContent' => $this->messageContent,
                    ]);
    }
}
