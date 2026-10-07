<!-- CONTACT -->
<section id="contact" class="h-cta">
  <div class="aws-wrap h-cta-grid">
    <div data-reveal>
      <x-tag dot>Let&#039;s talk</x-tag>
      <h2>Let's turn your website into your <span class="hl">best salesperson.</span></h2>
      <p>Tell me about your business and what you're trying to build. I'll reply within a day with an honest take on the most efficient way to get there.</p>
      <ul class="h-cta-list">
        <li><b>01</b>A short call to understand your goals</li>
        <li><b>02</b>A clear plan, timeline and quote for your requirements</li>
        <li><b>03</b>Build, launch and keep improving together</li>
      </ul>
      <div class="h-cta-alt">
        <div class="row"><a class="aws-btn aws-btn--ghost" href="{{ $callUrl }}" target="_blank" rel="noopener">Book a call on Calendly</a></div>
        <div class="row aws-soc-row">
          @foreach ($socials as $social)<a class="aws-soc" href="{{ $social['url'] }}" target="_blank" rel="noopener" aria-label="{{ $social['label'] }}" title="{{ $social['label'] }}">{!! $social['icon'] !!}</a>@endforeach
        </div>
      </div>
    </div>
    <div class="aws-form-card aws-contact-form" data-reveal>
      {!! do_shortcode($contactForm) !!}
    </div>
  </div>
</section>
