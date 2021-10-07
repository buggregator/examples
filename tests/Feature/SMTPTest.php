<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Mail\OrderShipped;
use App\Mail\WelcomeMail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SMTPTest extends TestCase
{
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        ray()->disable();
    }

    function test_send_mail()
    {
        Mail::to([$this->faker->email, $this->faker->email])
            ->send(new OrderShipped($this->faker->sentence));

        $this->assertTrue(true);
    }

    function test_send_mail2()
    {
        Mail::to($this->faker->email)->send(new WelcomeMail());
        $this->assertTrue(true);
    }
}
