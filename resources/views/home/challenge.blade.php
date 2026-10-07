<!-- PROBLEM -->
<section class="aws-sec h-chal" data-reveal>
  <div class="aws-wrap">
    <div class="aws-sec-head aws-sec-head--row">
      <div>
        <x-tag>Challenge</x-tag>
        <h2>Your business grew up. <span class="hl">Your website didn't.</span></h2>
        <p>Most sites I'm asked to fix weren't built badly. They were built for a smaller version of the business. Hover or tap a card to see the fix.</p>
      </div>
      <button type="button" class="h-ch-switch" aria-pressed="false"><span class="lbl lbl-a">Before</span><span class="track"><span class="knob"></span></span><span class="lbl lbl-b">After</span></button>
    </div>
    <div class="h-ch-grid">
      @foreach ($challenges as $challenge)
        <article class="h-ch fx-spot" tabindex="0" role="button" aria-pressed="false" aria-label="{{ $challenge['title'] }}. Show the fix">
          <div class="h-ch-art fx-viz"><span class="h-ch-state"><b class="bad">The problem</b><b class="good">Fixed</b></span>{!! $challenge['svg'] !!}</div>
          <span class="h-ch-num" aria-hidden="true">{{ sprintf('%02d', $loop->iteration) }}</span><h3>{{ $challenge['title'] }}</h3>
          <p>{{ $challenge['text'] }}</p>
        </article>
      @endforeach
    </div>
  </div>
</section>
