<div class="mt-4">
  <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl p-4 md:p-5 
              dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">

    <h3 class="text-lg font-bold text-gray-800 dark:text-white text-center">
      Avaliações dos Professores
    </h3>
    <p class="text-center">--Status das Avaliações--</p>
   
    <div class="space-y-3 mt-4 mb-4">
      <!-- Progress -->
      <div class="flex w-full mt-2 h-3 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700"
           role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
        <div class="flex flex-col justify-center rounded-full overflow-hidden bg-blue-600 
                    text-[10px] text-white text-center whitespace-nowrap dark:bg-blue-500 
                    transition duration-500" style="width: 25%">
          25%
        </div>
      </div>
    </div>

    <div class="flex items-center justify-center gap-2 mb-4">
       <form method="POST" action="{{ route('avaliacoes.gerenciar') }}" id="avaliacao-form">
        @csrf
        <!-- Status -->
        <div class="flex flex-col lg:flex-row items-center gap-4">
          
          <!-- Botão Abrir com Modal -->
          <button 
            type="button" 
            class="py-1.5 px-3 text-xs font-medium rounded-md bg-blue-600 text-white 
                   hover:bg-blue-700 focus:outline-none"
            data-hs-overlay="#hs-scale-animation-modal">
            Abrir
          </button>

          <!-- Modal -->
          <div id="hs-scale-animation-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-scale-animation-modal-label">
            <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
              <div class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                  <h3 id="hs-scale-animation-modal-label" class="font-bold text-gray-800 dark:text-white">
                    Deseja abrir as avaliações dos professores?
                  </h3>
                  <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#hs-scale-animation-modal">
                    <span class="sr-only">Close</span>
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M18 6 6 18"></path>
                      <path d="m6 6 12 12"></path>
                    </svg>
                  </button>
                </div>
                <div class="p-4 overflow-y-auto">
                  <p class="text-sm text-gray-600 dark:text-neutral-400 mb-4">Selecione as datas</p>
                  <div class="space-y-4">
                    <div>
                      <label for="data_abertura" class="block text-xs font-medium text-gray-600 dark:text-neutral-400 mb-1">
                        Data de Abertura *
                      </label>
                      <input type="date" 
                             name="data_abertura" 
                             id="data_abertura" 
                             class="border border-gray-300 rounded p-2 text-sm w-full dark:bg-neutral-700 dark:border-neutral-600 dark:text-white"
                             min="{{ date('d-my') }}"
                             required>
                      <p class="text-xs text-red-600 mt-1 hidden" id="error-data_abertura"></p>
                    </div>
                    <div>
                      <label for="data_fechamento" class="block text-xs font-medium text-gray-600 dark:text-neutral-400 mb-1">
                        Data de Fechamento *
                      </label>
                      <input type="date" 
                             name="data_fechamento" 
                             id="data_fechamento" 
                             class="border border-gray-300 rounded p-2 text-sm w-full dark:bg-neutral-700 dark:border-neutral-600 dark:text-white"
                             required>
                      <p class="text-xs text-red-600 mt-1 hidden" id="error-data_fechamento"></p>
                    </div>
                  </div>
                </div>
                <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                  <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#hs-scale-animation-modal">
                    Fechar
                  </button>
                  <button type="button" 
                    id="confirmar-abertura"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-blue-600 text-white hover:bg-blue-700 focus:outline-none disabled:opacity-50"
                    onclick="validarDatas()">
                    Confirmar
                  </button>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Botão Finalizar com Spinner -->
          <button 
            type="submit" 
            name="acao" 
            value="concluir"
            id="finalizar-btn"
            class="py-1.5 px-3 text-xs font-medium rounded-md bg-red-500 text-white 
                   hover:bg-red-600 focus:outline-none transition duration-200
                   flex items-center justify-center gap-2 min-w-[80px]"
            onclick="showLoading(this)">
            <span id="finalizar-text">Finalizar</span>
            <span id="finalizar-spinner" class="hidden">
              <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
            </span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function showLoading(button) {
  const spinner = button.querySelector('#finalizar-spinner');
  const text = button.querySelector('#finalizar-text');
  
  spinner.classList.remove('hidden');
  text.classList.add('hidden');
  button.disabled = true;
  
  setTimeout(() => {
    spinner.classList.add('hidden');
    text.classList.remove('hidden');
    button.disabled = false;
  }, 3000);
}

function validarDatas() {
  const dataAbertura = document.getElementById('data_abertura').value;
  const dataFechamento = document.getElementById('data_fechamento').value;
  const errorAbertura = document.getElementById('error-data_abertura');
  const errorFechamento = document.getElementById('error-data_fechamento');
  const btnConfirmar = document.getElementById('confirmar-abertura');
  
  // Reset errors
  errorAbertura.classList.add('hidden');
  errorFechamento.classList.add('hidden');
  btnConfirmar.disabled = false;
  
  let isValid = true;
  
  // Validação: Data de abertura não pode ser no passado
  if (dataAbertura && new Date(dataAbertura) < new Date().setHours(0,0,0,0)) {
    errorAbertura.textContent = 'A data de abertura não pode ser no passado';
    errorAbertura.classList.remove('hidden');
    isValid = false;
  }
  
  // Validação: Data de fechamento não pode ser menor que abertura
  if (dataAbertura && dataFechamento && new Date(dataFechamento) < new Date(dataAbertura)) {
    errorFechamento.textContent = 'A data de fechamento não pode ser anterior à data de abertura';
    errorFechamento.classList.remove('hidden');
    isValid = false;
  }
  
  // Validação: Campos obrigatórios
  if (!dataAbertura) {
    errorAbertura.textContent = 'Data de abertura é obrigatória';
    errorAbertura.classList.remove('hidden');
    isValid = false;
  }
  
  if (!dataFechamento) {
    errorFechamento.textContent = 'Data de fechamento é obrigatória';
    errorFechamento.classList.remove('hidden');
    isValid = false;
  }
  
  if (isValid) {
    // Se tudo válido, submete o formulário
    document.getElementById('avaliacao-form').submit();
  } else {
    btnConfirmar.disabled = true;
  }
}

// Validação em tempo real
document.getElementById('data_abertura').addEventListener('change', validarDatas);
document.getElementById('data_fechamento').addEventListener('change', validarDatas);
</script>