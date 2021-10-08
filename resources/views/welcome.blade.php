<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <title>Buggregator test console</title>
</head>
<body class="p-5">
<div id="app" class="grid grid-cols-2 gap-4">
    @foreach($buttonGroups as $group => $buttons)
        <div class="p-4 border rounded-lg mb-4">
            <h3 class="text-lg font-bold mb-3">{{ \Illuminate\Support\Str::studly($group) }}</h3>

            <div class="flex flex-wrap gap-4 text-sm">
                @foreach($buttons as $button)
                    <button-action
                        action="{{ $group.':'.\Illuminate\Support\Str::snake($button) }}">{{ $button }}</button-action>
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
            template: '<button @click="callAction" type="button" class="border rounded-full py-1 px-3 bg-gray-50 hover:bg-blue-500 hover:text-white transition-all duration-300"><slot></slot></button>'


        })

        new Vue({
            el: '#app',
        })
    </script>
@endverbatim

</body>
</html>
