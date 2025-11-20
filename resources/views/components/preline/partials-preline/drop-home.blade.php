<div class="flex flex-col bg-white border border-gray-200 shadow-sm rounded-lg hover:shadow-md transition-shadow duration-200 dark:bg-neutral-900 dark:border-neutral-700 max-w-md">
  <div class="p-4">
    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-3">
      Pré cadastro
    </h3>
    
    <div data-hs-file-upload='{
      "maxFiles": 1,
      "singleton": true,
      "accept": ".xlsx,.xls,.csv"
    }'>
      <!-- Preview area que aparece quando tem arquivo -->
      <div class="hidden" data-hs-file-upload-preview="">
        <div class="flex items-center justify-between bg-gray-50 rounded-lg p-3 mb-2">
          <div class="flex items-center min-w-0 flex-1">
            <span class="truncate text-sm font-medium text-gray-700" data-hs-file-upload-file-name></span>
            <span class="text-sm text-gray-700">.</span>
            <span class="text-sm text-gray-700" data-hs-file-upload-file-ext></span>
          </div>
          <button type="button" class="text-red-500 hover:text-red-700 ml-3 flex-shrink-0" data-hs-file-upload-delete="">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
      </div>

      <!-- Botão principal de upload -->
      <div class="relative flex w-full border-2 border-dashed border-gray-300 rounded-lg text-sm cursor-pointer hover:border-accent transition-colors duration-200 bg-white">
        <span class="h-full py-3 px-4 bg-accent text-white text-nowrap rounded-l-lg">Escolher arquivo</span>
         <!-- Texto quando NÃO houver arquivo -->
      <span class="text-gray-500 text-center group-has-[span[data-hs-file-upload-file-name]]:hidden">
          Nenhum arquivo selecionado
      </span>

      <!-- Nome do arquivo -->
      <span class="truncate text-gray-800 text-sm font-medium hidden"
            data-hs-file-upload-file-name></span>

      <!-- Extensão -->
      <span class="text-gray-500 text-sm hidden"
            data-hs-file-upload-file-ext></span>
  </span>
        <input type="file" name="arquivo_excel" class="absolute top-0 left-0 w-full h-full opacity-0 cursor-pointer" data-hs-file-upload-trigger="">
      </div>
    </div>
  </div>
</div>