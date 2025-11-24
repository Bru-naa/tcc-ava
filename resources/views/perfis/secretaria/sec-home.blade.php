<x-layouts.app>
   

 <p class="text-base text-center lg:text-4xl font-semibold mt-2 mb-8">
  Seja bem-vindo(a), {{ auth()->user()->name }}
</p>
<div class="bg-white mb-8 border border-gray-200 rounded-lg shadow-lg p-4 dark:border-neutral-700" role="alert" tabindex="-1" aria-labelledby="hs-discovery-label">
  <div class="flex">
    <div class="shrink-0">
      <svg class="shrink-0 size-4 text-blue-600 mt-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"></circle>
        <path d="M12 16v-4"></path>
        <path d="M12 8h.01"></path>
      </svg>
    </div>
    <div class="ms-3">
      <h3 id="hs-discovery-label" class="text-gray-800 font-semibold dark:text-black text-center">
        Autenticação de dois fatores disponível
      </h3>
      <p class="mt-2 text-sm text-gray-700 dark:text-neutral-800 text-center">
        Por favor, por motivos de segurança ative a autenticação de dois fatores. Se já ativou, desconsidere.
      </p>
    </div>
  </div>
</div>

<flux:separator />

<div id="avaliacoes">
   <livewire:avaliacoes-status />

</div>




<flux:separator text="Novos usuários" class="my-8 mt-4" />

<livewire:importar-pre-cadastro />

<div class="flex flex-col lg:flex-row items-start gap-6 mb-8">
    <div class="lg:flex-1 w-full">
        @include('flux.precadastro-form', ['roles' => $roles, 'escolas' => $escolas])
    </div>
    <div class="lg:flex-1 w-full">
         @include('flux.aluno-form', ['cursos' => $cursos]) 
    </div>
    <div class="lg:flex-1 w-full">
        @include('flux.curso-form')
    </div>
</div>


<livewire:reclamacoes-table />
<flux:separator text="Gerenciamento de dados (Tabelas)" class="my-8 mt-12 mb-12" />

<div class="hs-accordion-group mt-4">
  <!-- Cursos -->
  <div class="hs-accordion active bg-white border border-gray-200 -mt-px first:rounded-t-lg last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700" id="hs-bordered-heading-one">
    <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 py-4 px-5 hover:text-gray-500 disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-none dark:focus:text-neutral-400" aria-expanded="true" aria-controls="hs-basic-bordered-collapse-one">
      <svg class="hs-accordion-active:hidden block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M5 12h14"></path>
        <path d="M12 5v14"></path>
      </svg>
      <svg class="hs-accordion-active:block hidden size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M5 12h14"></path>
      </svg>
      Cursos
    </button>
    <div id="hs-basic-bordered-collapse-one" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="hs-bordered-heading-one">
      <div class="pb-6 px-5">
     
<liverwire:curso-edit-modal />
<livewire:curso-table />


      </div>
    </div>
  </div>

  <!-- Alunos -->
  <div class="hs-accordion bg-white border border-gray-200 -mt-px first:rounded-t-lg last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700" id="hs-bordered-heading-two">
    <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 py-4 px-5 hover:text-gray-500 disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-none dark:focus:text-neutral-400" aria-expanded="false" aria-controls="hs-basic-bordered-collapse-two">
      <svg class="hs-accordion-active:hidden block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M5 12h14"></path>
        <path d="M12 5v14"></path>
      </svg>
      <svg class="hs-accordion-active:block hidden size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M5 12h14"></path>
      </svg>
      Alunos
    </button>
    <div id="hs-basic-bordered-collapse-two" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="hs-bordered-heading-two">
      <div class="pb-6 px-5">
        <livewire:aluno-table />
      </div>
    </div>
  </div>

  <!-- Pré Cadastros -->
  <div class="hs-accordion bg-white border border-gray-200 -mt-px first:rounded-t-lg last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700" id="hs-bordered-heading-three">
    <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 py-4 px-5 hover:text-gray-500 disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-none dark:focus:text-neutral-400" aria-expanded="false" aria-controls="hs-basic-bordered-collapse-three">
      <svg class="hs-accordion-active:hidden block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M5 12h14"></path>
        <path d="M12 5v14"></path>
      </svg>
      <svg class="hs-accordion-active:block hidden size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M5 12h14"></path>
      </svg>
      Pré Cadastros
    </button>
    <div id="hs-basic-bordered-collapse-three" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="hs-bordered-heading-three">
      <div class="pb-6 px-5">
        <livewire:pre-cadastro-table />
      </div>
    </div>
  </div>
</div>




</x-layouts.app>
