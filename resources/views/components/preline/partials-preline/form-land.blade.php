 <!-- Formulário -->
        <form method="POST" action="{{ route('contato.enviar') }}" class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-lg rounded-xl p-6 space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Seu e-mail
                </label>
                <input type="email" name="email" id="email" required
                    class="block w-full px-4 py-3 text-gray-900 dark:text-gray-200 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    placeholder="you@example.com">
            </div>

            <!-- Assunto -->
            <div>
                <label for="assunto" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Assunto
                </label>
                <input type="text" name="assunto" id="assunto" required
                    class="block w-full px-4 py-3 text-gray-900 dark:text-gray-200 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    placeholder="Assunto da mensagem">
            </div>

            <!-- Mensagem -->
            <div>
                <label for="mensagem" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Mensagem
                </label>
                <textarea name="mensagem" id="mensagem" rows="5" required
                    class="block w-full px-4 py-3 text-gray-900 dark:text-gray-200 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    placeholder="Escreva sua mensagem aqui..."></textarea>
            </div>

            <!-- Botão -->
            <div class="text-center">
                <button type="submit"
                    class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Enviar
                </button>
            </div>

        </form>
        @if (session('success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 4000)"
        class="fixed bottom-4 right-4 max-w-xs bg-white border border-gray-200 rounded-xl shadow-lg dark:bg-neutral-800 dark:border-neutral-700"
        role="alert"
        tabindex="-1"
        aria-labelledby="hs-toast-success-example-label"
    >
        <div class="flex p-4">
            <div class="shrink-0">
                <svg class="shrink-0 size-4 text-teal-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg>
            </div>
            <div class="ms-3">
                <p id="hs-toast-success-example-label" class="text-sm text-gray-700 dark:text-neutral-400">
                    {{ session('success') }}
                </p>
            </div>
        </div>
    </div>
@endif

    </div>