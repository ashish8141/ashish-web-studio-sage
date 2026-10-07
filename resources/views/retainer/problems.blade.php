<section class="py-sec">
  <div class="wrap">
    <x-section-head tag="The problem">
      An unmaintained site <span class="text-accent">breaks quietly.</span>
      <x-slot:lede>WordPress is not set and forget. Without regular care, small problems stack up until one of them takes the site down, lets someone in or loses you a lead.</x-slot:lede>
    </x-section-head>
    {{-- rm-grid: JS hook (staggered reveal). rm-prob-ico: icon strokes in retainer.css. --}}
    <div class="rm-grid grid grid-cols-[repeat(4,1fr)] gap-4 max-[1001px]:grid-cols-[repeat(2,1fr)] max-sm:grid-cols-[1fr]">
      @foreach ($problems as $problem)
        <article class="fx-spot rounded-lg border border-line bg-surface px-6 pt-6.5 pb-7 [transition:transform_.4s,border-color_.4s] hover:border-line-2 hover:[transform:translateY(-4px)]">
          <div class="rm-prob-ico mb-5.5 flex size-19 items-center justify-center rounded-[14px] border border-line bg-surface-2" aria-hidden="true">{!! $problem['icon'] !!}</div>
          <span class="font-mono text-[11px]/none font-medium tracking-[.06em] text-muted">0{{ $loop->iteration }}</span>
          <h3 class="mt-2.5 mb-2 text-[20px]">{{ $problem['title'] }}</h3>
          <p class="text-[15px]/[1.55] text-muted">{{ $problem['text'] }}</p>
        </article>
      @endforeach
    </div>
  </div>
</section>
