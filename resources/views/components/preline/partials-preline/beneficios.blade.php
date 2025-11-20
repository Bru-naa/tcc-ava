<div class="group relative z-10 p-6 md:p-8 h-full flex flex-col bg-white dark:bg-neutral-900 border border-gray-200 dark:border-neutral-700 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 focus:outline-none before:absolute before:inset-0 before:bg-linear-to-b hover:before:from-transparent hover:before:via-transparent hover:before:to-blue-500/5 before:via-80% focus:before:from-transparent focus:before:via-transparent focus:before:to-blue-500/5 before:-z-1 before:opacity-0 hover:before:opacity-100 focus:before:opacity-100 mt-24">
  
  <!-- Header card benefícios -->
  <div class="mb-6 mt-8">
    <h3 class="text-xl md:text-2xl font-semibold text-gray-900 dark:text-white mb-2">
      Principais benefícios
    </h3>
    <div class="w-12 h-1 bg-blue-600 rounded-full"></div>
  </div>

  <!-- Lista de Benefícios -->
  <ul class="space-y-4 mb-8 flex-1">
    <li class="flex items-start space-x-3 text-gray-700 dark:text-neutral-300">
      <span class="text-blue-600 text-lg mt-0.5">🌟</span>
      <span class="font-medium">Avaliações centralizadas</span>
    </li>
    <li class="flex items-start space-x-3 text-gray-700 dark:text-neutral-300">
      <span class="text-blue-600 text-lg mt-0.5">📊</span>
      <span class="font-medium">Relatórios inteligentes e visuais</span>
    </li>
    <li class="flex items-start space-x-3 text-gray-700 dark:text-neutral-300">
      <span class="text-blue-600 text-lg mt-0.5">🛡</span>
      <span class="font-medium">Dados seguros e anônimos</span>
    </li>
    <li class="flex items-start space-x-3 text-gray-700 dark:text-neutral-300">
      <span class="text-blue-600 text-lg mt-0.5">⚙</span>
      <span class="font-medium">Processos desburocratizados</span>
    </li>
    <li class="flex items-start space-x-3 text-gray-700 dark:text-neutral-300">
      <span class="text-blue-600 text-lg mt-0.5">🕒</span>
      <span class="font-medium">Economia de tempo para gestores e professores</span>
    </li>
  </ul>

  <!-- Call to Action -->
  <div class="mt-auto pt-6 border-t border-gray-200 dark:border-neutral-700">
    <p class="text-gray-600 dark:text-neutral-400 mb-4 text-sm leading-relaxed">
      <strong class="text-gray-900 dark:text-white">Já tem um pré-cadastro?</strong> Finalize seu cadastro e comece a usar.
    </p>
    
    <div class="space-y-3">
      <!-- Botão Principal - Finalizar Cadastro -->
      <form action="{{ route('register') }}" method="get" class="mt-2">
        @csrf
        <button type="submit" class="group w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-medium py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center space-x-2">
          <span>Finalizar Meu Cadastro</span>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 transition-transform group-hover:translate-x-1">
            <path stroke-linecap="round" stroke-linejoin="round" d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>
        </button>
      </form>

    
      
    </div>
  </div>
</div>