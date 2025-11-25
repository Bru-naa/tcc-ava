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

<div>
<flux:separator text="Dashboard" class="my-8" />
</div>

@includeIf('partials.professor-dashboard')


<footer><a href="https://wa.me/15558465326" class="wa-float-img-circle" target="_blank">
    <img src="https://cdn.sendpulse.com/img/messengers/sp-i-small-forms-wa.svg" alt="WhatsApp"/>
</a>
<style type="text/css"> .wa-float-img-circle { width: 56px; height: 56px; bottom: 20px; right: 20px; border-radius: 100%; position: fixed; z-index: 99999; display: flex; transition: all .3s; align-items: center; justify-content: center; background: #25D366; } .wa-float-img-circle img { position: relative; } .wa-float-img-circle:before { position: absolute; content: ''; background-color: #25D366; width: 70px; height: 70px; bottom: -7px; right: -7px; border-radius: 100%; animation: wa-float-circle-fill-anim 2.3s infinite ease-in-out; transform-origin: center; opacity: .2; } .wa-float-img-circle:hover{ box-shadow: 0px 3px 16px #24af588a; } .wa-float-img-circle:focus{ box-shadow: 0px 0 0 3px #25d36645; } .wa-float-img-circle:hover:before, .wa-float-img-circle:focus:before{ display: none; } @keyframes wa-float-circle-fill-anim { 0% { transform: rotate(0deg) scale(0.7) skew(1deg); } 50% { transform: rotate(0deg) scale(1) skew(1deg); } 100% { transform: rotate(0deg) scale(0.7) skew(1deg); } }</style></footer>


</x-layouts.app>