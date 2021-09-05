<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Mail\OrderShipped;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SMTPTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        ray()->disable();
    }

    function test_send_mail()
    {
        Mail::to(['test@site.com', 'admin@site.com'])
            ->send(new OrderShipped());

        $this->assertTrue(true);
    }

    function test_send_mail2()
    {
        Mail::to('test@site.com')->send(new WelcomeMail());
        $this->assertTrue(true);
    }
}
