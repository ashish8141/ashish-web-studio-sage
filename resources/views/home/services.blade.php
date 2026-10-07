<!-- SERVICES -->
<section id="services" class="h-sol border-t border-line py-sec" data-reveal>
  <div class="wrap">
    <x-section-head tag="Solution">
      I bridge the gap between the website you have <span class="text-accent">and the one your business needs.</span>
      <x-slot:lede>From brand to design to build to launch, I handle what most businesses split across three vendors.</x-slot:lede>
    </x-section-head>
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
      <div class="h-sol-cta"><x-button href="#contact" arrow>Book a call</x-button><x-button href="#work" variant="ghost">See my work</x-button></div>
    </div>
  </div>
</section>
