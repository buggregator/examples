<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(string $subject)
    {
        $this->subject($subject)
            ->cc(['cc@site.com'])
            ->bcc(['bcc@site.com'])
            ->replyTo('reply-to@site.com', 'To name');
    }

    public function build()
    {
        return $this
            ->markdown('emails.orders.shipped');
    }
}
