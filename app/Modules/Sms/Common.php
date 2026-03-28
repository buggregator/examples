<?php

declare(strict_types=1);

namespace App\Modules\Sms;

use App\RandomPhraseGenerator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

trait Common
{
    protected string $smsBaseUrl;

    public function setUpSms(): void
    {
        ray()->disable();
        $this->smsBaseUrl = rtrim(config('services.sms.endpoint'), '/');
    }

    private function smsUrl(?string $gateway = null): string
    {
        // Derive gateway name from calling method: smsTwilio -> twilio, smsSmsru -> smsru
        if ($gateway === null) {
            $method = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['function'] ?? '';
            $gateway = lcfirst(str_replace('sms', '', $method)) ?: null;
        }

        return $gateway ? "{$this->smsBaseUrl}/{$gateway}" : $this->smsBaseUrl;
    }

    private function phone(string $prefix = '+1', int $digits = 10): string
    {
        return $prefix . $this->faker->numerify(str_repeat('#', $digits));
    }

    // ===== International providers =====

    /** @test */
    public function smsTwilio(): void
    {
        Http::post($this->smsUrl(), [
            'MessageSid' => 'SM' . bin2hex(random_bytes(16)),
            'From' => $this->phone('+1'),
            'To' => $this->phone('+1'),
            'Body' => 'Your verification code is ' . random_int(1000, 9999) . '. Valid for 10 minutes.',
        ]);
    }

    /** @test */
    public function smsVonage(): void
    {
        Http::post($this->smsUrl(), [
            'api_key' => 'demo-key',
            'api_secret' => 'demo-secret',
            'from' => $this->phone('+31', 9),
            'to' => $this->phone('+31', 9),
            'text' => 'Security alert: New login from ' . $this->faker->city() . '. If this wasn\'t you, reset your password.',
        ]);
    }

    /** @test */
    public function smsPlivo(): void
    {
        Http::post($this->smsUrl(), [
            'MessageUUID' => (string) Str::uuid(),
            'From' => $this->phone('+44'),
            'To' => $this->phone('+44'),
            'Text' => 'Reminder: Your appointment is tomorrow at 10:00 AM. Reply CONFIRM or CANCEL.',
        ]);
    }

    /** @test */
    public function smsSinch(): void
    {
        Http::post($this->smsUrl(), [
            'batch_id' => (string) Str::uuid(),
            'from' => $this->phone('+46', 9),
            'to' => $this->phone('+46', 9),
            'body' => 'Your order #' . random_int(10000, 99999) . ' has been shipped. Track at https://example.com/track',
        ]);
    }

    /** @test */
    public function smsInfobip(): void
    {
        Http::post($this->smsUrl(), [
            'messages' => [
                [
                    'from' => 'ServiceAlert',
                    'destinations' => [['to' => $this->phone('+49')]],
                    'text' => 'Your account balance is low. Current balance: $' . number_format(random_int(1, 50) / 10, 2),
                ],
            ],
        ]);
    }

    /** @test */
    public function smsMessagebird(): void
    {
        Http::post($this->smsUrl(), [
            'originator' => $this->phone('+31', 9),
            'recipients' => [$this->phone('+1')],
            'body' => 'Welcome to our service! Your account has been activated.',
        ]);
    }

    /** @test */
    public function smsTelnyx(): void
    {
        Http::post($this->smsUrl(), [
            'messaging_profile_id' => (string) Str::uuid(),
            'from' => $this->phone('+1'),
            'to' => $this->phone('+1'),
            'text' => 'Payment of $' . number_format(random_int(999, 99999) / 100, 2) . ' received. Thank you!',
        ]);
    }

    /** @test */
    public function smsBandwidth(): void
    {
        Http::post($this->smsUrl(), [
            'applicationId' => (string) Str::uuid(),
            'from' => $this->phone('+1'),
            'to' => $this->phone('+1'),
            'text' => 'Your package has been delivered to ' . $this->faker->address() . '.',
        ]);
    }

