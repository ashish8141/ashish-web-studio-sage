<!-- PROBLEM -->
<section class="h-chal py-sec" data-reveal>
  <div class="wrap">
    <x-section-head tag="Challenge">
      Your business grew up. <span class="text-accent">Your website didn't.</span>
      <x-slot:lede>Most sites I'm asked to fix weren't built badly. They were built for a smaller version of the business. Hover or tap a card to see the fix.</x-slot:lede>
      <x-slot:aside><button type="button" class="h-ch-switch group/sw box-content inline-flex text-start cursor-pointer appearance-none items-center gap-3 rounded-full border border-line-2 bg-surface px-3.5 py-2.5 font-mono text-[12px] leading-[normal] font-medium tracking-[.06em] text-muted uppercase focus-visible:outline-2 focus-visible:outline-offset-3 focus-visible:outline-accent" aria-pressed="false"><span class="text-ink group-aria-pressed/sw:text-muted">Before</span><span class="relative h-6 w-[46px] rounded-full bg-[#2a2925] [transition:background_.3s] group-aria-pressed/sw:bg-accent"><span class="absolute top-[3px] left-[3px] size-4.5 rounded-full bg-ink [transition:transform_.4s_var(--ease-spring)] group-aria-pressed/sw:[transform:translateX(22px)]"></span></span><span class="group-aria-pressed/sw:text-ink">After</span></button></x-slot:aside>
    </x-section-head>
    <div class="h-ch-grid grid grid-cols-[1fr_1fr] gap-4 max-md:grid-cols-[1fr]">
      @foreach ($challenges as $challenge)
        <article class="h-ch fx-spot group/ch flex cursor-pointer flex-col gap-2.5 rounded-lg border border-line bg-surface px-3.5 pt-3.5 pb-6.5 [transition:border-color_.35s,transform_.35s_var(--ease-spring)] focus-visible:outline-2 focus-visible:outline-offset-3 focus-visible:outline-accent [&.is-fixed]:border-[rgba(255,77,46,.5)] [@media(hover:hover)]:hover:border-[rgba(255,77,46,.5)]" tabindex="0" role="button" aria-pressed="false" aria-label="{{ $challenge['title'] }}. Show the fix">
          <div class="fx-viz relative overflow-hidden rounded-[18px] border border-line bg-[radial-gradient(60%_70%_at_50%_60%,rgba(179,71,44,.14),transparent_70%),linear-gradient(180deg,#141311,#101010)] px-3.5 pt-10 pb-3 [transition:background_.6s] group-[.is-fixed]/ch:bg-[radial-gradient(60%_70%_at_50%_60%,rgba(255,77,46,.2),transparent_70%),linear-gradient(180deg,#141311,#101010)] max-md:px-1.5 max-md:pt-11 max-md:pb-2"><span class="absolute top-3.5 left-3.5 z-2 font-mono text-[11px]/none font-medium tracking-[.08em] uppercase"><b class="inline-block rounded-full border border-[rgba(179,71,44,.55)] bg-[rgba(14,14,12,.7)] px-[11px] py-[7px] font-medium text-[#e07a5f] [transition:opacity_.35s,transform_.45s_var(--ease-spring)] group-[.is-fixed]/ch:[transform:translateY(-8px)] group-[.is-fixed]/ch:opacity-0 [@media(hover:hover)]:group-hover/ch:[transform:translateY(-8px)] [@media(hover:hover)]:group-hover/ch:opacity-0">The problem</b><b class="absolute top-0 left-0 inline-block [transform:translateY(8px)] rounded-full bg-accent px-[11px] py-[7px] font-medium text-paper-ink opacity-0 [transition:opacity_.35s,transform_.45s_var(--ease-spring)] group-[.is-fixed]/ch:[transform:none] group-[.is-fixed]/ch:opacity-100 [@media(hover:hover)]:group-hover/ch:[transform:none] [@media(hover:hover)]:group-hover/ch:opacity-100">Fixed</b></span>{!! $challenge['svg'] !!}</div>
          <span class="-mb-1 block px-2.5 font-mono text-[12px] leading-[normal] font-medium text-accent" aria-hidden="true">{{ sprintf('%02d', $loop->iteration) }}</span><h3 class="flex items-baseline gap-3 px-2.5 text-[21px] max-md:text-[19px]">{{ $challenge['title'] }}</h3>
          <p class="px-2.5 text-[15.5px]">{{ $challenge['text'] }}</p>
        </article>
      @endforeach
    </div>
  </div>
</section>
