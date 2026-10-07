<!-- TESTIMONIALS -->
<section class="border-t border-line bg-paper py-sec text-paper-text" data-reveal>
  <div class="wrap">
    <x-section-head tag="Wall of love" tone="paper">Don't just take my word for it.</x-section-head>
    {{-- h-quotes: JS hook (staggered reveal). --}}
    <div class="h-quotes grid grid-cols-[1.3fr_1fr] gap-4.5 max-md:grid-cols-1">
      @foreach ($testimonials as $testimonial)
        @php($big = $testimonial['big'])
        <figure @class([
          'm-0 flex flex-col gap-5.5 rounded-lg border p-8 max-md:p-6',
          'border-paper-line bg-[#fbfaf7]' => ! $big,
          'row-span-2 border-paper-ink bg-paper-ink max-md:row-auto' => $big,
        ])>
          <blockquote @class([
            'm-0 font-sans font-normal max-md:text-[16px]',
            'text-[17px]/[1.6] text-[#34332e]' => ! $big,
            'text-[clamp(19px,1.8vw,23px)]/[1.5] tracking-[-.01em] text-ink' => $big,
          ])>{{ $testimonial['quote'] }}</blockquote>
          <figcaption class="mt-auto flex items-center gap-3"><img class="size-11 rounded-full object-cover" src="{{ $testimonial['image'] }}" alt="{{ $testimonial['name'] }}" loading="lazy"><div><b @class(['block font-sans text-[15px]/[1.2] font-medium', 'text-paper-ink' => ! $big, 'text-ink' => $big])>{{ $testimonial['name'] }}</b><span @class(['font-mono text-[12px] leading-[normal] font-medium', 'text-[#77766f]' => ! $big, 'text-muted' => $big])>{{ $testimonial['company'] }}</span></div></figcaption>
        </figure>
      @endforeach
    </div>
    <div class="mt-7"><x-link :href="$reviewsUrl" tone="paper" target="_blank" rel="noopener">Read more client reviews on Fiverr &#8599;</x-link></div>
  </div>
</section>