    /** @test */
    public function smsBrevo(): void
    {
        Http::post($this->smsUrl(), [
            'sender' => 'MyApp',
            'recipient' => $this->phone('+33', 9),
            'content' => 'Flash sale! Use code SAVE' . random_int(10, 50) . ' for ' . random_int(10, 50) . '% off. Ends tonight!',
        ]);
    }

    /** @test */
    public function smsTermii(): void
    {
        Http::post($this->smsUrl(), [
            'api_key' => 'demo-api-key',
            'from' => 'MyApp',
            'to' => $this->phone('+234'),
            'sms' => 'Your OTP is ' . random_int(100000, 999999) . '. Do not share with anyone.',
            'channel' => 'generic',
            'type' => 'plain',
        ]);
    }

    /** @test */
    public function smsClickatell(): void
    {
        Http::post($this->smsUrl(), [
            'from' => $this->phone('+27'),
            'to' => $this->phone('+27'),
            'text' => 'Your appointment at ' . $this->faker->company() . ' is confirmed for ' . now()->addDays(2)->format('M d') . '.',
        ]);
    }

    /** @test */
    public function smsMessagemedia(): void
    {
        Http::post($this->smsUrl(), [
            'source_number' => $this->phone('+61', 9),
            'destination_number' => $this->phone('+61', 9),
            'content' => 'G\'day! Your booking ref #' . strtoupper(Str::random(6)) . ' is confirmed.',
        ]);
    }

    /** @test */
    public function smsLox24(): void
    {
        Http::post($this->smsUrl(), [
            'sender_id' => 'MyShop',
            'phone' => $this->phone('+49'),
            'text' => 'Ihre Bestellung #' . random_int(10000, 99999) . ' wurde versandt. Lieferung: ' . now()->addDays(random_int(1, 3))->format('d.m.Y'),
        ]);
    }

    /** @test */
    public function smsUnifonic(): void
    {
        Http::post($this->smsUrl(), [
            'AppSid' => 'demo-app-sid',
            'SenderID' => 'MyBank',
            'Recipient' => $this->phone('+966', 9),
            'Body' => 'Your transfer of SAR ' . number_format(random_int(100, 50000) / 10, 2) . ' has been completed.',
        ]);
    }

    /** @test */
    public function smsYunpian(): void
    {
        Http::post($this->smsUrl(), [
            'apikey' => 'demo-apikey',
            'mobile' => $this->phone('+86', 11),
            'text' => '【MyApp】Your verification code is ' . random_int(1000, 9999) . '. Valid for 5 minutes.',
        ]);
    }

    /** @test */
    public function smsOctopush(): void
    {
        Http::post($this->smsUrl(), [
            'sms_text' => 'Votre code: ' . random_int(1000, 9999) . '. Valide pendant 10 minutes.',
            'sms_recipients' => $this->phone('+33', 9),
            'sms_sender' => 'MonApp',
            'user_login' => 'demo',
            'api_key' => 'demo-key',
        ]);
    }

    /** @test */
    public function smsGatewayapi(): void
    {
        Http::post($this->smsUrl(), [
            'sender' => 'MyService',
            'recipients' => [['msisdn' => $this->phone('+45', 8)]],
            'message' => 'Din ordre #' . random_int(1000, 9999) . ' er klar til afhentning.',
        ]);
    }

    /** @test */
    public function smsSevenio(): void
    {
        Http::post($this->smsUrl(), [
            'json' => 1,
            'from' => 'MyApp',
            'to' => $this->phone('+49'),
            'text' => 'Ihr Termin bei ' . $this->faker->company() . ' am ' . now()->addDays(3)->format('d.m.') . ' um ' . random_int(8, 17) . ':00 Uhr.',
        ]);
    }

    /** @test */
    public function smsSmsfactor(): void
    {
        Http::post($this->smsUrl(), [
            'gsmsmsid' => 'msg-' . bin2hex(random_bytes(8)),
            'sender' => 'MyApp',
            'to' => $this->phone('+33', 9),
            'text' => 'Votre colis est en cours de livraison. Référence: ' . strtoupper(Str::random(8)),
        ]);
    }

