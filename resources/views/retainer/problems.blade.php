<section class="py-sec">
  <div class="wrap">
    <x-section-head tag="The problem">
      An unmaintained site <span class="text-accent">breaks quietly.</span>
      <x-slot:lede>WordPress is not set and forget. Without regular care, small problems stack up until one of them takes the site down, lets someone in or loses you a lead.</x-slot:lede>
    </x-section-head>
    <div class="rm-probs rm-grid">
      @foreach ($problems as $problem)
        <article class="rm-prob fx-spot">
          <div class="rm-prob-ico" aria-hidden="true">{!! $problem['icon'] !!}</div>
          <span class="rm-num">0{{ $loop->iteration }}</span>
          <h3>{{ $problem['title'] }}</h3>
          <p>{{ $problem['text'] }}</p>
        </article>
      @endforeach
    </div>
  </div>
</section>
