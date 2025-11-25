

<div class="w-full mx-auto mt-6 space-y-6">
    @if ($isLoading)
        <div class="text-center py-8">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600 mx-auto"></div>
            <p class="mt-2 text-gray-500 dark:text-gray-400">Carregando dados da sua escola...</p>
        </div>
    @elseif(Auth::user()->escola_id)
        <!-- Cabeçalho com nome da escola -->
        <div class="mb-6 text-center">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                📊 Reclamações da Minha Escola
            </h2>
            <p class="text-gray-600 dark:text-gray-300 mt-2">
                Dados referentes à: <strong class="text-blue-600 dark:text-blue-400">{{ $nomeEscola }}</strong>
            </p>
        </div>

        <!-- Cards de Métricas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total de Reclamações -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-xl text-center border border-gray-200 dark:border-gray-700">
                <div class="flex flex-col items-center">
                    <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-full mb-3">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Total</h3>
                    <p class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">{{ $total }}</p>
                </div>
            </div>

            <!-- Pendentes -->
            <div class="p-6 bg-yellow-50 dark:bg-yellow-900 shadow rounded-xl text-center border border-yellow-200 dark:border-yellow-800">
                <div class="flex flex-col items-center">
                    <div class="p-3 bg-yellow-100 dark:bg-yellow-800 rounded-full mb-3">
                        <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Pendentes</h3>
                    <p class="text-3xl font-bold mt-2 text-yellow-700 dark:text-yellow-300">{{ $pendentes }}</p>
                </div>
            </div>

            <!-- Resolvidas -->
            <div class="p-6 bg-green-50 dark:bg-green-900 shadow rounded-xl text-center border border-green-200 dark:border-green-800">
                <div class="flex flex-col items-center">
                    <div class="p-3 bg-green-100 dark:bg-green-800 rounded-full mb-3">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Resolvidas</h3>
                    <p class="text-3xl font-bold mt-2 text-green-700 dark:text-green-300">{{ $resolvidas }}</p>
                </div>
            </div>
        </div>

        <!-- Informações Adicionais -->
        @if($total > 0)
            <div class="mt-6 text-center space-y-2">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    📈 Taxa de resolução: 
                    <strong class="text-green-600 dark:text-green-400">
                        {{ round(($resolvidas / $total) * 100, 1) }}%
                    </strong>
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    ⏳ Pendentes: 
                    <strong class="text-yellow-600 dark:text-yellow-400">
                        {{ round(($pendentes / $total) * 100, 1) }}%
                    </strong>
                </p>
            </div>
        @else
            <div class="mt-6 text-center p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                <p class="text-gray-600 dark:text-gray-300">
                    🎉 Nenhuma reclamação registrada para sua escola!
                </p>
            </div>
        @endif
    @else
        <!-- Usuário sem escola vinculada -->
        <div class="text-center p-6 bg-red-50 dark:bg-red-900 rounded-lg border border-red-200 dark:border-red-800">
            <svg class="w-12 h-12 text-red-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
            </svg>
            <h3 class="text-lg font-semibold text-red-800 dark:text-red-200 mb-2">
                Escola Não Vinculada
            </h3>
            <p class="text-red-700 dark:text-red-300">
                Você não está vinculado a nenhuma escola. 
                Contate o administrador para associar sua conta.
            </p>
        </div>
    @endif
</div>