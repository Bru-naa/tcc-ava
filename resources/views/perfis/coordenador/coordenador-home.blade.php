<x-layouts.app>
    @php
        $cursosVinculados = auth()->user()?->cursosCoordenados()->get() ?? collect();
        $siglasVinculadas = $cursosVinculados->pluck('sigla')->implode(', ');
    @endphp

    <p class="text-base text-center lg:text-4xl font-semibold mt-2 mb-8">
        Seja bem-vindo(a), {{ auth()->user()->name }}
    </p>

    <div class="bg-white mb-8 border border-gray-200 rounded-lg shadow-lg p-4 dark:bg-neutral-700 dark:border-neutral-700" role="alert" tabindex="-1" aria-labelledby="hs-discovery-label">
        <div class="flex">
            <div class="shrink-0">
                <svg class="shrink-0 size-4 text-blue-600 mt-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M12 16v-4"></path>
                    <path d="M12 8h.01"></path>
                </svg>
            </div>
            <div class="ms-3">
                <h3 id="hs-discovery-label" class="text-gray-800 font-semibold dark:text-white text-center">
                    Autenticação de dois fatores disponível
                </h3>
                <p class="mt-2 text-sm text-gray-700 dark:text-neutral-200 text-center">
                    Por favor, por motivos de segurança ative a autenticação de dois fatores. Se já ativou, desconsidere.
                </p>
            </div>
        </div>
    </div>

    <flux:separator />

    <div id="avaliacoes">
        <livewire:avaliacoes-status />
    </div>

    <div>
        <flux:separator text="Ouvidoria e Reclamações" class="my-8" />

        <livewire:reclamacaoda-minha-escola />

        <!-- Alternador de Escopo: Meus Cursos vs Geral da Escola -->
        <div x-data="{ escopo: 'meus_cursos' }" class="mt-8 mb-4 flex flex-col sm:flex-row items-center justify-between gap-4 bg-zinc-50 dark:bg-neutral-800 p-4 rounded-xl border border-gray-200 dark:border-neutral-700">
            <div>
                <h3 class="text-base font-semibold text-gray-800 dark:text-white">
                    Filtro de Visualização das Reclamações
                </h3>
                <p class="text-xs text-gray-500 dark:text-neutral-400">
                    Cursos vinculados à sua coordenação:
                    <strong class="text-cyan-600 dark:text-cyan-400">{{ $siglasVinculadas ?: 'Nenhum curso vinculado' }}</strong>
                </p>
            </div>

            <div class="inline-flex rounded-lg shadow-xs bg-white dark:bg-neutral-900 p-1 border border-gray-200 dark:border-neutral-700">
                <button
                    type="button"
                    @click="escopo = 'meus_cursos'; Livewire.dispatch('alterar-escopo-reclamacoes', { escopo: 'meus_cursos' })"
                    :class="escopo === 'meus_cursos'
                        ? 'bg-cyan-600 text-white shadow-xs'
                        : 'text-gray-700 dark:text-neutral-300 hover:bg-gray-100 dark:hover:bg-neutral-800'"
                    class="px-4 py-2 text-sm font-medium rounded-md transition-colors"
                >
                    Apenas Meus Cursos ({{ $siglasVinculadas ?: 'Coordenação' }})
                </button>

                <button
                    type="button"
                    @click="escopo = 'geral'; Livewire.dispatch('alterar-escopo-reclamacoes', { escopo: 'geral' })"
                    :class="escopo === 'geral'
                        ? 'bg-cyan-600 text-white shadow-xs'
                        : 'text-gray-700 dark:text-neutral-300 hover:bg-gray-100 dark:hover:bg-neutral-800'"
                    class="px-4 py-2 text-sm font-medium rounded-md transition-colors"
                >
                    Visão Geral da Escola
                </button>
            </div>
        </div>

        <livewire:reclamacao-table escopo="meus_cursos" />
    </div>

    <flux:separator text="Avaliação de Professores (Cursos Vinculados)" class="my-8" />

    @include('partials.coordenador-dashboard', ['cursosVinculados' => $cursosVinculados])
</x-layouts.app>

