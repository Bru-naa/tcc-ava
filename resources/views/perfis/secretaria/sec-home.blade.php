<x-layouts.app>
   

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

<flux:separator text="Gerenciamento de usuários" class="my-8" />

<livewire:importar-pre-cadastro />

<div class="flex items-center justify-between gap-4 mb-8">
    
    <div class="flex-1">
        @include('flux.precadastro-form', ['roles' => $roles, 'escolas' => $escolas])
    </div>
    
    <div class="flex-shrink-0">
        <livewire:gerenciador-usuarios />
    </div>

</div>

<livewire:pre-cadastro-table/>
<!-- <livewire:pre-registro-table /> -->

<flux:separator />

<livewire:alunos-table />

<flux:separator />

<livewire:reclamacoes-table />


</x-layouts.app>
