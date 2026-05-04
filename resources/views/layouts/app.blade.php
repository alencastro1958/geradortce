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

                // Constrói prefixo DDD
                var r = '(' + digits.slice(0, Math.min(2, len));
                if (len <= 2) return r;
                r += ') ';

                if (len <= 10) {
                    // 10 dígitos: (xx) xxxx-xxxx
                    r += digits.slice(2, Math.min(6, len));
                    if (len > 6) r += '-' + digits.slice(6, 10);
                } else if (len === 11) {
                    // 11 dígitos: (xx) x xxxx-xxxx
                    r += digits.slice(2, 3);
                    r += ' ' + digits.slice(3, Math.min(7, len));
                    if (len > 7) r += '-' + digits.slice(7, 11);
                } else {
                    // 12 dígitos: (xx) xx xxxx-xxxx
                    r += digits.slice(2, 4);
                    r += ' ' + digits.slice(4, Math.min(8, len));
                    if (len > 8) r += '-' + digits.slice(8, 12);
                }
                return r;
            }

            function initPhoneFields(root) {
                (root || document).querySelectorAll(phoneSelector).forEach(function (input) {
                    if (input.dataset.phoneMasked) return;
                    input.dataset.phoneMasked = '1';
                    if (input.value) input.value = applyPhoneMask(input.value);
                    input.placeholder = '(00) 0000-0000 / (00) 0 0000-0000';
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

        <!-- Formatação automática de capitalização nos campos de texto -->
        <script>
        (function () {
            // Campos que devem sempre ficar em MAIÚSCULAS (por name attribute)
            var upperByName = ['razao_social', 'nome_fantasia', 'responsavel_legal_nome'];

            // Padrões de campos telefône/fone que não devem ser alterados
            var phonePatterns = ['telefone', 'celular', 'whatsapp', 'fone'];

            function isPhoneField(input) {
                var n = (input.name || '').toLowerCase();
                return phonePatterns.some(function (p) { return n.indexOf(p) !== -1; });
            }

            function isUpperField(input) {
                return input.dataset.case === 'upper' || upperByName.indexOf(input.name) !== -1;
            }

            function toTitleCase(str) {
                if (!str) return str;
                return str.toLowerCase().replace(/(?:^|[\s\-\/\\(])\S/g, function (c) { return c.toUpperCase(); });
            }

            function initCaseField(input) {
                if (input.dataset.caseMasked) return;
                var type = (input.type || 'text').toLowerCase();
                var skipTypes = ['email', 'date', 'number', 'hidden', 'password', 'checkbox', 'radio', 'file', 'tel', 'submit', 'button', 'reset', 'search'];
                if (skipTypes.indexOf(type) !== -1) return;
                if (isPhoneField(input) || input.dataset.phoneMasked) return;

                input.dataset.caseMasked = '1';
                var upper = isUpperField(input);

                // Converte valor já existente ao carregar a página
                if (input.value) {
                    input.value = upper ? input.value.toUpperCase() : toTitleCase(input.value);
                }

                if (upper) {
                    // Uppercase: converte a cada tecla
                    input.addEventListener('input', function () {
                        var pos = this.selectionStart;
                        this.value = this.value.toUpperCase();
                        try { this.setSelectionRange(pos, pos); } catch (e) {}
                    });
                } else {
                    // Title case: converte ao sair do campo (menos intrusivo ao digitar)
                    input.addEventListener('blur', function () {
                        if (this.value) this.value = toTitleCase(this.value);
                    });
                }
            }

            function initCaseFields(root) {
                var container = root || document;
                container.querySelectorAll('input, textarea').forEach(function (el) {
                    initCaseField(el);
                });
            }

            document.addEventListener('DOMContentLoaded', function () {
                // Pequeno delay para garantir que as máscaras de telefone já rodaram
                setTimeout(function () { initCaseFields(); }, 10);

                document.addEventListener('alpine:initialized', function () {
                    setTimeout(function () { initCaseFields(); }, 10);
                });

                var caseObserver = new MutationObserver(function (mutations) {
                    mutations.forEach(function (m) {
                        m.addedNodes.forEach(function (node) {
                            if (node.nodeType === 1) {
                                setTimeout(function () { initCaseFields(node); }, 10);
                            }
                        });
                    });
                });
                caseObserver.observe(document.body, { childList: true, subtree: true });
            });
        })();
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
