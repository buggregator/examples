<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $invoiceNumber,
        public float $amount,
        public string $customerName,
    ) {}

    public function build()
    {
        return $this
            ->subject("Invoice #{$this->invoiceNumber}")
            ->cc('accounting@example.com')
            ->markdown('emails.invoice');
    }

    public function attachments()
    {
        return [
            Attachment::fromPath(app()->resourcePath('images/logo.svg'))->as('company-logo.svg'),
        ];
    }
}
