<?php

declare(strict_types=1);

namespace App\Modules\Smtp;

use App\Mail\ContactForm;
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

    /** @test */
    function smtpContactForm(): void
    {
        $languages = ['cs', 'de', 'ja', 'ar', 'ru', 'zh', 'en'];
        $messages = [
            'cs' => 'Dobrý den, mám dotaz ohledně vašeho produktu. Můžete mi prosím poskytnout více informací? Děkuji.',
            'de' => 'Guten Tag, ich hätte eine Frage zu Ihrem Produkt. Könnten Sie mir bitte weitere Informationen zukommen lassen? Vielen Dank.',
            'ja' => 'こんにちは、御社の製品についてお伺いしたいことがあります。詳細をお教えいただけますでしょうか。よろしくお願いいたします。',
            'ar' => 'مرحباً، لدي استفسار حول منتجكم. هل يمكنكم تزويدي بمزيد من المعلومات؟ شكراً لكم.',
            'ru' => 'Здравствуйте, у меня есть вопрос о вашем продукте. Не могли бы вы предоставить мне дополнительную информацию? Спасибо.',
            'zh' => '您好，我对贵公司的产品有一些疑问。能否提供更多信息？谢谢。',
            'en' => 'Hello, I have a question about your product. Could you please provide me with more information? Thank you.',
        ];

        $language = $languages[array_rand($languages)];

        Mail::to($this->faker->email)->send(new ContactForm(
            senderName: $this->faker->name,
            message: $messages[$language],
            language: $language,
        ));
    }
}
