<div class="w-full mx-auto mt-10 space-y-6">

    <div class="max-w-md mx-auto">
        <label class="block mb-2 font-semibold">Selecione a Escola:</label>

        <select wire:model="selectedEscola"
                class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:text-white">
            <option value="">-- Escolha uma escola --</option>

            @foreach ($escolas as $escola)
                <option value="{{ $escola->id }}">{{ $escola->esc_nome }}</option>
            @endforeach
        </select>
    </div>

    @if ($selectedEscola)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">

            <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-xl text-center">
                <h3 class="text-lg font-semibold">Total de Reclamações</h3>
                <p class="text-3xl font-bold mt-2">{{ $total }}</p>
            </div>

            <div class="p-6 bg-yellow-100 dark:bg-yellow-700 shadow rounded-xl text-center">
                <h3 class="text-lg font-semibold">Pendentes</h3>
                <p class="text-3xl font-bold mt-2">{{ $pendentes }}</p>
            </div>

            <div class="p-6 bg-green-100 dark:bg-green-700 shadow rounded-xl text-center">
                <h3 class="text-lg font-semibold">Resolvidas</h3>
                <p class="text-3xl font-bold mt-2">{{ $resolvidas }}</p>
            </div>

        </div>
    @else
        <p class="text-center text-gray-600 dark:text-gray-300 mt-6">
            Selecione uma escola para visualizar os dados.
        </p>
    @endif

</div>
