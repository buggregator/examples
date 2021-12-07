<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link href="/app.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/site.webmanifest">

    <title>{{ config('app.name') }}</title>
</head>
<body>
<div id="app" class="h-screen">
    <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto px-5 md:px-8 lg:px-16 my-6">
        <header class="flex justify-between">
            <a href="/">
                <img src="/images/logo.png" alt="{{ config('app.name') }} logo">
            </a>

            <a class="py-2 px-3" href="https://github.com/buggregator/app" target="_blank">
                <svg class="w-6 h-6 fill-current" viewBox="0 0 1024 1024" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8C0 11.54 2.29 14.53 5.47 15.59C5.87 15.66 6.02 15.42 6.02 15.21C6.02 15.02 6.01 14.39 6.01 13.72C4 14.09 3.48 13.23 3.32 12.78C3.23 12.55 2.84 11.84 2.5 11.65C2.22 11.5 1.82 11.13 2.49 11.12C3.12 11.11 3.57 11.7 3.72 11.94C4.44 13.15 5.59 12.81 6.05 12.6C6.12 12.08 6.33 11.73 6.56 11.53C4.78 11.33 2.92 10.64 2.92 7.58C2.92 6.71 3.23 5.99 3.74 5.43C3.66 5.23 3.38 4.41 3.82 3.31C3.82 3.31 4.49 3.1 6.02 4.13C6.66 3.95 7.34 3.86 8.02 3.86C8.7 3.86 9.38 3.95 10.02 4.13C11.55 3.09 12.22 3.31 12.22 3.31C12.66 4.41 12.38 5.23 12.3 5.43C12.81 5.99 13.12 6.7 13.12 7.58C13.12 10.65 11.25 11.33 9.47 11.53C9.76 11.78 10.01 12.26 10.01 13.01C10.01 14.08 10 14.94 10 15.21C10 15.42 10.15 15.67 10.55 15.59C13.71 14.53 16 11.53 16 8C16 3.58 12.42 0 8 0Z" transform="scale(64)" fill="#1B1F23"/>
                </svg>
            </a>
        </header>
    </div>

    <div class="bg-gray-100">
        <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto py-10 px-5 md:px-8 lg:px-16 my-6">
            <h1 class="text-2xl sm:text-3xl lg:text-5xl leading-none text-blue-800 font-extrabold tracking-tight text-white mt-6 mb-4">
                A server for debugging more than just Laravel applications.
            </h1>
            <p class="max-w-screen-lg text-lg sm:text-2xl font-semibold text-gray-500 mb-10 sm:mb-11 text-white">
                {{ config('app.name') }} is a beautiful, lightweight debug server build on Laravel that helps you debug your
                app.
            </p>

            <div class="text-sm mb-6 border bg-white rounded-lg px-5 py-3">
                <p class="max-w-screen-lg font-medium text-gray-400 mb-2">
                    Use the command below to run {{ config('app.name') }} via docker container.
                </p>
                <div
                    class="mb-2 w-full bg-white text-gray-400 font-semibold hover:text-gray-700 font-mono px-3 py-2 border border-gray-200 hover:border-blue-600 rounded-lg transition-colors duration-200">
                    docker run --pull always -p 23517:8000 -p 1025:1025 -p 9912:9912 -p 9913:9913
                    butschster/buggregator:latest
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto py-10 px-5 md:px-8 lg:px-16 my-6">
        @if(config('app.buggregator_url'))
        <a href="#demo" class="flex flex-col items-center">
            <h3 class="sm:text-lg lg:text-4xl text-purple-800 font-extrabold tracking-wide mb-3">demo</h3>
            <div class="animate-bounce text-purple-500">
                <svg class="fill-current h-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 330 330" xml:space="preserve"><path d="M326 79c-6-5-16-5-22 0L165 219 26 79a15 15 0 0 0-22 22l150 150a15 15 0 0 0 22 0l150-150c5-6 5-16 0-22z"/></svg>
            </div>
        </a>
        @endif

        <div class="px-4 sm:px-6 md:px-8 my-5 md:my-10 lg:my-20">
            <h2 class="text-3xl sm:text-5xl lg:text-6xl leading-none font-extrabold text-gray-800 tracking-tight mb-8 text-center">
                {{ config('app.name') }} is a standalone.
            </h2>
            <p class="text-center max-w-4xl text-lg sm:text-2xl text-gray-500 font-bold space-y-6 max-w-4xl mx-auto mb-6">
                It runs without installation on multiple platforms via docker and supports <a href="https://github.com/symfony/var-dumper">symfony var-dumper</a>, <a
                    href="https://github.com/Seldaek/monolog">Monolog</a>,
                <a href="https://sentry.io/">Sentry</a>, smtp, <a href="https://inspector.dev">Inspector</a> and <a href="https://spatie.be/docs/ray/v1/introduction">spatie ray</a> package.
            </p>
            <a href="https://github.com/butschster" target="_blank" class="flex flex-col items-center">
                <div class="p-1 border-2 border-blue-400 rounded-full">
                    <img src="https://avatars.githubusercontent.com/u/773481?v=4" alt="" class="w-16 h-16 rounded-full bg-blue-200" loading="lazy">
                </div>
                <div class="text-gray-900 text-xl font-medium">Pavel Buchnev</div>
                <div class="text-blue-600 text-sm font-bold">Creator of {{ config('app.name') }}</div>
            </a>
        </div>
    </div>

    <div class="relative">
        @if(config('app.buggregator_url'))
            <div class="p-0 lg:px-10" id="demo">
                <preview >
                    <iframe src="{{ config('app.buggregator_url') }}" frameborder="0"></iframe>
                </preview>
            </div>
        @endif

        <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto py-10 px-5 md:px-8 lg:px-16">
            @foreach($buttonGroups as $group => $data)
                <div class="mb-5 sm:mb-16 md:mb-20 lg:mb-32" id="{{ $group }}">
                    <h3 class="text-3xl sm:text-5xl lg:text-6xl leading-none font-extrabold text-blue-800 tracking-tight mb-8">
                        {{ $data['title'] ?? \Illuminate\Support\Str::studly($group) }}
                    </h3>

                    @if(isset($data['description']))
                        <p class="max-w-4xl text-lg sm:text-2xl text-gray-500 font-medium sm:leading-10 mb-6">{{ $data['description'] }}</p>
                    @endif

                    <div class="p-5 md:p-8 lg:p-10 bg-gray-50 border border-blue-200 rounded-xl">
                        <p class="text-sm text-gray-400 font-bold mb-4">Click a button to send an event to {{ config('app.name') }} server.</p>
                        @foreach($data['events'] as $type => $buttons)
                            @if($type !== 'common')
                                <h4 class="text-xl lg:text-3xl leading-none font-extrabold text-blue-600 tracking-tight mt-6 mb-4">
                                    {{ \Illuminate\Support\Str::studly($type) }}
                                </h4>
                            @endif

                            <div class="flex flex-wrap gap-2 md:gap-3 lg:gap-4 text-sm">
                                @foreach($buttons as $button)
                                    <button-action action="{{ $group.($type === 'common' ? '' : '_' . $type).':'.\Illuminate\Support\Str::snake($button) }}">
                                        {{ $button }}
                                    </button-action>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="flex justify-center py-20">
        <img src="/images/pacman.png">
    </div>
