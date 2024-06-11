<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    //use Queueable, SerializesModels;

    public function __construct() {}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->markdown('emails.welcome');
    }

    public function attachments()
    {
        return [
            Attachment::fromPath(app()->resourcePath('images/logo.svg'))->as('logo'),
        ];
    }
}
