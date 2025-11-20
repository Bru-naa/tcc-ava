<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <x-auth-header 
            :title="__('Seja bem-vindo(a)')" 
            :description="__('Preencha todos os campos abaixo, para realizar o seu cadastro')" 
        />

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Nome -->
            <flux:input
                name="username"
                :label="__('Nome*')"
                type="text"
                required
                autofocus
                autocomplete="name"
                :placeholder="__('Digite seu nome completo...')"
            />

            <!-- Email -->
            <div class="relative w-full max-w-lg">
                <flux:input
                    name="email"
                    x-model="email"
                    :label="__('Email educacional:')"
                    type="email"
                    required
                    autocomplete="email"
                    placeholder="email@example.com"
                    class="pr-10"
                    id="email"
                    aria-describedby="email-help"
                    regexp="^[a-zA-Z0-9._%+-]+@(secretaria\.gov\.br|professor\.gov\.br|coordenador\.gov\.br)$"
                />

                <div class="absolute top-1 right-2 flex items-center pointer-events-auto">
                    <flux:tooltip toggleable placement="top">
                        <flux:button
                            icon="information-circle"
                            size="sm"
                            variant="ghost"
                            class="p-0"
                            aria-label="Informação sobre e-mail"
                            aria-controls="email-help"
                            aria-expanded="false"
                        />
                        <flux:tooltip.content id="email-help" class="max-w-[20rem] space-y-2">
                            <p>Os domínios permitidos são:</p>
                            <ul class="list-disc list-inside text-sm">
                                <li>@secretaria.gov.br</li>
                                <li>@professor.gov.br</li>
                                <li>@coordenador.gov.br</li>
                                <li> Utilize o email educacional que foi enviado para você</li>
                                <li><strong>Precisa de ajuda? Entre em contato com o suporte</strong></li>
                            </ul>
                        </flux:tooltip.content>
                    </flux:tooltip>
                </div>
            </div>

            <!-- Senha -->
            <div x-data="{
                pwd: '',
                valid() {
                    return /(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W).{8,}/.test(this.pwd)
                }
            }" class="relative w-full max-w-lg mt-2">

                <div class="relative w-full">
                    <flux:input
                        id="password"
                        x-model="pwd"
                        name="password"
                        :label="__('Senha*')"
                        type="password"
                        required
                        autocomplete="new-password"
                        :placeholder="__('Digite sua senha aqui...')"
                        viewable
                        class="mt-2"
                    />

                    <div class="absolute top-1 left-10 flex items-center pointer-events-auto">
                        <flux:tooltip toggleable placement="top">
                            <flux:button
                                icon="information-circle"
                                size="sm"
                                variant="ghost"
                                class="p-0"
                                aria-label="Informação sobre a senha"
                                aria-controls="password-help"
                                aria-expanded="false"
                            />
                            <flux:tooltip.content id="password-help" class="max-w-[10rem] space-y-2">
                                <p>A senha deve conter:</p>
                                <ul class="list-disc list-inside text-sm">
                                    <li>8 caracteres</li>
                                    <li>1 letra maiúscula e 1 minúscula</li>
                                    <li>1 número</li>
                                    <li>1 caractere especial</li>
                                </ul>
                            </flux:tooltip.content>
                        </flux:tooltip>
                    </div>
                </div>

                <div class="text-sm mt-1" :class="valid() ? 'text-green-600' : 'text-red-600'">
                    <template x-if="valid()">Senha válida</template>
                    <template x-if="!valid()">Mín. 8, 1 minúscula, 1 maiúscula, 1 número e 1 símbolo</template>
                </div>
            </div>

            <!-- Confirmar Senha -->
            <flux:input
                name="password_confirmation"
                :label="__('Confirmar Senha*')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Confirmar senha*')"
                viewable
                class="mt-2"
            />

            <!-- Termos de Uso -->
            <flux:field variant="inline">
    <flux:checkbox wire:model="terms" />

    <flux:label>Eu li e concordo com os termos de uso (Obrigatório)*</flux:label>

    <flux:error name="terms" />
</flux:field>



            <!-- Botão de Cadastro -->
            <div class="flex items-center justify-end mt-4">
                <flux:button wire:click="save" type="submit" variant="primary" class="w-full cursor-pointer" data-test="register-user-button">
                    {{ __('Cadastrar') }}
                </flux:button>
            </div>
        </form>

        <!-- Link para Login -->
        <div class="space-x-1 rtl:space-x-reverse text-center text-sm">
            <span>{{ __('Já tem uma conta?') }}</span>
            <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
        </div>
    </div>

    <flux:button x-data x-on:click="$flux.dark = ! $flux.dark" icon="moon" variant="subtle" aria-label="Toggle dark mode" class="mx-auto"/>
    
</x-layouts.auth>
