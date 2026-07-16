<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Rogai Conosco</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#0f0a1a] text-white">
        <div class="relative min-h-screen flex flex-col">
            <div class="absolute inset-0 bg-gradient-to-br from-[#1a1040] via-[#0f0a1a] to-[#0a0510]"></div>
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_rgba(120,80,200,0.15)_0%,_transparent_70%)]"></div>

            <header class="relative z-10">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between py-6">
                        <div class="flex items-center gap-3">
                            <svg class="h-8 w-8 text-[#c084fc]" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                            </svg>
                        </div>

                        <livewire:welcome.navigation />
                    </div>
                </div>
            </header>

            <main class="relative z-10 flex-1 flex flex-col">
                <section class="flex-1 flex flex-col items-center justify-center px-4 py-20 text-center">
                    <div class="animate-brand-reveal max-w-3xl">
                        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold tracking-tight">
                            <span class="bg-gradient-to-r from-[#c084fc] to-[#e879f9] bg-clip-text text-transparent">Rogai Conosco</span>
                        </h1>
                        <p class="mt-6 text-lg sm:text-xl text-[#a1a1aa] max-w-xl mx-auto leading-relaxed">
                            Sua intenção de oração, acolhida com fé. Enviamos sua prece de três formas especiais.
                        </p>
                    </div>

                    <div class="mt-16 grid gap-6 sm:grid-cols-3 max-w-4xl mx-auto w-full px-4">
                        <div class="group relative rounded-2xl bg-white/5 border border-white/10 p-8 text-center transition-all duration-300 hover:bg-white/[0.08] hover:border-[#c084fc]/30 hover:-translate-y-1">
                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-xl bg-[#c084fc]/10 text-[#c084fc] mb-5">
                                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 0 1-3-3V4.5a3 3 0 1 1 6 0v8.25a3 3 0 0 1-3 3Z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-white">Oração Gravada</h3>
                            <p class="mt-3 text-sm text-[#a1a1aa] leading-relaxed">
                                Receba uma oração personalizada em áudio ou vídeo, entregue por WhatsApp ou e-mail em até 48h.
                            </p>
                        </div>

                        <div class="group relative rounded-2xl bg-white/5 border border-white/10 p-8 text-center transition-all duration-300 hover:bg-white/[0.08] hover:border-[#c084fc]/30 hover:-translate-y-1">
                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-xl bg-[#c084fc]/10 text-[#c084fc] mb-5">
                                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-white">Oração Instantânea</h3>
                            <p class="mt-3 text-sm text-[#a1a1aa] leading-relaxed">
                                Escolha entre orações bíblicas cuidadosamente selecionadas para cada momento da sua vida.
                            </p>
                        </div>

                        <div class="group relative rounded-2xl bg-white/5 border border-white/10 p-8 text-center transition-all duration-300 hover:bg-white/[0.08] hover:border-[#c084fc]/30 hover:-translate-y-1">
                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-xl bg-[#c084fc]/10 text-[#c084fc] mb-5">
                                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 0 0-2.455 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-white">Oração por IA</h3>
                            <p class="mt-3 text-sm text-[#a1a1aa] leading-relaxed">
                                Uma oração única gerada por inteligência artificial, baseada nas suas palavras e sentimentos.
                            </p>
                        </div>
                    </div>

                    <div class="mt-12 animate-fade-in">
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-[#c084fc] to-[#a855f7] px-8 py-3.5 text-sm font-semibold text-white shadow-lg shadow-[#c084fc]/25 transition-all duration-300 hover:shadow-[#c084fc]/40 hover:scale-105">
                            Fazer Pedido de Oração
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>
                </section>
            </main>

            <footer class="relative z-10 border-t border-white/5 py-8">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <p class="text-center text-sm text-[#71717a]">
                        Rogai Conosco &mdash; {{ Illuminate\Foundation\Application::VERSION }}
                    </p>
                </div>
            </footer>
        </div>
    </body>
</html>
