<!-- PROBLEM -->
<section class="h-chal py-sec" data-reveal>
  <div class="wrap">
    <x-section-head tag="Challenge">
      Your business grew up. <span class="text-accent">Your website didn't.</span>
      <x-slot:lede>Most sites I'm asked to fix weren't built badly. They were built for a smaller version of the business. Hover or tap a card to see the fix.</x-slot:lede>
      <x-slot:aside><button type="button" class="h-ch-switch" aria-pressed="false"><span class="lbl lbl-a">Before</span><span class="track"><span class="knob"></span></span><span class="lbl lbl-b">After</span></button></x-slot:aside>
    </x-section-head>
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
