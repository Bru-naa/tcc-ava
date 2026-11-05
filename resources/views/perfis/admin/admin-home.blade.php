<x-layouts.app>
    <p class="text-base text-center lg:text-4xl font-semibold mt-2 mb-8">
        Painel Administrativo — {{ auth()->user()->name }}
    </p>

    <livewire:dashboard.reclamacoes-por-escola />
</x-layouts.app>
