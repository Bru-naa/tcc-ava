<div class="mt-4">
  <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl p-4 md:p-5 
              dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">

    <h3 class="text-lg font-bold text-gray-800 dark:text-white text-center">
      Avaliações dos Professores
    </h3>

    <p class="mt-1 text-xs font-medium uppercase text-gray-500 dark:text-neutral-500 text-center">
      --Status das avaliações--
    </p>

    <p class="mt-2 text-gray-500 dark:text-neutral-400 mb-3">
      Some quick example text to build on the card title and make up the bulk of the card's content.
    </p>

    <!-- Botões lado a lado e menores -->
    <div class="flex items-center justify-center gap-2 mb-4">
      <button 
        type="button" 
        class="py-1.5 px-3 text-xs font-medium rounded-md bg-blue-600 text-white 
               hover:bg-blue-700 focus:outline-none">
        Abrir
      </button>

      <button 
        type="button" 
        class="py-1.5 px-3 text-xs font-medium rounded-md bg-red-500 text-white 
               hover:bg-red-600 focus:outline-none">
        Concluir
      </button>
    </div>

    <div class="space-y-3">
      <!-- Progress -->
      <div class="flex w-full h-3 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700"
           role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
        <div class="flex flex-col justify-center rounded-full overflow-hidden bg-blue-600 
                    text-[10px] text-white text-center whitespace-nowrap dark:bg-blue-500 
                    transition duration-500" style="width: 25%">
          25%
        </div>
      </div>
    </div>

  </div>
</div>
