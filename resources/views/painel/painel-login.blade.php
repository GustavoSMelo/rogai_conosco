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

<div class="painel-page-body painel-login-body">
    <div class="painel-login-box">
        <div class="painel-login-header">
            <a href="{{ route('welcome') }}" class="painel-brand-link-lg">
                <img src="{{ asset('images/ovelhinha.png') }}" alt="" class="painel-brand-logo-lg">
                <span class="painel-brand-text-xl">Rogai Conosco</span>
            </a>
        </div>

        <div class="painel-login-card">
            <h1 class="painel-login-title">Acesso Restrito</h1>
            <p class="painel-login-subtitle">Digite a senha para continuar.</p>

            <form class="painel-form">
                <div>
                    <label for="password" class="painel-form-label">Senha</label>
                    <input
                        type="password"
                        id="password"
                        wire:model="password"
                        wire:keydown.enter="login"
                        autocomplete="current-password"
                        class="painel-form-input"
                    >

                @if ($error)
                    <p class="painel-form-error">{{ $error }}</p>
                @endif

                <button
                    type="button"
                    wire:click="login"
                    class="painel-btn-primary-lg"
                >
                    Entrar
                </button>
            </form>
        </div>
        </div>

        <p class="painel-login-footer">
            <a href="{{ route('welcome') }}" class="painel-footer-link">
                Voltar ao início
            </a>
        </p>
    </div>

    @vite('resources/css/painel.css')
</div>
