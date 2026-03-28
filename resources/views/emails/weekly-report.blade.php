@component('mail::message')
# Weekly Activity Report

Hello {{ $userName }},

Here's your activity summary for the past week:

@component('mail::table')
| Metric | Value |
|:-------|------:|
| Posts Created | {{ $stats['posts_created'] }} |
| Comments Received | {{ $stats['comments_received'] }} |
| Profile Views | {{ $stats['profile_views'] }} |
| New Followers | {{ $stats['new_followers'] }} |
@endcomponent

@if($stats['posts_created'] > 5)
@component('mail::panel')
**Great job!** You've been very active this week. Keep it up!
@endcomponent
@endif

@component('mail::button', ['url' => 'https://example.com/dashboard'])
View Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
