<!-- Slider -->
<div data-hs-carousel='{
  "loadingClasses": "opacity-0",
  "dotsItemClasses": "hs-carousel-active:bg-blue-700 hs-carousel-active:border-blue-700 size-3 border border-gray-400 rounded-full cursor-pointer dark:border-neutral-600 dark:hs-carousel-active:bg-blue-500 dark:hs-carousel-active:border-blue-500",
  "slidesQty": {
    "xs": 1,
    "lg": 3
  },
  "isDraggable": true
}' class="relative">

  <div class="hs-carousel w-full overflow-hidden bg-white rounded-lg dark:bg-neutral-900">
    <div class="relative min-h-72 -mx-1">
      <div class="hs-carousel-body absolute top-0 bottom-0 start-0 flex flex-nowrap opacity-0 cursor-grab transition-transform duration-700 hs-carousel-dragging:transition-none hs-carousel-dragging:cursor-grabbing">

        <!-- Slide 1 -->
        <div class="hs-carousel-slide px-1">
          <img src="{{ asset('images/slide.jpeg') }}"
               class="w-full h-72 object-cover rounded-lg"
               alt="Slide 1">
        </div>

        <!-- Slide 2 -->
        <div class="hs-carousel-slide px-1">
          <img src="{{ asset('images/slide.jpeg') }}"
               class="w-full h-72 object-cover rounded-lg"
               alt="Slide 2">
        </div>

        <!-- Slide 3 -->
        <div class="hs-carousel-slide px-1">
          <img src="{{ asset('images/slide.jpeg') }}"
               class="w-full h-72 object-cover rounded-lg"
               alt="Slide 3">
        </div>

      </div>
    </div>
  </div>

  <!-- Controls -->
  <button type="button"
    class="hs-carousel-prev hs-carousel-disabled:opacity-50 hs-carousel-disabled:pointer-events-none absolute inset-y-0 start-0 inline-flex justify-center items-center w-11.5 h-full text-gray-800 hover:bg-gray-800/10 dark:text-white dark:hover:bg-white/10">
    <span aria-hidden="true">
      <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path d="m15 18-6-6 6-6"/>
      </svg>
    </span>
    <span class="sr-only">Anterior</span>
  </button>

  <button type="button"
    class="hs-carousel-next hs-carousel-disabled:opacity-50 hs-carousel-disabled:pointer-events-none absolute inset-y-0 end-0 inline-flex justify-center items-center w-11.5 h-full text-gray-800 hover:bg-gray-800/10 dark:text-white dark:hover:bg-white/10">
    <span class="sr-only">Próximo</span>
    <span aria-hidden="true">
      <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path d="m9 18 6-6-6-6"/>
      </svg>
    </span>
  </button>

  <!-- Dots -->
  <div class="hs-carousel-pagination flex justify-center absolute bottom-3 start-0 end-0 gap-x-2"></div>
</div>
<!-- End Slider -->

<!-- Script Preline (necessário) -->
<script src="https://unpkg.com/preline/dist/preline.js"></script>
