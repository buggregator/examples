<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->subject('Hello world')
            ->cc(['cc@site.com'])
            ->bcc(['bcc@site.com'])
            ->replyTo('reply-to@site.com', 'To name')
            ->attach(app()->basePath('.env.example'));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->markdown('emails.orders.shipped');
    }
}