</div>
@verbatim
    <script>
        Vue.component('preview', {
            props: {
                device: {
                    default() {
                        return 'desktop'
                    }
                }
            },
            computed: {
                deviceClass() {
                    return `device-${this.device}`
                }
            },
            template: `
<div class="flex flex-col items-center h-full">
    <div class="flex justify-center mb-5">
        <button class="p-1 rounded" @click="device = 'mobile'" :class="{'bg-blue-50 text-blue-600': device == 'mobile'}">
            <svg class="w-10 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 53"><path fill-rule="evenodd" clip-rule="evenodd" d="M9 1H2a1 1 0 0 0-1 1v49c0 .6.4 1 1 1h24c.6 0 1-.4 1-1V2c0-.6-.4-1-1-1h-7c0 .6-.4 1-1 1h-8a1 1 0 0 1-1-1ZM2 0a2 2 0 0 0-2 2v49c0 1.1.9 2 2 2h24a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2Zm14 49a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z" /></svg>
        </button>
        <button @click="device = 'tablet'" class="p-1 rounded" :class="{'bg-blue-50 text-blue-600': device == 'tablet'}">
            <svg class="w-10 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 38 53"><path fill-rule="evenodd" clip-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v49c0 .6.4 1 1 1h34c.6 0 1-.4 1-1V2c0-.6-.4-1-1-1H24c0 .6-.4 1-1 1h-8a1 1 0 0 1-1-1ZM2 0a2 2 0 0 0-2 2v49c0 1.1.9 2 2 2h34a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2Zm32 4H4a1 1 0 0 0-1 1v39c0 .6.4 1 1 1h30c.6 0 1-.4 1-1V5c0-.6-.4-1-1-1ZM4 3a2 2 0 0 0-2 2v39c0 1.1.9 2 2 2h30a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H4Zm15 48a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" /></svg>
        </button>
        <button @click="device = 'desktop'" class="p-1 rounded" :class="{'bg-blue-50 text-blue-600': device == 'desktop'}">
            <svg class="w-10 h-7 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 58 53"><path fill-rule="evenodd" clip-rule="evenodd" d="M2 1h54c.6 0 1 .4 1 1v36.5H1V2c0-.6.4-1 1-1ZM1 39.5V43c0 .6.4 1 1 1h54c.6 0 1-.4 1-1v-3.5H1Zm57 0V43a2 2 0 0 1-2 2H36.5l1 4.9v.1H40c.6 0 1 .4 1 1v1c0 .6-.4 1-1 1H19a1 1 0 0 1-1-1v-1c0-.6.4-1 1-1h2.5v-.1l1-4.9H2a2 2 0 0 1-2-2V2C0 .9.9 0 2 0h54a2 2 0 0 1 2 2v37.5ZM36.5 50l-1-4.9V45h-12v.1l-1 4.9h14ZM54 42a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm-35 9h21v1H19v-1Z" /></svg>
        </button>
    </div>

    <div :class="deviceClass">
        <div>
            <slot></slot>
        </div>
    </div>
</div>
`
        })

        Vue.component('button-action', {
            props: {
                action: String
            },
            methods: {
                callAction() {
                    fetch('/', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({action: this.action})
                    })
                        .then(data => console.log(data));
                }
            },
            template: `
<button @click="callAction" type="button" class="border rounded-full text-blue-600 md:py-1 md:px-3 px-2 lg:px-3 border-blue-400 hover:bg-blue-500 hover:text-white transition-all duration-300">
    <slot></slot>
</button>
`
        })

        new Vue({
            el: '#app',
        })
    </script>
@endverbatim

@if(config('app.google_tagmanager'))
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-151758540-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '{{ config('app.google_tagmanager') }}');
</script>
@endif
</body>
</html>
