<!-- SERVICES -->
{{--
  Solution cards. Hooks kept for JS / section CSS (sections/home-services.css):
  h-sol-panel.is-on (staggered reveal + solIn entrance), h-sol-card (entrance delays, illustration hover speed),
  fx-spot (cursor spotlight), fx-viz (adds .is-in to start the illustration), h-sol-art (dotted ::after overlay).
--}}
<section id="services" class="border-t border-line py-sec" data-reveal>
  <div class="wrap">
    <x-section-head tag="Solution">
      I bridge the gap between the website you have <span class="text-accent">and the one your business needs.</span>
      <x-slot:lede>From brand to design to build to launch, I handle what most businesses split across three vendors.</x-slot:lede>
    </x-section-head>
    <div class="h-sol-panel is-on grid grid-cols-2 gap-4 max-md:grid-cols-1">
      @foreach ($solutions as $solution)
        <article class="h-sol-card fx-spot flex flex-col gap-2.5 rounded-lg border border-line bg-surface px-3.5 pt-3.5 pb-6.5 [transition:transform_.35s_var(--ease-spring),border-color_.3s] hover:[transform:translateY(-4px)] hover:border-[rgba(255,77,46,.45)]">
          <div class="fx-viz h-sol-art relative mb-3 overflow-hidden rounded-[18px] border border-line bg-[radial-gradient(60%_65%_at_50%_62%,rgba(255,77,46,.16),transparent_72%),linear-gradient(180deg,#141311,#101010)] px-4.5 pt-10 pb-2.5 max-md:px-2 max-md:pt-11 max-md:pb-1.5"><span class="absolute top-3.5 left-3.5 z-2 rounded-full border border-[rgba(255,77,46,.4)] bg-[rgba(14,14,12,.7)] px-[11px] py-[7px] font-mono text-[11px]/none font-medium tracking-[.08em] text-accent uppercase">{{ $solution['label'] }}</span>{!! $solution['svg'] !!}</div>
          <h3 class="px-2.5 text-[22px] max-md:text-[19px]">{{ $solution['title'] }}</h3>
          <p class="max-w-[48ch] px-2.5 text-[15.5px]">{{ $solution['text'] }}</p>
        </article>
      @endforeach
    </div>
    <div class="mt-7 flex flex-wrap items-center justify-between gap-5">
      <div class="flex flex-wrap gap-3"><x-button href="#contact" arrow>Book a call</x-button><x-button href="#work" variant="ghost">See my work</x-button></div>
    </div>
  </div>
</section>
