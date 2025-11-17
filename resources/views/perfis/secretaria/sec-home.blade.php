<x-layouts.app>
   

  <p>Seja bem-vindo(a), {{ auth()->user()->name }}</p>

<flux:separator />

<div class="relative items-center w-full px-5 py-12 mx-auto md:px-12 lg:px-24 max-w-7xl">
  <div class="p-6 border-l-4 -6 rounded-r-xl border-yellow-800/50">
    <div class="flex">
      <div class="flex-shrink-0">
        <svg class="w-5 h-5 text-yellow-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill="currentColor"
                d="M23.119,20,13.772,2.15h0a2,2,0,0,0-3.543,0L.881,20a2,2,0,0,0,1.772,2.928H21.347A2,2,0,0,0,23.119,20ZM11,8.423a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Zm1.05,11.51h-.028a1.528,1.528,0,0,1-1.522-1.47,1.476,1.476,0,0,1,1.448-1.53h.028A1.527,1.527,0,0,1,13.5,18.4,1.475,1.475,0,0,1,12.05,19.933Z">
            </path>
        </svg>
      </div>
      <div class="ml-3">
        <div class="text-sm text-yellow-800">
          <p> Por favor, ative a autenticação de dois fatores em sua conta para aumentar a segurança. Se já ativou, ignore essa mensagem.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!--  <div class="bg-orange-200 px-6 py-4 my-4 rounded-md text-lg flex items-center mx-auto max-w-lg">
        <svg viewBox="0 0 24 24" class="text-yellow-600 w-5 h-5 sm:w-5 sm:h-5 mr-3">
            <path fill="currentColor"
                d="M23.119,20,13.772,2.15h0a2,2,0,0,0-3.543,0L.881,20a2,2,0,0,0,1.772,2.928H21.347A2,2,0,0,0,23.119,20ZM11,8.423a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Zm1.05,11.51h-.028a1.528,1.528,0,0,1-1.522-1.47,1.476,1.476,0,0,1,1.448-1.53h.028A1.527,1.527,0,0,1,13.5,18.4,1.475,1.475,0,0,1,12.05,19.933Z">
            </path>
        </svg>
        <span class="text-yellow-800">
        Por favor, ative a autenticação de dois fatores em sua conta para aumentar a segurança. Se já ativou, ignore essa mensagem.
      </span>
    </div> -->
    
</x-layouts.app>