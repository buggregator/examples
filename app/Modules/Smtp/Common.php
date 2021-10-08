<?php
declare(strict_types=1);

namespace App\Modules\Smtp;

use App\Mail\OrderShipped;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

trait Common
{
    public function setUpSmtp()
    {
        ray()->disable();
    }

    /** @test */
    function smtpOrderShipped()
    {
        Mail::to([$this->faker->email, $this->faker->email])
            ->send(new OrderShipped($this->faker->sentence));
    }

    /** @test */
    function smtpWelcomeMail()
    {
        Mail::to($this->faker->email)->send(new WelcomeMail());
    }
}
