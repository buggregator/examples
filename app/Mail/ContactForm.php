<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $senderName,
        public string $message,
        public string $language,
    ) {}

    public function build()
    {
        return $this
            ->subject($this->localizedSubject())
            ->replyTo('noreply@example.com', $this->senderName)
            ->markdown('emails.contact_form');
    }

    private function localizedSubject(): string
    {
        return match ($this->language) {
            'cs' => "Vaše zpráva: {$this->senderName} — potvrzení přijetí",
            'de' => "Ihre Nachricht: {$this->senderName} — Eingangsbestätigung",
            'ja' => "お問い合わせ: {$this->senderName} — 受付確認",
            'ar' => "رسالتك: {$this->senderName} — تأكيد الاستلام",
            'ru' => "Ваше сообщение: {$this->senderName} — подтверждение получения",
            'zh' => "您的留言: {$this->senderName} — 收件确认",
            default => "Your message: {$this->senderName} — receipt confirmation",
        };
    }
}
