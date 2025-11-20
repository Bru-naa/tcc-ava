<!-- Formulário -->
<form x-data="{
    form: {
        email: '',
        assunto: '', 
        mensagem: ''
    },
    loading: false,
    
    async submitForm() {
        this.loading = true;
        
        try {
            const response = await fetch('{{ route('contato.enviar') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(this.form)
            });

            const data = await response.json();

            if (response.ok) {
                this.$dispatch('show-toast', {
                    message: 'Mensagem enviada com sucesso!',
                    type: 'success'
                });
                
                // Limpa o formulário
                this.form = { 
                    email: '', 
                    assunto: '', 
                    mensagem: '' 
                };
            } else {
                throw new Error(data.message || 'Erro ao enviar mensagem');
            }
        } catch (error) {
            this.$dispatch('show-toast', {
                message: error.message || 'Erro ao processar sua solicitação',
                type: 'error'
            });
        } finally {
            this.loading = false;
        }
    }
}" 
@submit.prevent="submitForm"
class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-lg rounded-xl p-6 space-y-5">

    <!-- Email -->
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Seu e-mail
        </label>
        <input type="email" 
               id="email" 
               x-model="form.email"
               required
               class="block w-full px-4 py-3 text-gray-900 dark:text-gray-200 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
               placeholder="you@example.com"
               :disabled="loading">
    </div>

    <!-- Assunto -->
    <div>
        <label for="assunto" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Assunto
        </label>
        <input type="text" 
               id="assunto" 
               x-model="form.assunto"
               required
               class="block w-full px-4 py-3 text-gray-900 dark:text-gray-200 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
               placeholder="Assunto da mensagem"
               :disabled="loading">
    </div>

    <!-- Mensagem -->
    <div>
        <label for="mensagem" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Mensagem
        </label>
        <textarea id="mensagem" 
                  rows="5" 
                  x-model="form.mensagem"
                  required
                  class="block w-full px-4 py-3 text-gray-900 dark:text-gray-200 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                  placeholder="Escreva sua mensagem aqui..."
                  :disabled="loading"></textarea>
    </div>

    <!-- Botão -->
    <div class="text-center">
        <button type="submit"
                :disabled="loading"
                class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200"
                x-text="loading ? 'Enviando...' : 'Enviar Mensagem'">
        </button>
    </div>

</form>