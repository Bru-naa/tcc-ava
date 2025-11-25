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

            <!-- Email com verificação de pré-cadastro -->
            <div class="relative w-full max-w-lg" 
                 x-data="{
                     email: '',
                     isPreCadastrado: false,
                     isLoading: false,
                     
                     async checkPreCadastro() {
                         if (!this.email) {
                             this.isPreCadastrado = false;
                             return;
                         }

                         // Valida formato primeiro
                         const pattern = /^[a-zA-Z0-9._%+-]+@(secretaria\.gov\.br|professor\.gov\.br|coordenador\.gov\.br)$/;
                         if (!pattern.test(this.email)) {
                             this.isPreCadastrado = false;
                             return;
                         }

                         this.isLoading = true;

                         try {
                             const response = await fetch('{{ route('register.check-email') }}', {
                                 method: 'POST',
                                 headers: {
                                     'Content-Type': 'application/json',
                                     'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                 },
                                 body: JSON.stringify({ email: this.email })
                             });

                             const data = await response.json();
                             this.isPreCadastrado = data.pre_cadastrado;
                             
                         } catch (error) {
                             this.isPreCadastrado = false;
                         } finally {
                             this.isLoading = false;
                         }
                     }
                 }" 
                 x-init="() => { $watch('email', value => checkPreCadastro()) }">

                <flux:input
                    name="email"
                    x-model="email"
                    :label="__('Email Institucional:')"
                    type="email"
                    required
                    autocomplete="email"
                    placeholder="email@professor.gov.br"
                    :class="{
                        'pr-16 border-green-500 bg-green-50 dark:bg-green-900/20': isPreCadastrado,
                        'pr-16 border-red-500 bg-red-50 dark:bg-red-900/20': !isPreCadastrado && email,
                        'pr-10 border-gray-300': !email
                    }"
                    id="email"
                    aria-describedby="email-help"
                    pattern="^[a-zA-Z0-9._%+-]+@(secretaria\.gov\.br|professor\.gov\.br|coordenador\.gov\.br)$"
                />

                <!--  status pré-cadastro -->
                <div class="absolute top-9 right-8 flex items-center" x-show="email && !isLoading">
                    <template x-if="isPreCadastrado">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </template>
                    <template x-if="!isPreCadastrado && email">
                        <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </template>
                </div>

               
                <div class="absolute top-9 right-8 flex items-center" x-show="isLoading">
                    <svg class="animate-spin h-5 w-5 text-orange-500" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>

                <!-- tooltip -->
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
                
                <div class="mt-2 text-sm" x-show="email">
                    <template x-if="isPreCadastrado">
                        <span class="text-green-600 dark:text-green-400">✅ Email pré-cadastrado. Complete seu cadastro criando uma senha.</span>
                    </template>
                    <template x-if="!isPreCadastrado && email">
                        <span class="text-red-600 dark:text-red-400">❌ Email não encontrado no pré-cadastro. Entre em contato com a secretaria.</span>
                    </template>
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
                </template>
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
                <flux:button type="submit" variant="primary" class="w-full cursor-pointer" data-test="register-user-button">
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