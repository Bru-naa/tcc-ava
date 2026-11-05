<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        {{ $slot }}
    </flux:main>
<div vw class="enabled">
      <div vw-access-button class="active"></div>
      <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
      </div>
    </div>
    <script>
      window.addEventListener('load', function () {
        if (document.querySelector('script[src*="vlibras-plugin.js"]')) return;
        const s = document.createElement('script');
        s.src = 'https://vlibras.gov.br/app/vlibras-plugin.js';
        s.async = true;
        s.onload = function () {
          if (window.VLibras) new window.VLibras.Widget('https://vlibras.gov.br/app');
        };
        document.body.appendChild(s);
      });
    </script>



</x-layouts.app.sidebar>
