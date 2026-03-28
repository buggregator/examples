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
    @foreach($buttonGroups as $group => $data)
        <div class="border p-4 bg-white" id="{{ $group }}">
            <h3 class="md:text-xl leading-none font-bold text-blue-800 tracking-tight mb-4">
                {{ $data['title'] ?? \Illuminate\Support\Str::studly($group) }}
            </h3>

            @if(isset($data['description']))
                <p class="hidden md:block text-gray-500 text-sm font-medium mb-6">
                    {{ $data['description'] }}
                </p>
            @endif

            @if(isset($data['docs']))
                <div class="mb-8 flex gap-4 items-center">
                    <a href="{{ $data['docs'] }}" target="_blank"
                       class="border bg-blue-100 hover:bg-blue-200 font-bold text-xs text-blue-800 px-3 py-1 rounded-full">
                        Docs
                    </a>
                </div>
            @endif

            <div>
                @foreach($data['events'] as $type => $buttons)
                    @if($type !== 'common')
                        <h4 class="md:text-xl leading-none font-extrabold text-blue-600 tracking-tight mt-6 mb-4">
                            {{ \Illuminate\Support\Str::studly($type) }}
                        </h4>
                    @endif

                    <div class="overflow-hidden flex flex-wrap gap-2 md:gap-3 lg:gap-4 text-sm">
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
                    <div :class="deviceClass" class="shadow-xl md:rounded-xl">
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
