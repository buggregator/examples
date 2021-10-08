@component('mail::message')
# Welcome to the Buggregator

Debug with Buggregator to fix problems faster

* Use in WordPress or any PHP project
* See models, mails, queries, … in Laravel
* Debug locally or via SSH
* Works with Javascript, Node.js and Ruby
* Measure performance & set breakpoints

@component('mail::button', ['url' => 'https://github.com/buggregator/app'])
    Download
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
