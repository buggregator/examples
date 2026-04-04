<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"DM Sans"', 'system-ui', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace']
                    },
                    colors: {
                        purple: tailwind.colors.indigo
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/site.webmanifest">

    <title>Buggregator Examples</title>
    <style>
        body { font-feature-settings: 'cv02', 'cv03', 'cv04', 'cv11'; }
        .btn-action {
            transition: all 0.15s ease;
        }
        .btn-action:active {
            transform: scale(0.97);
        }
        .group-card {
            border-left: 2px solid transparent;
            transition: border-color 0.2s ease;
        }
        .group-card:hover {
            border-left-color: rgb(99 102 241);
        }
    </style>
</head>
<body class="bg-gray-950 text-gray-200 min-h-screen antialiased">
<div id="app" class="max-w-5xl mx-auto px-4 py-8">
    <header class="mb-10">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-8 h-8 bg-indigo-600 rounded flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
            </div>
            <h1 class="text-xl font-bold text-white tracking-tight">Buggregator</h1>
            <span class="text-xs font-mono text-gray-500 bg-gray-800 px-2 py-0.5 rounded">examples</span>
        </div>
        <p class="text-sm text-gray-500">Trigger debug events to see them captured in real time.</p>
    </header>

    @foreach($buttonGroups as $group => $data)
        <div class="group-card bg-gray-900 border border-gray-800 mb-3 px-5 py-4" id="{{ $group }}">
            <h3 class="text-sm font-semibold text-gray-300 uppercase tracking-wider mb-3">
                {{ $data['title'] ?? \Illuminate\Support\Str::studly($group) }}
            </h3>

            @if(isset($data['description']) && $data['description'] !== '-')
                <p class="text-xs text-gray-500 mb-3">{{ $data['description'] }}</p>
            @endif

            <div>
                @foreach($data['events'] as $type => $buttons)
                    @if($type !== 'common')
                        <div class="text-xs font-medium text-indigo-400 tracking-wide mt-4 mb-2 font-mono">
                            {{ \Illuminate\Support\Str::studly($type) }}
                        </div>
                    @endif

                    <div class="flex flex-wrap gap-1.5">
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
        Vue.component('button-action', {
            props: {
                action: String
            },
            data() {
                return { loading: false, done: false }
            },
            methods: {
                callAction() {
                    if (this.loading) return;
                    this.loading = true;
                    this.done = false;
                    const url = this.action === 'profiler:report' ? '/_profiler' : '/';
                    fetch(url, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({action: this.action})
                    })
                    .then(() => {
                        this.done = true;
                        setTimeout(() => { this.done = false }, 1500);
                    })
                    .catch(() => {})
                    .finally(() => { this.loading = false });
                }
            },
            template: `
                <button @click="callAction" type="button"
                        :class="[
                            'btn-action inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1 border transition-colors',
                            done
                                ? 'bg-emerald-950 border-emerald-700 text-emerald-300'
                                : 'bg-gray-800 border-gray-700 text-gray-300 hover:bg-gray-750 hover:border-indigo-600 hover:text-indigo-300',
                            loading ? 'opacity-60 cursor-wait' : 'cursor-pointer'
                        ]">
                    <svg v-if="done" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    <slot></slot>
                </button>
            `
        })

        new Vue({ el: '#app' })
    </script>
@endverbatim

@if(config('app.google_tagmanager'))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('app.google_tagmanager') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', '{{ config('app.google_tagmanager') }}');
    </script>
@endif
</body>
</html>
