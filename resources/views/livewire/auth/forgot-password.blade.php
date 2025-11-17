<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <x-auth-header 
            :title="'Esqueceu a senha'" 
            :description="'Digite seu e‑mail para receber um link de redefinição de senha'" 
        />

        <!-- Status da Sessão -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Endereço de E-mail -->
            <flux:input
                name="email"
                label="Email Institucional"
                type="email"
                required
                autofocus
                placeholder="email@example.com"
            />

            <flux:button variant="primary" type="submit" class="w-full" data-test="email-password-reset-link-button">
                Enviar link de redefinição de senha por e‑mail
            </flux:button>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-400">
            <span>Ou, voltar para</span>
            <flux:link :href="route('login')" wire:navigate>login</flux:link>
        </div>
    </div>
</x-layouts.auth>
