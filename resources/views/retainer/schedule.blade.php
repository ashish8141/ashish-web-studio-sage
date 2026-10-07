<section id="process" class="border-t border-line py-sec">
  <div class="wrap">
    <div class="mb-12 flex items-end justify-between gap-10 max-tab:mb-8 max-tab:flex-col max-tab:items-start max-tab:gap-4">
      <x-section-head tag="How it works" class="mb-0 max-w-[640px]">Your month, <span class="text-accent">week by week.</span></x-section-head>
      <p class="m-0 max-w-[34ch] text-[17px]/[1.55] text-text">What happens every week, every two weeks and every month, including your weekly Zoom call and the five website changes included in the plan.</p>
    </div>
    {{-- Desktop calendar. The script in retainer/scripts sets data-wk (0-4) while scrolling; retainer.css highlights that week's column (.c1-.c4, .rm-cal-head, .rm-cal-pill). --}}
    <div class="rm-cal overflow-hidden rounded-[18px] border border-line bg-surface max-[781px]:hidden" data-wk="0">
      <div class="rm-cal-head grid grid-cols-[minmax(260px,1.35fr)_repeat(4,1fr)] text-muted max-[1001px]:grid-cols-[minmax(200px,1.2fr)_repeat(4,1fr)]" aria-hidden="true">
        <span class="border-b border-line px-4.5 py-4 font-mono text-[11px]/none font-medium tracking-[.06em] uppercase [transition:color_.3s,background_.3s]">Task</span>
        @foreach ($weeks as $week => $tasks)<span class="c{{ $week }} border-b border-l border-line px-4.5 py-4 text-center font-mono text-[11px]/none font-medium tracking-[.06em] uppercase [transition:color_.3s,background_.3s]">Week {{ $week }}</span>@endforeach
      </div>
      @foreach ($schedule as $row)
        <div @class(['grid grid-cols-[minmax(260px,1.35fr)_repeat(4,1fr)] max-[1001px]:grid-cols-[minmax(200px,1.2fr)_repeat(4,1fr)]', 'border-t border-line' => ! $loop->first]) style="--c:{{ $row['color'] }}">
          <div class="border-l-[3px] border-l-(--c) px-5.5 py-5">
            <span class="inline-block border border-[color-mix(in_srgb,var(--c)_60%,transparent)] px-[7px] py-[5px] font-mono text-[10px]/none font-medium tracking-[.06em] text-(color:--c) uppercase">{{ $row['cadence'] }}</span>
            <h3 class="mt-2.5 mb-1.5 text-[18px]">{{ $row['title'] }}</h3>
            <p class="text-[13.5px]/[1.5] text-muted">{{ $row['text'] }}</p>
          </div>
          @foreach ($weeks as $week => $tasks)
            <div class="c{{ $week }} flex items-center justify-center border-l border-line px-2.5 py-3.5 [transition:background_.35s]">@if (isset($row['weeks'][$week]))<span class="rm-cal-pill inline-flex items-center gap-2 rounded-[8px] border border-l-[3px] border-[color-mix(in_srgb,var(--c)_45%,transparent)] border-l-(--c) bg-[color-mix(in_srgb,var(--c)_12%,var(--color-surface-2))] py-[9px] pr-3 pl-2.5 text-left font-sans text-[13px]/[1.2] font-medium text-ink [transition:transform_.35s,box-shadow_.35s] max-[1001px]:p-2 max-[1001px]:text-[12px]"><i class="flex size-4.5 flex-none items-center justify-center rounded-full bg-(--c) text-paper-ink max-[1001px]:hidden"><x-rm-check class="size-[11px] stroke-current stroke-3" /></i>{{ $row['weeks'][$week] }}</span>@else<span class="size-[5px] rounded-full bg-line-2" aria-hidden="true"></span>@endif</div>
          @endforeach
        </div>
      @endforeach
    </div>
    {{-- Phone version: one card per week. --}}
    <div class="hidden gap-3 max-[781px]:grid">
      @foreach ($weeks as $week => $tasks)
        <div class="overflow-hidden rounded-md border border-line bg-surface">
          <div class="bg-accent px-4 py-3 font-mono text-[12px]/none font-medium tracking-[.06em] text-paper-ink uppercase">Week {{ $week }}</div>
          <ul class="px-4 py-1.5">@foreach ($tasks as $task)<li class="my-2 flex items-center justify-between gap-3 rounded-r-[8px] border-l-[3px] border-l-(--c) bg-[color-mix(in_srgb,var(--c)_7%,transparent)] p-3" style="--c:{{ $task['color'] }}"><b class="text-[15px] font-medium text-ink">{{ $task['title'] }}</b><span class="text-right font-mono text-[10px]/[1.2] font-medium tracking-[.05em] text-(color:--c) uppercase">{{ $task['cadence'] }}</span></li>@endforeach</ul>
        </div>
      @endforeach
    </div>
  </div>
</section>
