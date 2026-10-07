<!-- STATS -->
@php
  // Shared box of the four infographics: 64px tall, scaled down on phones. fx.js adds .is-in when it scrolls into view.
  $viz = 'fx-viz mb-5.5 max-md:origin-bottom-left max-md:[transform:scale(.85)]';
@endphp
<section class="h-stats-sec border-t border-line py-sec" data-reveal>
  <div class="wrap">
    <x-section-head class="mb-9">Eight years of shipping, <span class="text-accent">in numbers.</span></x-section-head>
    <div class="h-stats grid grid-cols-[repeat(4,1fr)] border-y border-line max-lg:grid-cols-[1fr_1fr]">
      @foreach ($stats as $stat)
        <div class="border-l border-line px-7 py-10 first:border-l-0 first:pl-0 max-lg:nth-3:border-l-0 max-lg:nth-3:pl-0 max-lg:nth-[n+3]:border-t max-md:px-3.5 max-md:py-7 max-md:odd:pl-0">
          @switch($stat['viz'])
            @case('grid')
              {{-- 70 squares fill in one by one; the last 30 use the lighter accent. --}}
              <div class="{{ $viz }} group grid h-auto w-[170px] items-end grid-cols-[repeat(14,1fr)] gap-1 max-md:w-[150px]" aria-hidden="true">@for ($i = 0; $i < 70; $i++)<i @class([
                'block aspect-square rounded-[2px] bg-[#2a2925] [transition:background_.3s_calc(var(--i)*16ms)] motion-reduce:bg-accent',
                'group-[.is-in]:bg-accent' => $i < 40,
                'group-[.is-in]:bg-accent-2! group-[.is-in]:opacity-75' => $i >= 40,
              ]) style="--i:{{ $i }}"></i>@endfor</div>
              @break
            @case('years')
              {{-- Eight blocks, each filled from the left by its ::after, one after another. --}}
              <div class="{{ $viz }} group flex h-16 w-[170px] flex-col items-stretch justify-end" aria-hidden="true"><div class="flex gap-1">@for ($i = 0; $i < 8; $i++)<i class="relative h-3.5 flex-1 overflow-hidden rounded-[3px] bg-[#2a2925] after:absolute after:inset-0 after:origin-left after:[transform:scaleX(0)] after:bg-accent after:[transition:transform_.35s_ease_calc(var(--i)*140ms)] after:content-[''] group-[.is-in]:after:[transform:scaleX(1)] motion-reduce:after:[transform:scaleX(1)]" style="--i:{{ $i }}"></i>@endfor</div><div class="mt-2 flex justify-between font-mono text-[10px] leading-[normal] font-medium text-muted"><span>{{ $statYears['from'] }}</span><span>{{ $statYears['to'] }}</span></div></div>
              @break
            @case('ring')
              <div class="{{ $viz }} v-ring flex h-16 items-end" aria-hidden="true"><svg class="size-16" viewBox="0 0 64 64"><circle class="v-ring-t" cx="32" cy="32" r="26"/><circle class="v-ring-f" pathLength="100" cx="32" cy="32" r="26"/><path class="v-ring-c" d="M23 33l6 6 12-13"/></svg></div>
              @break
            @case('clock')
              <div class="{{ $viz }} v-clock flex h-16 items-end" aria-hidden="true"><svg class="size-16" viewBox="0 0 64 64">@foreach ($clockTicks as $tick)<line style="--i:{{ $loop->index }}" x1="{{ $tick['x1'] }}" y1="{{ $tick['y1'] }}" x2="{{ $tick['x2'] }}" y2="{{ $tick['y2'] }}"/>@endforeach<line class="v-hand" x1="32" y1="32" x2="32" y2="14"/><circle class="v-hub" cx="32" cy="32" r="2.5"/></svg></div>
              @break
          @endswitch
          <div class="font-sans text-[clamp(44px,5.4vw,72px)]/none font-medium tracking-[-.045em] text-ink"><span @if ($stat['count']) data-count="{{ $stat['value'] }}" @endif>{{ $stat['value'] }}</span><em class="text-accent not-italic">{{ $stat['suffix'] }}</em></div><div class="mt-3 max-w-[22ch] text-[15px] text-muted">{{ $stat['label'] }}</div>
        </div>
      @endforeach
    </div>
  </div>
</section>
