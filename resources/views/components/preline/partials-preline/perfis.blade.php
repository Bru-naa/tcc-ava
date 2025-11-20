<!-- Perfis -->
<div >
  <div class="max-w-5xl px-4 xl:px-0 py-10 lg:pt-20 mx-auto">
    <!-- Title -->
    <div class="max-w-3xl mb-10 lg:mb-14">
      <h2 class="text-gray-900 dark:text-white font-semibold text-2xl md:text-4xl md:leading-tight">Perfis de Acesso</h2>
      <p class="mt-1 text-gray-600 dark:text-neutral-400">Sistema organizado com diferentes níveis de permissão para atender todas as necessidades da comunidade escolar.</p>
    </div>

    <!-- Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 lg:items-center">
      <div class="aspect-w-16 aspect-h-9 lg:aspect-none">
        <img class="w-full object-cover rounded-xl" src="{{ asset('images/chatbotExemp.jpeg') }}" alt="Sistema de Gestão Educacional">
      </div>

      <!-- Timeline -->
      <div>
        <!-- Heading -->
        <div class="mb-4">
          <h3 class="text-blue-600 dark:text-blue-400 text-xs font-medium uppercase">
            Perfis
          </h3>
        </div>

        <!-- Admin -->
        <div class="flex gap-x-5 ms-1">
          <div class="relative last:after:hidden after:absolute after:top-8 after:bottom-0 after:start-4 after:w-px after:-translate-x-[0.5px] after:bg-gray-200 dark:after:bg-neutral-700">
            <div class="relative z-10 size-8 flex justify-center items-center">
              <span class="flex shrink-0 justify-center items-center size-8 border border-gray-300 dark:border-neutral-600 text-blue-600 dark:text-blue-400 font-semibold text-xs uppercase rounded-full">
                1
              </span>
            </div>
          </div>

          <div class="grow pt-0.5 pb-8 sm:pb-12">
            <p class="text-sm lg:text-base text-gray-600 dark:text-neutral-400">
              <span class="text-gray-900 dark:text-white">Administrador:</span>
              Permissão geral, pode ser utilizado como perfil regional. Acesso completo ao sistema.
            </p>
          </div>
        </div>

        <!-- Direção -->
        <div class="flex gap-x-5 ms-1">
          <div class="relative last:after:hidden after:absolute after:top-8 after:bottom-0 after:start-4 after:w-px after:-translate-x-[0.5px] after:bg-gray-200 dark:after:bg-neutral-700">
            <div class="relative z-10 size-8 flex justify-center items-center">
              <span class="flex shrink-0 justify-center items-center size-8 border border-gray-300 dark:border-neutral-600 text-blue-600 dark:text-blue-400 font-semibold text-xs uppercase rounded-full">
                2
              </span>
            </div>
          </div>

          <div class="grow pt-0.5 pb-8 sm:pb-12">
            <p class="text-sm lg:text-base text-gray-600 dark:text-neutral-400">
              <span class="text-gray-900 dark:text-white">Direção:</span>
              Privilégio sobre a escola, gestão completa, visão geral e encaminhamento de problemas para a regional.
            </p>
          </div>
        </div>

        <!-- Coordenação -->
        <div class="flex gap-x-5 ms-1">
          <div class="relative last:after:hidden after:absolute after:top-8 after:bottom-0 after:start-4 after:w-px after:-translate-x-[0.5px] after:bg-gray-200 dark:after:bg-neutral-700">
            <div class="relative z-10 size-8 flex justify-center items-center">
              <span class="flex shrink-0 justify-center items-center size-8 border border-gray-300 dark:border-neutral-600 text-blue-600 dark:text-blue-400 font-semibold text-xs uppercase rounded-full">
                3
              </span>
            </div>
          </div>

          <div class="grow pt-0.5 pb-8 sm:pb-12">
            <p class="text-sm md:text-base text-gray-600 dark:text-neutral-400">
              <span class="text-gray-900 dark:text-white">Coordenação:</span>
              Abre inscrições, acesso às reclamações e avaliações, gestão pedagógica.
            </p>
          </div>
        </div>

        <!-- Professor -->
        <div class="flex gap-x-5 ms-1">
          <div class="relative last:after:hidden after:absolute after:top-8 after:bottom-0 after:start-4 after:w-px after:-translate-x-[0.5px] after:bg-gray-200 dark:after:bg-neutral-700">
            <div class="relative z-10 size-8 flex justify-center items-center">
              <span class="flex shrink-0 justify-center items-center size-8 border border-gray-300 dark:border-neutral-600 text-blue-600 dark:text-blue-400 font-semibold text-xs uppercase rounded-full">
                4
              </span>
            </div>
          </div>

          <div class="grow pt-0.5 pb-8 sm:pb-12">
            <p class="text-sm md:text-base text-gray-600 dark:text-neutral-400">
              <span class="text-gray-900 dark:text-white">Professor:</span>
              Dashboard individual, acesso ao chatbot e acompanhamento do desempenho dos alunos.
            </p>
          </div>
        </div>

        <!-- Secretaria -->
        <div class="flex gap-x-5 ms-1">
          <div class="relative last:after:hidden after:absolute after:top-8 after:bottom-0 after:start-4 after:w-px after:-translate-x-[0.5px] after:bg-gray-200 dark:after:bg-neutral-700">
            <div class="relative z-10 size-8 flex justify-center items-center">
              <span class="flex shrink-0 justify-center items-center size-8 border border-gray-300 dark:border-neutral-600 text-blue-600 dark:text-blue-400 font-semibold text-xs uppercase rounded-full">
                5
              </span>
            </div>
          </div>

          <div class="grow pt-0.5 pb-8 sm:pb-12">
            <p class="text-sm md:text-base text-gray-600 dark:text-neutral-400">
              <span class="text-gray-900 dark:text-white">Secretaria:</span>
              Atualização de dados dos alunos, geração de emails educacionais, acesso às reclamações com possibilidade de resposta ou encaminhamento.
            </p>
          </div>
        </div>

        <a class="group inline-flex items-center gap-x-2 py-2 px-3 bg-blue-600 font-medium text-sm text-white rounded-full hover:bg-blue-700 focus:outline-hidden transition-colors" href="#">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
            <path class="opacity-0 group-hover:opacity-100 group-focus:opacity-100 group-hover:delay-100 transition" d="M14.05 2a9 9 0 0 1 8 7.94"></path>
            <path class="opacity-0 group-hover:opacity-100 group-focus:opacity-100 transition" d="M14.05 6A5 5 0 0 1 18 10"></path>
          </svg>
          Saiba mais
        </a>
      </div>
    </div>
  </div>
</div>
<!-- End Perfis -->