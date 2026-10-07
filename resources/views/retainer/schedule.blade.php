<section id="process" class="aws-sec rm-calsec">
  <div class="aws-wrap">
    <div class="h-cal-top">
      <div class="aws-sec-head">
        <x-tag>How it works</x-tag>
        <h2>Your month, <span class="hl">week by week.</span></h2>
      </div>
      <p class="h-cal-lede">What happens every week, every two weeks and every month, including your weekly Zoom call and the five website changes included in the plan.</p>
    </div>
    <div class="rm-cal" data-wk="0">
      <div class="rm-cal-head" aria-hidden="true"><span>Task</span>@foreach ($weeks as $week => $tasks)<span class="c{{ $week }}">Week {{ $week }}</span>@endforeach</div>
      @foreach ($schedule as $row)
        <div class="rm-cal-row" style="--c:{{ $row['color'] }}">
          <div class="rm-cal-lab">
            <span class="rm-cad">{{ $row['cadence'] }}</span>
            <h3>{{ $row['title'] }}</h3>
            <p>{{ $row['text'] }}</p>
          </div>
          @foreach ($weeks as $week => $tasks)
            <div class="rm-cal-cell c{{ $week }}">@if (isset($row['weeks'][$week]))<span class="rm-cal-pill"><i>{!! $check !!}</i>{{ $row['weeks'][$week] }}</span>@else<span class="rm-cal-empty" aria-hidden="true"></span>@endif</div>
          @endforeach
        </div>
      @endforeach
    </div>
    <div class="rm-cal-m">
      @foreach ($weeks as $week => $tasks)
        <div class="rm-cal-wk">
          <div class="rm-cal-wk-h">Week {{ $week }}</div>
          <ul>@foreach ($tasks as $task)<li style="--c:{{ $task['color'] }}"><b>{{ $task['title'] }}</b><span>{{ $task['cadence'] }}</span></li>@endforeach</ul>
        </div>
      @endforeach
    </div>
  </div>
</section>
