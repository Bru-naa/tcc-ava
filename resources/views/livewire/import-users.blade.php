<form 
  wire:submit.prevent="importar"
  x-data="{ fileName: '', confirmado: false }"
  x-init="
    window.addEventListener('arquivo-confirmed', () => {
      confirmado = true;
      setTimeout(() => { confirmado = false; }, 3000);
    });
  "
  class="flex flex-col mb-6 mt-8 bg-white border border-gray-200 shadow-sm rounded-lg p-4 max-w-md"
>
  <h3 class="text-lg text-black font-bold mb-3">Pré cadastro</h3>

  {{-- Input real --}}
  <input
    id="uploadExcel"
    type="file"
    wire:model="arquivo"
    @change="fileName = $event.target.files[0]?.name || ''"
    accept=".xlsx,.xls,.csv"
    class="hidden"
  >

  <label for="uploadExcel" class="flex items-center w-full border-2 border-dashed border-gray-300 rounded-lg text-sm cursor-pointer hover:border-accent transition-colors py-3 px-4 bg-white">
    <span class="bg-accent text-white px-4 py-2 rounded-lg">Escolher arquivo</span>
    <span class="ml-3 text-gray-500" x-text="fileName || 'Selecionar arquivo'"></span>
  </label>

  {{-- Mostra erro --}}
  @error('arquivo')
    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
  @enderror

  <div x-show="fileName" class="mt-4">

    {{-- Barra com nome e botões --}}
    <div class="flex justify-between items-center bg-gray-50 rounded-lg p-3">
      <span class="truncate text-sm font-medium text-gray-700" x-text="fileName"></span>

      <div class="flex gap-2">
        {{-- CONFIRMAR = SUBMIT! --}}
        <button
          type="submit"
          class="py-2 px-3 text-sm rounded-full text-white shadow bg-green-600 hover:bg-green-700"
        >
          Confirmar
        </button>

        <button
          type="button"
          wire:click="cancelar"
          @click="fileName = ''"
          class="py-2 px-3 text-sm rounded-full bg-red-500 border-red-200 text-white shadow hover:bg-red-600"
        >
          Cancelar
        </button>
      </div>
    </div>

    {{-- Preview --}}
    @if ($totalLinhas > 0)
      <div class="mt-3">
        <div class="text-sm text-gray-700 mb-2">
          Total de linhas: <b>{{ $totalLinhas }}</b>
        </div>

        <div class="overflow-auto max-h-40 border rounded">
          <table class="w-full text-xs">
            <tbody>
              @foreach ($previewLinhas as $linha)
                <tr class="border-b">
                  @foreach ($linha as $celula)
                    <td class="p-2 border-r">{{ $celula }}</td>
                  @endforeach
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    @endif

    {{-- Mensagem Confirmado --}}
    <div x-show="confirmado" class="text-green-600 mt-2 text-sm">
      Arquivo confirmado!
    </div>

  </div>

  {{-- Loader --}}
  <div wire:loading wire:target="importar" class="mt-3">
    <div class="bg-gray-200 h-2 rounded-full overflow-hidden">
      <div class="h-2 animate-pulse w-2/3"></div>
    </div>
    <p class="text-xs text-gray-500 mt-1">Processando...</p>
  </div>

  {{-- Sucesso --}}
  @if (session('success'))
    <p class="text-green-600 text-sm mt-3">{{ session('success') }}</p>
  @endif
</form>
