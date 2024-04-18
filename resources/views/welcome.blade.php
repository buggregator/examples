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
    <div class="bg-gray-900 text-gray-300 h-52">
        <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto px-5 md:px-8 lg:px-16 py-8">
            <header class="flex justify-between items-center">
                <a href="/">
                    <svg class="h-10 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 154 29" fill="currentColor" ><path d="M50.54 3.31h3.24v14.66l-.23 2.86h-3V3.3Zm9.77 10.94v.8c0 1.01-.08 1.89-.25 2.63-.15.75-.4 1.37-.73 1.87-.32.5-.74.88-1.25 1.13-.51.25-1.12.38-1.81.38-.63 0-1.17-.15-1.62-.44-.45-.3-.83-.7-1.13-1.22a7.89 7.89 0 0 1-.75-1.83c-.18-.71-.32-1.48-.4-2.32v-1.2c.07-.82.2-1.58.39-2.29.2-.7.44-1.32.74-1.83.3-.53.68-.93 1.13-1.22.46-.3 1-.45 1.61-.45.72 0 1.33.13 1.84.4.5.24.93.62 1.25 1.12.33.5.58 1.13.73 1.88.17.75.25 1.6.25 2.59Zm-3.24.8v-.8c0-.57-.03-1.06-.07-1.47a3.45 3.45 0 0 0-.26-1.03c-.12-.27-.3-.48-.53-.61a1.7 1.7 0 0 0-.9-.2c-.33 0-.6.06-.83.19-.23.12-.42.3-.58.54-.16.24-.27.52-.35.85-.07.32-.1.67-.12 1.06v2.15c.01.53.08.99.2 1.4.12.4.32.7.6.93.27.22.64.33 1.1.33.37 0 .67-.06.89-.18.22-.13.4-.32.52-.59.13-.26.22-.6.26-1.02.04-.43.07-.94.07-1.54ZM67.19 17.86V8.5h3.26v12.34h-3.07l-.2-2.97Zm.37-2.54.9-.02c0 .83-.08 1.6-.24 2.3-.16.7-.4 1.3-.73 1.83a3.6 3.6 0 0 1-1.22 1.2 3.9 3.9 0 0 1-3.15.17c-.42-.17-.79-.44-1.1-.8a4.09 4.09 0 0 1-.73-1.43 7.62 7.62 0 0 1-.26-2.1V8.48h3.27v8c0 .34.03.63.09.87s.15.43.25.58c.11.16.24.27.39.33.14.07.31.1.5.1.5 0 .9-.13 1.2-.4.3-.26.52-.62.64-1.08.13-.46.19-.98.19-1.57ZM78.23 8.5h2.95v12.33c0 1.12-.22 2.04-.66 2.76a3.83 3.83 0 0 1-1.82 1.58 6.67 6.67 0 0 1-5.47-.13 3.75 3.75 0 0 1-1.13-.78l1.1-2.21c.3.3.7.55 1.2.75.48.21.96.32 1.43.32.46 0 .84-.07 1.14-.22.3-.13.54-.37.7-.7.16-.34.24-.79.24-1.35v-9.5l.32-2.86Zm-7 6.6v-.83c0-1 .09-1.88.28-2.63.2-.75.47-1.38.84-1.88.36-.5.8-.88 1.33-1.12a4.15 4.15 0 0 1 1.8-.38c.68 0 1.26.15 1.72.45.46.29.84.7 1.13 1.22.3.52.52 1.14.67 1.86.16.71.29 1.5.37 2.35v1.18c-.08.8-.22 1.56-.42 2.26-.18.7-.43 1.3-.74 1.82-.3.52-.69.93-1.14 1.22-.45.3-.99.44-1.62.44a3.71 3.71 0 0 1-3.1-1.53 5.66 5.66 0 0 1-.84-1.87c-.2-.75-.29-1.6-.29-2.57Zm3.25-.83v.82c0 .58.04 1.08.1 1.5.09.4.2.75.36 1.01.15.26.35.45.59.58.25.12.54.19.87.19.47 0 .85-.11 1.13-.32.28-.22.5-.52.62-.9.14-.4.22-.84.23-1.34v-2.15c0-.42-.05-.8-.15-1.13a2.8 2.8 0 0 0-.36-.86 1.6 1.6 0 0 0-.6-.54c-.24-.13-.52-.2-.85-.2a1.58 1.58 0 0 0-1.46.8 3.4 3.4 0 0 0-.36 1.04 8.4 8.4 0 0 0-.12 1.5ZM89.03 8.5h2.94v12.33c0 1.12-.22 2.04-.66 2.76a3.83 3.83 0 0 1-1.82 1.58 6.67 6.67 0 0 1-5.47-.13 3.75 3.75 0 0 1-1.12-.78l1.1-2.21c.3.3.7.55 1.18.75.5.21.97.32 1.44.32.46 0 .84-.07 1.14-.22.31-.13.54-.37.7-.7.16-.34.24-.79.24-1.35v-9.5l.33-2.86ZM82 15.1v-.83c0-1 .1-1.88.3-2.63.19-.75.47-1.38.83-1.88s.8-.88 1.33-1.12a4.15 4.15 0 0 1 1.8-.38c.68 0 1.26.15 1.72.45.47.29.84.7 1.13 1.22.3.52.52 1.14.67 1.86.16.71.29 1.5.37 2.35v1.18c-.08.8-.22 1.56-.41 2.26-.19.7-.44 1.3-.75 1.82-.3.52-.69.93-1.14 1.22-.44.3-.99.44-1.62.44a3.71 3.71 0 0 1-3.1-1.53 5.66 5.66 0 0 1-.84-1.87c-.19-.75-.29-1.6-.29-2.57Zm3.27-.83v.82c0 .58.03 1.08.1 1.5.08.4.2.75.35 1.01.15.26.35.45.6.58.24.12.53.19.86.19.47 0 .85-.11 1.13-.32.28-.22.5-.52.62-.9.14-.4.22-.84.24-1.34v-2.15c-.01-.42-.06-.8-.15-1.13-.09-.34-.2-.62-.36-.86a1.6 1.6 0 0 0-.6-.54c-.25-.13-.53-.2-.86-.2a1.58 1.58 0 0 0-1.46.8 3.4 3.4 0 0 0-.36 1.04 8.4 8.4 0 0 0-.11 1.5ZM96.46 11.24v9.59h-3.25V8.49h3.07l.18 2.75Zm2.96-2.84-.04 3.18a2.27 2.27 0 0 0-2 .08c-.26.1-.47.27-.64.5-.16.2-.29.47-.37.79-.09.32-.14.68-.15 1.08l-.62-.23c0-.8.07-1.54.19-2.2.13-.68.32-1.27.58-1.76.26-.5.56-.9.92-1.17a2 2 0 0 1 1.23-.4c.15 0 .31 0 .49.04.17.02.31.05.41.09ZM104.72 21.06c-.86 0-1.62-.13-2.28-.4a4.53 4.53 0 0 1-2.72-2.9c-.24-.7-.36-1.5-.36-2.4v-1c0-1.01.12-1.89.35-2.64.23-.76.56-1.4.98-1.92.43-.51.95-.9 1.57-1.15a5.53 5.53 0 0 1 2.13-.39c.79 0 1.48.13 2.08.4.6.24 1.1.62 1.5 1.13.39.5.69 1.13.89 1.87.2.75.3 1.61.3 2.6v1.46h-8.42v-2.25h5.23v-.28c0-.5-.06-.92-.17-1.26-.1-.34-.27-.6-.5-.76a1.56 1.56 0 0 0-.94-.25c-.32 0-.6.06-.82.2-.23.12-.4.32-.53.6-.14.27-.23.63-.3 1.07-.06.43-.09.95-.09 1.56v1.02c0 .57.05 1.05.15 1.43.1.38.25.7.45.94.2.23.44.4.73.51a3.85 3.85 0 0 0 2.54-.15c.46-.2.86-.48 1.18-.83l1.3 1.94a5.11 5.11 0 0 1-2.34 1.57c-.55.19-1.19.28-1.9.28ZM116.46 8.5h2.95v12.33c0 1.12-.23 2.04-.67 2.76a3.83 3.83 0 0 1-1.82 1.58 6.68 6.68 0 0 1-5.47-.13 3.74 3.74 0 0 1-1.12-.78l1.1-2.21c.3.3.7.55 1.18.75.5.21.97.32 1.44.32.46 0 .84-.07 1.14-.22.31-.13.54-.37.7-.7.16-.34.24-.79.24-1.35v-9.5l.33-2.86Zm-7.02 6.6v-.83c0-1 .1-1.88.3-2.63.19-.75.47-1.38.83-1.88s.8-.88 1.34-1.12a4.15 4.15 0 0 1 1.78-.38c.7 0 1.27.15 1.73.45.47.29.84.7 1.13 1.22.3.52.52 1.14.67 1.86.17.71.29 1.5.37 2.35v1.18c-.08.8-.22 1.56-.41 2.26-.19.7-.44 1.3-.75 1.82-.3.52-.69.93-1.14 1.22-.44.3-.98.44-1.62.44a3.72 3.72 0 0 1-3.1-1.53 5.69 5.69 0 0 1-.84-1.87c-.19-.75-.29-1.6-.29-2.57Zm3.27-.83v.82c0 .58.03 1.08.1 1.5.08.4.2.75.35 1.01.15.26.35.45.6.58.24.12.53.19.86.19.47 0 .85-.11 1.13-.32.28-.22.5-.52.63-.9.13-.4.21-.84.23-1.34v-2.15c-.01-.42-.06-.8-.15-1.13a2.8 2.8 0 0 0-.36-.86 1.59 1.59 0 0 0-.6-.54c-.25-.13-.53-.2-.86-.2a1.58 1.58 0 0 0-1.46.8c-.15.27-.27.61-.36 1.04-.07.42-.11.92-.11 1.5ZM126.18 17.99v-5.7c0-.37-.05-.67-.14-.9a.89.89 0 0 0-.4-.47c-.16-.1-.37-.16-.62-.16-.28 0-.51.06-.7.17-.18.12-.32.28-.41.5-.09.2-.13.46-.13.76h-3.27a3.67 3.67 0 0 1 1.24-2.76c.4-.37.9-.65 1.46-.86.56-.2 1.2-.3 1.9-.3.84 0 1.58.13 2.23.41a3.3 3.3 0 0 1 1.54 1.32c.38.6.57 1.38.57 2.33v5.5c0 .7.04 1.25.1 1.69.09.43.2.8.34 1.11v.2h-3.27a5.26 5.26 0 0 1-.34-1.28c-.06-.52-.1-1.04-.1-1.56Zm.4-4.7v1.92h-1.19c-.3 0-.58.05-.81.15a1.74 1.74 0 0 0-.92 1.04 2.63 2.63 0 0 0 .02 1.5c.09.2.22.36.39.47.17.1.37.16.6.16.36 0 .67-.08.93-.22.26-.15.46-.32.58-.53.13-.2.17-.4.13-.57l.74 1.25c-.1.28-.22.57-.38.87-.16.3-.35.59-.6.85-.23.26-.53.47-.89.64a3.79 3.79 0 0 1-3.09-.22 3.42 3.42 0 0 1-1.8-3.23c0-.62.1-1.18.3-1.68.22-.51.52-.94.94-1.3.4-.35.92-.62 1.55-.81a7.63 7.63 0 0 1 2.2-.29h1.3ZM136.15 8.5v2.4h-6.41V8.5h6.4Zm-4.94-3.05h3.24v11.62c0 .34.04.6.1.78a.7.7 0 0 0 .32.39c.15.07.34.1.58.1.16 0 .31 0 .45-.02s.25-.05.32-.07v2.5a4.58 4.58 0 0 1-1.81.3 3.7 3.7 0 0 1-1.7-.36 2.5 2.5 0 0 1-1.1-1.16 4.87 4.87 0 0 1-.4-2.12V5.45ZM136.05 15.08v-.83c0-.97.12-1.82.35-2.57.24-.74.58-1.36 1.02-1.87.44-.5.97-.89 1.6-1.15.62-.26 1.32-.4 2.1-.4.77 0 1.47.14 2.1.4.62.26 1.15.64 1.6 1.15.44.5.79 1.13 1.03 1.87.24.75.36 1.6.36 2.57v.83c0 .96-.12 1.81-.36 2.56a5.23 5.23 0 0 1-1.03 1.88c-.45.5-.98.89-1.6 1.15-.61.26-1.31.39-2.09.39-.77 0-1.47-.13-2.1-.4a4.34 4.34 0 0 1-1.6-1.14c-.45-.51-.8-1.14-1.03-1.88a8.59 8.59 0 0 1-.35-2.56Zm3.25-.83v.83c0 .57.04 1.07.12 1.48.08.42.2.77.36 1.04.16.28.35.48.58.6.22.14.48.2.77.2a1.45 1.45 0 0 0 1.36-.8c.16-.27.27-.62.34-1.04.08-.41.12-.9.12-1.48v-.83a7.4 7.4 0 0 0-.13-1.46 3.4 3.4 0 0 0-.36-1.04 1.61 1.61 0 0 0-.58-.61 1.38 1.38 0 0 0-.77-.22c-.28 0-.54.07-.76.22-.22.13-.41.34-.57.61a3.4 3.4 0 0 0-.36 1.04c-.08.42-.12.9-.12 1.46ZM150.32 11.24v9.59h-3.25V8.49h3.07l.19 2.75Zm2.97-2.84-.05 3.18a2.27 2.27 0 0 0-2 .08c-.25.1-.47.27-.64.5-.16.2-.28.47-.37.79-.08.32-.13.68-.15 1.08l-.61-.23c0-.8.06-1.54.18-2.2.13-.68.33-1.27.58-1.76.26-.5.56-.9.92-1.17a2 2 0 0 1 1.23-.4c.16 0 .32 0 .49.04.18.02.31.05.42.09ZM8.46 0l.58 1.68c-1.18.37-2 1.02-2.44 1.97-.45.93-.67 2-.67 3.22v3.06c0 .98-.2 1.88-.61 2.69-.4.8-1.03 1.43-1.9 1.9-.87.47-2.01.71-3.42.71v-1.8c1.12 0 1.93-.32 2.41-.95.5-.63.75-1.48.75-2.55V6.87c0-1.03.16-2 .47-2.9.33-.9.88-1.7 1.64-2.37A7.9 7.9 0 0 1 8.47 0Zm.58 27.3L8.46 29a8.16 8.16 0 0 1-3.19-1.6 5.78 5.78 0 0 1-1.64-2.37 8.6 8.6 0 0 1-.47-2.9v-3.04c0-.72-.11-1.34-.33-1.86A2.52 2.52 0 0 0 1.8 16a3.27 3.27 0 0 0-1.8-.44v-1.8a7.1 7.1 0 0 1 3.41.7 4.36 4.36 0 0 1 1.9 1.93c.42.8.62 1.7.62 2.69v3.04c0 .8.1 1.56.28 2.25a4.06 4.06 0 0 0 2.83 2.93ZM32.39 1.68 32.97 0c1.36.37 2.42.9 3.19 1.6a5.6 5.6 0 0 1 1.63 2.37c.32.9.48 1.87.48 2.9v3.06c0 .7.11 1.33.33 1.86.22.52.55.92 1.01 1.21.47.29 1.07.43 1.82.43v1.67c-1.4 0-2.54-.22-3.41-.67a4.35 4.35 0 0 1-1.92-1.84c-.4-.8-.6-1.68-.6-2.66V6.87c0-.8-.1-1.56-.28-2.25a4.3 4.3 0 0 0-.97-1.8 3.95 3.95 0 0 0-1.86-1.14ZM32.97 29l-.58-1.7c.78-.25 1.4-.62 1.84-1.14.46-.5.78-1.1.97-1.78.2-.7.3-1.44.3-2.25v-3.04c0-1 .2-1.88.6-2.66a4.27 4.27 0 0 1 1.92-1.83 7.41 7.41 0 0 1 3.4-.68v1.65c-1.1 0-1.9.32-2.4.96-.5.63-.75 1.48-.75 2.56v3.04c0 1.03-.16 2-.48 2.9a5.6 5.6 0 0 1-1.63 2.37 8.02 8.02 0 0 1-3.2 1.6Z" fill="#fff"/><path fill-rule="evenodd" clip-rule="evenodd" d="M13.86 8.6a6.11 6.11 0 0 1 12.23 0v.36l.05.02 2.02-2.28a.74.74 0 0 1 1.1.99l-1.93 2.18c.55.63.87 1.46.85 2.36l-.06 1.81c0 .35-.03.7-.06 1.05h2.69a.74.74 0 1 1 0 1.48h-2.92a14.8 14.8 0 0 1-1.26 3.67l-.6 1.2-.15.27 2.68 2.72a.74.74 0 1 1-1.06 1.03l-2.49-2.53a6.83 6.83 0 0 1-10.5-.39l-2.68 2.64a.74.74 0 0 1-1.04-1.05l2.94-2.89a5.38 5.38 0 0 1-.03-.07l-.8-1.76a14.8 14.8 0 0 1-.93-2.84H9.03a.74.74 0 1 1 0-1.48h2.63c-.04-.28-.06-.56-.08-.85l-.11-1.9c-.06-.9.24-1.75.77-2.4L10.2 7.76a.74.74 0 1 1 1.08-1.01l2.13 2.27c.14-.07.3-.13.45-.18V8.6Zm10.02 0v.08h-7.81V8.6a3.9 3.9 0 0 1 7.81 0Zm.84 2.28h-9.8c-.72 0-1.3.6-1.25 1.32l.11 1.91c.1 1.52.46 3 1.08 4.4l.8 1.76a4.62 4.62 0 0 0 8.33.18l.6-1.2a12.6 12.6 0 0 0 1.33-5.27l.05-1.81c.02-.7-.55-1.29-1.25-1.29Z"/><path fill="currentColor" d="M22.45 12.65c.32-.3.83-.3 1.15 0a.7.7 0 0 1 0 1.05l-2.57 2.37 2.76 2.54a.7.7 0 0 1 0 1.06c-.31.29-.83.29-1.14 0l-2.76-2.55-2.76 2.55c-.32.29-.83.29-1.15 0a.7.7 0 0 1 0-1.06l2.76-2.54-2.57-2.37a.7.7 0 0 1 0-1.05c.32-.3.83-.3 1.15 0L19.89 15l2.56-2.36Z" /></svg>
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
        <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto flex flex-col items-center bg-white -mt-24 rounded-xl shadow-2xl py-16">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl leading-none font-extrabold tracking-tight mb-4 text-center">
                <span class="text-black">Buggregator</span> <br> <small class="text-blue-800">The Ultimate Debugging
                    Server for PHP</small>
            </h1>

            <p class="text-lg text-gray-500 mb-10 sm:mb-11 text-center w-2/3 xl:w-1/2">
                Buggregator is a free Swiss Army knife for developers. What makes it special is that it offers a range
                of features that you would usually find in various paid tools, but it's available for free.
            </p>

            <div class="flex items-center justify-center gap-x-6 lg:justify-start mb-8">
                <a href="#demo" class="rounded-md bg-blue-800 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">Try demo</a>
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
                <h3 class="text-xl leading-none font-bold text-blue-800 tracking-tight mb-4">
                    {{ $data['title'] ?? \Illuminate\Support\Str::studly($group) }}
                </h3>

                @if(isset($data['description']))
                <p class="text-gray-500 text-sm font-medium mb-6">
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
                    <h4 class="text-xl leading-none font-extrabold text-blue-600 tracking-tight mt-6 mb-4">
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


    <div class="bg-gray-900 py-20 mt-24">
        <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto">
            <h3 class="text-3xl lg:text-5xl leading-none font-extrabold text-yellow-200 tracking-tight mb-8">
                How to run?
            </h3>

            <p class="text-gray-200 font-medium mb-6 text-xl">
                Getting Buggregator up and running is super simple! Just make sure Docker is installed on your server. Then, run this command in your terminal:
            </p>

            <div class="mb-10 flex">
                <code class="select-all cursor-pointer w-auto bg-gray-50 text-gray-800 font-semibold hover:text-gray-700 font-mono px-3 py-2 border border-gray-200 hover:border-blue-600 rounded-full transition-colors duration-200">
                    docker run -p 8000:8000 -p 1025:1025 -p 9912:9912 -p 9913:9913 ghcr.io/buggregator/server:latest
                </code>
            </div>

            <a href="https://docs.buggregator.dev/getting-started.html" target="_blank"
               class="border bg-gray-100 hover:bg-gary-200 font-bold text-gary-800 px-5 py-2 rounded-full">
                Read more
            </a>
        </div>
    </div>

    <hr>

    <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto py-10 my-12">
        <div>
            <h3 class="text-3xl lg:text-5xl leading-none font-extrabold text-blue-800 tracking-tight mb-8">
                Features
            </h3>


            <div class="border p-8 rounded-lg flex flex-col gap-4 hover:shadow-xl transition mb-6 bg-[url('/images/bg.jpg')]">
                <div>
                    <a href="https://docs.buggregator.dev/config/sso.html" target="_blank"
                       class="text-2xl font-bold text-white">
                        Seamless Integration
                    </a>
                    <p class="text-gray-100 mb-6 text-lg">
                        Easily integrate Buggregator with the libraries you already use, like Ray and Symfony/VarDumper, without any additional installations. Just configure your server address, and you're ready to go. Our aim is to offer a server that aggregates data from your preferred libraries conveniently in one place.
                    </p>
                </div>
                <div>
                    <img src="/images/clients.png" />
                </div>
            </div>

            <div class="flex gap-6">
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
                        <p class="text-gray-500 mb-6">Securely manage user access and authentication through Single
                            Sign-On (SSO) with providers like <a href="https://auth0.com/" class="text-blue-700 underline">Auth0</a>.
                        </p>
                        <a href="https://docs.buggregator.dev/config/sso.html" target="_blank"
                           class="border bg-purple-100 hover:bg-purple-200 font-bold text-purple-800 px-5 py-2 rounded-full">
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
                        <p class="text-gray-500 mb-6">Configure Buggregator to use external databases like MongoDB or
                            PostgreSQL for event storage. This flexibility allows you to scale storage according to your
                            project needs.</p>

                        <a href="https://docs.buggregator.dev/config/external-db.html" target="_blank"
                           class="border bg-green-100 hover:bg-green-200 font-bold text-green-800 px-5 py-2 rounded-full">
                            Read more
                        </a>
                    </div>
                </div>
            </div>

            <div class="border p-8 rounded-lg bg-blue-50 w-full flex flex-col gap-4 mt-6 hover:shadow-xl transition">
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
                    <p class="text-blue-800">Deploy Buggregator in your Kubernetes cluster to enhance debugging and
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
                <code class="select-all cursor-pointer w-auto bg-gray-50 text-gray-800 font-semibold hover:text-gray-700 font-mono px-3 py-2 border border-gray-200 hover:border-blue-600 rounded-full transition-colors duration-200">
                    composer require --dev buggregator/trap -W
                </code>
            </div>

            <a href="https://docs.buggregator.dev/trap/what-is-trap.html" target="_blank"
               class="border bg-blue-100 hover:bg-blue-200 font-bold text-blue-800 px-5 py-2 rounded-full">
                Read more
            </a>
        </div>
    </div>


    <hr>


    <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto py-12 my-12">
        <div>
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


    <hr>


    <div class="py-12 bg-gray-900 text-center">
        <a href="https://www.jetbrains.com/phpstorm/" class="inline-flex justify-center items-center gap-6">
            <span class="text-lg text-gray-400 text-right">Developed with <br>love and</span>
            <img
                class="w-14"
                src="https://resources.jetbrains.com/storage/products/company/brand/logos/PhpStorm_icon.png" alt="PhpStorm logo."
            >
        </a>
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
