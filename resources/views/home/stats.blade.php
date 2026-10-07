<!-- STATS -->
<section class="aws-sec h-stats-sec" data-reveal>
  <div class="aws-wrap">
    <div class="aws-sec-head">
      <h2>Eight years of shipping, <span class="hl">in numbers.</span></h2>
    </div>
    <div class="h-stats">
      @foreach ($stats as $stat)
        <div class="h-stat">
          @switch($stat['viz'])
            @case('grid')
              <div class="fx-viz h-stat-viz v-grid" aria-hidden="true">@for ($i = 0; $i < 70; $i++)<i style="--i:{{ $i }}"></i>@endfor</div>
              @break
            @case('years')
              <div class="fx-viz h-stat-viz v-years" aria-hidden="true"><div class="v-yrow">@for ($i = 0; $i < 8; $i++)<i style="--i:{{ $i }}"></i>@endfor</div><div class="v-ylab"><span>{{ $statYears['from'] }}</span><span>{{ $statYears['to'] }}</span></div></div>
              @break
            @case('ring')
              <div class="fx-viz h-stat-viz v-ring" aria-hidden="true"><svg viewBox="0 0 64 64"><circle class="v-ring-t" cx="32" cy="32" r="26"/><circle class="v-ring-f" pathLength="100" cx="32" cy="32" r="26"/><path class="v-ring-c" d="M23 33l6 6 12-13"/></svg></div>
              @break
            @case('clock')
              <div class="fx-viz h-stat-viz v-clock" aria-hidden="true"><svg viewBox="0 0 64 64">@foreach ($clockTicks as $tick)<line style="--i:{{ $loop->index }}" x1="{{ $tick['x1'] }}" y1="{{ $tick['y1'] }}" x2="{{ $tick['x2'] }}" y2="{{ $tick['y2'] }}"/>@endforeach<line class="v-hand" x1="32" y1="32" x2="32" y2="14"/><circle class="v-hub" cx="32" cy="32" r="2.5"/></svg></div>
              @break
          @endswitch
          <div class="n"><span @if ($stat['count']) data-count="{{ $stat['value'] }}" @endif>{{ $stat['value'] }}</span><em>{{ $stat['suffix'] }}</em></div><div class="l">{{ $stat['label'] }}</div>
        </div>
      @endforeach
    </div>
  </div>
</section>
