<!-- TESTIMONIALS -->
<section class="h-paper border-t border-line py-sec" data-reveal>
  <div class="wrap">
    <x-section-head tag="Wall of love" tone="paper">Don't just take my word for it.</x-section-head>
    <div class="h-quotes">
      @foreach ($testimonials as $testimonial)
        <figure @class(['h-quote', 'h-quote--big' => $testimonial['big']]) style="margin:0">
          <blockquote>{{ $testimonial['quote'] }}</blockquote>
          <figcaption class="h-quote-by"><img src="{{ $testimonial['image'] }}" alt="{{ $testimonial['name'] }}" loading="lazy"><div><b>{{ $testimonial['name'] }}</b><span>{{ $testimonial['company'] }}</span></div></figcaption>
        </figure>
      @endforeach
    </div>
    <div class="h-wol-more"><x-link :href="$reviewsUrl" tone="paper" target="_blank" rel="noopener">Read more client reviews on Fiverr &#8599;</x-link></div>
  </div>
</section>
