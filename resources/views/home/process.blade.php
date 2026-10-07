<!-- PROCESS -->
<section id="process" class="aws-sec h-cal">
  <div class="aws-wrap">
    <div class="h-cal-top">
      <div class="aws-sec-head">
        <x-tag>Process</x-tag>
        <h2>A 14-day sprint, <span class="hl">built to ship.</span></h2>
      </div>
      <p class="h-cal-lede">No vague timelines and no endless back and forth. Every few days ships a clear output, from first call to a launched website in about two weeks.</p>
    </div>
    <div class="h-cal-board">
      <div class="h-cal-ruler" aria-hidden="true"><span class="h-cal-gut">Day</span><div class="h-cal-days">@foreach ($processDays as $day)<span data-d="{{ $day['day'] }}">{{ $day['label'] }}</span>@endforeach</div></div>
      <div class="h-cal-body">
        <div class="h-cal-grid" aria-hidden="true">@foreach ($processDays as $day)<i></i>@endforeach</div>
        <div class="h-cal-now" aria-hidden="true"><b>Day 1</b></div>
        @foreach ($processSteps as $step)
          <div class="h-cal-row" data-from="{{ $step['from'] }}" data-to="{{ $step['to'] }}" style="--c:{{ $step['color'] }};--l:{{ $step['left'] }};--w:{{ $step['width'] }}">
            <div class="h-cal-lab"><span>{{ $step['label'] }}</span></div>
            <div class="h-cal-track">
              <article class="h-cal-bar fx-spot">
                <div class="h-cal-ico" aria-hidden="true">{!! $step['icon'] !!}</div>
                <div class="h-step-when">Day {{ $step['from'] }}&ndash;{{ $step['to'] }}</div>
                <h3>{{ $step['title'] }}</h3>
                <p>{{ $step['text'] }}</p>
              </article>
            </div>
          </div>
        @endforeach
      </div>
    </div>
    <div class="h-cal-foot">
      <p>Typical timeline for a business website. Larger stores and web apps are scoped per project.</p>
      <a class="aws-btn aws-btn--accent" href="{{ $bookUrl }}">Start your sprint <span aria-hidden="true">&rarr;</span></a>
    </div>
  </div>
</section>
