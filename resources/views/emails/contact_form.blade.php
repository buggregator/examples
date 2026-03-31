@component('mail::message')
# ✉ {{ match($language) {
    'cs' => 'Potvrzení přijetí zprávy',
    'de' => 'Eingangsbestätigung',
    'ja' => 'お問い合わせ受付確認',
    'ar' => 'تأكيد استلام الرسالة',
    'ru' => 'Подтверждение получения сообщения',
    'zh' => '留言收件确认',
    default => 'Message Receipt Confirmation',
} }}

☺ {{ match($language) {
    'cs' => "Dobrý den, {$senderName},",
    'de' => "Sehr geehrte(r) {$senderName},",
    'ja' => "{$senderName} 様",
    'ar' => "عزيزي {$senderName}،",
    'ru' => "Здравствуйте, {$senderName},",
    'zh' => "尊敬的 {$senderName}，",
    default => "Dear {$senderName},",
} }}

✅ {{ match($language) {
    'cs' => 'Děkujeme za vaši zprávu. Náš tým se vám ozve co nejdříve.',
    'de' => 'Vielen Dank für Ihre Nachricht. Unser Team wird sich so schnell wie möglich bei Ihnen melden.',
    'ja' => 'お問い合わせいただきありがとうございます。担当者より早急にご連絡いたします。',
    'ar' => 'شكراً لرسالتك. سيتواصل فريقنا معك في أقرب وقت ممكن.',
    'ru' => 'Спасибо за ваше сообщение. Наша команда свяжется с вами в ближайшее время.',
    'zh' => '感谢您的留言。我们的团队将尽快与您联系。',
    default => 'Thank you for your message. Our team will get back to you as soon as possible.',
} }}

@component('mail::panel')
✏ **{{ match($language) {
    'cs' => 'Vaše zpráva',
    'de' => 'Ihre Nachricht',
    'ja' => 'お問い合わせ内容',
    'ar' => 'رسالتك',
    'ru' => 'Ваше сообщение',
    'zh' => '您的留言',
    default => 'Your message',
} }}:**

{{ $message }}
@endcomponent

@component('mail::button', ['url' => 'https://example.com/support'])
☛ {{ match($language) {
    'cs' => 'Centrum podpory',
    'de' => 'Support-Center',
    'ja' => 'サポートセンター',
    'ar' => 'مركز الدعم',
    'ru' => 'Центр поддержки',
    'zh' => '支持中心',
    default => 'Support Center',
} }}
@endcomponent

★ {{ match($language) {
    'cs' => 'S pozdravem',
    'de' => 'Mit freundlichen Grüßen',
    'ja' => 'よろしくお願いいたします',
    'ar' => 'مع أطيب التحيات',
    'ru' => 'С уважением',
    'zh' => '此致敬礼',
    default => 'Best regards',
} }},<br>
{{ config('app.name') }}
@endcomponent
