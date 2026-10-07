<!-- SERVICES -->
<section id="services" class="aws-sec h-sol" data-reveal>
  <div class="aws-wrap">
    <div class="aws-sec-head">
      <x-tag>Solution</x-tag>
      <h2>I bridge the gap between the website you have <span class="hl">and the one your business needs.</span></h2>
      <p>From brand to design to build to launch, I handle what most businesses split across three vendors.</p>
    </div>
    <div class="h-sol-panel is-on">
      @foreach ($solutions as $solution)
        <article class="h-sol-card fx-spot">
          <div class="fx-viz h-sol-art"><span class="h-sol-k">{{ $solution['label'] }}</span>{!! $solution['svg'] !!}</div>
          <h3>{{ $solution['title'] }}</h3>
          <p>{{ $solution['text'] }}</p>
        </article>
      @endforeach
    </div>
    <div class="h-sol-foot">
      <div class="h-sol-cta"><a class="aws-btn aws-btn--accent" href="#contact">Book a call <span class="arr">&rarr;</span></a><a class="aws-btn aws-btn--ghost" href="#work">See my work</a></div>
    </div>
  </div>
</section>
