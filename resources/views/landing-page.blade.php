

<x-layouts.navbar>

<section id="home">
   

@includeIf('components.preline.partials-preline.descricao-land')
@includeIf('components.preline.partials-preline.accordion-land')
@includeIf('components.preline.partials-preline.slide-land')
@includeIf('components.preline.partials-preline.beneficios')
@includeIf('components.preline.partials-preline.perfis')







</section>

<!-- SECTION INSTITUIÇÕES -->




<flux:separator class="mb-4 mt-4 " />

 <section id="instituicoes" class="py-16">
    <div class="container mx-auto">
       
    <p class="text-center text-4xl font-bold">Instituições</p>
    
<livewire:dashboard.reclamacoes-por-escola wire:init.lazy="loadEscolas" />

    </div>


</section>

<!-- section sobre nós -->

@include('components.preline.partials-preline.sobrenos-land')



<section id="contato" class="py-16">
    <flux:separator text="Entrar em Contato" class="mt-4 mb-4"/>
    
    <div class="container mx-auto px-4 max-w-2xl">

<section id="contato" class="py-16">
    <div class="container mx-auto px-4 max-w-2xl">

        <!-- Título -->
        <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-white mb-8">
            Gostaria de mais informações?
        </h2>

        <!-- formulário de contato -->
        @include('components.preline.partials-preline.form-land')
        
    </div>
</section>

</x-layouts.navbar>