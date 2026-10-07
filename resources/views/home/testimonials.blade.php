<!-- TESTIMONIALS -->
<section class="aws-sec h-paper" data-reveal>
  <div class="aws-wrap">
    <div class="aws-sec-head">
      <x-tag>Wall of love</x-tag>
      <h2>Don't just take my word for it.</h2>
    </div>
    <div class="h-quotes">
      @foreach ($testimonials as $testimonial)
        <figure @class(['h-quote', 'h-quote--big' => $testimonial['big']]) style="margin:0">
          <blockquote>{{ $testimonial['quote'] }}</blockquote>
          <figcaption class="h-quote-by"><img src="{{ $testimonial['image'] }}" alt="{{ $testimonial['name'] }}" loading="lazy"><div><b>{{ $testimonial['name'] }}</b><span>{{ $testimonial['company'] }}</span></div></figcaption>
        </figure>
      @endforeach
    </div>
    <div class="h-wol-more"><a class="aws-link" href="{{ $reviewsUrl }}" target="_blank" rel="noopener">Read more client reviews on Fiverr &#8599;</a></div>
  </div>
</section>
