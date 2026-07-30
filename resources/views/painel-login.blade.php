<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;

new #[Layout('layouts::app')] #[Title('Rogai Conosco — Acesso Restrito')] class extends Component {
    public string $password = '';
    public ?string $error = null;

    public function login(): void
    {
        $this->error = null;

        if (blank($this->password)) {
            $this->error = 'Digite a senha de acesso.';
            return;
        }

        $stored = config('app.dashboard_password') ?: env('DASHBOARD_PASSWORD');

        if (blank($stored)) {
            $this->error = 'Senha não configurada.';
            return;
        }

        try {
            $decrypted = Crypt::decryptString($stored);
        } catch (\Exception) {
            $this->error = 'Erro ao verificar senha.';
            return;
        }

        if (!hash_equals($decrypted, $this->password)) {
            $this->error = 'Senha incorreta.';
            return;
        }

        session()->put('dashboard_authenticated', true);

        $this->redirect(route('painel.dashboard'));
    }

    public function render()
    {
        return $this->view();
    }
};

?>

<div class="painel-page-body flex min-h-screen flex-col items-center justify-center px-6">
    <div class="w-full max-w-sm">
        <div class="text-center mb-10">
            <a href="{{ route('welcome') }}" class="inline-flex items-center gap-3 no-underline">
                <img src="{{ asset('images/ovelhinha.png') }}" alt="" class="h-10 w-10 object-contain opacity-85">
                <span class="font-serif text-xl text-brand-primary">Rogai Conosco</span>
            </a>
        </div>

        <div class="rounded-sm bg-white p-8 shadow-sm">
            <h1 class="font-serif text-xl text-brand-ink text-center mb-1">Acesso Restrito</h1>
            <p class="text-sm text-brand-muted text-center mb-8">Digite a senha para continuar.</p>

            <form class="space-y-5">
                <div>
                    <label for="password" class="block text-sm font-medium text-brand-ink mb-2">Senha</label>
                    <input
                        type="password"
                        id="password"
                        wire:model="password"
                        wire:keydown.enter="login"
                        autocomplete="current-password"
                        class="mt-1 block w-full rounded-sm border border-brand-primary/30 bg-white px-4 py-3 text-brand-ink placeholder:text-brand-muted/60 focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                    >

                @if ($error)
                    <p class="text-sm text-brand-accent">{{ $error }}</p>
                @endif

                <button
                    type="button"
                    wire:click="login"
                    class="w-full mt-6 rounded-[5px] bg-brand-primary px-6 py-3 font-medium text-white transition-all duration-150 hover:shadow-md"
                >
                    Entrar
                </button>
            </form>
        </div>

        <p class="text-center mt-8">
            <a href="{{ route('welcome') }}" class="text-sm text-brand-primary no-underline transition-colors duration-150 hover:text-brand-accent">
                Voltar ao início
            </a>
        </p>
    </div>

    @vite('resources/css/painel.css')
</div>
