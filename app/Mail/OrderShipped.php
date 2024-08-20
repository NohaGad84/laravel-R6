<?php

namespace App\Mail;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;
public $data;
    /**
     * Create a new message instance.
     */
    public function __construct($data)
{
    $this->data=$data;    
}
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject:$this->data['subject'],
            from: new Address($this->data['email'],$this->data['name']),

        );
    }
//     

//     /**
//      * Get the message content definition.
//      */
    public function content(): Content
    {
        return new Content(
            view: 'mail.contactmail',
        );
    }
}
