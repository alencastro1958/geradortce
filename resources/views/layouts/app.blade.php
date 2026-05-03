<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="{{ asset('js/cnpj-lookup.js') }}" defer></script>

        <!-- Máscara global de telefone: (xx) x xxxxx-xxxx -->
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            var phoneSelector = [
                'input[name*="telefone"]',
                'input[name*="celular"]',
                'input[name*="whatsapp"]',
                'input[name$="fone"]'
            ].join(', ');

            function applyPhoneMask(value) {
                var digits = value.replace(/\D/g, '').slice(0, 12);
                var len = digits.length;
                if (len === 0) return '';
                var r = '(' + digits.slice(0, Math.min(2, len));
                if (len <= 2) return r;
                r += ') ' + digits.slice(2, 3);
                if (len <= 3) return r;
                r += ' ' + digits.slice(3, Math.min(8, len));
                if (len <= 8) return r;
                r += '-' + digits.slice(8, 12);
                return r;
            }

            function initPhoneFields(root) {
                (root || document).querySelectorAll(phoneSelector).forEach(function (input) {
                    if (input.dataset.phoneMasked) return;
                    input.dataset.phoneMasked = '1';
                    if (input.value) input.value = applyPhoneMask(input.value);
                    input.placeholder = '(00) 0 00000-0000';
                    input.setAttribute('maxlength', '17');
                    input.addEventListener('input', function () {
                        this.value = applyPhoneMask(this.value);
                    });
                });
            }

            initPhoneFields();

            // Re-aplica quando Alpine.js renderiza conteúdo dinâmico
            document.addEventListener('alpine:initialized', function () { initPhoneFields(); });

            // MutationObserver para campos adicionados dinamicamente (ex: modais, Alpine x-if)
            var observer = new MutationObserver(function (mutations) {
                mutations.forEach(function (m) {
                    m.addedNodes.forEach(function (node) {
                        if (node.nodeType === 1) initPhoneFields(node);
                    });
                });
            });
            observer.observe(document.body, { childList: true, subtree: true });
        });
        </script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
