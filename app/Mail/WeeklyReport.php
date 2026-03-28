<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WeeklyReport extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public array $stats,
        public string $userName,
    ) {}

    public function build()
    {
        return $this
            ->subject('Your Weekly Activity Report')
            ->markdown('emails.weekly-report');
    }
}
