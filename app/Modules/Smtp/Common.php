<?php
declare(strict_types=1);

namespace App\Modules\Smtp;

use App\Mail\OrderShipped;
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
}
