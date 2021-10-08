<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('favicon/safari-pinned-tab.svg') }}" color="#5bbad5">

    <title>Buggregator</title>
</head>
<body>
<div id="app" class="h-screen">
    <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto py-10 px-5 md:px-8 lg:px-16">
        <img src="{{ asset('images/logo.png') }}" alt="">
        <h1 class="text-2xl sm:text-3xl lg:text-4xl leading-none font-extrabold tracking-tight text-blue-600 mt-6 mb-6">
            Buggregator is a beautiful, lightweight debug server build on Laravel that helps you debug your app.
        </h1>

        <div class="text-sm mb-5 md:mb-10 lg:mb-20">
            <p class="max-w-screen-lg text-lg sm:text-2xl sm:leading-10 font-medium mb-5 text-gray-600">
                You can run Buggregator via docker from Docker Hub by using command below.
            </p>
            <div
                class="mb-2 text-center w-full bg-gray-50 text-gray-400 font-semibold hover:text-gray-900 font-mono px-3 py-2 border border-gray-200 rounded-xl transition-colors duration-200">
                docker run --pull always -p 23517:8000 -p 1025:1025 -p 9912:9912 -p 9913:9913
                butschster/buggregator:latest
            </div>
            <a class="flex border border-gray-200 w-28 justify-center items-center gap-x-2 bg-gray-50 hover:bg-gray-700 text-gray-700 hover:text-white leading-6 font-semibold py-3 border border-transparent rounded-xl focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-none transition-colors duration-200"
               href="https://github.com/buggregator/app">
                <svg class="w-6 h-6 fill-current" viewBox="0 0 1024 1024" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M8 0C3.58 0 0 3.58 0 8C0 11.54 2.29 14.53 5.47 15.59C5.87 15.66 6.02 15.42 6.02 15.21C6.02 15.02 6.01 14.39 6.01 13.72C4 14.09 3.48 13.23 3.32 12.78C3.23 12.55 2.84 11.84 2.5 11.65C2.22 11.5 1.82 11.13 2.49 11.12C3.12 11.11 3.57 11.7 3.72 11.94C4.44 13.15 5.59 12.81 6.05 12.6C6.12 12.08 6.33 11.73 6.56 11.53C4.78 11.33 2.92 10.64 2.92 7.58C2.92 6.71 3.23 5.99 3.74 5.43C3.66 5.23 3.38 4.41 3.82 3.31C3.82 3.31 4.49 3.1 6.02 4.13C6.66 3.95 7.34 3.86 8.02 3.86C8.7 3.86 9.38 3.95 10.02 4.13C11.55 3.09 12.22 3.31 12.22 3.31C12.66 4.41 12.38 5.23 12.3 5.43C12.81 5.99 13.12 6.7 13.12 7.58C13.12 10.65 11.25 11.33 9.47 11.53C9.76 11.78 10.01 12.26 10.01 13.01C10.01 14.08 10 14.94 10 15.21C10 15.42 10.15 15.67 10.55 15.59C13.71 14.53 16 11.53 16 8C16 3.58 12.42 0 8 0Z"
                          transform="scale(64)" fill="#1B1F23"/>
                </svg>
                <span class="flex-none">Github</span>
            </a>
        </div>


        <a href="#demo" class="flex flex-col items-center text-gray-900 mb-5 md:mb-10 lg:mb-20">
            <h3 class="sm:text-lg lg:text-4xl sm:leading-snug font-extrabold tracking-wide mb-3">demo</h3>
            <div class="animate-bounce">
                <svg class="fill-current transform rotate-90 h-10" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 512 512">
                    <path
                        d="M295.6 163.7c-5.1 5-5.1 13.3-.1 18.4l60.8 60.9H124.9c-7.1 0-12.9 5.8-12.9 13s5.8 13 12.9 13h231.3l-60.8 60.9c-5 5.1-4.9 13.3.1 18.4 5.1 5 13.2 5 18.3-.1l82.4-83c1.1-1.2 2-2.5 2.7-4.1.7-1.6 1-3.3 1-5 0-3.4-1.3-6.6-3.7-9.1l-82.4-83c-4.9-5.2-13.1-5.3-18.2-.3z"/>
                </svg>
            </div>
        </a>

        <div class="px-4 sm:px-6 md:px-8 mb-5 md:mb-10 lg:mb-20">
            <h2 class="text-3xl sm:text-5xl lg:text-6xl leading-none font-extrabold text-blue-600 tracking-tight mb-8 text-center">
                Buggregator is a standalone.</h2>
            <p class="text-center max-w-4xl text-lg sm:text-2xl text-gray-700 font-bold space-y-6 max-w-4xl mx-auto mb-6">
                It runs without installation on multiple platforms via docker and supports symfony var-dumper, monolog,
                sentry, smtp and spatie ray package.
            </p>
            <div class="flex flex-col items-center">
                <div class="p-1 border-2 border-blue-400 rounded-full">
                    <img src="https://avatars.githubusercontent.com/u/773481?v=4" alt=""
                         class="w-16 h-16 rounded-full bg-blue-200" loading="lazy">
                </div>
                <a href="https://github.com/butschster" class="text-gray-900 text-lg font-bold">butschster</a>
                <div class="text-blue-600 text-sm font-bold">Creator of Buggregator</div>
            </div>
        </div>

    </div>

    <div class="relative">
        @if(config('app.buggregator_url'))
            <div class="sticky top-0 p-0 lg:px-10" id="demo">
                <iframe src="{{ config('app.buggregator_url') }}"
                        frameborder="0"
                        height="600px"
                        class="transform sm:scale-75 lg:scale-100 w-full bg-white border-4 border-blue-600 rounded-lg sticky top-0 w-full shadow-2xl">
                        </iframe>
            </div>
        @endif

        <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto py-10 px-5 md:px-8 lg:px-16">
            <div class="space-y-5 sm:space-y-10 md:space-y-16 lg:space-y-20 rounded-b-lg">
                @foreach($buttonGroups as $group => $buttons)
                    <div class="p-5 md:p-8 lg:p-10 bg-gray-50 rounded-xl">
                        <h3 class="text-lg sm:text-xl lg:text-3xl leading-none font-extrabold text-gray-900 tracking-tight mb-8">
                            {{ \Illuminate\Support\Str::studly($group) }}
                        </h3>

                        <div class="flex flex-wrap gap-2 md:gap-3 lg:gap-4 text-sm">
                            @foreach($buttons as $button)
                                <button-action
                                    action="{{ $group.':'.\Illuminate\Support\Str::snake($button) }}">{{ $button }}</button-action>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="flex justify-center my-20">
        <img src="{{ asset('images/pacman.png') }}" alt="">
    </div>
</div>
@verbatim
    <script>
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
            template: '<button @click="callAction" type="button" class="border rounded-full text-blue-600 md:py-1 md:px-3 px-2 lg:px-3 border-blue-400 hover:bg-blue-500 hover:text-white transition-all duration-300"><slot></slot></button>'
        })

        new Vue({
            el: '#app',
        })
    </script>
@endverbatim

</body>
</html>
