<section id="included" class="border-t border-line py-sec">
  <div class="wrap">
    <x-section-head tag="What you get">
      Everything your site needs, <span class="text-accent">in one plan.</span>
      <x-slot:lede>No add-ons and no surprise invoices. The checklist covers all of it.</x-slot:lede>
    </x-section-head>
    {{-- rm-grid: JS hook (staggered reveal). rm-inc / rm-inc-art: perspective grid, icon strokes and icon hover lift in retainer.css. --}}
    <div class="rm-grid grid grid-cols-[repeat(4,1fr)] gap-4 max-xl:grid-cols-[repeat(2,1fr)] max-sm:grid-cols-[1fr]">
      @foreach ($included as $item)
        <article class="rm-inc fx-spot rounded-lg border border-line bg-surface px-3.5 pt-3.5 pb-6.5 [transition:transform_.4s,border-color_.4s] hover:border-[rgba(255,77,46,.4)] hover:[transform:translateY(-4px)]">
          <div class="rm-inc-art relative mb-5 flex h-[150px] items-center justify-center overflow-hidden rounded-[12px] border border-line bg-[radial-gradient(55%_60%_at_50%_60%,rgba(255,77,46,.16),transparent_72%),linear-gradient(180deg,#141311,#101010)]" aria-hidden="true">{!! $item['art'] !!}</div>
          <span class="mx-2.5 inline-block font-mono text-[11px]/none font-medium tracking-[.08em] text-accent uppercase">{{ $item['kicker'] }}</span>
          <h3 class="mx-2.5 mt-2.5 mb-2 text-[20px]">{{ $item['title'] }}</h3>
          <p class="mx-2.5 text-[15px]/[1.55] text-muted">{{ $item['text'] }}</p>
        </article>
      @endforeach
    </div>
  </div>
</section>
