<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <x-auth-header 
            :title="__('Seja bem-vindo(a)')" 
            :description="__('Preencha todos os campos abaixo, para finalizar o seu cadastro')" 
        />

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Nome -->
            <div class="w-full max-w-lg">
                <flux:input
                    name="name"
                    :label="__('Nome*')"
                    type="text"
                    required
                    autofocus
                    autocomplete="name"
                    :placeholder="__('Digite seu nome completo...')"
                />
            </div>

            <!-- Email -->
           <div class="relative w-full max-w-lg" x-data="{ email: '' }">
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
        pattern="^[a-zA-Z0-9._%+-]+@(secretaria\.gov\.br|professor\.gov\.br|coordenador\.gov\.br)$"
    />

    <!-- Ícone e Tooltip -->
    <div class="absolute top-9 right-2 flex items-center pointer-events-auto">
        <flux:tooltip toggleable placement="top">
            <flux:button
                icon="information-circle"
                size="sm"
                variant="ghost"
                class="p-0"
                aria-label="Informação sobre e-mail"
                aria-controls="email-help"
            />
            <flux:tooltip.content id="email-help" class="max-w-[20rem] space-y-2">
                <p>Os domínios permitidos são:</p>
                <ul class="list-disc list-inside text-sm">
                    <li>@secretaria.gov.br</li>
                    <li>@professor.gov.br</li>
                    <li>@coordenador.gov.br</li>
                    <li>Utilize o email educacional enviado para você</li>
                    <li><strong>Precisa de ajuda? Contate o suporte</strong></li>
                </ul>
            </flux:tooltip.content>
        </flux:tooltip>
    </div>
</div>

            <!-- Senha -->
            <div x-data="{
                pwd: '', pwdConfirm:'',
                valid() {
                    return /(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W).{8,}/.test(this.pwd)
                }
            }" class="w-full max-w-lg">
                <div class="relative">
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
                    />

                    <div class="absolute -top-4 left-10 flex items-center pointer-events-auto">
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
                            <flux:tooltip.content id="password-help" class="max-w-[16rem] space-y-2">
                                <p>A senha deve conter:</p>
                                <ul class="list-disc list-inside text-sm">
                                    <li>Mínimo de 8 caracteres</li>
                                    <li>Pelo menos 1 letra maiúscula</li>
                                    <li>Pelo menos 1 letra minúscula</li>
                                    <li>Pelo menos 1 número</li>
                                    <li>Pelo menos 1 caractere especial</li>
                                </ul>
                            </flux:tooltip.content>
                        </flux:tooltip>
                    </div>
                </div>

                <div class="mt-2 text-sm" x-show="pwd.length > 0" :class="valid() ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400'">
                    <template x-if="valid()">
                        <span>Senha forte</span>
                    </template>
                    <template x-if="!valid() && pwd.length > 0">
                        <span>A senha não atende aos requisitos</span>
                    </template>
                </div>
            </div>

            <!-- Confirmar Senha -->
            <div class="w-full max-w-lg">
                <flux:input
                    name="password_confirmation"
                    :label="__('Confirmar Senha*')"
                    type="password"
                    required
                    x-model="pwdConfirm"
                    autocomplete="new-password"
                    :placeholder="__('Confirmar senha*')"
                    viewable
                />
            </div>
               
            <!-- Confirmação de Senha no front -->

            <div class="text-sm mt-1" x-show="pwdConfirm.length > 0" :class="pwd === pwdConfirm ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400'">
                <template x-if="pwd === pwdConfirm">
                    <span>As senhas coincidem </span>
                </template>
                <template x-if="pwd !== pwdConfirm && pwdConfirm.length > 0">
                    <span>As senhas não coincidem </span>
                </template  >

            </div>
            <!-- Termos de Uso -->
            <div class="w-full max-w-lg mt-2">
                <flux:field variant="inline">
                    <flux:checkbox wire:model="terms" />
                    <flux:label>
                        <a 
                            href="#"
                            class="bg-transparent border-none p-0 m-0 text-sm font-medium 
                                   text-gray-800 dark:text-white 
                                   hover:underline focus:outline-none"
                            aria-haspopup="dialog" 
                            aria-expanded="false" 
                            aria-controls="hs-scroll-inside-body-modal" 
                            data-hs-overlay="#hs-scroll-inside-body-modal">
                            Eu li e concordo com os Termos de Uso (Obrigatório)*
                        </a>
                    </flux:label>
                    <flux:error name="terms" />
                </flux:field>
            </div>

            <!-- Modal de Termos de Uso -->
            <div id="hs-scroll-inside-body-modal" 
                 class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" 
                 role="dialog" 
                 tabindex="-1" 
                 aria-labelledby="hs-scroll-inside-body-modal-label">

                <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 h-[calc(100%-56px)] sm:mx-auto">
                    <div class="max-h-full overflow-hidden flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                        
                        <!-- Cabeçalho -->
                        <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                            <h3 id="hs-scroll-inside-body-modal-label" class="font-bold text-gray-800 dark:text-white">
                                Termos de Uso
                            </h3>
                            <button type="button" 
                                    class="size-8 inline-flex justify-center items-center rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400" 
                                    aria-label="Close" 
                                    data-hs-overlay="#hs-scroll-inside-body-modal">
                                ✕
                            </button>
                        </div>

                        <!-- Conteúdo -->
                        <div class="p-4 overflow-y-auto space-y-3 text-sm text-gray-600 dark:text-neutral-400">
                            <p>Ao criar uma conta, você concorda com estes Termos de Uso.</p>
                            <p><strong>1.</strong> Seus dados serão tratados conforme a Lei Geral de Proteção de Dados (LGPD - Lei nº 13.709/2018).</p>
                            <p><strong>2.</strong> Você se compromete a fornecer informações verdadeiras e a não utilizar a plataforma para fins ilegais.</p>
                            <p><strong>3.</strong> Reservamo-nos o direito de suspender contas que violem nossos termos.</p>
                            <p><strong>4.</strong> Ao continuar, você confirma ter lido e concordado com os Termos.</p>
                        </div>

                        <!-- Rodapé -->
                        <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                            <button type="button" 
                                    class="py-2 px-3 text-sm font-medium rounded-lg 
               border border-gray-200 bg-accent text-white 
               cursor-pointer 
               dark:border-neutral-700 dark:text-gray-900" 
                                    data-hs-overlay="#hs-scroll-inside-body-modal">
                                Fechar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botão de Cadastro -->
            <div class="flex items-center justify-end mt-2 w-full max-w-lg">
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