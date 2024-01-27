<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    
    public $order_with_details;
    public $products;
    public $user;

    public function __construct($order_with_details, $products , $user)
    {
        $this->order_with_details=$order_with_details;
        $this->products=$products;
        $this->user=$user;
    }

    /**
     * Get the message envelope.
     */


    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.orderShipped',
            with:[
                'order'=> $this->order_with_details->order,
                'order_details'=>$this->order_with_details->order_details,
                'products'=>$this->products,
                'user'=>$this->user
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
