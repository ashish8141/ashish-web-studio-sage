<!-- PROCESS -->
{{--
  14-day sprint calendar. fx.js (ScrollTrigger) sweeps the "today" line across the board and toggles:
  .is-live on the section, .is-now / .is-past on the ruler days, .is-active on the rows whose day range is current.
  The h-cal* classes are its hooks. Below 901px the calendar becomes a plain stack of cards and JS shows the
  floating day pill (.h-proc-float, sections/home-process.css). Each row carries --c (colour), --l and --w (bar position).
--}}
<section id="process" class="h-cal group/cal border-t border-line py-sec">
  {{-- Not the wrap utility: this section has a wider gutter (40px, 34px up to 900px), matching the 40px label column. --}}
  <div class="mx-auto max-w-wrap px-10 max-tab:px-[34px]">
    <div class="mb-12 flex items-end justify-between gap-10 max-tab:mb-8 max-tab:flex-col max-tab:items-start max-tab:gap-4">
      <x-section-head tag="Process" class="mb-0 max-w-[640px]">A 14-day sprint, <span class="text-accent">built to ship.</span></x-section-head>
      <p class="m-0 max-w-[34ch] text-[17px]/[1.55] text-text">No vague timelines and no endless back and forth. Every few days ships a clear output, from first call to a launched website in about two weeks.</p>
    </div>
    <div class="h-cal-board relative">
      <div class="mb-2.5 grid grid-cols-[40px_1fr] gap-1.5 max-tab:hidden" aria-hidden="true"><span class="font-mono text-[10px]/7 font-medium tracking-[.08em] text-muted uppercase">Day</span><div class="h-cal-days grid grid-cols-[repeat(var(--n,14),1fr)]">@foreach ($processDays as $day)<span class="border-l border-line text-center font-mono text-[11px]/7 font-medium text-muted [transition:color_.3s,background_.3s] last:border-r [&.is-now]:bg-accent [&.is-now]:text-paper-ink [&.is-past]:text-text" data-d="{{ $day['day'] }}">{{ $day['label'] }}</span>@endforeach</div></div>
      <div class="h-cal-body relative flex flex-col gap-2.5">
        {{-- Dashed day columns behind the rows; weekends are tinted. --}}
        <div class="pointer-events-none absolute inset-y-0 right-0 left-[46px] z-0 grid grid-cols-[repeat(var(--n,14),1fr)] max-tab:hidden" aria-hidden="true">@foreach ($processDays as $day)<i @class(['border-l border-dashed border-line last:border-r', 'bg-[rgba(255,255,255,.012)]' => in_array($day['day'] % 7, [6, 0])])></i>@endforeach</div>
        {{-- "Today" line: fx.js moves it with an inline transform. --}}
        <div class="h-cal-now pointer-events-none absolute inset-y-0 left-[46px] z-3 -ml-px w-0.5 bg-accent opacity-0 shadow-[0_0_18px_rgba(255,77,46,.55)] [transform:translateX(0)] [transition:opacity_.3s] group-[.is-live]/cal:opacity-100 max-tab:hidden" aria-hidden="true"><b class="hidden">Day 1</b></div>
        @foreach ($processSteps as $step)
          <div class="h-cal-row group/row relative z-1 grid min-h-[176px] grid-cols-[40px_1fr] gap-1.5 max-tab:min-h-0 max-tab:grid-cols-[34px_1fr]" data-from="{{ $step['from'] }}" data-to="{{ $step['to'] }}" style="--c:{{ $step['color'] }};--l:{{ $step['left'] }};--w:{{ $step['width'] }}">
            <div class="h-cal-lab flex items-center justify-center bg-(--c)"><span class="font-mono text-[11px]/none font-semibold tracking-[.12em] text-paper-ink uppercase [writing-mode:vertical-rl] [transform:rotate(180deg)]">{{ $step['label'] }}</span></div>
            <div class="relative">
              @include('home.process.bar')
            </div>
          </div>
        @endforeach
      </div>
    </div>
    <div class="mt-9 flex items-center justify-between gap-6 border-t border-line pt-6 max-tab:flex-col max-tab:items-start">
      <p class="text-[14px] text-muted">Typical timeline for a business website. Larger stores and web apps are scoped per project.</p>
      <x-button :href="$bookUrl">Start your sprint <span aria-hidden="true">&rarr;</span></x-button>
    </div>
  </div>
</section>