    // ===== Russian providers =====

    /** @test */
    public function smsSmsru(): void
    {
        Http::post($this->smsUrl(), [
            'api_id' => 'demo-api-id',
            'from' => 'MyService',
            'to' => $this->phone('+7'),
            'msg' => 'Код подтверждения: ' . random_int(1000, 9999) . '. Никому не сообщайте этот код.',
        ]);
    }

    /** @test */
    public function smsSmsaero(): void
    {
        Http::post($this->smsUrl(), [
            'sign' => 'MyApp',
            'number' => $this->phone('+7'),
            'text' => 'Ваш заказ #' . random_int(10000, 99999) . ' собран и передан в доставку.',
        ]);
    }

    /** @test */
    public function smsSmsc(): void
    {
        Http::post($this->smsUrl(), [
            'login' => 'demo',
            'psw' => 'demo',
            'phones' => $this->phone('+7'),
            'mes' => 'Списание ' . number_format(random_int(100, 50000) / 100, 2) . ' руб. Баланс: ' . number_format(random_int(10000, 500000) / 100, 2) . ' руб.',
            'sender' => 'Bank',
        ]);
    }

    /** @test */
    public function smsDevino(): void
    {
        Http::post($this->smsUrl(), [
            'SourceAddress' => 'Clinic',
            'DestinationAddress' => $this->phone('+7'),
            'Data' => 'Напоминаем о записи к врачу ' . $this->faker->lastName() . ' на ' . now()->addDays(random_int(1, 7))->format('d.m.Y') . ' в ' . random_int(9, 18) . ':00.',
        ]);
    }

    /** @test */
    public function smsIqsms(): void
    {
        Http::post($this->smsUrl(), [
            'clientId' => 'demo-client',
            'phone' => $this->phone('+7'),
            'text' => 'Заказ такси принят. Машина подъедет через ' . random_int(3, 15) . ' мин.',
            'sender' => 'Taxi',
        ]);
    }

    /** @test */
    public function smsMts(): void
    {
        Http::post($this->smsUrl(), [
            'naming' => 'MTS-Bank',
            'msisdn' => $this->phone('+7'),
            'text' => 'Операция по карте *' . random_int(1000, 9999) . ': покупка ' . number_format(random_int(50, 15000), 0, '.', ' ') . ' руб.',
        ]);
    }

    /** @test */
    public function smsBeeline(): void
    {
        Http::post($this->smsUrl(), [
            'sender' => 'Beeline',
            'target' => $this->phone('+7'),
            'message' => 'Баланс вашего номера: ' . number_format(random_int(0, 100000) / 100, 2) . ' руб.',
        ]);
    }

    /** @test */
    public function smsMegafon(): void
    {
        Http::post($this->smsUrl(), [
            'from' => 'Megafon',
            'to' => $this->phone('+7'),
            'subject' => 'Info',
            'message' => 'На вашем счету ' . number_format(random_int(0, 50000) / 100, 2) . ' руб. Подключите автоплатёж.',
        ]);
    }

    // ===== Validation error examples =====

    /** @test — Twilio without MessageSid → 422 + warnings in UI */
    public function smsTwilioMissingFields(): void
    {
        Http::post($this->smsUrl('twilio'), [
            'From' => $this->phone('+1'),
            'To' => $this->phone('+1'),
            // Missing MessageSid and Body
        ]);
    }

    /** @test — Vonage without api_key/api_secret → 422 + warnings in UI */
    public function smsVonageMissingAuth(): void
    {
        Http::post($this->smsUrl('vonage'), [
            'from' => $this->phone('+31', 9),
            'to' => $this->phone('+31', 9),
            'text' => 'This message is missing auth credentials.',
            // Missing api_key and api_secret
        ]);
    }

    // ===== Generic =====

    /** @test */
    public function smsGeneric(RandomPhraseGenerator $generator): void
    {
        Http::post($this->smsBaseUrl, [
            'From' => $this->phone('+1'),
            'To' => $this->phone('+1'),
            'content' => $generator->generate('Buggregator'),
        ]);
    }
}
