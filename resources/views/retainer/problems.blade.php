<section class="aws-sec">
  <div class="aws-wrap">
    <div class="aws-sec-head">
      <x-tag>The problem</x-tag>
      <h2>An unmaintained site <span class="hl">breaks quietly.</span></h2>
      <p>WordPress is not set and forget. Without regular care, small problems stack up until one of them takes the site down, lets someone in or loses you a lead.</p>
    </div>
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
