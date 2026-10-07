<section id="included" class="border-t border-line py-sec">
  <div class="wrap">
    <x-section-head tag="What you get">
      Everything your site needs, <span class="text-accent">in one plan.</span>
      <x-slot:lede>No add-ons and no surprise invoices. The checklist covers all of it.</x-slot:lede>
    </x-section-head>
    <div class="rm-incs rm-grid">
      @foreach ($included as $item)
        <article class="rm-inc fx-spot">
          <div class="rm-inc-art" aria-hidden="true">{!! $item['art'] !!}</div>
          <span class="rm-k">{{ $item['kicker'] }}</span>
          <h3>{{ $item['title'] }}</h3>
          <p>{{ $item['text'] }}</p>
        </article>
      @endforeach
    </div>
  </div>
</section>
