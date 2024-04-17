<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="/app.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/site.webmanifest">

    <title>Buggregator - The Ultimate PHP Debugging Tool</title>

</head>
<body>
<div id="app" class="bg-gray-100 relative">
    <div class="bg-gray-900 text-gray-300 h-48">
        <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto px-5 md:px-8 lg:px-16 py-4">
            <header class="flex justify-between items-center">
                <a href="/">
                    <img src="/images/logo.png" class="h-10" alt="{{ config('app.name') }} logo">
                </a>

                <div class="py-2 px-3 flex justify-end gap-6">
                    <a href="https://docs.buggregator.dev" target="_blank"
                       class="text-lg font-bold hover:text-gray-400">
                        Docs
                    </a>

                    <a href="https://github.com/buggregator/server" target="_blank">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 1024 1024" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M8 0C3.58 0 0 3.58 0 8C0 11.54 2.29 14.53 5.47 15.59C5.87 15.66 6.02 15.42 6.02 15.21C6.02 15.02 6.01 14.39 6.01 13.72C4 14.09 3.48 13.23 3.32 12.78C3.23 12.55 2.84 11.84 2.5 11.65C2.22 11.5 1.82 11.13 2.49 11.12C3.12 11.11 3.57 11.7 3.72 11.94C4.44 13.15 5.59 12.81 6.05 12.6C6.12 12.08 6.33 11.73 6.56 11.53C4.78 11.33 2.92 10.64 2.92 7.58C2.92 6.71 3.23 5.99 3.74 5.43C3.66 5.23 3.38 4.41 3.82 3.31C3.82 3.31 4.49 3.1 6.02 4.13C6.66 3.95 7.34 3.86 8.02 3.86C8.7 3.86 9.38 3.95 10.02 4.13C11.55 3.09 12.22 3.31 12.22 3.31C12.66 4.41 12.38 5.23 12.3 5.43C12.81 5.99 13.12 6.7 13.12 7.58C13.12 10.65 11.25 11.33 9.47 11.53C9.76 11.78 10.01 12.26 10.01 13.01C10.01 14.08 10 14.94 10 15.21C10 15.42 10.15 15.67 10.55 15.59C13.71 14.53 16 11.53 16 8C16 3.58 12.42 0 8 0Z"
                                  transform="scale(64)" />
                        </svg>
                    </a>
                </div>
            </header>
        </div>
    </div>

    <div>
        <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto flex flex-col items-center bg-white -mt-28 rounded-xl shadow-2xl p-10">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl leading-none font-extrabold tracking-tight mb-4 text-center">
                <span class="text-black">Buggregator</span> <br> <small class="text-blue-800">The Ultimate Debugging
                    Server for PHP</small>
            </h1>

            <p class="text-lg text-gray-500 mb-10 sm:mb-11 text-center w-2/3 xl:w-1/2">
                Buggregator is a free Swiss Army knife for developers. What makes it special is that it offers a range
                of features that you would usually find in various paid tools, but it's available for free.
            </p>

            <div class="flex items-center justify-center gap-x-6 lg:justify-start mb-8">
                <a href="#demo" class="rounded-md bg-blue-800 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">Try demo</a>
                <a href="https://docs.buggregator.dev" class="text-sm font-semibold leading-6 text-blue-800">Documentation</a>
            </div>

            <div class="mt-4 scale-110">
                <a class="github-button" href="https://github.com/buggregator/server"
                   data-icon="octicon-star" data-size="large" data-show-count="true"
                   aria-label="Star buggregator/server on GitHub">Star</a>
            </div>
        </div>
    </div>

    <div class="mt-24 flex gap-4 mb-24">
        <div class="relative flex-1">
            <div class="p-0 sticky top-0 h-screen" id="demo">
                <preview>
                    <iframe src="{{ config('app.buggregator_url') }}" frameborder="0"></iframe>
                </preview>
            </div>
        </div>

        <div class="w-1/2 md:w-1/3 xl:w-1/4 flex flex-col gap-4 md:gap-10 lg:gap-16">
            @foreach($buttonGroups as $group => $data)
            <div class="border p-10 rounded-xl bg-white hover:shadow-xl transition" id="{{ $group }}">
                <h3 class="text-2xl lg:text-3xl leading-none font-extrabold text-blue-800 tracking-tight mb-4">
                    {{ $data['title'] ?? \Illuminate\Support\Str::studly($group) }}
                </h3>

                @if(isset($data['description']))
                <p class="text-gray-500 font-medium mb-6">
                    {{ $data['description'] }}
                </p>
                @endif

                @if(isset($data['docs']))
                <div class="mb-8">
                    <a href="{{ $data['docs'] }}" target="_blank"
                       class="border bg-blue-100 hover:bg-blue-200 font-bold text-blue-800 px-3 py-1 rounded-full">
                        Read more
                    </a>
                </div>
                @endif

                <div>
                    @foreach($data['events'] as $type => $buttons)
                    @if($type !== 'common')
                    <h4 class="text-xl lg:text-3xl leading-none font-extrabold text-blue-600 tracking-tight mt-6 mb-4">
                        {{ \Illuminate\Support\Str::studly($type) }}
                    </h4>
                    @endif

                    <div class="flex flex-wrap gap-2 md:gap-3 lg:gap-4 text-sm">
                        @foreach($buttons as $button)
                        <button-action
                            action="{{ $group.($type === 'common' ? '' : '_' . $type).':'.\Illuminate\Support\Str::snake($button) }}">
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

    <div class="mt-8 flex justify-center flex-col items-center">
        <div class="text-xs font-semibold text-center text-blue-600 relative mb-4">
            We need your support! <br> Please star the project on GitHub.

            <svg class="w-6 z-10 absolute -bottom-16 right-10 opacity-50" viewBox="0 0 1024 1024"
                 xmlns="http://www.w3.org/2000/svg"
                 fill="currentColor"
                 overflow="hidden">
                <path
                    d="m516 222.6 24.9-149.4q5.9-35.6 41.4-29.6 35.5 5.9 29.6 41.4L587 234.4q-5.9 35.5-41.4 29.6-35.5-5.9-29.6-41.4ZM219.4 95.6q29.3-20.9 50.2 8.4l88.1 123.3q21 29.3-8.3 50.2-29.3 21-50.3-8.4l-88-123.2q-21-29.3 8.3-50.2ZM68.6 410.6q5.9-35.5 41.4-29.6L259.4 406q35.5 5.9 29.6 41.4-5.9 35.5-41.4 29.6L98.2 452q-35.6-5.9-29.6-41.4ZM154.1 693.3l123.3-88q29.3-21 50.2 8.3 21 29.3-8.4 50.2l-123.2 88q-29.3 21-50.3-8.3-20.9-29.3 8.4-50.2ZM955.8 581 401.1 316a16 16 0 0 0-21.3 7.5 16 16 0 0 0-1.2 10.1L501.4 936a16 16 0 0 0 19 12.5 16 16 0 0 0 8.3-4.6l110.6-116.2 87.6 112a32 32 0 0 0 44.9 5.6l127.6-99.8a32 32 0 0 0 5.5-44.9l-87.5-112 139.4-79.2a16 16 0 0 0 6-21.8 16 16 0 0 0-7-6.6zM471.6 429.3l356.3 170.2L709.2 667l114.4 146.3-64.6 50.5-114.4-146.3-94 98.9-79-387zM698.8 304 822 216q29.3-21 50.3 8.4 20.9 29.2-8.4 50.2l-123.3 88q-29.2 21-50.2-8.3-20.9-29.3 8.4-50.2Z"/>
            </svg>

        </div>
        <a class="github-button" href="https://github.com/buggregator/server"
           data-icon="octicon-star" data-size="large" data-show-count="true"
           aria-label="Star buggregator/server on GitHub">Star</a>
    </div>


    <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto py-10 my-12">
        <div>
            <h3 class="text-3xl lg:text-5xl leading-none font-extrabold text-blue-800 tracking-tight mb-8">
                Features
            </h3>

            <div class="flex gap-4">
                <div class="border p-8 rounded-lg w-1/2 flex flex-col gap-4 bg-white hover:shadow-xl transition">
                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                         class="w-8 text-purple-400">
                        <path fill="currentColor"
                              d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 256h64c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm-32-96a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zm256-32H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s7.2-16 16-16z"
                              data-v-d08416bc="" class=""></path>
                    </svg>
                    <div>
                        <a href="https://docs.buggregator.dev/config/sso.html" target="_blank"
                           class="text-lg font-bold text-gray-600">
                            Single Sign On
                        </a>
                        <p class="text-gray-500 mb-4">Securely manage user access and authentication through Single
                            Sign-On (SSO) with providers like <a href="https://auth0.com/"
                                                                 class="text-blue-700 underline">Auth0</a>.</p>

                        <a href="https://docs.buggregator.dev/config/sso.html" target="_blank"
                           class="border bg-purple-100 hover:bg-purple-200 font-bold text-purple-800 px-3 py-1 rounded-full">
                            Read more
                        </a>
                    </div>
                </div>
                <div class="border p-8 rounded-lg w-1/2 flex flex-col gap-4 bg-white hover:shadow-xl transition">
                    <svg class="w-8 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                              d="M64 32C28.7 32 0 60.7 0 96v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm48 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zM64 288c-35.3 0-64 28.7-64 64v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V352c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm56 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z"
                              data-v-d08416bc="" class=""></path>
                    </svg>
                    <div>
                        <a href="https://docs.buggregator.dev/config/external-db.html" target="_blank"
                           class="text-lg font-bold text-gray-600">
                            External database support
                        </a>
                        <p class="text-gray-500 mb-4">Configure Buggregator to use external databases like MongoDB or
                            PostgreSQL for event storage. This flexibility allows you to scale storage according to your
                            project needs.</p>

                        <a href="https://docs.buggregator.dev/config/external-db.html" target="_blank"
                           class="border bg-green-100 hover:bg-green-200 font-bold text-green-800 px-3 py-1 rounded-full">
                            Read more
                        </a>
                    </div>
                </div>
            </div>

            <div class="border p-8 rounded-lg bg-blue-50 w-full flex flex-col gap-4 mt-4 hover:shadow-xl transition">
                <svg class="w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 722.8 702">
                    <path
                        d="M359 10a46.7 46.3 0 0 0-18 4.6L96.8 131.3a46.7 46.3 0 0 0-25.2 31.5L11.2 425a46.7 46.3 0 0 0 6.3 35.6 46.7 46.3 0 0 0 2.7 3.6l169.1 210.3a46.7 46.3 0 0 0 36.5 17.5l271.2-.1a46.7 46.3 0 0 0 36.6-17.4l169-210.3a46.7 46.3 0 0 0 9-39.2l-60.3-262.3a46.7 46.3 0 0 0-25.3-31.4L381.6 14.6A46.7 46.3 0 0 0 359 10z"
                        fill="#326ce5"/>
                    <path
                        d="M367.7 274c-8 0-14.6 7.3-14.6 16.3v4.2c.2 5.1 1.3 9.1 2 13.9 1.2 10.2 2.3 18.6 1.6 26.5a16 16 0 0 1-4.7 7.6l-.4 6.2a188.1 188.1 0 0 0-122 58.7l-5.2-3.8c-2.7.3-5.3 1.1-8.7-.9-6.6-4.4-12.5-10.5-19.7-17.8-3.4-3.5-5.7-6.8-9.7-10.2l-3.2-2.6c-3-2.5-6.7-3.7-10.2-3.9a14 14 0 0 0-11.7 5.2c-5 6.3-3.4 16 3.6 21.6l.2.1 3 2.5c4.2 3 8 4.6 12.2 7 8.7 5.5 16 10 21.8 15.3 2.2 2.4 2.6 6.6 2.9 8.5l4.7 4.2a189.3 189.3 0 0 0-29.9 131.9l-6 1.8c-1.7 2-4 5.3-6.4 6.3-7.5 2.4-16 3.3-26.2 4.3-4.8.4-9 .2-14 1.2l-4 .9h-.3c-8.6 2.1-14.1 10-12.3 17.9 1.7 7.8 10.2 12.5 18.8 10.7h.2l.3-.2 3.8-.8c5-1.3 8.6-3.3 13.1-5 9.7-3.5 17.7-6.4 25.5-7.5 3.3-.3 6.7 2 8.4 3l6.4-1.2a190.3 190.3 0 0 0 84.4 105.3l-2.7 6.4c1 2.5 2 5.8 1.3 8.3a143 143 0 0 1-13.2 23.8c-2.7 4-5.5 7-7.9 11.7-.6 1-1.3 2.8-1.9 4-3.7 8-1 17.2 6.3 20.7 7.2 3.5 16.2-.2 20.2-8.3l1.8-3.7c2-4.8 2.8-8.9 4.2-13.4 3.9-9.8 6-20 11.3-26.3 1.5-1.8 3.9-2.4 6.3-3l3.4-6a189 189 0 0 0 135 .3l3 5.6c2.6.8 5.3 1.2 7.5 4.5 4 6.8 6.7 14.9 10 24.6 1.5 4.6 2.2 8.7 4.3 13.4l1.8 3.8c3.9 8 13 11.7 20.2 8.2 7.2-3.4 10-12.7 6.2-20.7l-1.9-4c-2.4-4.6-5.1-7.6-7.8-11.6a136.6 136.6 0 0 1-13-23.3c-1.2-3.7.2-6.1 1.2-8.6-.6-.6-1.8-4.2-2.5-5.9 40.5-23.9 70.3-62 84.3-106l6.3 1c2.2-1.4 4.2-3.3 8.2-3 7.8 1.1 15.8 4 25.5 7.5 4.5 1.7 8 3.7 13 5 1.1.4 2.7.6 3.9.9h.3l.2.1c8.6 1.9 17-2.9 18.8-10.7 1.8-7.8-3.7-15.7-12.3-17.8l-4.3-1c-5-1-9.2-.7-14-1.1-10.2-1-18.7-2-26.2-4.3-3.1-1.2-5.3-4.9-6.3-6.4l-6-1.7a188.9 188.9 0 0 0-30.4-131.6l5.2-4.7c.2-2.6 0-5.3 2.7-8.2 5.8-5.4 13-10 21.8-15.3 4.1-2.5 8-4 12.1-7.1l3.2-2.6c7-5.6 8.7-15.3 3.6-21.6-5-6.3-14.8-6.9-21.8-1.3l-3.2 2.6c-4 3.4-6.4 6.7-9.7 10.2-7.2 7.3-13.2 13.5-19.7 17.9-2.8 1.6-7 1-8.9 1l-5.5 3.9a191.7 191.7 0 0 0-121.4-58.7l-.4-6.5c-1.9-1.8-4.2-3.4-4.8-7.3-.6-7.9.5-16.3 1.7-26.5.7-4.8 1.8-8.8 2-14v-4c0-9-6.6-16.3-14.7-16.3zm-18.3 113.5-4.3 76.7-.3.2a12.9 12.9 0 0 1-20.5 9.8l-.1.1-63-44.6a150.7 150.7 0 0 1 88.2-42.2zm36.7 0a152 152 0 0 1 87.6 42.2l-62.5 44.4-.2-.1a13 13 0 0 1-20.5-9.9zm-147.6 70.9 57.4 51.3v.4a12.9 12.9 0 0 1-5.1 22.1l-.1.3-73.6 21.2a150.6 150.6 0 0 1 21.4-95.3zm258.1 0a152.5 152.5 0 0 1 22 95l-74-21.2v-.4a12.9 12.9 0 0 1-5-22.1l-.1-.2 57.1-51.1zM356 513.7h23.5L394 532l-5.2 22.8-21.2 10.2-21.2-10.2-5.2-22.8zm75.4 62.6c1 0 2 0 3 .2v-.2l76.2 13a150.8 150.8 0 0 1-61 76.5l-29.5-71.4.1-.1a13 13 0 0 1 11.2-18zm-128 .3a12.9 12.9 0 0 1 11.7 18l.3.2-29.3 70.7a151.4 151.4 0 0 1-60.8-76l75.5-12.8.2.1a13 13 0 0 1 2.5-.2zm63.9 31a12.8 12.8 0 0 1 11.8 6.8h.3l37.2 67.2a154.3 154.3 0 0 1-97.4-.1l37.1-67.1a13 13 0 0 1 11-6.8z"
                        style="text-indent:0;text-align:start;line-height:normal;text-transform:none;block-progression:tb;marker:none;-inkscape-font-specification:Sans"
                        font-weight="400" color="#000" fill="#fff" stroke="#fff" stroke-width=".3" overflow="visible"
                        font-family="Sans" transform="translate(-6.3 -174.8)"/>
                </svg>
                <div>
                    <span class="text-lg font-bold text-gray-600">
                        Kubernetes ready
                    </span>
                    <p class="text-gray-500">Deploy Buggregator in your Kubernetes cluster to enhance debugging and
                        operational efficiency. Real-time data collection and error tracking from your pods help
                        maintain application reliability.</p>
                </div>
            </div>

            <div class="text-lg font-bold flex items-center gap-2 justify-center mt-5">
                <svg class="w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"
                     viewBox="0 0 122.9 122.9"><path fill="currentColor"
                                                     d="M34.4 68a7 7 0 0 1-1.8-6 7 7 0 0 1 1.7-3.6l.4-.3a7 7 0 0 1 9.6-.1l7.4 6.8 1.8 1.6L76 42.8a7 7 0 0 1 5-2.1 7.5 7.5 0 0 1 2.6.4 6.8 6.8 0 0 1 2.3 1.5l.1.1a7.1 7.1 0 0 1 2.1 4.9v.2a7.2 7.2 0 0 1-1 3.7 7 7 0 0 1-.9 1L59 81.1a6.8 6.8 0 0 1-4.8 2.2h-1.5a7.3 7.3 0 0 1-2.4-1h-.1l-1-.8L44 77c-3-2.6-7.2-6.4-9.7-9zm27-68a61.3 61.3 0 1 1 .2 122.7A61.3 61.3 0 0 1 61.4 0zM97 26a50 50 0 0 0-85.6 35.4A50 50 0 0 0 96.9 97a50 50 0 0 0 0-71z"/></svg>
                Full source code available
            </div>
        </div>
    </div>


    <hr>


    <div class="bg-white py-12">
        <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto my-12">
            <h3 class="text-3xl lg:text-5xl leading-none font-extrabold text-blue-800 tracking-tight mb-8">
                Buggregator Trap
            </h3>

            <p class="text-gray-500 font-medium mb-6">
                Buggregator Trap is a lightweight, standalone debugging tool designed to be integrated with PHP
                applications. It is distributed as a Composer package and includes a suite of utilities that
                significantly enhance the debugging capabilities traditionally available in PHP environments.
            </p>

            <div class="mb-6 flex">
                <span class="w-auto bg-gray-50 text-gray-800 font-semibold hover:text-gray-700 font-mono px-3 py-2 border border-gray-200 hover:border-blue-600 rounded-lg transition-colors duration-200">
                    composer require --dev buggregator/trap -W
                </span>
            </div>

            <a href="https://docs.buggregator.dev/trap/what-is-trap.html" target="_blank"
               class="border bg-blue-100 hover:bg-blue-200 font-bold text-blue-800 px-3 py-1 rounded-full">
                Read more
            </a>
        </div>
    </div>


    <hr>


    <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto py-12 mt-12">
        <div class="mb-48">
            <h2 class="text-3xl lg:text-5xl leading-none font-extrabold text-gray-800 tracking-tight mb-8 text-center">
                We are Buggregator developers
            </h2>

            <div class="flex flex-col md:flex-row space-y-5 md:space-y-0 md:space-x-5 justify-center">
                <a href="https://github.com/butschster" target="_blank"
                   class="flex flex-col items-center justify-start">
                    <div class="p-1 border-2 border-blue-400 rounded-full">
                        <img src="https://avatars.githubusercontent.com/u/773481?v=4"
                             class="w-16 h-16 rounded-full bg-blue-200" loading="lazy">
                    </div>
                    <div class="text-gray-900 text-xl font-medium">Pavel Buchnev</div>
                    <div class="text-blue-600 text-sm font-bold">Creator of Buggregator</div>
                </a>
                <a href="https://github.com/roxblnfk" target="_blank" class="flex flex-col items-center justify-start">
                    <div class="p-1 border-2 border-blue-400 rounded-full">
                        <img src="https://avatars.githubusercontent.com/u/4152481?v=4"
                             class="w-16 h-16 rounded-full bg-blue-200" loading="lazy">
                    </div>
                    <div class="text-gray-900 text-xl font-medium">Aleksei Gagarin</div>
                    <div class="text-blue-600 text-sm font-bold">PHP developer</div>
                </a>
                <a href="https://github.com/Kreezag" target="_blank" class="flex flex-col items-center justify-start">
                    <div class="p-1 border-2 border-blue-400 rounded-full">
                        <img src="https://avatars.githubusercontent.com/u/13301570?v=4" alt=""
                             class="w-16 h-16 rounded-full bg-blue-200" loading="lazy">
                    </div>
                    <div class="text-gray-900 text-xl font-medium">Andrey Kuchuk</div>
                    <div class="text-blue-600 text-sm font-bold">Frontend developer</div>
                </a>
            </div>
        </div>
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
                <div :class="deviceClass" class=" shadow-xl">
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
                const url = this.action === 'profiler:report' ? '/_profiler' : '/';
                fetch(url, {
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
            <button @click="callAction" type="button"
                    class="border rounded-full text-blue-600 md:py-1 md:px-3 px-2 lg:px-3 border-blue-400 hover:bg-blue-500 hover:text-white transition-all duration-300">
                <slot></slot>
            </button>
        `
    })

    new Vue({
        el: '#app',
    })
</script>
@endverbatim

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

@if(config('app.google_tagmanager'))
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{ config('app.google_tagmanager') }}"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', '{{ config('app.google_tagmanager') }}');
</script>
@endif
</body>
</html>
