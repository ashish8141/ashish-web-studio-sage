<section id="included" class="aws-sec">
  <div class="aws-wrap">
    <div class="aws-sec-head">
      <x-tag>What you get</x-tag>
      <h2>Everything your site needs, <span class="hl">in one plan.</span></h2>
      <p>No add-ons and no surprise invoices. The checklist covers all of it.</p>
    </div>
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
