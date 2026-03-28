<?php

declare(strict_types=1);

namespace App\Modules\Smtp;

use App\Mail\InvoiceMail;
use App\Mail\OrderShipped;
use App\Mail\PasswordReset;
use App\Mail\WeeklyReport;
use App\Mail\WelcomeMail;
use App\RandomPhraseGenerator;
use Illuminate\Support\Facades\Mail;

trait Common
{
    public function setUpSmtp(): void
    {
        ray()->disable();
    }

    /** @test */
    function smtpOrderShipped(RandomPhraseGenerator $generator): void
    {
        Mail::to([$this->faker->email, $this->faker->email])
            ->send(new OrderShipped($generator->generateEmailSubject()));
    }

    /** @test */
    function smtpWelcomeMail(): void
    {
        Mail::to($this->faker->email)->send(new WelcomeMail());
    }

    /** @test */
    function smtpPasswordReset(): void
    {
        Mail::to($this->faker->email)->send(new PasswordReset(
            resetUrl: 'https://example.com/reset-password?token=' . bin2hex(random_bytes(32)),
            userName: $this->faker->name,
        ));
    }

    /** @test */
    function smtpWeeklyReport(): void
    {
        Mail::to($this->faker->email)->send(new WeeklyReport(
            stats: [
                'posts_created' => random_int(0, 12),
                'comments_received' => random_int(5, 50),
                'profile_views' => random_int(100, 2000),
                'new_followers' => random_int(0, 25),
            ],
            userName: $this->faker->name,
        ));
    }

    /** @test */
    function smtpInvoice(): void
    {
        Mail::to($this->faker->email)->send(new InvoiceMail(
            invoiceNumber: 'INV-' . date('Y') . '-' . str_pad((string) random_int(1, 9999), 4, '0', STR_PAD_LEFT),
            amount: round(random_int(2999, 49999) / 100, 2),
            customerName: $this->faker->company,
        ));
    }
}
